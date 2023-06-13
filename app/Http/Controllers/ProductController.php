<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Models\Umkm;

class ProductController extends Controller
{
    private $service;
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        $umkm = [];
        if (Auth::guard('web')->check()) {
            $umkm = Umkm::orderBy('name')->get();
        }

        return view('product.create', compact('umkm'));
    }

    public function store(ProductRequest $request)
    {
        $umkm_id = Auth::guard('web')->check() ? $request->umkm_id : Auth::guard('umkm')->user()->id;
        if ($this->service->save($umkm_id, $request->name, $request->price, $request->description, $request->picture)) {
            return to_route('product.index')->with('success', 'Data Produk Berhasil Disimpan');
        } else {
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function detail($id)
    {
        return view('product.detail');
    }

    public function edit($id)
    {
        $umkm = [];
        if (Auth::guard('web')->check()) {
            $umkm = Umkm::orderBy('name')->get();
        }
        return view('product.create', [
            'product' => Product::with('product_picture')->find($id),
            'umkm' => $umkm
        ]);
    }

    public function update(Request $request, $id)
    {
        $umkm_id = Auth::guard('web')->check() ? $request->umkm_id : Auth::guard('umkm')->user()->id;
        if ($this->service->update($umkm_id, $id, $request->name, $request->price, $request->description, $request->picture)) {
            return to_route('product.index')->with('success', 'Data Produk Berhasil Diperbaharui');
        } else {
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function delete($id)
    {
        return $this->service->delete_product($id);
    }

    public function datatable(Request $request)
    {
        if (Auth::guard('umkm')->check()) {
            $umkm_id = Auth::guard('umkm')->user()->id;
            return $this->service->product_datatable($request, $umkm_id);
        } else {
            return $this->service->admin_product_datatable($request);
        }
    }
}
