<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function addItem(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
        ]);


        $item = Item::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'store_id' => $request('store_id'),
            'user_id' => auth()->user()->id
        ]);

        return response([
            'request_data' => $request->all(),
            'store' => $item,
            'message' => 'You are successfully added an item'
        ]);
    }

    public function viewItems() {
        $item = Item::with('')
    }
}
