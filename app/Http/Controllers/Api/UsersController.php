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
            'tel' => 'required|unique:users'
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
            
            return back()->withErrors('login failed!');//back()->with('errors','登录失败');
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
            echo "<script type='text/javascript'>alert('you have successfully registered!)</script>";
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

    public function userInformationUpdate(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'tel' => 'required'
        ]);
        echo "<script type='text/javascript'>alert('111')</script>";
        
        $tmp_usr = User::where('tel', $request->tel);
        if(isset($tmp_usr))
        {
            return 0;// tel is used by other
        }
        $user = User::find($request->id);
        if($user->name != $request->input('name'))
        {
            return 0;// user name is changed
        }
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        

        if ($user->save()) {
            
            $user = Auth::user();
            $userinformation = UserInformation::find($user->id);
            $userinformation->sex = $request->input('sex');
            $userinformation->location = $request->input('location');

            if ($request->hasFile('image')) {
                if(!empty($userinformation->user_image)){
                    Storage::delete('images/' . $userinformation->user_image);
                }
                $file_name = strval($item_id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
                Storage::put('images/' . $file_name,
                    file_get_contents($request->file('image')->getRealPath()));
                $userinformation->user_image = $file_name;
                $userinformation->save();
                echo "<script type='text/javascript'>alert('save with picture!')</script>";
                $user_information = UserInformation::find($user->id);
                return view('myprofile',compact('user','user_information'));
            }
            else{
                $userinformation->save();
                echo "<script type='text/javascript'>alert('profile successfully update. Save without picture')</script>";
                $user_information = UserInformation::find($user->id);
                return view('myprofile',compact('user','user_information'));
            }

        } else {
            echo "<script type='text/javascript'>alert('profile update failed! Please check your name and tel!')</script>";
            return 0;
        }

    }

    public function userInformationPage()
    {
        $user = Auth::user();
        $user_information = UserInformation::find($user->id);
        return view('myprofile',compact('user','user_information'));//view('user_information')->with('user_information',$user_information);
    }
}
