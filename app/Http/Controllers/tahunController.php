<?php

namespace App\Http\Controllers;

use App\Models\tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = tahun::all();
        return view('tahun.index',['tahun' => $tahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun.create');
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
            "tahun" => "required",
            "jmlpenduduk" => "required",
        ])->validate();

        $tahun = new tahun();
        $tahun->tahun = $request->get('tahun');
        $tahun->jmlpenduduk = $request->get('jmlpenduduk');
        $tahun->save();
        return redirect()->route('tahun.index')->with('status','Data Berhasil Disimpan');
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
        $tahun = tahun::findOrfail($id);
        return view('tahun.edit',['tahun' => $tahun]);
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
            "tahun" => "required",
            "jmlpenduduk" => "required",
        ])->validate();

        $tahun = tahun::findOrfail($id);
        $tahun->tahun = $request->get('tahun');
        $tahun->jmlpenduduk = $request->get('jmlpenduduk');
        $tahun->save();
        return redirect()->route('tahun.index')->with('status','Data Berhasil Diupdate');
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
