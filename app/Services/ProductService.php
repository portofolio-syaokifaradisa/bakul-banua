<?php

namespace App\Services;

use Exception;
use App\Models\Product;
use App\Models\ProductPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService{
    private function uploadProductPictures($pictures, $umkm_id, $product_id){
        try{
            $paths = ProductPicture::where('product_id', $product_id)->pluck('path');
            ProductPicture::where('product_id', $product_id)->delete();

            $num = 1;
            foreach($pictures as $picture){
                $extension = explode('.', $picture->getClientOriginalName())[1];

                $fileName = "Foto Produk $num.$extension";        
                $path = "product_image/$umkm_id/$product_id/";
                $picture->move(public_path($path), $fileName);
                $num++;

                ProductPicture::create([
                    'path' => $path."/".$fileName,
                    'product_id' => $product_id
                ]);
            }

            foreach($paths as $path){
                unlink($path);
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function save($umkm_id, $name, $price, $description, $pictures){
        try{
            DB::beginTransaction();
            $product = Product::create([
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'umkm_id' => $umkm_id
            ]);

            $this->uploadProductPictures($pictures, $umkm_id, $product->id);
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function update($umkm_id, $product_id, $name, $price, $description, $pictures){
        try{
            DB::beginTransaction();
            $product = Product::find($product_id);
            $product->name = $name;
            $product->price = $price;
            $product->description = $description;
            $product->save();

            if($pictures){
                $this->uploadProductPictures($pictures, $umkm_id, $product->id);
            }
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function delete_product($product_id){
        try{
            $paths = ProductPicture::where('product_id', $product_id)->pluck('path');
            DB::beginTransaction();
            ProductPicture::where('product_id', $product_id)->delete();

            Product::find($product_id)->delete();
            DB::commit();

            foreach($paths as $path){
                unlink($path);
            }
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message' => 'Sukses Menghapus Produk'
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Terjadi Kesalahan, Silahkan Coba Lagi!'
            ]);
        }
    }

    public function product_datatable(Request $request, $umkm_id){
        /* ================== [1] Persiapan Pengambilan Data ================== */
        $startNumber = $request->start;
        $rowperpage = $request->length;
        $records = Product::with('product_picture')->where('umkm_id', $umkm_id)->orderBy('name');

        /* ================== [2] Sorting Kolom ================== */
        $sortColumnIndex = $request->order[0]['column'];
        $sortColumnName = $request->columns[$sortColumnIndex]['data'];
        $sortType = $request->order[0]['dir'];
        if($sortColumnName === "no"){
            $records = $records->orderBy('name', 'ASC');
        }else{
            $records = $records->orderBy($sortColumnName, $sortType);
        }

        /* ================== [3] Individual Search ================== */
        $productNameSearch = $request->columns[3]['search']['value'];
        if($productNameSearch){
            $records = $records->where('name', 'like', "%{$productNameSearch}%");
        }

        $productPriceSearch = $request->columns[4]['search']['value'];
        if($productPriceSearch){
            $records = $records->where('price', 'like', "%{$productPriceSearch}%");
        }

        $productDescriptionSearch = $request->columns[5]['search']['value'];
        if($productDescriptionSearch){
            $records = $records->where('description', 'like', "%{$productDescriptionSearch}%");
        }

        /* ================== [4] Pengambilan Data ================== */
        $totalRecordswithFilter = $records->count();
        $totalRecord = Product::where('umkm_id', $umkm_id)->count();
        $records = $records->skip($startNumber)->take($rowperpage)->get();

        /* ================== [5] Memformat Data ================== */
        $data_arr = array();
        foreach($records as $index => $record){
            $pictures = [];
            foreach($record->product_picture as $picture){
                $pictures[] = asset($picture->path);
            }

            $data_arr[] = array(
                "no" => $startNumber + $index + 1,
                "action" => $record->id,
                'picture' => $pictures,
                "name" => $record->name,
                "price" => "Rp.".$record->price,
                "description" => $record->description
            );
        }

        /* ================== [6] Mengirim JSON ================== */
        echo json_encode([
            "draw" => intval($request->draw),
            "iTotalRecords" => $totalRecord,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ]);
    }

    public function admin_product_datatable(Request $request){
        /* ================== [1] Persiapan Pengambilan Data ================== */
        $startNumber = $request->start;
        $rowperpage = $request->length;
        $records = Product::with('product_picture', 'umkm')->orderBy('name');

        /* ================== [2] Sorting Kolom ================== */
        $sortColumnIndex = $request->order[0]['column'];
        $sortColumnName = $request->columns[$sortColumnIndex]['data'];
        $sortType = $request->order[0]['dir'];
        if($sortColumnName === "no"){
            $records = $records->orderBy('name', 'ASC');
        }else{
            $records = $records->orderBy($sortColumnName, $sortType);
        }

        /* ================== [3] Individual Search ================== */
        $umkmSearch = $request->columns[2]['search']['value'];
        if($umkmSearch){
            $records = $records->whereHas('umkm', function($q) use ($umkmSearch){
                $q->where('name', 'like', "%{$umkmSearch}%");
            });
        }

        $productNameSearch = $request->columns[4]['search']['value'];
        if($productNameSearch){
            $records = $records->where('name', 'like', "%{$productNameSearch}%");
        }

        $productPriceSearch = $request->columns[5]['search']['value'];
        if($productPriceSearch){
            $records = $records->where('price', 'like', "%{$productPriceSearch}%");
        }

        $productDescriptionSearch = $request->columns[6]['search']['value'];
        if($productDescriptionSearch){
            $records = $records->where('description', 'like', "%{$productDescriptionSearch}%");
        }

        /* ================== [4] Pengambilan Data ================== */
        $totalRecordswithFilter = $records->count();
        $totalRecord = Product::count();
        $records = $records->skip($startNumber)->take($rowperpage)->get();

        /* ================== [5] Memformat Data ================== */
        $data_arr = array();
        foreach($records as $index => $record){
            $pictures = [];
            foreach($record->product_picture as $picture){
                $pictures[] = asset($picture->path);
            }

            $data_arr[] = array(
                "no" => $startNumber + $index + 1,
                "action" => $record->id,
                'umkm' => $record->umkm->name,
                'picture' => $pictures,
                "name" => $record->name,
                "price" => "Rp.".$record->price,
                "description" => $record->description
            );
        }

        /* ================== [6] Mengirim JSON ================== */
        echo json_encode([
            "draw" => intval($request->draw),
            "iTotalRecords" => $totalRecord,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ]);
    }
}