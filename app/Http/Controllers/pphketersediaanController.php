<?php

namespace App\Http\Controllers;

use App\Exports\pphketersediaanExport;
use App\Models\bahanpangan;
use App\Models\bahanpanganpph;
use App\Models\pphketersediaan;
use App\Models\pphketersediaantahun;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class pphketersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = $request->get('ta');
        $tahun = tahun::all();
        $t = Carbon::now()->year;

        if ($ta){
            $pphketersediaan = pphketersediaan::where('tahun', $ta)->get();
        }else{
            $pphketersediaan = pphketersediaan::where('tahun', $t)->get();
        }
        return view('pphketersediaan.index',[
            'pphketersediaan' => $pphketersediaan,
            'tahun' => $tahun,
            'ta' => $ta
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bahanpanganpph = bahanpanganpph::all();
        //$pphketersediaantahun = pphketersediaantahun::where
        $tahun = tahun::all();
        return view('pphketersediaan.create',['bahanpanganpph' => $bahanpanganpph,'tahun' => $tahun]);
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
            "pphketersediaan.*.id_bahanpangan" => "required",
            "pphketersediaan.*.id_tahun" => "required",
            "pphketersediaan.*.energi" => "required",
        ])->validated();
    
        foreach ($request->pphketersediaan as $data) {
            $d = $data['id_tahun'];
            $pphketersediaantahun = pphketersediaantahun::find($d);
            $kkal = $pphketersediaantahun->ake;
    
            $bp = $data['id_bahanpangan'];
            $bahanpanganpph = bahanpanganpph::find($bp);
            $b = $bahanpanganpph->bobot;
            $m = $bahanpanganpph->skormaks;
    
            $ake = $data['energi'] / $kkal * 100;
            $skorriil = $ake * $b;
    
            if ($skorriil >= $m) {
                $skorpph = $m;
            } else {
                $skorpph = $skorriil;
            }
    
            $pphketersediaan = pphketersediaan::create([
                'id_bahanpangan' => $data['id_bahanpangan'],
                'energi' => $data['energi'],
                'id_tahun' => $data['id_tahun'],
                'ake' => $ake,
                'skorriil' => $skorriil,
                'skorpph' => $skorpph,
                'tahun' => $data['tahun'],
            ]);
        }
    
        return redirect()->route('pphketersediaantahun.show',[$pphketersediaan->id_tahun])->with('status', 'Data Berhasil Disimpan');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pphketersediaan = pphketersediaan::findOrfail($id);
        return view('pphketersediaan.show',['pphketersediaan' => $pphketersediaan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bahanpangan = bahanpangan::all();
        $tahun = tahun::all();
        $pphketersediaan = pphketersediaan::findOrfail($id);
        return view('pphketersediaan.edit',['pphketersediaan' => $pphketersediaan,'bahanpangan' => $bahanpangan,'tahun' => $tahun]);
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
            "id_bahanpangan" => "required",
            "tahun" => "required",
            "skorriil" => "required",
            "skormaks" => "required",
	        "skorpph" => "required",
        ])->validated();

        $pphketersediaan = pphketersediaan::findOrfail($id);
        $pphketersediaan->energi = $request->get('energi');
        $pphketersediaan->save();

        return redirect()->route('pphketersediaantahun.show',[$pphketersediaan->id_tahun])->with('status','Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pphketersediaan = pphketersediaan::findOrfail($id);
        $pphketersediaan->delete();
        return redirect()->route('pphketersediaan.index')->with('Status','Data Berhasil dihapus');
 
    }

    public function export_excel(Request $request) 
    {
	    $ta = $request->get('ta');
        //dd($ta);
        return Excel::download(new pphketersediaanExport($ta), 'pphketersediaan.xlsx');
    }

}
