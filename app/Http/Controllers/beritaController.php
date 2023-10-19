<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class beritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = berita::all();
        return view('berita.index',['berita' => $berita]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
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
            "judul" => "required",
            "keterangan" => "required",
            "isi" => "required|min:5",
            "foto" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:5048"
        ])->validated();

        $berita = new berita();
        $berita->judul = $request->get('judul');
        $berita->slug = Str::slug($request->judul);
        $berita->isi = $request->get('isi');
        $berita->keterangan = $request->get('keterangan');
        $berita->created_by = Auth::user()->id;
        $berita->status = 'INACTIVE';
        if ($request->file('file')) {
            $file = $request->file('file')->store('foto','public');
            $berita->file = $file;
            $berita->tittle = $request->file('file')->getClientOriginalName();
        }
        $berita->save();
        return redirect()->route('berita.index')->with('status','Data Berhasil disimpan');
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
        $berita = berita::find($id);
        return view('berita.edit',['berita' => $berita]);
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
            "judul" => "required",
            "keterangan" => "required",
            "isi" => "required|min:5",
            "foto" => "image|mimes:jpeg,png,jpg,gif,svg|max:5048",
        ])->validated();

        $berita = berita::find($id);
        $berita->judul = $request->get('judul');
        $berita->slug = Str::slug($request->judul);
        $berita->keterangan = $request->get('keterangan');
        $berita->isi = $request->get('isi');
        $berita->updated_by = Auth::user()->id;
        $berita->status = $request->get('status');
        if ($request->file('file')) {

            if ($berita->file && file_exists(storage_path('app/public/'.$berita->file))){
                Storage::delete('public/'.$berita->file);
            }
            $file = $request->file('file')->store('foto','public');
            $berita->file = $file;
            $berita->tittle = $request->file('file')->getClientOriginalName();
        }
        $berita->save();

        return redirect()->route('berita.index')->with('status','Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = berita::find($id);
        if ($berita->file && file_exists(storage_path('app/public/'.$berita->file))){
            Storage::delete('public/'. $berita->file);
                }
                $berita->delete();
        return redirect()->route('berita.index')->with('Status','Berhasil dihapus'); 
    }
    
}