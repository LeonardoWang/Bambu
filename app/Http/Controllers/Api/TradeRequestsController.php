<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TradeRequest;
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
    public function update(Request $request, $id)
    {
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
        $trade_request = TradeRequest::find($id);
        $trade_request->delete();
        return 1;
    }
}
