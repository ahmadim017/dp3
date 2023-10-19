<?php

namespace App\Http\Controllers;

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
	$this->middleware(function($request, $next){
            if( Auth::user()->role == "admin" && auth::user()->status == "ACTIVE"){
                return $next($request);
            }elseif(Auth::user()->role == "operator" && auth::user()->status == "ACTIVE"){
                return $next($request);
            }elseif(Auth::user()->role == "user" && auth::user()->status == "ACTIVE"){
                return $next($request);
            }else{
                return redirect('login')->with(Auth::logout())->with('status','USER Anda tidak active');
            }
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
