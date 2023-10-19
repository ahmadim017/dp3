<?php

namespace App\Http\Controllers;

use App\Models\bahanpanganpph;
use App\Models\pphketersediaan;
use App\Models\pphketersediaantahun;
use App\Models\tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class pphketersediaantahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pphketersediaantahun = pphketersediaantahun::all();
        return view('pphketersediaantahun.index',['pphketersediaantahun' => $pphketersediaantahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = tahun::all();
        return view('pphketersediaantahun.create',['tahun' => $tahun]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validation = Validator::make($request->all(), [
        "tahun" => [
            "required",
            Rule::unique('pphketersediaantahuns', 'tahun')
        ],
        "ake" => "required",
        
    ]);
    if ($validation->fails()) {
        return redirect()->route('pphketersediaantahun.create')
            ->withErrors($validation)
            ->withInput();
    }        
        $pphketersediaantahun = new pphketersediaantahun();
        $pphketersediaantahun->tahun = $request->get('tahun');
        $pphketersediaantahun->ake = $request->get('ake');
	if ($request->file('filepph')) {
            $file = $request->file('filepph')->store('filepph','public');
            $pphketersediaantahun->filepph = $file;
            }
        $pphketersediaantahun->save();

        return redirect()->route('pphketersediaantahun.index')->with('status','Data Berhasil disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pphketersediaantahun = pphketersediaantahun::findOrfail($id);
        $pphketersediaan = pphketersediaan::where('id_tahun', $id)->get();
        return view('pphketersediaantahun.show',['pphketersediaantahun' => $pphketersediaantahun,'pphketersediaan' => $pphketersediaan]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pphketersediaantahun = pphketersediaantahun::findOrfail($id);
        $tahun = tahun::all();
        return view('pphketersediaantahun.edit',['pphketersediaantahun' =>$pphketersediaantahun, 'tahun' =>$tahun]);
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
            "ake" => "required",
        ])->validated();
        
        $pphketersediaantahun = pphketersediaantahun::findOrfail($id);
        //$pphketersediaantahun->tahun = $request->get('tahun');
        $pphketersediaantahun->ake = $request->get('ake');
	 if ($request->file('filepph')) {
            if (  $pphketersediaantahun->filepph && file_exists(storage_path('app/public/'. $pphketersediaantahun->filepph))){
                Storage::delete('public/'. $pphketersediaantahun->filepph);
            }
            $file = $request->file('filepph')->store('filepph','public');
            $pphketersediaantahun->filepph = $file;
            }
        $pphketersediaantahun->save();

        return redirect()->route('pphketersediaantahun.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pphketersediaantahun = pphketersediaantahun::findOrfail($id);
        $pphketersediaantahun->pphketersediaan()->delete();
        if (  $pphketersediaantahun->filepph && file_exists(storage_path('app/public/'. $pphketersediaantahun->filepph))){
            Storage::delete('public/'. $pphketersediaantahun->filepph);
        }
        $pphketersediaantahun->delete();
        return redirect()->route('pphketersediaantahun.index')->with('Status','Data Berhasil dihapus');
    }
    public function download($id)
    {
        $pphketersediaantahun = pphketersediaantahun::findOrfail($id);
        return response()->download(storage_path('app/public/'. $pphketersediaantahun->filepph));
    }
    public function ketersediaan($id)
    {
        $pphketersediaantahun = pphketersediaantahun::findOrfail($id);
        $pphketersediaan = pphketersediaan::where('id_tahun', $id)->get();
        $bahanpanganpph = bahanpanganpph::all();
        $tahun = tahun::all();
        return view('pphketersediaan.create',[
            'bahanpanganpph' => $bahanpanganpph,
            'tahun' => $tahun,
            'pphketersediaan' => $pphketersediaan,
            'pphketersediaantahun' => $pphketersediaantahun
        ]);
    }
}
