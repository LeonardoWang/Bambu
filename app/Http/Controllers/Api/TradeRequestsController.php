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
use App\TradeRequest;
use App\Item;
use App\Comment;
class TradeRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return TradeRequest::all();
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
            'user_id' => 'required',
            'item_id' => 'required',
            'message' => 'required',
            'status' => 'required'
        ]);
        $trade_request = new TradeRequest;
        $trade_request->user_id = $request->input('user_id');
        $trade_request->item_id = $request->input('item_id');
        $trade_request->message = $request->input('message');
        $trade_request->status = $request->input('status');

        if ($trade_request->save()) {
            return 1;
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
        return TradeRequest::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    //public function update(Request $request, $id)
    public function update($id)
    {

        /*
        $this->validate($request, [
            'user_id' => 'required',
            'item_id' => 'required',
            'message' => 'required',
            'status' => 'required'
        ]);
        $trade_request = TradeRequest::find($id);
        $trade_request->user_id = $request->input('user_id');
        $trade_request->item_id = $request->input('item_id');
        $trade_request->message = $request->input('message');
        $trade_request->status = $request->input('status');

        if ($trade_request->save()) {
            return 1;
        } else {
            return 0;
        }*/
        return 1;//view('welcome');//['products'=>Item::where('id', $id)->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $trade_request = TradeRequest::find($id);
        $trade_request->delete();
        return 1;
    }

    public function doRequest($id)
    {
        $user = Auth::user();
        $products = Item::where('id', $id)->get();
        $comments = Comment::where('item_id',$id)->get();
        return view('productshow',compact('user','products','comments'));
        //return view('productshow',['products'=>Item::where('id', $id)->get()]);
    }

    public function postRequest(Request $request)
    {
        
        
        $this->validate($request, [
            'user_id' => 'required',
            'item_id' => 'required',
            'description' => 'required',
        ]);
        $comment = new Comment;
        $comment->user_id = $request->input('user_id');
        $comment->item_id = $request->input('item_id');
        $comment->message = $request->input('description');
        if($comment->save())
        {
            echo "<script type='text/javascript'>alert('your comment is added successfully!')</script>";
            return 1;
        }
        else 
        {
            echo "<script type='text/javascript'>alert('your comment is added unsuccessfully!')</script>";
            return 0;
        }       
    }

}
