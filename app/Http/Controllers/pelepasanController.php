<?php

namespace App\Http\Controllers;

use App\Imports\pelepasanImport;
use App\Models\cadanganpangan;
use App\Models\komoditas;
use App\Models\pelepasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class pelepasanController extends Controller
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
        $validation = Validator::make($request->all(),[
            "nik" => "required|numeric|digits_between:16,16",
	        "nama" => "required",
	        "id_komoditas" => "required",
            "jumlah" => "required",
         ])->validated();

         $pelepasan = new pelepasan();
         $pelepasan->id_cadanganpangan = $request->get('id_cadanganpangan');
         $pelepasan->nik = $request->get('nik');
         $pelepasan->nama = $request->get('nama');
         $pelepasan->id_komoditas = $request->get('id_komoditas');
         $pelepasan->jumlah = $request->get('jumlah');
        $pelepasan->save();

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
        $pelepasan = pelepasan::findOrfail($id);
        $komoditas = komoditas::all();
        return view('pelepasan.edit',['pelepasan' => $pelepasan,'komoditas' =>$komoditas]);
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
    
        $pelepasan = pelepasan::findOrFail($id);
        $previousAmount = $pelepasan->jumlah; // Jumlah penyaluran sebelumnya
    
        // Menghitung selisih jumlah penyaluran
        $selisihPenyaluran = $request->get('jumlah') - $previousAmount;
    
        $pelepasan->jumlah = $request->get('jumlah');
        $pelepasan->save();
    
        // Menghitung total penyaluran setelah perubahan
        $totalPelepasan = pelepasan::where('id_cadanganpangan', $pelepasan->id_cadanganpangan)->sum('jumlah');
    
        // Update nilai 'penyaluran' di tabel 'cadanganpangan'
        $cadanganpangan = cadanganpangan::find($pelepasan->id_cadanganpangan);
        if ($cadanganpangan) {
            // Menghitung stok akhir yang diperbarui
            $stokAwal = $cadanganpangan->stockawal;
            $pengadaan = $cadanganpangan->pengadaan;
            $penyaluran = $cadanganpangan->penyaluran;
            $stockAkhir = $stokAwal + $pengadaan -$penyaluran - $totalPelepasan;
    
            // Validasi agar stok akhir tidak menjadi negatif
            if ($stockAkhir < 0) {
                return redirect()->back()->with('error', 'Pengurangan penyaluran melebihi stok yang tersedia.');
            }
    
            $cadanganpangan->stockakhir = $stockAkhir;
            $cadanganpangan->pelepasan = $totalPelepasan;
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
        $pelepasan = pelepasan::find($id);
        $pelepasan->delete();
        return redirect()->back()->with('Status','Data Berhasil dihapus');
    }

    public function import(Request $request,$id)
    {
        $validation = Validator::make($request->all(),[
            "file" => "required|file|mimes:csv,excel",
         ])->validated();

        $cadanganPanganId = $id;
        Excel::import(new pelepasanImport($cadanganPanganId), request()->file('file'));
        return redirect()->back()->with('status', 'Import Successful');
    }

}
