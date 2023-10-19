<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = menu::all();
        return view('menu.index',['menu' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
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
            "name" => "required",
            "route" => "required",
            "image" => "required",
        ])->validate();

        $menu = new menu();
        $menu->name = $request->get('name');
        $menu->route = $request->get('route');
        if ($request->file('image')) {
            $file = $request->file('image')->store('image','public');
            $menu->image = $file;
        }
        $menu->save();
        return redirect()->route('menu.index')->with('status','Data Berhasil disimpan');
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
        $menu = menu::findOrfail($id);
        
        return view('menu.edit',['menu' => $menu]);
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
            "name" => "required",
            "route" => "required",
	    "status" => "required",
        ])->validate();

        $menu = menu::findOrfail($id);
        $menu->name = $request->get('name');
        $menu->route = $request->get('route');
	$menu->status = $request->get('status');
        if ($request->file('image')) {

            if ($menu->image && file_exists(storage_path('app/public/'.$menu->image))){
                Storage::delete('public/'.$menu->image);
            }
            $file = $request->file('image')->store('image','public');
            $menu->image = $file;
        }
        $menu->save();
        return redirect()->route('menu.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
