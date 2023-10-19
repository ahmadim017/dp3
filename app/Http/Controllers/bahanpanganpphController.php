<?php

namespace App\Http\Controllers;

use App\Models\bahanpanganpph;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class bahanpanganpphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bahanpanganpph = bahanpanganpph::all();
        return view('bahanpanganpph.index',['bahanpanganpph' => $bahanpanganpph]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bahanpanganpph.create');
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
            "bahanpangan" => "required",
           
        ])->validate();

        $bahanpanganpph = new bahanpanganpph();
        $bahanpanganpph->bahanpangan = $request->get('bahanpangan');
        $bahanpanganpph->bobot = $request->get('bobot');
        $bahanpanganpph->skormaks = $request->get('skormaks');
        $bahanpanganpph->save();
        return redirect()->route('bahanpanganpph.index')->with('status','Data Berhasil disimpan');
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
        $bahanpanganpph = bahanpanganpph::findOrfail($id);
        return view('bahanpanganpph.edit',['bahanpanganpph' => $bahanpanganpph]);
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
            "bahanpangan" => "required",
        ])->validate();

        $bahanpanganpph = bahanpanganpph::findOrfail($id);
        $bahanpanganpph->bahanpangan = $request->get('bahanpangan');
        $bahanpanganpph->bobot = $request->get('bobot');
        $bahanpanganpph->skormaks = $request->get('skormaks');
        $bahanpanganpph->save();
        return redirect()->route('bahanpanganpph.index')->with('status','Data Berhasil disimpan');
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
