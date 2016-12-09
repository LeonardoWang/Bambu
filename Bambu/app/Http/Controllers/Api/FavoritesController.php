<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($user_id)
    {
        $user = User::find($user_id);
        return $user->favorites()->orderBy('updated_at', 'desc')->get()->pluck('id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $item_id = $request->input('item_id');
        $user->favorites()->attach($item_id);
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user_id, $item_id)
    {
        $user = User::find($user_id);
        $user->favorites()->detach($item_id);
        return 1;
    }
}
