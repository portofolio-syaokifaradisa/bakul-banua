<?php

namespace App\Http\Controllers;

use App\Http\Requests\UmkmRequest;
use App\Models\Product;
use App\Models\Umkm;
use App\Services\ProductService;
use App\Services\UmkmService;
use Illuminate\Http\Request;

class UMKMController extends Controller
{
    private $service;
    private $productService;
    public function __construct(UmkmService $service, ProductService $productService)
    {
        $this->service = $service;
        $this->productService = $productService;
    }

    public function index()
    {
        return view('umkm.index');
    }

    public function create()
    {
        return view('umkm.create');
    }

    public function store(UmkmRequest $request)
    {
        if ($this->service->save(
            $request->name,
            $request->since,
            $request->nib,
            isset($request->has_bpom),
            isset($request->has_pirt),
            isset($request->has_halal),
            $request->address,
            $request->owner,
            $request->phone,
            $request->email,
            $request->password
        )) {
            return to_route('umkm.index')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function detail($id)
    {
        $umkm = Umkm::find($id);
        return view('umkm.detail', compact('umkm'));
    }

    public function edit($id)
    {
        $umkm = Umkm::find($id);
        return view('umkm.create', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        if ($this->service->update(
            $id,
            $request->name,
            $request->since,
            $request->nib,
            isset($request->has_bpom),
            isset($request->has_pirt),
            isset($request->has_halal),
            $request->address,
            $request->owner,
            $request->phone,
            $request->email,
            $request->password
        )) {
            return to_route('umkm.index')->with('success', 'DData Berhasil Diperbaharui!');
        } else {
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function datatable(Request $request)
    {
        return $this->service->umkm_datatable($request);
    }

    public function productCreate($umkm_id)
    {
        return view('umkm.product_create', compact('umkm_id'));
    }

    public function productStore(Request $request, $umkm_id)
    {
        if ($this->productService->save($umkm_id, $request->name, $request->price, $request->description, $request->picture)) {
            return to_route('umkm.detail', ['umkm_id' => $umkm_id])->with('success', 'Data Produk Berhasil Disimpan');
        } else {
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function productEdit($umkm_id, $id)
    {
        $product = Product::find($id);
        return view('umkm.product_create', compact('umkm_id', 'product'));
    }

    public function productUpdate(Request $request, $umkm_id, $id)
    {
        if ($this->productService->update($umkm_id, $id, $request->name, $request->price, $request->description, $request->picture)) {
            return to_route('umkm.detail', ['umkm_id' => $umkm_id])->with('success', 'Data Produk Berhasil Diperbaharui');
        } else {
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function productDelete($umkm_id, $id)
    {
        return $this->productService->delete_product($id);
    }

    public function productDatatable(Request $request, $umkm_id)
    {
        return $this->productService->product_datatable($request, $umkm_id);
    }
}
