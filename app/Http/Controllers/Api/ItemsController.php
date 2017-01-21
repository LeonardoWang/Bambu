<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Storage;
use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImagesController;
use App\User;
use App\Item;
use App\TradeRequest;
use App\Image;

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
        $user = Auth::user();
        if(isset($keyword))
        {

           $products = Item::where('title', 'like', '%'.$keyword.'%')->orWhere('description', 'like', '%'.$keyword.'%')->get();
            return view('welcome',compact('user','products'));
            //view('welcome',['products'=>Item::where('title', 'like', '%'.$keyword.'%')->orWhere('description', 'like', '%'.$keyword.'%')->get()]);
        }
        else
            return view('welcome')->with('user',$user);
        //->orWhere('description', 'like', '%'.$keyword.'%')->pluck('id')]);
    }
    public function ProductIndex()
    {
        return view('product');
    }

    public function ProductAdd(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);
        
        if(Auth::check())
        {

        $user = Auth::user();
        $item = new Item;
        $item->title = $request->input('title');
        $item->user_id = $user->id;
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->status = 'unreviewed';
        $item->category = $request->input('category');
        //$item->keywords = $request->input('keywords');
        if ($item->save()) {
            $item_id = $item->id;
            if ($request->hasFile('image')) {
                $file_name = strval($item_id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
                Storage::put('images/' . $file_name,
                    file_get_contents($request->file('image')->getRealPath()));
                $image_record = New Image;
                $image_record->item_id = $item_id;
                $image_record->filename = $file_name;
                $item->image_file = $file_name;
                if ($image_record->save() && $item->save()){
                    echo "<script type='text/javascript'>alert('your item is successfully uploaded!')</script>";
                    $products = Item::orderBy('updated_at', 'desc')->get();
                    //return $file_name;
                    return view('welcome',compact('user','products'));
                }else {
                    echo "<script type='text/javascript'>alert('There's something wrong! Please check your nerwork connection.)</script>";
                    return 0;
                }
            }
            else {
                return 'no image file';
            }
        } else {
            return 'save error';
        }
        }
        else
        {
            echo "<script type='text/javascript'>alert('you haven't logged in!)</script>";
            return view('auth.login');  
        }


    }

    public function ProductShow()
    {
        return ['products'=>Item::orderBy('updated_at', 'desc')->get()];//view('productshow', ['products'=>Item::orderBy('updated_at', 'desc')->get()]);
    }

    public function MyProduct()
    {
        $user = Auth::user();
        $products = Item::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        return view('welcome',compact('user','products'));
        //view('welcome',['products'=>Item::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get()]);
    }
}
