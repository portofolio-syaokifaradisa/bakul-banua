<?php

namespace App\Services;

use Exception;
use App\Models\Umkm;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmkmService{
    private $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function save($name, $since, $nib, $has_bpom, $has_pirt, $has_halal, $address, $owner, $phone, $email, $password){
        try{
            Umkm::create([
                'name' => $name,
                'since' => $since,
                'nib' => $nib,
                'address' => $address,
                'owner' => $owner,
                'phone' => $phone,
                'email' => $email,
                'password' => bcrypt($password),
                'has_bpom' => $has_bpom,
                'has_pirt' => $has_pirt,
                'has_halal' => $has_halal,
            ]);

            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function update($id, $name, $since, $nib, $has_bpom, $has_pirt, $has_halal, $address, $owner, $phone, $email, $password){
        try{
            $umkm = Umkm::find($id);
            $umkm->name = $name;
            $umkm->since = $since;
            $umkm->nib = $nib;
            $umkm->has_pirt = $has_pirt;
            $umkm->has_bpom = $has_bpom;
            $umkm->has_halal = $has_halal;
            $umkm->address = $address;
            $umkm->owner = $owner;
            $umkm->phone = $phone;
            $umkm->email = $email;
            if($password){
                $umkm->password = bcrypt($password);
            }
            $umkm->save();

            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function delete($umkm_id){
        try{
            DB::beginTransaction();
            $products = Product::where('umkm_id', $umkm_id)->get();
            foreach($products as $product){
                $this->productService->delete_product($product->id);
            }
            Umkm::find($umkm_id)->delete($umkm_id);
            
            DB::commit();
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message' => 'Sukses Menghapus UMKM'
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

    public function umkm_datatable(Request $request){
        /* ================== [1] Persiapan Pengambilan Data ================== */
        $startNumber = $request->start;
        $rowperpage = $request->length;
        $records = Umkm::orderBy('name');

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
            $records = $records->where('name', 'like', "%{$umkmSearch}%");
        }

        $sinceSearch = $request->columns[3]['search']['value'];
        if($sinceSearch){
            $records = $records->where('since', 'like', "%{$sinceSearch}%");
        }

        $nibSearch = $request->columns[4]['search']['value'];
        if($nibSearch){
            $records = $records->where('nib', 'like', "%{$nibSearch}%");
        }

        $ownerSearch = $request->columns[6]['search']['value'];
        if($ownerSearch){
            $records = $records->where('owner', 'like', "%{$ownerSearch}%");
            $records = $records->orwhere('phone', 'like', "%{$ownerSearch}%");
            $records = $records->orwhere('email', 'like', "%{$ownerSearch}%");
        }

        $address = $request->columns[7]['search']['value'];
        if($address){
            $records = $records->where('address', 'like', "%{$address}%");
        }

        /* ================== [4] Pengambilan Data ================== */
        $totalRecordswithFilter = $records->count();
        $totalRecord = Umkm::count();
        $records = $records->skip($startNumber)->take($rowperpage)->get();

        /* ================== [5] Memformat Data ================== */
        $data_arr = array();
        foreach($records as $index => $record){
            $data_arr[] = array(
                "no" => $startNumber + $index + 1,
                "action" => $record->id,
                'name' => $record->name,
                'since' => $record->since,
                'nib' => $record->nib,
                'address' => $record->address,
                'has_bpom' => $record->has_bpom,
                'has_pirt' => $record->has_pirt,
                'has_halal' => $record->has_halal,
                'owner' => $record->owner,
                'phone' => $record->phone,
                'email' => $record->email
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