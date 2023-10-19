<?php

namespace App\Http\Controllers;

use App\Models\kelurahan;
use App\Models\menu;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\usermenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index',['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            "name" => "required|min:5|max:100",
            "role" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "password_confirmation" => "required|same:password"
        ])->validate();

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->get('role');
        $user->status = 'INACTIVE';
        $user->save();
        return redirect()->route('user.index')->with('status','User Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usermenu = usermenu::all();
        $menu = menu::all();
        $kelurahan = kelurahan::all();
        $user = User::find($id);
        return view('user.edit',['user' => $user,'kelurahan' => $kelurahan,'menu' => $menu,'usermenu' => $usermenu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            "name" => "required|min:5|max:100",
            "status" => "required",
            "role" => "required",
        ])->validate();

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->role = $request->get('role');
        $user->id_kelurahan = $request->get('id_kelurahan');
        $user->status = $request->get('status');
        $user->save();

        $user->menus()->sync($request->id_menu);

        return redirect()->route('user.index')->with('status','Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('status','data berhasil dihapus');
    }

    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            if(Auth::user()->role == "admin"){
                return $next($request);
            }
            return redirect()->guest('/404');
        });
    }
}
