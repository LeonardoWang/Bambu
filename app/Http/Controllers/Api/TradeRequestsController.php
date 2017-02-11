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
use App\User;
use App\UserInformation;

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
        $comment = Comment::find($id);
        if(!empty($comment))
        {
            $comment->delete();
            return 1;
        }
        else
            return 0;
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
        //echo "<script type='text/javascript'>alert('begin posting comment')</script>";
        $this->validate($request, [
            'user_id' => 'required',
            'item_id' => 'required',
            'message' => 'required',
            'price' => 'required|numeric',
        ]);
        $user = Auth::user();
        $userinformation = UserInformation::find($user->id);
        $comment = new Comment;
        $comment->user_image = $userinformation->user_image;
        $comment->user_id = $request->input('user_id');
        $comment->user_name = $request->input('user_name');
        $comment->item_id = $request->input('item_id');
        $comment->message = $request->input('message');
        $comment->itemfortrade = $request->input('itemfortrade');
        $comment->price = $request->input('price');
        $products = Item::where('id', $comment->item_id)->first();
        $comment->item_owner_id = $products->user_id;


        if($comment->save())
        {
            $products = Item::where('id', $comment->item_id)->get();
            $comments = Comment::where('item_id',$comment->item_id)->get();
            $notif = new NotifiController;
            $notif->addCommentNotif($comment->item_owner_id);
            $notif->sendNotif($comment->item_owner_id);
            echo "<script type='text/javascript'>alert('your comment is added successfully!')</script>";
            return view('productshow',compact('user','products','comments'));
        }
        else 
        {
            echo "<script type='text/javascript'>alert('your comment is added unsuccessfully!')</script>";
            return 0;
        }       
    }

    public function myRequest()
    {
        $user = Auth::user();
        $notif = new NotifiController;
        $notif->removeCommentNotif($user->id);
        $comments = Comment::where('item_owner_id',$user->id)->get();
        return view('myrequest',compact('user','comments'));    
    }
}
