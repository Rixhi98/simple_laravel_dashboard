<?php

namespace goni\Http\Controllers;
use goni\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
            return view('home')->withUser($user);
            }
            else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
