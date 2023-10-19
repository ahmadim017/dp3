<?php

namespace App\Http\Controllers;

use App\Models\bahanpanganpph;
use App\Models\pphkecukupangizi;
use App\Models\pphkonsumsitahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pphkecukupangiziController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            "pphkecukupangizi.*.id_bahanpangan" => "required",
            "pphkecukupangizi.*.id_tahun" => "required",
            "pphkecukupangizi.*.kkal" => "required",
            "pphkecukupangizi.*.gram" => "required",
        ])->validate(); // Menggunakan validate() daripada validated()
        
        $totalkkal = 0;
        $totalgram = 0;
        foreach ($request->pphkecukupangizi as $data) {
            $kkal = floatval($data['kkal']);
            $gram = floatval($data['gram']);
            $totalkkal += $kkal;
            $totalgram += $gram;
        }

        $pphkecukupangizi = [];

        foreach ($request->pphkecukupangizi as $data) {
            // Ambil nilai kkal dari tabel pphkonsumsitahun berdasarkan id_tahun
            $d = $data['id_tahun'];
            $pphkonsumsitahun = pphkonsumsitahun::find($d);
            $kkalake = $pphkonsumsitahun->ake;
            $gramakp = $pphkonsumsitahun->akp;
           
            $bp = $data['id_bahanpangan'];
            $bahanpanganpph = bahanpanganpph::find($bp);
            $b = $bahanpanganpph->bobot;
            $m = $bahanpanganpph->skormaks;

            // Hitung total kkal
            $kkal = floatval($data['kkal']);
            $persen = ($kkal / $totalkkal) * 100;
            
            $gram = floatval($data['gram']);
            $persenprotein = ($gram / $totalgram) * 100;
            // Hitung ake, skoraktual, dan skorake
            $ake = $kkal /  $kkalake * 100;
	    $skoraktual = $persen * $b;
            $skorake = $ake * $b;
            $akp = $gram / $gramakp * 100;
            
	     if ($skorake >= $m) {
                $skorpph = $m;
            } else {
                $skorpph = $skorake;
            }

            // Simpan data ke tabel pphkonsumsi
            $pphkecukupangizi[] = [
                'id_bahanpangan' => $data['id_bahanpangan'],
                'kkal' => $data['kkal'],
                'id_tahun' => $data['id_tahun'],
                'ake' => $ake,
		'skoraktual' => $skoraktual,
                'skorake' => $skorake,
                'skorpph' => $skorpph,
                'gram' => $data['gram'],
                'persenprotein' => $persenprotein,
                'akp' => $akp,
                'persen' => $persen,
                'tahun' => $data['tahun'],
            ];
        }
        foreach ($pphkecukupangizi as $data) {
            pphkecukupangizi::create($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pphkecukupangizi = pphkecukupangizi::where('id_tahun',$id);
	$pphkecukupangizi->delete();
	return redirect()->back()->with('Status', 'Data Berhasil dihapus');
    }
}
