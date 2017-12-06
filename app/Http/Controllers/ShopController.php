<?php

namespace App\Http\Controllers;

use App\Item;
use App\UserItem;
use App\Vendor;
use App\Shop;
use App\ShopItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class ShopController extends Controller
{
    /**
     * Create a shop
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createShop(Request $r){
        if(!$r->isMethod('POST'))
            return response()->json(['success'=>false]);
        $shop = new Shop();
        $shop->name = $r->input('name');
        $shop->description = $r->input('description');
        $shop->vendor_id = $r->input('vendorId');
        $shop->active = $r->input('active');
        $shop->timestamp = Carbon::now();
        $shop->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Delete a shop
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteShop(Request $r){
        if(!$r->isMethod('DELETE'))
            return response()->json(['success'=>false]);
        $shopId = $r->input('id');
        $shop = Shop::find($shopId);
        $shop->delete(); //Delete the shop
        $shopItems = ShopItem::all()->where('shop_id','=',$shopId); //"Delete" all items of that shop
        foreach($shopItems as $shopItem){
            $shopItem->delete();
        }
        return response()->json(['success'=>true]);
    }

    /**
     * Edit shop info (only name, description, and status(active or not))
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function editShop(Request $r){
        if(!$r->isMethod('PUT'))
            return response()->json(['success'=>false]);
        $shop = Shop::find($r->input('id'));
        $shop->name = $r->input('name');
        $shop->description = $r->input('description');
        $shop->active = $r->input('active');
        return response()->json(['success'=>true]);
    }

    /**
     * Edit shop vendor
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function editShopVendor(Request $r){
        $shopId = $r->input('shopId');
        $vendorId = $r->input('vendorId');
        $shop = Shop::find($shopId);
        $shop->vendor_id = $vendorId;
        $shop->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Get all shops(by page)
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getShops(Request $r){
        if(!$r->isMethod('GET'))
            return response()->json(['success'=>false]);
        $data = [
            "quantity" => Shop::count(),
            "info" => array(),
        ];
        $page = $r->has('page')? $r->input("page") : 1;
        $shops = DB::table('shops')->offset(($page-1)*20)->limit(20)->orderBy('id','asc')->get();
        foreach($shops as $shop){
            $data['info'][$shop->id] = [
                'id'=>$shop->id,
                'name'=>$shop->name,
            ];
        }
        return response()->json($data);
    }

    public function shopInfo(Request $r){
        if(!$r->isMethod('GET'))
            return response()->json(['success'=>false]);
        $data = [
            'info'=>array(),
            'items'=>array(),
        ];
        $shop = Shop::find($r->input('id'));
        $vendor = Vendor::find($shop->vendor_id);
        $data['info'] = [
            'id'=>$shop->id,
            'name'=>$shop->name,
            'description'=>$shop->description,
            'vendorId' =>$shop->vendor_id,
            'vendor'=> $vendor->name,
        ];
        $shopItems = ShopItem::all()->where('shop_id','=',$r->input('id'));
        foreach($shopItems as $shopItem){
            $item = Item::find($shopItem->item_id);
            array_push($data['items'],[
                'id'=>$item->id,
                'name'=>$item->name,
                'description'=>$item->description,
                'buyValue'=>$item->buy_value,
                'sellValue'=>$item->sell,
                'icon'=>$item->icon,
            ]);
        }
        return response()->json($data);
    }

    public function addItemToShop(Request $r){
        $shopId = $r->input('shopId');
        $itemId = $r->input('itemId');
        $shopItem = new ShopItem();
        $shopItem->shop_id = $shopId;
        $shopItem->item_id = $itemId;
        $shopItem->save();
        return response()->json(['success'=>true]);
    }

    public function deleteItemFromShop(Request $r){
        $shopId = $r->input('shopId');
        $itemId = $r->input('itemId');
        $shopItem = ShopItem::where(['shop_id'=>$shopId,'item_id'=>$itemId])->get()->first();
        $shopItem->delete();
        return response()->json(['success'=>true]);
    }

    public function shopMenu(Request $r){
        //You need to be logged in
        if(!Auth::user()){
            return redirect('unauthorized');
        }
        $data = array();
        $shops = Shop::all();
        foreach($shops as $shop){
            $vendor = Vendor::find($shop->vendor_id);
            array_push($data,[
                'id'=>$shop->id,
                'name'=>$shop->name,
                'description'=>$shop->description,
                'vendorId' =>$shop->vendor_id,
                'vendor'=> $vendor->name,
            ]);
        }
        return view('shop_menu',['shops'=>$data]);
    }

    public function shopInside($shopId){
        if(!Auth::user()){
            return redirect('unauthorized');
        }
        $shop = Shop::find($shopId);
        $vendorId = $shop->vendor_id;
        $vendor = Vendor::find($vendorId);
        //Vendor info
        $info = [
            'shopName'=>$shop->name,
            'shopDescription'=>$shop->description,
            'name' => $vendor->name,
            'image'=>$vendor->image,
            'description'=>$vendor->description,
        ];
        $items = array();
        $shopItems = ShopItem::all()->where('shop_id','=',$shopId);
        foreach($shopItems as $shopItem){
            $item = Item::find($shopItem->item_id);
            array_push($items,[
                'id'=>$item->id,
                'name'=>$item->name,
                'buyValue'=>$item->buy_value,
                'sellValue'=>$item->sell_value,
                'icon'=>$item->icon,
                'description'=>$item->description,
            ]);
        }
        return view('shop_inside',['items'=>$items,'info'=>$info]);
    }

    public function buyItem(Request $r){
        if(!Auth::user())
            return response()->json("At least, log in y'know",518);
        $item = Item::find($r->input('itemId'))->first();
        $user = Auth::user();

        if($item->buy_value > $user->money)
            return response("Not enough money, pal",518);

        $userItem = new UserItem();
        $userItem->user_id = $user->id;
        $userItem->item_id = $item->id;
        $userItem->save();
        $user->money -= $item->buy_value;
        $user->save();

        return response()->json(['success'=>true]);
    }
}
