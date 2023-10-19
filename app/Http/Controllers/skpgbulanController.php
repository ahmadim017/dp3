<?php

namespace App\Http\Controllers;

use App\Models\bulan;
use App\Models\kecamatan;
use App\Models\skpg;
use App\Models\skpgbulan;
use App\Models\tahun;
use App\Rules\UniqueYearMonth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class skpgbulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = tahun::all();
       
        $tahun = $request->get('tahun');
      
        //dd($bulan);
        if($tahun !=''){
        $skpgbulan = skpgbulan::when($tahun, function ($query, $tahun) {
                        return $query->where('tahun', $tahun);
                    })
                    ->get();
        }else{
        $skpgbulan = skpgbulan::all();
        }
         return view('skpgbulan.index',['skpgbulan' => $skpgbulan,'tahun' => $tahun,'ta' => $ta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bulan = bulan::all();
        $tahun = tahun::all();
        return view('skpgbulan.create',['bulan' => $bulan,'tahun' => $tahun]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingEntry = Skpgbulan::where('tahun', $request->get('tahun'))
        ->where('id_bulan', $request->get('id_bulan'))
        ->first();
    
    if ($existingEntry) {
        // Tampilkan pesan kesalahan jika data sudah ada
        return redirect()->route('skpgbulan.create')
            ->withErrors(['id_bulan' => 'Data dengan tahun dan bulan yang sama sudah ada'])
            ->withInput();
    }
               
            $skpgbulan = new skpgbulan();
            $skpgbulan->tahun = $request->get('tahun');
            $skpgbulan->id_bulan = $request->get('id_bulan');    
            if ($request->file('fileik')) {
                $file = $request->file('fileik')->store('fileik','public');
                $skpgbulan->fileik = $file;
            }
            if ($request->file('fileia')) {
                $file = $request->file('fileia')->store('fileia','public');
                $skpgbulan->fileia = $file;
            }
            if ($request->file('fileip')) {
                $file = $request->file('fileip')->store('fileip','public');
                $skpgbulan->fileip = $file;
            }
            $skpgbulan->save();

        return redirect()->route('skpgbulan.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skpg = skpg::where('id_skpgbulan', $id)->get();
        $skpgbulan = skpgbulan::findOrfail($id);
        return view('skpgbulan.show',['skpgbulan' => $skpgbulan,'skpg' => $skpg]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bulan = bulan::all();
        $tahun = tahun::all();
        $skpgbulan = skpgbulan::findOrfail($id);
        return view('skpgbulan.edit',['skpgbulan' => $skpgbulan,'bulan' => $bulan,'tahun' => $tahun]);
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
        
        $skpgbulan = skpgbulan::findOrfail($id);    
        if ($request->file('fileik')) {
            if ($skpgbulan->fileik && file_exists(storage_path('app/public/'.$skpgbulan->fileik))){
                Storage::delete('public/'.$skpgbulan->fileik);
            }
            $file = $request->file('fileik')->store('fileik','public');
            $skpgbulan->fileik = $file;
        }
        if ($request->file('fileia')) {
            if ($skpgbulan->fileia && file_exists(storage_path('app/public/'.$skpgbulan->fileia))){
                Storage::delete('public/'.$skpgbulan->fileia);
            }
            $file = $request->file('fileia')->store('fileia','public');
            $skpgbulan->fileia = $file;
        }
        if ($request->file('fileip')) {
            if ($skpgbulan->fileip && file_exists(storage_path('app/public/'.$skpgbulan->fileip))){
                Storage::delete('public/'.$skpgbulan->fileip);
            }
            $file = $request->file('fileip')->store('fileip','public');
            $skpgbulan->fileip = $file;
        }
        $skpgbulan->save();

        return redirect()->route('skpgbulan.index')->with('status','Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skpgbulan = skpgbulan::findOrfail($id);
        $skpgbulan->skpg()->delete();
        if ($skpgbulan->fileik && file_exists(storage_path('app/public/'.$skpgbulan->fileik))){
            Storage::delete('public/'.$skpgbulan->fileik);
        }
        if ($skpgbulan->fileia && file_exists(storage_path('app/public/'.$skpgbulan->fileia))){
            Storage::delete('public/'.$skpgbulan->fileia);
        }
        if ($skpgbulan->fileip && file_exists(storage_path('app/public/'.$skpgbulan->fileip))){
            Storage::delete('public/'.$skpgbulan->fileip);
        }
        $skpgbulan->delete();
        return redirect()->route('skpgbulan.index')->with('Status','Data Berhasil dihapus');
    }

    public function downloadik($id)
    {
        $skpg = skpg::findOrfail($id);
        return response()->download(storage_path('app/public/'.$skpg->fileik));
    }

    public function downloadia($id)
    {
        $skpg = skpg::findOrfail($id);
        return response()->download(storage_path('app/public/'.$skpg->fileia));
    }

    public function downloadip($id)
    {
        $skpg = skpg::findOrfail($id);
        return response()->download(storage_path('app/public/'.$skpg->fileip));
    }

    public function skpg($id)
    {
        $skpgbulan = skpgbulan::findOrfail($id);
        $skpg = skpg::where('id_skpgbulan', $id)->get();
        $kecamatan = kecamatan::all();
        return view('skpg.create',[
            'kecamatan' => $kecamatan,
            'skpg' => $skpg,
            'skpgbulan' => $skpgbulan
        ]);
    }
}
