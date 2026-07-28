<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\PaymentPlan;
use Modules\Superadmin\Entities\Package;
use Modules\Superadmin\Entities\Subscription;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;

class PaymentController extends Controller
{
    public function index(){

        // $this->validaBusiness();
        $planos = Package::orderby('name', 'desc')
        ->where('is_active', true)
        ->where('is_visible', true)
        ->get();

        return view('payment.index', compact('planos'));
    }

    private function validaBusiness(){
        $business_id = request()->session()->get('user.business_id');
        $business = Business::findorfail($business_id);

        if($business->cep == "" || $business->rua == "" || $business->numero == "" || $business->bairro == "" ||    $business->cidade_id == null){
            $output = [
                'success' => 0,
                'msg' => "Informe o endereço completo."
            ];
            return redirect()->route('business.getBusinessSettings')->with('status', $output);
        }
    }

    public function paymentPix(Request $request){
        MercadoPagoConfig::setAccessToken(getenv("MERCADOPAGO_ACCESS_TOKEN"));
        $client = new PaymentClient();

        $plano = Package::findOrFail($request->plano_id);

        $doc = preg_replace('/[^0-9]/', '', $request->docNumber);

        $business_id = request()->session()->get('user.business_id');
        $business = Business::findorfail($business_id);

        $firstBusiness = Business::first();

        $paymentRequest = [
            "transaction_amount" => (float)$plano->price,
            "description" => '',
            "payment_method_id" => "pix",
            "payer" => [
                "email" => $request->payerEmail,
                "first_name" => $request->payerFirstName,
                "last_name" => $request->payerLastName,
                "identification" => [
                    "type" => $request->docType,
                    "number" => $doc
                ],
                "address" => [
                    "zip_code" => $business->cep != "*" ? $business->cep : $firstBusiness->cep,
                    "street_name" => $business->rua != "*" ? $business->rua : $firstBusiness->rua,
                    "street_number" => $business->numero != "*" ? $business->numero : $firstBusiness->numero,
                    "neighborhood" => $business->bairro != "*" ? $business->bairro : $firstBusiness->bairro,
                    "city" => $business->cidade_id != null ? $business->cidade->nome : $firstBusiness->cidade->nome,
                    "federal_unit" => $business->cidade_id != null ? $business->cidade->uf : $firstBusiness->cidade->uf
                ]
            ]
        ];

        try {
            $payment = $client->create($paymentRequest);
        } catch (MPApiException $e) {
            $output = [
                'success' => 0,
                'msg' => "Ocorreu um erro no pagamento."
            ];
            return redirect()->back()->with('status', $output);
        }

        if($payment->transaction_details){
            $data = [
                'payerFirstName' => $request->payerFirstName,
                'payerLastName' => $request->payerLastName,
                'payerEmail' => $request->payerEmail,
                'docNumber' => $doc,
                'valor' => (float)$plano->price,
                'transacao_id' => (string)$payment->id,
                'status' => $payment->status,
                'forma_pagamento' => 'pix',
                'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
                'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
                'link_boleto' => '',
                'numero_cartao' => '',
                'package_id' => $plano->id,
                'business_id' => $business_id
            ];
            PaymentPlan::create($data);
            $output = [
                'success' => 1,
                'msg' => "Qrcode gerado escaneie ou copie o código para efetuar o pagamento."
            ];
            return redirect('/payment/finish/' . (string)$payment->id)
            ->with('status', $output);
        }else{
            $output = [
                'success' => 0,
                'msg' => "Ocorreu um erro no pagamento."
            ];
            return redirect()->back()->with('status', $output);
        }

    }

    protected function setaPlano($paymentPlan){
        $package = Package::findOrFail($paymentPlan->package_id);

        $business = Business::findorfail($paymentPlan->business_id);
        $dates = $this->_get_package_dates($business->id, $package);

        $subscription = [
            'business_id' => $business->id,
            'package_id' => $package->id,
            'paid_via' => 'mercado_pago',
            'payment_transaction_id' => $paymentPlan->transacao_id,
            'start_date' => $dates['start'],
            'end_date' => $dates['end'],
            'trial_end_date' => $dates['trial'],
            'status' => 'approved',
        ];

        $subscription['package_price'] = $package->price;
        $subscription['package_details'] = [
            'location_count' => $package->location_count,
            'user_count' => $package->user_count,
            'product_count' => $package->product_count,
            'invoice_count' => $package->invoice_count,
            'name' => $package->name
        ];
        Subscription::create($subscription);
    }

    protected function _get_package_dates($business_id, $package)
    {
        $output = ['start' => '', 'end' => '', 'trial' => ''];

        //calculate start date
        $start_date = Subscription::end_date($business_id);
        $output['start'] = $start_date->toDateString();

        //Calculate end date
        if ($package->interval == 'days') {
            $output['end'] = $start_date->addDays($package->interval_count)->toDateString();
        } elseif ($package->interval == 'months') {
            $output['end'] = $start_date->addMonths($package->interval_count)->toDateString();
        } elseif ($package->interval == 'years') {
            $output['end'] = $start_date->addYears($package->interval_count)->toDateString();
        }
        
        $output['trial'] = $start_date->addDays($package->trial_days);

        return $output;
    }

    public function finish($transaction_id){
        $paymentPlan = PaymentPlan::where('transacao_id', $transaction_id)->first();
        return view('payment/finish', compact('paymentPlan'));
    }

    public function consultaPix($transacao_id){
        MercadoPagoConfig::setAccessToken(getenv("MERCADOPAGO_ACCESS_TOKEN"));
        $paymentPlan = PaymentPlan::where('transacao_id', $transacao_id)
        ->first();

        if($paymentPlan){
            $client = new PaymentClient();
            try {
                $payStatus = $client->get((int)$paymentPlan->transacao_id);
            } catch (MPApiException $e) {
                return response()->json($paymentPlan->status);
            }

            // $payStatus->status = "approved";

            if($payStatus->status == "approved" && $paymentPlan->status != $payStatus->status){
                $this->setaPlano($paymentPlan);
            }
            // $paymentPlan->status = $payStatus->status;

            $paymentPlan->save();

            return response()->json($payStatus->status);

        }else{
            return response()->json("erro", 401);
        }

    }

    public function paymentBoleto(Request $request){
        MercadoPagoConfig::setAccessToken(getenv("MERCADOPAGO_ACCESS_TOKEN"));
        $client = new PaymentClient();

        $plano = Package::findOrFail($request->plano_id);

        $doc = preg_replace('/[^0-9]/', '', $request->docNumber);

        $business_id = request()->session()->get('user.business_id');
        $business = Business::findorfail($business_id);

        $firstBusiness = Business::first();

        $paymentRequest = [
            "transaction_amount" => number_format($plano->price, 2),
            "description" => '',
            "payment_method_id" => "bolbradesco",
            "payer" => [
                "email" => $request->payerEmail,
                "first_name" => $request->payerFirstName,
                "last_name" => $request->payerLastName,
                "identification" => [
                    "type" => $request->docType,
                    "number" => $doc
                ],
                "address" => [
                    "zip_code" => $business->cep != "*" ? $business->cep : $firstBusiness->cep,
                    "street_name" => $business->rua != "*" ? $business->rua : $firstBusiness->rua,
                    "street_number" => $business->numero != "*" ? $business->numero : $firstBusiness->numero,
                    "neighborhood" => $business->bairro != "*" ? $business->bairro : $firstBusiness->bairro,
                    "city" => $business->cidade_id != null ? $business->cidade->nome : $firstBusiness->cidade->nome,
                    "federal_unit" => $business->cidade_id != null ? $business->cidade->uf : $firstBusiness->cidade->uf
                ]
            ]
        ];

        try {
            $payment = $client->create($paymentRequest);
        } catch (MPApiException $e) {
            $output = [
                'success' => 0,
                'msg' => "Ocorreu um erro no pagamento."
            ];
            return redirect()->back()->with('status', $output);
        }

        if($payment->transaction_details){
            $data = [
                'payerFirstName' => $request->payerFirstName,
                'payerLastName' => $request->payerLastName,
                'payerEmail' => $request->payerEmail,
                'docNumber' => $doc,
                'valor' => (float)$plano->price,
                'transacao_id' => (string)$payment->id,
                'status' => $payment->status,
                'forma_pagamento' => 'boleto',
                'qr_code_base64' => '',
                'qr_code' => '',
                'link_boleto' => $payment->transaction_details->external_resource_url,
                'numero_cartao' => '',
                'package_id' => $plano->id,
                'business_id' => $business_id
            ];
            $paymentPlan = PaymentPlan::create($data);

            $this->setaPlano($paymentPlan);
            $output = [
                'success' => 1,
                'msg' => "Boleto gerado com sucesso."
            ];
            return redirect('/payment/finish/' . (string)$payment->id)
            ->with('status', $output);
        }else{
            $output = [
                'success' => 0,
                'msg' => "Ocorreu um erro no pagamento."
            ];
            return redirect()->back()->with('status', $output);
        }

    }

    public function consultaValorPlano($id){
        $plano = Package::findOrFail($id);
        if($plano){
            return response()->json(number_format($plano->price,2));
        }
    }

    public function paymentCartao(Request $request){
        MercadoPagoConfig::setAccessToken(getenv("MERCADOPAGO_ACCESS_TOKEN"));
        $client = new PaymentClient();

        $business_id = request()->session()->get('user.business_id');
        $business = Business::findorfail($business_id);

        $plano = Package::findOrFail($request->plano_id);

        $doc = preg_replace('/[^0-9]/', '', $request->docNumber);

        $paymentRequest = [
            "transaction_amount" => number_format($plano->price, 2),
            "token" => $request->token,
            "description" => 'Pagamento de plano',
            "payment_method_id" => $request->paymentMethodId,
            "installments" => (int)$request->installments,
            "payer" => [
                "email" => $request->payerEmail,
                "identification" => [
                    "type" => $request->docType,
                    "number" => $request->docNumber
                ]
            ]
        ];

        try {
            $payment = $client->create($paymentRequest);
        } catch (MPApiException $e) {
            $output = [
                'success' => 0,
                'msg' => $e->getApiResponse()->getContent()['message'] ?? "Ocorreu um erro no pagamento."
            ];
            return redirect()->back()->with('status', $output);
        }

        $data = [
            'payerFirstName' => $request->cardholderName,
            'payerLastName' => '',
            'payerEmail' => $request->payerEmail,
            'docNumber' => $doc,
            'valor' => (float)$plano->price,
            'transacao_id' => (string)$payment->id,
            'status' => $payment->status,
            'forma_pagamento' => 'cartao',
            'qr_code_base64' => '',
            'qr_code' => '',
            'link_boleto' => '',
            'numero_cartao' => $request->cardNumber,
            'package_id' => $plano->id,
            'business_id' => $business_id
        ];
        PaymentPlan::create($data);
        $output = [
            'success' => 1,
            'msg' => "Boleto gerado com sucesso."
        ];
        return redirect('/payment/finish/' . (string)$payment->id)
        ->with('status', $output);
    }
}
