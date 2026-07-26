<?php

namespace App\Http\Controllers;

use App\Models\CarrosselEcommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CarrosselController extends Controller
{
    public function index(Request $request)
    {
        $this->authorizeView();

        if ($request->ajax()) {
            $items = CarrosselEcommerce::query()
                ->where('business_id', $this->businessId($request))
                ->select(['id', 'titulo', 'link_acao', 'img']);

            return DataTables::of($items)
                ->addColumn('img', function (CarrosselEcommerce $item) {
                    return '<img src="'.e($item->image_url).'" alt="" width="64" height="40" style="object-fit:cover">';
                })
                ->addColumn('action', function (CarrosselEcommerce $item) {
                    return '<a href="/carrosselEcommerce/edit/'.$item->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> '.e(__('messages.edit')).'</a> '
                        .'<button data-href="/carrosselEcommerce/delete/'.$item->id.'" class="btn btn-xs btn-danger delete_user_button"><i class="glyphicon glyphicon-trash"></i> '.e(__('messages.delete')).'</button>';
                })
                ->rawColumns(['img', 'action'])
                ->make(true);
        }

        return view('carrossel.list');
    }

    public function create()
    {
        $this->authorizeManage();

        return view('carrossel.create');
    }

    public function store(Request $request)
    {
        $this->authorizeManage();
        $data = $this->validatedData($request);
        $data['business_id'] = $this->businessId($request);
        $data['img'] = $this->storeImage($request);

        CarrosselEcommerce::create($data);

        return redirect('/carrosselEcommerce')->with('status', [
            'success' => true,
            'msg' => __('messages.success'),
        ]);
    }

    public function edit(Request $request, $id)
    {
        $this->authorizeManage();

        return view('carrossel.edit', [
            'carrossel' => $this->findForBusiness($request, $id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorizeManage();
        $item = $this->findForBusiness($request, $id);
        $data = $this->validatedData($request, true);

        if ($request->hasFile('image')) {
            $this->deleteImage($item->img);
            $data['img'] = $this->storeImage($request);
        }

        $item->update($data);

        return redirect('/carrosselEcommerce')->with('status', [
            'success' => true,
            'msg' => __('messages.success'),
        ]);
    }

    public function delete(Request $request, $id)
    {
        $this->authorizeManage();
        $item = $this->findForBusiness($request, $id);
        $this->deleteImage($item->img);
        $item->delete();

        return response()->json(['success' => true, 'msg' => __('messages.success')]);
    }

    private function validatedData(Request $request, bool $updating = false): array
    {
        $imageRule = $updating ? 'nullable' : 'required';

        $data = $request->validate([
            'titulo' => 'required|string|max:30',
            'descricao' => 'required|string|max:200',
            'link_acao' => 'required|string|max:200',
            'nome_botao' => 'required|string|max:20',
            'cor_fundo' => 'nullable|string|size:7',
            'image' => [$imageRule, 'image', 'max:5120'],
        ]);

        unset($data['image']);
        $data['cor_fundo'] = $data['cor_fundo'] ?? '#000000';

        return $data;
    }

    private function storeImage(Request $request): string
    {
        $directory = public_path('uploads/img/carrossel');
        File::ensureDirectoryExists($directory);
        $file = $request->file('image');
        $filename = $file->hashName();

        $file->move($directory, $filename);

        return $filename;
    }

    private function deleteImage(?string $filename): void
    {
        if ($filename) {
            File::delete(public_path('uploads/img/carrossel/'.$filename));
        }
    }

    private function findForBusiness(Request $request, $id): CarrosselEcommerce
    {
        return CarrosselEcommerce::where('business_id', $this->businessId($request))->findOrFail($id);
    }

    private function businessId(Request $request): int
    {
        return (int) $request->session()->get('user.business_id');
    }

    private function authorizeView(): void
    {
        if (! auth()->user()->can('user.view') && ! auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function authorizeManage(): void
    {
        if (! auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }
    }
}
