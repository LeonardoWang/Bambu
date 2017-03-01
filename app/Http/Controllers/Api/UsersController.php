<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function forgetPassword()
    {
        return view('auth.password');
    }

    public function createPassword()
    {
        return view('auth.createpassword');
    }

    public function resetPassword(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'password_old' => 'required|min:6',
            'password_confirmation' => 'required|min:6',
            'password' =>'required|min:6'
        ]);
        if(!Auth::attempt(['tel' => $user->tel, 'password' =>$request->input('password_old')]))
        {
            $messages="password wrong!";
            return back()->withErrors($messages);
        }
        if($request->input('password')!=$request->input('password_confirmation'))
        {
            $messages="your must type the same password two times!";
            return back()->withErrors($messages);
        }
        if(!$validator->fails()){
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
        Auth::login($user);
        return redirect()->intended('/');
    }

    public function SMSpassword()
    {
        $iphone=$_GET['iphone'];
        $user = User::Where('tel',$iphone)->first();
        if(empty($user))
        {
            echo "<script type='text/javascript'>alert('error phone number')</script>";
            return back();
        }
        $code=rand(100000,999999);
        $user->password = Hash::make($code);
        setcookie('code',$code,time()+600);
        $url='http://api.sms.cn/sms/?ac=send&uid=marcwong&pwd=99ba044dd4904759e99d9e7888b15fe8&mobile='.$iphone.'&content={"new password":"'.$code.'"}&template=100006';
        $data=array();
        $method='POST';
        
        //1.初始化
        $ch = curl_init();
        
        //2.请求地址
        curl_setopt($ch,CURLOPT_URL,$url);
        
        //3.请求方式
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,$method);
        
        //4.参数如下
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);//https
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_AUTOREFERER,1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch,CURLOPT_ENCODING,'gzip,deflate');

        //5.post方式的时候添加数据
        if($method=="POST"){
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        
        //6.执行
        $tmpInfo=curl_exec($ch);
    
        //7.如果出错
        if (curl_errno($ch))
        {
            return curl_error($ch);
        }
        curl_close($ch);
        $user->save();
        $stat = substr($tmpInfo, 9,3);
        echo "<script type='text/javascript'>alert('new password have send to your phone')</script>";
        return back();
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
            //$userinformation->address ='';
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
            'city' => 'max:20'
        ]);
        //echo "<script type='text/javascript'>alert('start updating')</script>";
        
        if($user->name != $request->input('name'))//change name
        {
            $tmp_usr = User::where('name', $request->input('name'));
            if(!isset($tmp_usr))
            {
                $user = Auth::user();
                $user_information = UserInformation::where('user_id',$user->id)->first();
                echo "<script type='text/javascript'>alert('this name is occupied by other!')</script>";
                return view('myprofile',compact('user','user_information'));// tel is used by other
            }
            $user->name = $request->input('name');// user name is changed
            $user->save();
            //echo "<script type='text/javascript'>alert('name changed successfully!')</script>";
        }
            
        $userinformation = UserInformation::where('user_id',$user->id)->first();
        $userinformation->sex = $request->input('sex');
        $userinformation->city = $request->input('city');
        $userinformation->address = $request->input('address');
        if ($request->hasFile('image')) {
            if(!empty($userinformation->user_image&&Storage::exists('images/'.$userinformation->user_image))){
                Storage::delete('images/' . $userinformation->user_image);
            }
            $file_name = strval($user->id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
            Storage::put('images/profile/' . $file_name,
                file_get_contents($request->file('image')->getRealPath()));
            $userinformation->user_image = 'profile/'.$file_name;
            $userinformation->save();
            echo "<script type='text/javascript'>alert('save with picture!')</script>";
            $user_information = UserInformation::where('user_id',$user->id)->first();
            return view('myprofile',compact('user','user_information'));
        }
        else{
            $userinformation->save();
            echo "<script type='text/javascript'>alert('profile successfully update. Saved without picture.')</script>";
            $user_information = UserInformation::where('user_id',$user->id)->first();
            return view('myprofile',compact('user','user_information'));
        }
    }

    public function userImageUpdate(Request $request)
    {
        $user = Auth::user();
        $userinformation = UserInformation::where('user_id',$user->id)->first();
        if ($request->hasFile('image')) {
            if(!empty($userinformation->user_image)){
                Storage::delete('images/profile/'.$userinformation->user_image);
            }
            $file_name = strval($user->id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
            Storage::put('images/profile/'.$file_name,
                file_get_contents($request->file('image')->getRealPath()));
            $userinformation->user_image = 'profile/'.$file_name;
            $userinformation->save();
            echo "<script type='text/javascript'>alert('save with picture!')</script>";
            $user_information = UserInformation::where('user_id',$user->id)->first();
            return view('myprofile',compact('user','user_information'));
        }
        else{
            $userinformation->save();
            echo "<script type='text/javascript'>alert('profile successfully update. Saved without picture.')</script>";
            $user_information = UserInformation::where('user_id',$user->id)->first();
            return view('myprofile',compact('user','user_information'));
        }
    }
    public function userInformationPage()
    {
        $user = Auth::user();
        $user_information = UserInformation::where('user_id',$user->id)->first();
        return view('myprofile',compact('user','user_information'));
    }
    public function otheruserInformationPage($id)
    {
        $user = Auth::user();

        $user_information = UserInformation::where('user_id',$id)->first();
        return view('profile',compact('user','user_information'));//view('user_information')->with('user_information',$user_information);
    }

    public function showImage($id)
    {
        $user_information = UserInformation::where('user_id',$id)->first();
        $file = $user_information->user_image;
        $value;
        if($file == "/img/default_user_profile.jpg")
            $value = "http://www.thebambu.com/img/default_user_profile.jpg";
        else
            $value =  "http://www.thebambu.com/images/".$file;  
        return response()->json(array(
            'image_path' => $value
        ));
    }


}
