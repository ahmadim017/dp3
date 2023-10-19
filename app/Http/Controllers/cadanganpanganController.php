<?php

namespace App\Http\Controllers;

use App\Exports\cadanganpanganExport;
use App\Models\bulan;
use App\Models\cadanganpangan;
use App\Models\komoditas;
use App\Models\pelepasan;
use App\Models\penyaluran;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class cadanganpanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = tahun::orderBy('tahun','asc')->get();
        $ba = bulan::all();
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        //dd($bulan);
        if($bulan !='' || $tahun !=''){
        $cadanganpangan = cadanganpangan::when($bulan, function ($query, $bulan) {
                        return $query->where('id_bulan', $bulan);
                    })
    
                        ->when($tahun, function ($query, $tahun) {
                        return $query->where('tahun', $tahun);
                    })
                    ->get();
        }else{
        $cadanganpangan = cadanganpangan::all();
        }
        return view('cadanganpangan.index',['cadanganpangan' => $cadanganpangan,'tahun' => $tahun,'ta' => $ta,'bulan' => $bulan,'ba' => $ba]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
{
    $currentYear = Carbon::now()->year;

    if (cadanganpangan::whereYear('created_at', $currentYear)->exists()) {
        $cadanganpangan = cadanganpangan::latest()->first();
        $stockakhir = $cadanganpangan->stockakhir;
    } else {
        $stockakhir = null;
    }

    $tahun = tahun::orderBy('tahun','asc')->get();
    $bulan = bulan::all();

    return view('cadanganpangan.create', ['stockakhir' => $stockakhir, 'tahun' => $tahun, 'bulan' => $bulan]);
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
            "stockawal" => "required",
	        "tahun" => "required",
	        "id_bulan" => "required",
            "filekontrak" => "file|mimes:pdf|max:15048",
         ])->validated();
        
	    $stockakhir = $request->get('stockawal') + $request->get('pengadaan') - $request->get('penyaluran');	
	

        $cadanganpangan = new cadanganpangan;
        $cadanganpangan->stockawal = $request->get('stockawal');
        $cadanganpangan->pengadaan = $request->get('pengadaan');
        //$cadanganpangan->penyaluran = $request->get('penyaluran');
       	$cadanganpangan->stockakhir = $stockakhir;
	$cadanganpangan->id_bulan = $request->get('id_bulan');
	$cadanganpangan->tahun = $request->get('tahun');
       	$cadanganpangan->nokontrak = $request->get('nokontrak');
        $cadanganpangan->tglkontrak = $request->get('tglkontrak');
        if ($request->file('filekontrak')) {
            $file = $request->file('filekontrak')->store('filekontrak','public');
            $cadanganpangan->filekontrak = $file;
            $cadanganpangan->tittle = $request->file('filekontrak')->getClientOriginalName();
        }
	    $cadanganpangan->save();
        return redirect()->route('cadanganpangan.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadanganpangan = cadanganpangan::findOrfail($id);
        return view('cadanganpangan.show',['cadanganpangan' => $cadanganpangan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun = tahun::orderBy('tahun','asc')->get();
	$bulan = bulan::all();
        $cadanganpangan = cadanganpangan::findOrfail($id);
        return view('cadanganpangan.edit',['cadanganpangan' => $cadanganpangan,'tahun' => $tahun,'bulan' => $bulan]);
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
            "stockawal" => "required",
	        "tahun" => "required",
	        "id_bulan" => "required",
            "filekontrak" => "file|mimes:pdf|max:15048",
         ])->validated();
            $totalPenyaluran = penyaluran::where('id_cadanganpangan',$id)->sum('jumlah');
	    $stockakhir = $request->get('stockawal') + $request->get('pengadaan') - $totalPenyaluran;	

	$penyaluran = penyaluran::where('id_cadanganpangan',$id)->sum('jumlah');
        $cadanganpangan = cadanganpangan::findOrfail($id);
        $cadanganpangan->stockawal = $request->get('stockawal');
        $cadanganpangan->pengadaan = $request->get('pengadaan');
        //$cadanganpangan->penyaluran = $request->get('penyaluran');
       	$cadanganpangan->stockakhir = $stockakhir;
	$cadanganpangan->id_bulan = $request->get('id_bulan');
	$cadanganpangan->tahun = $request->get('tahun');
       	$cadanganpangan->nokontrak = $request->get('nokontrak');
        $cadanganpangan->tglkontrak = $request->get('tglkontrak');
        if ($request->file('filekontrak')) {

            if ($cadanganpangan->filekontrak && file_exists(storage_path('app/public/'.$cadanganpangan->filekontrak))){
                Storage::delete('public/'.$cadanganpangan->filekontrak);
            }
            $file = $request->file('filekontrak')->store('filekontrak','public');
            $cadanganpangan->filekontrak = $file;
            $cadanganpangan->tittle = $request->file('filekontrak')->getClientOriginalName();
        }
       
	    $cadanganpangan->save();
        return redirect()->route('cadanganpangan.index')->with('status','Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cadanganpangan = cadanganpangan::findorfail($id);
        $penyaluran = penyaluran::where('id_cadanganpangan',$id)->get();
        if ($cadanganpangan->filekontrak && file_exists(storage_path('app/public/'.$cadanganpangan->filekontrak))){
            Storage::delete('public/'. $cadanganpangan->filekontrak);
                }
        $cadanganpangan->penyaluran()->delete();
        $cadanganpangan->delete();
        return redirect()->route('cadanganpangan.index')->with('Status','Data Berhasil dihapus');
    }

    public function export_excel(Request $request) 
    {
	    $ta = $request->get('ta');
        return Excel::download(new cadanganpanganExport($ta), 'cadanganpangan.xlsx');
    }
    public function download($id)
    {
        $cadanganpangan = cadanganpangan::findorfail($id);
        return response()->download(storage_path('app/public/'. $cadanganpangan->filekontrak));
    }

    public function daftarpenyaluran($id)
    {
        $penyaluran = penyaluran::where('id_cadanganpangan', $id)->get();
        $cadanganpangan = cadanganpangan::findOrfail($id);
        $komoditas = komoditas::all();
        return view('penyaluran.create',['penyaluran' => $penyaluran,'cadanganpangan' => $cadanganpangan,'komoditas' => $komoditas]);
    }

    public function daftarpelepasan($id)
    {
        $pelepasan = pelepasan::where('id_cadanganpangan', $id)->get();
        $cadanganpangan = cadanganpangan::findOrfail($id);
        $komoditas = komoditas::all();
        return view('pelepasan.create',['pelepasan' => $pelepasan,'cadanganpangan' => $cadanganpangan,'komoditas' => $komoditas]);
    }

    public function dash(Request $request)
    {
    $ta = $request->get('ta');
    $tahun = tahun::orderBy('tahun','asc')->get();
    $t = Carbon::now()->year;
    //dd($t);
    // Initialize arrays to avoid "undefined variable" errors
    $cbulan = [];
    $cstockawal = [];
    $cpengadaan = [];
    $cpenyaluran = [];
    $cpelepasan = [];
    $cstockakhir = [];
    
    if ($ta){
        $cdpangan = DB::table('cadanganpangan')
            ->leftJoin('bulan','cadanganpangan.id_bulan', '=', 'bulan.id')
            ->select('bulan.bulan',DB::raw('SUM(stockawal) as stockawal'),DB::raw('SUM(pengadaan) as pengadaan'), DB::raw('SUM(penyaluran) as penyaluran'), DB::raw('SUM(pelepasan) as pelepasan'), DB::raw('SUM(stockakhir) as stockakhir'))
            ->where('tahun', $ta)
            ->groupBy('bulan.bulan')
            ->orderBy('bulan.id','ASC')
            ->get();

        foreach ($cdpangan as $c){
            $cbulan[] = $c->bulan;
            $cstockawal[] =  $c->stockawal;
            $cpengadaan[] = $c->pengadaan;
            $cpenyaluran[] = $c->penyaluran;
            $cpelepasan[] = $c->pelepasan;
            $cstockakhir[] =  $c->stockakhir;
        }
        $cadanganpangan = cadanganpangan::where('tahun', $ta)->get();
    } else {
        $cdpangan = DB::table('cadanganpangan')
        ->leftJoin('bulan','cadanganpangan.id_bulan', '=', 'bulan.id')
        ->select('bulan.bulan',DB::raw('SUM(stockawal) as stockawal'),DB::raw('SUM(pengadaan) as pengadaan'), DB::raw('SUM(penyaluran) as penyaluran'), DB::raw('SUM(pelepasan) as pelepasan'), DB::raw('SUM(stockakhir) as stockakhir'))
        ->where('tahun', $t)
        ->groupBy('bulan.bulan')
        ->orderBy('bulan.id','ASC')
        ->get();

        foreach ($cdpangan as $c){
            $cbulan[] = $c->bulan;
            $cstockawal[] =  $c->stockawal;
            $cpengadaan[] = $c->pengadaan;
            $cpenyaluran[] = $c->penyaluran;
            $cpelepasan[] = $c->pelepasan;
            $cstockakhir[] =  $c->stockakhir;
            //dd($cdpangan);
        }
        $cadanganpangan = cadanganpangan::where('tahun', $t)->get();
    }

    
    
    return view('cadanganpangan.dashboard', [
        'ta' => $ta,
        'tahun' => $tahun,
        'cbulan' => $cbulan,
        'cadanganpangan' => $cadanganpangan,
        'cstockawal' => $cstockawal,
        'cpengadaan' => $cpengadaan,
        'cpenyaluran' => $cpenyaluran,
        'cpelepasan' => $cpelepasan,
        'cstockakhir' => $cstockakhir,
    ]);

    }
}
