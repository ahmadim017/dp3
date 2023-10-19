<?php

namespace App\Http\Controllers;

use App\Exports\sosialisasiExport;
use App\Models\jenispsat;
use App\Models\kecamatan;
use App\Models\sosialisasi;
use App\Models\tahun;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class sosialisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = tahun::orderBy('tahun', 'asc')->get();
        $tahun = $request->get('tahun');
       $sosialisasi = sosialisasi::all();
       return view('sosialisasipsat.index',['sosialisasi' => $sosialisasi,'tahun' => $tahun,'ta' => $ta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = kecamatan::all();
        //$centrepoint = CentrePoint::get()->first();
        return view('sosialisasipsat.create', ['kecamatan' => $kecamatan ]);
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
            "namausaha" => "required",
	        "nib" => "required",
	        "alamat" => "required",
            "kecamatan" => "required",
            "nohp" => "required|numeric",
            "namapelakuusaha" => "required",
            "file" => "file|max:2048",
         ])->validated();

         $sosialisasi = new sosialisasi();
         $sosialisasi->namausaha = $request->get('namausaha');
         $sosialisasi->nib = $request->get('nib');
         $sosialisasi->alamat = $request->get('alamat');
         $sosialisasi->kelurahan = $request->get('kelurahan');
         $sosialisasi->id_kecamatan = $request->get('id_kecamatan');
         $sosialisasi->nohp = $request->get('nohp');
         $sosialisasi->namapelakuusaha = $request->get('namapelakuusaha');
         $sosialisasi->sertifikat = $request->get('sertifikat');
         if ($request->file('file')) {
            $file = $request->file('file')->store('file','public');
            $sosialisasi->file = $file;
        }
        $sosialisasi->save();
        return redirect()->route('sosialisasipsat.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sosialisasi = sosialisasi::findOrfail($id);
        return view('sosialisasipsat.show',['sosialisasi' => $sosialisasi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = kecamatan::all();
        $sosialisasi = sosialisasi::findOrfail($id);
        return view('sosialisasipsat.edit',['sosialisasi' => $sosialisasi,'kecamatan' => $kecamatan]);
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
            "namausaha" => "required",
	    "nib" => "required",
	    "alamat" => "required",
            "kecamatan" => "required",
            "nohp" => "required|numeric",
            "namapelakuusaha" => "required",
            "file" => "file|max:2048",
         ])->validated();

         $sosialisasi = sosialisasi::findOrfail($id);
         $sosialisasi->namausaha = $request->get('namausaha');
         $sosialisasi->nib = $request->get('nib');
         $sosialisasi->alamat = $request->get('alamat');
         $sosialisasi->kelurahan = $request->get('kelurahan');
         $sosialisasi->id_kecamatan = $request->get('id_kecamatan');
         $sosialisasi->nohp = $request->get('nohp');
         $sosialisasi->namapelakuusaha = $request->get('namapelakuusaha');
         $sosialisasi->sertifikat = $request->get('sertifikat');
        
        if ($request->file('filekontrak')) {

            if ($sosialisasi->file && file_exists(storage_path('app/public/'.$sosialisasi->file))){
                Storage::delete('public/'.$sosialisasi->file);
            }
            $file = $request->file('file')->store('file','public');
            $sosialisasi->file = $file;
        }
        $sosialisasi->save();
        return redirect()->route('sosialisasipsat.index')->with('status','Data Berhasil diupdate');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	 $sosialisasi = sosialisasi::findOrfail($id);
	  if ($sosialisasi->file && file_exists(storage_path('app/public/'.$sosialisasi->file))){
                Storage::delete('public/'.$sosialisasi->file);
            }
	
         $sosialisasi->delete();
	 return redirect()->route('sosialisasipsat.index')->with('Status','Data Berhasil dihapus');
    }

    public function download($id)
    {
        $sosialisasi = sosialisasi::findOrfail($id);
        return response()->download(storage_path('app/public/'.$sosialisasi->file));
    }

    public function jenispsat($id)
    {
        $jenispsat =jenispsat::where('id_sosialisasi', $id)->get();
        $sosialisasi = sosialisasi::findOrfail($id);
        return view('jenispsat.create',['jenispsat' => $jenispsat,'sosialisasi' => $sosialisasi]);
    }

    public function cetak_pdf($id)
    {
       
        $sosialisasi = sosialisasi::findOrfail($id);
        $jenispsat =jenispsat::where('id_sosialisasi', $id)->get();
        set_time_limit(120);
        $pdf = PDF::loadview('sosialisasipsat.cetak',['jenispsat' => $jenispsat,'sosialisasi' => $sosialisasi]);
        return $pdf->stream();
    }

    public function export_excel(Request $request) 
    {
	    $ta = $request->get('ta');
        return Excel::download(new sosialisasiExport($ta), 'sosialisasipsat.xlsx');
    }
}
