<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function newStore(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'description' => 'string',
        ]);
        $photoPath = null;
        // if ($data['photo']) {
        //     $photoData = base64_decode($data['photo']);
        //     $photoExtension = 'png';  // You can adjust the extension based on your needs
        //     $photoFileName = Str::random(20) . '.' . $photoExtension;
        //     $photoPath = 'store-photos/' . $photoFileName;  // Adjust the path as needed

        //     // Save the decoded image to the storage disk
        //     Storage::disk('public')->put($photoPath, $photoData);
        // }
        $store = Store::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'description' => $data['description'],
            // 'photo' => $request('photo'),
            'user_id' => auth()->user()->id
        ]);

        return response([
            'request_data' => $request->all(),
            'store' => $store,
            'message' => 'You are successfully created your store'
        ]);
    }

    public function getStore()
    {
        $store = Store::with('store_owner')->get();
        return response([
            'store' => $store,
        ]);
    }


    public function editStore($id, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|string',
        ]);

        $store = Store::findOrFail($id);

        $store->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'description' => $data['description'],
            'photo' => $data['photo'],
        ]);

        return response([
            'request_data' => $request->all(),
            'store' => $store,
            'message' => 'You have successfully updated your store'
        ]);
    }
}
