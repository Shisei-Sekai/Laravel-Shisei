<?php

namespace App\Http\Controllers;
use App\Item;
use App\UserItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Create an item
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createItem(Request $r){
        $r->validate([
            'buyValue' => 'required|integer',
            'sellValue' => 'required|integer',
            'name' => 'required|string',
        ]);
        $name = $r->input('name');
        $buyValue = $r->has('buyValue')? $r->input('buyValue') : 0;
        $sellValue = $r->has('sellValue')? $r->input('sellValue') : 0;
        $icon = $r->input('icon');
        $description = $r->input('description');
        //$type = $r->has('type')? $r->input('type') : 0;

        $item = new Item();
        $item->name = $name;
        $item->description = $description;
        $item->buy_value = (int)$buyValue;
        $item->sell_value = (int)$sellValue;
        $item->icon = $icon;
        $item->type = false;
        $item->timestamp = Carbon::now();
        $item->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Delete item from existence
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $r){
        //Delete item, DELETE request
        if(!$r->has('id'))
            return response()->json(['success'=>false]);
        $item = Item::find($r->input('id'));
        $item->delete();
        DB::table('user_items')->where('item_id','=',$r->input('id'))->delete();
        return response()->json(['success'=>true]);
    }


    /**
     * Return item info (admin panel)
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function itemInfo(Request $r){
        if(!$r->has('id'))
            return response()->json(['success'=>false]);
        $item = Item::find($r->input('id'));

        return response()->json([
            'name'=>$item->name,
            'description'=>$item->description,
            'buyValue'=>$item->buy_value,
            'sellValue'=>$item->sell_value,
            'icon'=>$item->icon,
            'type'=>$item->type,
        ]);
    }

    /**
     * Gives an item to desired user
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function itemToUser(Request $r){
        //Required info
        $userId = $r->input('userId');
        $itemId = $r->input('itemId');
        //User info
        $userItem = new UserItem();
        $userItem->user_id = $userId;
        $userItem->item_id = $itemId;
        $userItem->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Delete a item from a user
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function takeItemFromUser(Request $r){
        $userId = $r->input('userId');
        $itemId = $r->input('itemId');
        $userItem = UserItem::where(['user_id'=>$userId,'item_id'=>$itemId])->get()->first();
        $userItem->delete();
        return response()->json(['success'=>true]);
    }

    /**
     * Return item list, it doesnt require admin permission
     * @param Request $r
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getItems(Request $r){
        $data = [
            "quantity" => Item::count(),
            "info" => array(),
        ];
        $page = $r->has('page')? $r->input("page") : 1;
        $items = DB::table('items')->offset(($page-1)*20)->limit(20)->orderBy('id','asc')->get();
        foreach($items as $item){
            $data['info'][$item->id] = [
                "id"=>$item->id,
                "name"=>$item->name,
                "buyValue"=>$item->buy_value,
                "sellValue"=>$item->sell_value,
                "icon"=>$item->icon,
                "type"=>$item->type,
                "description"=>$item->description,

            ];
        }
        return response()->json($data);
    }

    public function getAllItems(Request $r){
        $items = Item::all();
        foreach($items as $item){
            $data[$item->id] = [
                "id"=>$item->id,
                "name"=>$item->name,
                "buyValue"=>$item->buy_value,
                "sellValue"=>$item->sell_value,
                "icon"=>$item->icon,
                "type"=>$item->type,
                "description"=>$item->description,
            ];
        }
        return response()->json($data);
    }

    /**
     * Get all items that belongs to the user
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserItems(Request $r){
        $id = $r->input('id');
        $userItems = UserItem::all()->where('user_id','=',$id); //All items of that user
        $data = array(); //Return info
        foreach($userItems as $index=>$userItem){
            $item = Item::find($userItem->item_id);
            //we only want id and name of the item
            $data[$index] = [
                "id"=>$item->id,
                "name"=>$item->name,
            ];
        }
        return response()->json($data);
    }

    public function editItem(Request $r){
        $id = $r->input('id');
        $item = Item::find($id);
        $item->name = $r->input('name');
        $item->buy_value = $r->input('buyValue');
        $item->sell_value = $r->input('sellValue');
        $item->icon = $r->input('icon');
        $item->description = $r->input('description');
        $item->save();
        return response()->json(['success'=>true]);
    }

}
