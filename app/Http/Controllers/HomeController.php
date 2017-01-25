<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Item;

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

    public function home()
    {
            return view('welcome');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function test()
    {
        return view('test');
    }

    
}
