<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Crypt;
use Hash;
use Auth;
use Storage;
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
            'name' => 'required|unique:users|max:20',
            'tel' => 'required|unique:users|digits_between:5,32'
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
            'tel' => 'required|digits_between:5,32',
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
            'tel' => 'required|digits_between:5,32|unique:users',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6',
            'smscode' =>'required|digits:4'
        ]);
        
        $messages = $validator->messages();

        //smscode verification
        /*if($request->input('smscode')!=$request->input('verismscode'))
        {
            $messages="Incorrect smscode!";
            return back()->withErrors($messages);
        }*/

        //password verification
        if($request->input('password')!=$request->input('password_confirmation'))
        {
            $messages="your must type the same password two times!";
            return back()->withErrors($messages);
        }

        if(!$validator->fails()) {
            $user = User::create([
                'name' => $request->input('name'),
                'tel' => $request->input('tel'),
                'password' => Hash::make($request->input('password')),
                'email' => $request->input('email'),
            ]);
            $userinformation = new UserInformation();
            $userinformation->user_id = $user->id;
            $userinformation->sex ='unknown';
            $userinformation->city ='Beijing';
            $userinformation->address ='unknown';
            $userinformation->user_image = '/img/default_user_profile.jpg';
            $userinformation->save();
            Auth::login($user);
            echo "<script type='text/javascript'>alert('you have successfully registered!')</script>";
            $products = Item::orderBy('updated_at', 'desc')->get();
            return view('auth.registersuccess');
            //return view('welcome',compact('user','products'));
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
        $comments = $user->sent_trade_requests()->orderBy('updated_at', 'desc')->get()->pluck('id');
        return view('myrequest',compact('user','comments')); 
    }

    public function getReceivedRequests($id)
    {
        $user = User::find($id);
        $comments = $user->received_trade_requests()->orderBy('updated_at', 'desc')->get()->pluck('id');
        return view('myrequest',compact('user','comments'));
    }

    public function userInformationUpdate(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:20',
            'image' => 'image',
            'location' => 'max:20'
        ]);
        //echo "<script type='text/javascript'>alert('start updating')</script>";
        
        if($user->name != $request->input('name'))//change name
        {
            $tmp_usr = User::where('name', $request->input('name'));
            if(!isset($tmp_usr))
            {
                $user = Auth::user();
                $user_information = UserInformation::find($user->id);
                echo "<script type='text/javascript'>alert('this name is occupied by other!')</script>";
                return view('myprofile',compact('user','user_information'));// tel is used by other
            }
            $user->name = $request->input('name');// user name is changed
            $user->save();
            echo "<script type='text/javascript'>alert('name changed successfully!')</script>";
        }
            
        $userinformation = UserInformation::find($user->id);
        $userinformation->sex = $request->input('sex');
        $userinformation->location = $request->input('location');

        if ($request->hasFile('image')) {
            if(!empty($userinformation->user_image)){
                Storage::delete('images/' . $userinformation->user_image);
            }
            $file_name = strval($user->id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
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
            echo "<script type='text/javascript'>alert('profile successfully update. Saved without picture.')</script>";
            $user_information = UserInformation::find($user->id);
            return view('myprofile',compact('user','user_information'));
        }
    }

    public function userImageUpdate(Request $request)
    {
        $user = Auth::user();
        $userinformation = UserInformation::find($user->id);
        if ($request->hasFile('image')) {
            if(!empty($userinformation->user_image)){
                Storage::delete('images/' . $userinformation->user_image);
            }
            $file_name = strval($user->id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
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
            echo "<script type='text/javascript'>alert('profile successfully update. Saved without picture.')</script>";
            $user_information = UserInformation::find($user->id);
            return view('myprofile',compact('user','user_information'));
        }
    }
    public function userInformationPage()
    {
        $user = Auth::user();
        $user_information = UserInformation::find($user->id);
        return view('myprofile',compact('user','user_information'));//view('user_information')->with('user_information',$user_information);
    }
    public function otheruserInformationPage($id)
    {
        $user = Auth::user();
        $user_information = UserInformation::find($id);
        return view('profile',compact('user','user_information'));//view('user_information')->with('user_information',$user_information);
    }

    public function showImage($id)
    {
        $user_information = UserInformation::find($id);
        $file = Storage::get('images/' . $user_information->user_image);
        return (new Response($file, 200))->header('Content-Type', 'image/jpeg');
    }
}
