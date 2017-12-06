<?php

namespace App\Http\Controllers;

use App\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    /**
     * Create a vendor
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createVendor(Request $r){
        if(!$r->isMethod('POST'))
            return response()->json(['success'=>false]);
        $vendor = new Vendor();
        $vendor->name = $r->input('name');
        $vendor->description = $r->input('description');
        $vendor->image = $r->input('image');
        $vendor->timestamp = Carbon::now();
        $vendor->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Edit vendor info
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function editVendor(Request $r){
        if(!$r->isMethod('PUT'))
            return response()->json(['success'=>false]);
        $vendorId = $r->input('id');
        $vendor = Vendor::find($vendorId);
        $vendor->name = $r->input('name');
        $vendor->description = $r->input('description');
        $vendor->image = $r->input('image');
        $vendor->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Delete a vendor
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteVendor(Request $r){
        if(!$r->isMethod('DELETE'))
            return response()->json(['success'=>false]);
        $vendorId = $r->input('id');
        $vendor = Vendor::find($vendorId);
        $vendor->delete();
        return response()->json(['success'=>true]);
    }

    /**
     * Get all vendors, limit 20 per page
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVendors(Request $r){
        if(!$r->isMethod('GET'))
            return response()->json(['success'=>false]);
        $data = [
            "quantity" => Vendor::count(),
            "info" => array(),
        ];
        $page = $r->has('page')? $r->input("page") : 1;
        $vendors = DB::table('vendors')->offset(($page-1)*20)->limit(20)->orderBy('id','asc')->get();
        foreach($vendors as $vendor){
            $data['info'][$vendor->id] = [
                'id'=>$vendor->id,
                'name'=>$vendor->name,
                'description'=>$vendor->description,
                'image'=>$vendor->image,
            ];
        }
        return response()->json($data);
    }

    /**
     * Return the avaliable vendors
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPossibleVendors(Request $r){
        $vendors = Vendor::all();
        $data = array();
        foreach($vendors as $vendor){
            array_push($data,[
                'id'=>$vendor->id,
                'name'=>$vendor->name,
            ]);
        }
        return response()->json($data);
    }
}
