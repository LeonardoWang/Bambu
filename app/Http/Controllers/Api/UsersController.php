<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Crypt;
use Hash;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Item;
use App\UserInformation;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return User::find($id);
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
            'name' => 'required|unique:users|max:255',
            'tel' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        if ($user->save()) {
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
        $user = User::find($id);
        $user->delete();
        return 1;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'tel' => 'required',
            'password' => 'required'
        ]);
        $tel = $request->input('tel');
        $password = $request->input('password');
        
        if (Auth::attempt(['tel' => $tel, 'password' =>$password])) {
            //return User::where('email', $email)->first();
            return redirect()->intended('/');
        }
        else {
            
            return back()->withErrors('登录失败');//back()->with('errors','登录失败');
        }

        
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->intended('/');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:users',
            'tel' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        $messages = $validator->messages();
        if(!$validator->fails()) {
            $user = User::create([
                'name' => $request->input('name'),
                'tel' => $request->input('tel'),
                'password' => Hash::make($request->input('password')),
            ]);
            $userinformation = new UserInformation();
            $userinformation->user_id = $user->id;
            $userinformation->sex ='unknown';

            $userinformation->save();
            Auth::login($user);
            return redirect()->intended('/');
            /*User::where('email', $request->input('email'))->first();*/
        }
        else {
            return back()->withErrors($messages);//back()->with('message','注册失败');
        }
    }

    public function getItems($id)
    {
        $user = User::find($id);
        return $user->items()->orderBy('updated_at', 'desc')->get()->pluck('id');
    }

    public function getSentRequests($id)
    {
        $user = User::find($id);
        return $user->sent_trade_requests()->orderBy('updated_at', 'desc')->get()->pluck('id');
    }

    public function getReceivedRequests($id)
    {
        $user = User::find($id);
        return $user->received_trade_requests()->orderBy('updated_at', 'desc')->get()->pluck('id');
    }

    public function UserInformationUpdate(Request $request)
    {
        
        $user = Auth::user();
        $userinformation = UserInformation::find($user->id);
        $userinformation->sex = $request->input('sex');
        $userinformation->location = $request->input('location');

        if ($request->hasFile('image')) {
            if(!empty($userinformation->user_image))
            {
                Storage::delete('images/' . $userinformation->user_image);
            }
            $file_name = strval($item_id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
            Storage::put('images/' . $file_name,
                file_get_contents($request->file('image')->getRealPath()));
            $userinformation->user_image = $file_name;
            $userinformation->save();
            return 'save with picture';
        }
        else {
            $userinformation->save();
            return 'save without picture';
        }

    }

    public function UserInormationPage()
    {
        $user = Auth::user();
        $user_information = UserInformation::find($user->id);
        return $user_information;//view('user_information')->with('user_information',$user_information);
    }
}