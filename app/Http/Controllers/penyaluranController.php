<?php

namespace App\Http\Controllers;

use App\Imports\penyaluranImport;
use App\Exports\penyaluranExport;
use App\Models\komoditas;
use App\Models\tahun;
use App\Models\penyaluran;
use App\Models\cadanganpangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Carbon;

class penyaluranController extends Controller
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
        return view('penyaluran.index',['tahun' => $tahun,'ta' => $ta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
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
            "nik" => "required|numeric|digits_between:16,16",
	        "nama" => "required",
	        "id_komoditas" => "required",
            "jumlah" => "required",
         ])->validated();

         $penyaluran = new penyaluran();
         $penyaluran->id_cadanganpangan = $request->get('id_cadanganpangan');
         $penyaluran->nik = $request->get('nik');
         $penyaluran->nama = $request->get('nama');
         $penyaluran->id_komoditas = $request->get('id_komoditas');
         $penyaluran->jumlah = $request->get('jumlah');
         $penyaluran->save();
	  
          $totalPenyaluran = Penyaluran::where('id_cadanganpangan', $request->input('id_cadanganpangan'))->sum('jumlah');

        // Update nilai 'penyaluran' di tabel 'cadanganpangan'
        $cadanganpangan = Cadanganpangan::find($request->input('id_cadanganpangan'));
        if ($cadanganpangan) {
	    $akhir = $cadanganpangan->stockawal + $cadanganpangan->pengadaan - $totalPenyaluran;
            $cadanganpangan->penyaluran = $totalPenyaluran;
	    $cadanganpangan->stockakhir = $akhir;
            $cadanganpangan->save();
        }
        return redirect()->back()->with('status','Data Berhasil disimpan');
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
        $penyaluran = penyaluran::findOrfail($id);
        $komoditas = komoditas::all();
        return view('penyaluran.edit',['penyaluran' => $penyaluran,'komoditas' =>$komoditas]);
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
    $validation = Validator::make($request->all(), [
        "jumlah" => "required",
    ])->validated();

    $penyaluran = penyaluran::findOrFail($id);
    $previousAmount = $penyaluran->jumlah; // Jumlah penyaluran sebelumnya

    // Menghitung selisih jumlah penyaluran
    $selisihPenyaluran = $request->get('jumlah') - $previousAmount;

    $penyaluran->jumlah = $request->get('jumlah');
    $penyaluran->save();

    // Menghitung total penyaluran setelah perubahan
    $totalPenyaluran = penyaluran::where('id_cadanganpangan', $penyaluran->id_cadanganpangan)->sum('jumlah');

    // Update nilai 'penyaluran' di tabel 'cadanganpangan'
    $cadanganpangan = cadanganpangan::find($penyaluran->id_cadanganpangan);
    if ($cadanganpangan) {
        // Menghitung stok akhir yang diperbarui
        $stokAwal = $cadanganpangan->stockawal;
        $pengadaan = $cadanganpangan->pengadaan;
        $pelepasan = $cadanganpangan->pelepasan;
        $stockAkhir = $stokAwal + $pengadaan -$pelepasan - $totalPenyaluran;

        // Validasi agar stok akhir tidak menjadi negatif
        if ($stockAkhir < 0) {
            return redirect()->back()->with('error', 'Pengurangan penyaluran melebihi stok yang tersedia.');
        }

        $cadanganpangan->stockakhir = $stockAkhir;
        $cadanganpangan->penyaluran = $totalPenyaluran;
        $cadanganpangan->save();
    }

    return redirect()->back()->with('status', 'Data Berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyaluran = penyaluran::find($id);
        $penyaluran->delete();
        return redirect()->back()->with('Status','Data Berhasil dihapus');
    }
    

    public function import(Request $request,$id)
    {
        
        $cadanganPanganId = $id;
        Excel::import(new penyaluranImport($cadanganPanganId), request()->file('file'));
        return redirect()->back()->with('status', 'Import Successful');

    }

    public function cetak_pdf(Request $request)
    {
        $ta = $request->get('ta');
	$t = Carbon::now()->year;
	if ($ta){
        $penyaluran = penyaluran::whereYear('created_at', $ta)->get();
        }else{
	$penyaluran = penyaluran::whereYear('created_at', $ta)->get();

	}
        set_time_limit(120);
        $pdf = PDF::loadView('penyaluran.cetak', ['penyaluran' => $penyaluran]);
        return $pdf->stream('daftarpenyaluran.pdf');
    }

   public function export_excel(Request $request) 
    {
	   $ta = $request->get('ta');
        //return Excel::download(new usulanExport($opd,$kategori,$date1,$date2), 'usulan.xlsx');
        return Excel::download(new penyaluranExport($ta), 'daftarpenyaluran.xlsx');
    }
}
