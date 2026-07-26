<div class="pos-tab-content active">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'name', 'value' => __('business.business_name') . ':*'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                @php
                $__f2 = ['name' => 'name', 'value' => $business->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('business.business_name')]];
                @endphp
                <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f3 = ['name' => 'razao_social', 'value' => __('business.business_razao') . ':*'];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'razao_social', 'value' => $business->razao_social, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('business.business_razao'), 'minlength' => '10']];
                @endphp
                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f5 = ['name' => 'start_date', 'value' => 'Data de início:'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    
                    @php
                    $__f6 = ['name' => 'start_date', 'value' => \Carbon::createFromTimestamp(strtotime($business->start_date))->format(session('business.date_format')), 'options' => ['class' => 'form-control start-date-picker','placeholder' => __('business.start_date'), 'readonly']];
                    @endphp
                    <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f7 = ['name' => 'default_profit_percent', 'value' => __('business.default_profit_percent') . ':*'];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" /> @show_tooltip(__('tooltip.default_profit_percent'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    @php
                    $__f8 = ['name' => 'default_profit_percent', 'value' => number_format($business->default_profit_percent, 2, ',', '.'), 'options' => ['class' => 'form-control input_number']];
                    @endphp
                    <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f9 = ['name' => 'currency_id', 'value' => __('business.currency') . ':'];
                @endphp
                <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    @php
                    $__f10 = ['name' => 'currency_id', 'list' => $currencies, 'selected' => $business->currency_id, 'options' => ['class' => 'form-control select2','placeholder' => __('business.currency'), 'required']];
                    @endphp
                    <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                @php
                $__f11 = ['name' => 'currency_symbol_placement', 'value' => __('lang_v1.currency_symbol_placement') . ':'];
                @endphp
                <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                @php
                $__f12 = ['name' => 'currency_symbol_placement', 'list' => ['before' => __('lang_v1.before_amount'), 'after' => __('lang_v1.after_amount')], 'selected' => $business->currency_symbol_placement, 'options' => ['class' => 'form-control select2', 'required']];
                @endphp
                <x-form.select :name="$__f12['name']" :list="$__f12['list']" :selected="$__f12['selected']" :options="$__f12['options']" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                @php
                $__f13 = ['name' => 'time_zone', 'value' => __('business.time_zone') . ':'];
                @endphp
                <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-clock"></i>
                    </span>
                    @php
                    $__f14 = ['name' => 'time_zone', 'list' => $timezone_list, 'selected' => $business->time_zone, 'options' => ['class' => 'form-control select2', 'required']];
                    @endphp
                    <x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f15 = ['name' => 'business_logo', 'value' => __('business.upload_logo') . ':'];
                @endphp
                <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                @php
                $__f16 = ['name' => 'business_logo', 'options' => ['accept' => 'image/jpeg']];
                @endphp
                <x-form.input type="file" :name="$__f16['name']" :options="$__f16['options']" />
                <p class="help-block"><i> @lang('business.logo_help')</i></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                @php
                $__f17 = ['name' => 'fy_start_month', 'value' => __('business.fy_start_month') . ':'];
                @endphp
                <x-form.label :name="$__f17['name']" :value="$__f17['value']" /> @show_tooltip(__('tooltip.fy_start_month'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    @php
                    $__f18 = ['name' => 'fy_start_month', 'list' => $months, 'selected' => $business->fy_start_month, 'options' => ['class' => 'form-control select2', 'required']];
                    @endphp
                    <x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f19 = ['name' => 'accounting_method', 'value' => __('business.accounting_method') . ':*'];
                @endphp
                <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
                @show_tooltip(__('tooltip.accounting_method'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calculator"></i>
                    </span>
                    @php
                    $__f20 = ['name' => 'accounting_method', 'list' => $accounting_methods, 'selected' => $business->accounting_method, 'options' => ['class' => 'form-control select2', 'required']];
                    @endphp
                    <x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f21 = ['name' => 'transaction_edit_days', 'value' => __('business.transaction_edit_days') . ':*'];
                @endphp
                <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
                @show_tooltip(__('tooltip.transaction_edit_days'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-edit"></i>
                    </span>
                    @php
                    $__f22 = ['name' => 'transaction_edit_days', 'value' => $business->transaction_edit_days, 'options' => ['class' => 'form-control','placeholder' => __('business.transaction_edit_days'), 'required']];
                    @endphp
                    <x-form.input type="number" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f23 = ['name' => 'date_format', 'value' => __('lang_v1.date_format') . ':*'];
                @endphp
                <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    @php
                    $__f24 = ['name' => 'date_format', 'list' => $date_formats, 'selected' => $business->date_format, 'options' => ['class' => 'form-control select2', 'required']];
                    @endphp
                    <x-form.select :name="$__f24['name']" :list="$__f24['list']" :selected="$__f24['selected']" :options="$__f24['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f25 = ['name' => 'time_format', 'value' => __('lang_v1.time_format') . ':*'];
                @endphp
                <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-clock"></i>
                    </span>
                    @php
                    $__f26 = ['name' => 'time_format', 'list' => [12 => __('lang_v1.12_hour'), 24 => __('lang_v1.24_hour')], 'selected' => $business->time_format, 'options' => ['class' => 'form-control select2', 'required']];
                    @endphp
                    <x-form.select :name="$__f26['name']" :list="$__f26['list']" :selected="$__f26['selected']" :options="$__f26['options']" />
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                @php
                $__f27 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
                @endphp
                <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
                <div class="input-group" style="width: 100%;">

                    @php
                    $__f28 = ['name' => 'tipo', 'list' => ['j' => 'Juridica', 'f' => 'Fisica'], 'selected' => $pessoa, 'options' => ['class' => 'form-control']];
                    @endphp
                    <x-form.select :name="$__f28['name']" :list="$__f28['list']" :selected="$__f28['selected']" :options="$__f28['options']" />
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f29 = ['name' => 'cnpj', 'value' => 'CPF/CNPJ' . ':*'];
                @endphp
                <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
                @php
                $__f30 = ['name' => 'cnpj', 'value' => $business->cnpj, 'options' => ['class' => 'form-control', 'required', 'data-mask="00.000.000/0000-00"', 'placeholder' => 'CNPJ']];
                @endphp
                <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f31 = ['name' => 'ie', 'value' => 'IE' . ':*'];
                @endphp
                <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
                @php
                $__f32 = ['name' => 'ie', 'value' => $business->ie, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'IE']];
                @endphp
                <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="certificado">Certificado:</label>
                <input name="certificado" type="file" id="certificado">
                <p class="help-block"><i>O Certificado anterior (se existir) será substituído</i></p>
            </div>
        </div>

        @if($infoCertificado != null && $infoCertificado != -1)
        <h5>Serial: <strong>{{$infoCertificado['serial']}}</strong></h5>
        <h5>Expiração: <strong>{{$infoCertificado['expiracao']}}</strong></h5>
        <h5>ID: <strong>{{$infoCertificado['id']}}</strong></h5>
        @endif

        @if($infoCertificado == -1)
        <h5 style="color: red">Erro na leitura do certificado, verifique a senha e outros dados, e realize o upload novamente!!</h5>
        @endif


        <div class="clearfix"></div>

        <div class="col-sm-2">
            <div class="form-group">
                @php
                $__f33 = ['name' => 'senha_certificado', 'value' => 'Senha' . ':*'];
                @endphp
                <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
                @php
                $__f34 = ['name' => 'senha_certificado', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Senha']];
                @endphp
                <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-6">
            <div class="form-group">
                @php
                $__f35 = ['name' => 'rua', 'value' => 'Rua' . ':*'];
                @endphp
                <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
                @php
                $__f36 = ['name' => 'rua', 'value' => $business->rua, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Rua']];
                @endphp
                <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                @php
                $__f37 = ['name' => 'numero', 'value' => 'Número' . ':*'];
                @endphp
                <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
                @php
                $__f38 = ['name' => 'numero', 'value' => $business->numero, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Número']];
                @endphp
                <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
            </div>
        </div>
        <div class="col-md-4 customer_fields">
            <div class="form-group">
                @php
                $__f39 = ['name' => 'cidade_id', 'value' => 'Cidade:*'];
                @endphp
                <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
                @php
                $__f40 = ['name' => 'cidade_id', 'list' => $cities, 'selected' => $business->cidade_id, 'options' => ['class' => 'form-control select2', 'required']];
                @endphp
                <x-form.select :name="$__f40['name']" :list="$__f40['list']" :selected="$__f40['selected']" :options="$__f40['options']" />
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f41 = ['name' => 'bairro', 'value' => 'Bairro' . ':*'];
                @endphp
                <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
                @php
                $__f42 = ['name' => 'bairro', 'value' => $business->bairro, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Bairro']];
                @endphp
                <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f43 = ['name' => 'cep', 'value' => 'CEP' . ':*'];
                @endphp
                <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
                @php
                $__f44 = ['name' => 'cep', 'value' => $business->cep, 'options' => ['class' => 'form-control', 'required', 'data-mask="00000-000"', 'placeholder' => 'CEP']];
                @endphp
                <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f45 = ['name' => 'telefone', 'value' => 'Telefone' . ':*'];
                @endphp
                <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
                @php
                $__f46 = ['name' => 'telefone', 'value' => $business->telefone, 'options' => ['class' => 'form-control', 'required', 'data-mask="00 000000000"', 'placeholder' => 'Telefone']];
                @endphp
                <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">

                @php
                $__f47 = ['name' => 'regime', 'value' => 'Regime' . ':'];
                @endphp
                <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
                @php
                $__f48 = ['name' => 'regime', 'list' => ['1' => 'Simples', '3' => 'Normal'], 'selected' => $business->regime, 'options' => ['class' => 'form-control select2', 'required']];
                @endphp
                <x-form.select :name="$__f48['name']" :list="$__f48['list']" :selected="$__f48['selected']" :options="$__f48['options']" />
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f49 = ['name' => 'ultimo_numero_nfe', 'value' => 'Ultimo Núm. NFe' . ':*'];
                @endphp
                <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
                @php
                $__f50 = ['name' => 'ultimo_numero_nfe', 'value' => $business->ultimo_numero_nfe, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. NFe']];
                @endphp
                <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f51 = ['name' => 'ultimo_numero_nfce', 'value' => 'Ultimo Núm. NFCe' . ':*'];
                @endphp
                <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
                @php
                $__f52 = ['name' => 'ultimo_numero_nfce', 'value' => $business->ultimo_numero_nfce, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. NFCe']];
                @endphp
                <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f53 = ['name' => 'inscricao_municipal', 'value' => 'Inscrição municipal' . ':*'];
                @endphp
                <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
                @php
                $__f54 = ['name' => 'inscricao_municipal', 'value' => $business->inscricao_municipal, 'options' => ['class' => 'form-control', 'placeholder' => 'Inscrição municipal']];
                @endphp
                <x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f55 = ['name' => 'numero_serie_nfe', 'value' => 'Núm. Série NFe' . ':*'];
                @endphp
                <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
                @php
                $__f56 = ['name' => 'numero_serie_nfe', 'value' => $business->numero_serie_nfe, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Núm. Série NF-e']];
                @endphp
                <x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f57 = ['name' => 'numero_serie_nfce', 'value' => 'Núm. Série NFCe' . ':*'];
                @endphp
                <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
                @php
                $__f58 = ['name' => 'numero_serie_nfce', 'value' => $business->numero_serie_nfce, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Núm. Série NFC-e']];
                @endphp
                <x-form.input type="text" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">

                @php
                $__f59 = ['name' => 'ambiente', 'value' => 'Ambiente' . ':'];
                @endphp
                <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
                @php
                $__f60 = ['name' => 'ambiente', 'list' => ['1' => 'Produção', '2' => 'Homologação'], 'selected' => $business->ambiente, 'options' => ['class' => 'form-control select2', 'required']];
                @endphp
                <x-form.select :name="$__f60['name']" :list="$__f60['list']" :selected="$__f60['selected']" :options="$__f60['options']" />
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f61 = ['name' => 'csc_id', 'value' => 'CSCID' . ':*'];
                @endphp
                <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
                @php
                $__f62 = ['name' => 'csc_id', 'value' => $business->csc_id, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CSCID']];
                @endphp
                <x-form.input type="text" :name="$__f62['name']" :value="$__f62['value']" :options="$__f62['options']" />
            </div>
        </div>

        <div class="col-sm-5">
            <div class="form-group">
                @php
                $__f63 = ['name' => 'csc', 'value' => 'CSC' . ':*'];
                @endphp
                <x-form.label :name="$__f63['name']" :value="$__f63['value']" />
                @php
                $__f64 = ['name' => 'csc', 'value' => $business->csc, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CSC']];
                @endphp
                <x-form.input type="text" :name="$__f64['name']" :value="$__f64['value']" :options="$__f64['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f65 = ['name' => 'aut_xml', 'value' => 'AUT XML' . ':'];
                @endphp
                <x-form.label :name="$__f65['name']" :value="$__f65['value']" />
                @php
                $__f66 = ['name' => 'aut_xml', 'value' => $business->aut_xml, 'options' => ['class' => 'form-control cnpj', 'placeholder' => 'AUT XML']];
                @endphp
                <x-form.input type="text" :name="$__f66['name']" :value="$__f66['value']" :options="$__f66['options']" />
            </div>
        </div>

    </div>
</div>

