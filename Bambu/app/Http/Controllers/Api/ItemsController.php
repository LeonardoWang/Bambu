<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use Storage;
use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImagesController;
use App\User;
use App\Item;
use App\TradeRequest;
class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //return DB::table('items')->orderBy('updated_at', 'desc')->get();
        return Item::orderBy('updated_at', 'desc')->get()->pluck('id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'number' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $item = new Item;
        $item->title = $request->input('title');
        $item->number = $request->input('number');
        $item->user_id = $request->input('user_id');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->status = $request->input('status');

        if ($item->save()) {
            return $item->id;
        } else {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        $user = $item->user;
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'number' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $item = Item::find($id);
        $item->title = $request->input('title');
        $item->number = $request->input('number');
        $item->user_id = $request->input('user_id');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->status = $request->input('status');

        if ($item->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return 1;
    }

    public function images($id)
    {
        $item = Item::find($id);
        return $item->images()->pluck('filename');
    }

    public function search($keyword)
    {
        return Item::where('title', 'like', '%'.$keyword.'%')
            ->orWhere('description', 'like', '%'.$keyword.'%')->get()->pluck('id');
    }
}
