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
        if(Auth::check())
        {
            $user = Auth::user();
            return view('welcome')->with(['products'=>Item::orderBy('updated_at', 'desc')->get()]);
        }
        else
            return view('welcome');
    }

    public function haha()
    {
        return view('auth.login');
    }

    public function haha2()
    {
        return view('auth.register');
    }
}
