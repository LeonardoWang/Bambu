<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Item;
use App\User;
class HomeController extends Controller
{
	
    public function index()
    {
        $products = Item::orderBy('updated_at', 'desc')->get();
        if(Auth::check())
        {
            $user = Auth::user();
            return view('welcome',compact('user','products'));
        }
        else
            return view('welcome')->with(['products'=>Item::orderBy('updated_at', 'desc')->get()]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        $code=18401621061;
        return view('auth.register')->with('code',$code);
    }

    public function userName($id)
    {
        $user = User::Where('id',$id)->first();
        return response()->json(array(
            'name' => $user->name
        ));
    }

    public function sendSMS()
    {
        $iphone=$_GET['iphone'];
        $code=rand(1000,9999);
        setcookie('code',$code,time()+600);
        $url='http://api.sms.cn/sms/?ac=send&uid=marcwong&pwd=99ba044dd4904759e99d9e7888b15fe8&mobile='.$iphone.'&content={"code":"'.$code.'"}&template=396940';
        //old template id:100006
        
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

        $stat = substr($tmpInfo, 9,3);
        return response()->json(array(
            'stat' => $stat,
            'code' => $code
        ));
    }

}
