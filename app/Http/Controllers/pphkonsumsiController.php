<?php

namespace App\Http\Controllers;

use App\Exports\pphkonsumsiExport;
use App\Models\bahanpanganpph;
use App\Models\pphketersediaan;
use App\Models\pphkonsumsi;
use App\Models\pphkonsumsitahun;
use App\Models\pphkecukupangizi;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class pphkonsumsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "pphkonsumsi.*.id_bahanpangan" => "required",
            "pphkonsumsi.*.id_tahun" => "required",
            "pphkonsumsi.*.kkal" => "required",
        ])->validate(); // Menggunakan validate() daripada validated()
        
        $totalkkal = 0;

        foreach ($request->pphkonsumsi as $data) {
            $kkal = floatval($data['kkal']);
            $totalkkal += $kkal;
        }

        $pphkonsumsi = [];

        foreach ($request->pphkonsumsi as $data) {
            // Ambil nilai kkal dari tabel pphkonsumsitahun berdasarkan id_tahun
            $d = $data['id_tahun'];
            $pphkonsumsitahun = pphkonsumsitahun::find($d);
            $kkalake = $pphkonsumsitahun->ake;
        
            // Ambil bobot dan skormaks dari tabel bahanpanganpph berdasarkan id_bahanpangan
            $bp = $data['id_bahanpangan'];
            $bahanpanganpph = bahanpanganpph::find($bp);
            $b = $bahanpanganpph->bobot;
            $m = $bahanpanganpph->skormaks;
        
            // Hitung total kkal
            $kkal = floatval($data['kkal']);
            $persen = ($kkal / $totalkkal) * 100;
        
            // Hitung ake, skoraktual, dan skorake
            $ake = $kkal /  $kkalake * 100;
            $skoraktual = $persen * $b;
            $skorake = $ake * $b;
        
            // Tentukan nilai skorpph
            if ($skorake >= $m) {
                $skorpph = $m;
            } else {
                $skorpph = $skorake;
            }
        
            // Simpan data ke tabel pphkonsumsi
            $pphkonsumsi[] = [
                'id_bahanpangan' => $data['id_bahanpangan'],
                'kkal' => $data['kkal'],
                'id_tahun' => $data['id_tahun'],
                'ake' => $ake,
                'skoraktual' => $skoraktual,
                'skorake' => $skorake,
                'skorpph' => $skorpph,
                'persen' => $persen,
                'tahun' => $data['tahun'],
            ];
        }
        foreach ($pphkonsumsi as $data) {
            pphkonsumsi::create($data);
        }
        return redirect()->route('pphkonsumsitahun.show',$data['id_tahun'])->with('status','data Berhasil Disimpan');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pphkonsumsi = pphkonsumsi::findOrfail($id);
        return view('pphkonsumsi.show',['pphkonsumsi' => $pphkonsumsi]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            "kkal" => "required",
        ])->validated();

	    $pphkonsumsi = pphkonsumsi::findOrfail($id);
        $pphkonsumsi->kkal = $request->get('kkal');  
	    $pphkonsumsi->save();
        return redirect()->route('pphkonsumsitahun.show',[$pphkonsumsi->id_tahun])->with('status','data Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $pphkonsumsi = pphkonsumsi::findOrfail($id);
       $pphkonsumsi->delete();
       return redirect()->route('pphkonsumsitahun.show',[$pphkonsumsi->id_tahun])->with('Status','Data Berhasil dihapus');

    }

    public function export_excel(Request $request) 
    {
	$ta = $request->get('ta');
        return Excel::download(new pphkonsumsiExport($ta), 'pphkonsumsi.xlsx');
    }

    public function dash(Request $request)
    {
        $ta = $request->get('ta');
        $tahun = tahun::orderBy('tahun','asc')->get();
        $t = Carbon::now()->year;

        if ($ta){
            $pphkonsumsi = pphkecukupangizi::where('tahun', $ta)->get();
            $pphketersediaan = pphketersediaan::where('tahun', $ta)->get();
        }else{
            $pphkonsumsi = pphkecukupangizi::where('tahun', $t)->get();
            $pphketersediaan = pphketersediaan::where('tahun', $t)->get();
        }
       
        return view('pphkonsumsi.dashboard',[
            'pphkonsumsi' => $pphkonsumsi,
            'pphketersediaan' => $pphketersediaan,
            'ta' => $ta,
            'tahun' => $tahun,
            't' => $t
        ]);
    }
}
