<?php

namespace App\Http\Controllers;

use App\Exports\prognosaExport;
use App\Models\bulan;
use App\Models\komoditas;
use App\Models\prognosa;
use App\Models\tahun;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class prognosaController extends Controller
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
    $t = Carbon::now()->year;
	$tahun = $request->get('tahun');
	$bulan = $request->get('bulan');
	if($bulan !='' || $tahun !=''){
	 $prognosa = prognosa::when($bulan, function ($query, $bulan) {
                    return $query->where('id_bulan', $bulan);
                })
                ->when($tahun, function ($query, $tahun) {
                    return $query->where('tahun', $tahun);
                })
                ->get();
    }else{
	$prognosa = prognosa::where('tahun',$t)->get();
	}    
        return view('prognosa.index',[
            'prognosa' => $prognosa,
            'ba' => $ba,
            'ta' => $ta,
            'tahun' => $tahun,
            'bulan' => $bulan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $komoditas = komoditas::all();
        $tahun = tahun::orderBy('tahun','asc')->get();
        $bulan = bulan::all();
        return view('prognosa.create',['komoditas' => $komoditas,'tahun' => $tahun,'bulan' => $bulan]);
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

            "prognosa.*.id_komoditas" => "required",
            "prognosa.*.kebutuhantahunan" => "required",
	     "prognosa.*.id_bulan" => "required",
	     "prognosa.*.tahun" => "required",
        ])->validated();

        foreach ($request->prognosa as $data) {

            $totalketersediaan = $data['stockawal'] + $data['produksi'] + $data['barangmasuk'];
            $neraca = $totalketersediaan - $data['kebutuhantahunan'];
            $rencanaimpor = $neraca * 1.2;
            $stockakhir = $neraca + $rencanaimpor;
            $kebutuhanbulanan = $data['kebutuhantahunan'] /12 ;

            prognosa::create([
                'id_komoditas' => $data['id_komoditas'],
                'stockawal' => $data['stockawal'],
                'produksi' =>  $data['produksi'],
		'barangmasuk' =>  $data['barangmasuk'],
                'kebutuhantahunan' =>  $data['kebutuhantahunan'],
                'neraca' => $neraca,
                'kebutuhanbulanan' => $kebutuhanbulanan,
                'rencanaimpor'  => $rencanaimpor,
                'stockakhir' => $stockakhir,
                'totalketersediaan' => $totalketersediaan,
                'id_bulan' => $data['id_bulan'],
                'tahun' => $data['tahun'],
                
            ]);
        }

         return redirect()->route('prognosa.index')->with('status','data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prognosa = prognosa::findOrfail($id);
        return view('prognosa.show',['prognosa' => $prognosa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komoditas = komoditas::all();
        $tahun = tahun::orderBy('tahun','asc')->get();
        $bulan = bulan::all();
        $prognosa = prognosa::findOrfail($id);
        return view('prognosa.edit',['komoditas' => $komoditas,'tahun' => $tahun,'prognosa' => $prognosa,'bulan' => $bulan]);
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
	        "id_komoditas" => "required",
            "id_bulan" => "required",
            "kebutuhantahunan" => "required",
            ])->validated();

         $totalketersediaan = $request->get('stockawal') + $request->get('produksi') + $request->get('barangmasuk');
         $neraca = $totalketersediaan - $request->get('kebutuhantahunan');
         $rencanaimpor = $neraca * 1.2;
         $stokakhir = $neraca + $rencanaimpor;
         $kebutuhanbulanan = $request->get('kebutuhantahunan') /12 ;
	 
         $prognosa = prognosa::findOrfail($id);
         $prognosa->id_komoditas = $request->get('id_komoditas');
         $prognosa->tahun = $request->get('tahun');
         $prognosa->id_bulan = $request->get('id_bulan');
         $prognosa->stockawal = $request->get('stockawal');
         $prognosa->produksi = $request->get('produksi');
	 $prognosa->barangmasuk = $request->get('barangmasuk');
         $prognosa->totalketersediaan = $totalketersediaan;
         $prognosa->kebutuhantahunan = $request->get('kebutuhantahunan');
         $prognosa->kebutuhanbulanan = $kebutuhanbulanan;
         $prognosa->neraca = $neraca;
         $prognosa->rencanaimpor =  $rencanaimpor;
         $prognosa->stockakhir = $stokakhir;
         $prognosa->save();
         return redirect()->route('prognosa.index')->with('status','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prognosa = prognosa::findOrfail($id);
        $prognosa->delete();
        return redirect()->route('prognosa.index')->with('Status','data berhasil dihapus');
    }

    public function export_excel(Request $request) 
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        //dd($bulan);
        //return Excel::download(new usulanExport($opd,$kategori,$date1,$date2), 'usulan.xlsx');
        return Excel::download(new prognosaExport($bulan,$tahun), 'prognosapangan.xlsx');
    }

    public function dashboard(Request $request)
    {

    $ta = tahun::orderBy('tahun','asc')->get();

	$ba = bulan::all();
	$tahun = $request->get('tahun');
	$bulan = $request->get('bulan');
    $t = Carbon::now()->year;
    $b =  prognosa::latest('id_bulan')->first();
    if($b){
        $b = $b->id_bulan;
    }else{
        $b = Carbon::now()->month;
    }

    $komo = [];
    $stockakhir = [];
    $neraca = [];
    $kebutuhantahunan = [];
    $totalketersediaan = [];

    if($bulan||$tahun){
        $progno = DB::table('prognosa')->leftJoin('komoditas', 'prognosa.id_komoditas', '=', 'komoditas.id')
    	->select('komoditas.komoditas', DB::raw('SUM(totalketersediaan) as totalketersediaan'),
        DB::raw('SUM(kebutuhantahunan) as kebutuhantahunan'), DB::raw('SUM(neraca) as neraca'), 
        DB::raw('SUM(stockakhir) as stockakhir'))
        ->when($bulan, function ($query, $bulan) {
            return $query->where('id_bulan', $bulan);
        })
        ->when($tahun, function ($query, $tahun) {
            return $query->where('tahun', $tahun);
        })
        ->groupBy('komoditas.komoditas')->orderBy('komoditas.id','ASC')->get();	
	   
        foreach ($progno as $n){
            $komo[] = $n->komoditas;
            $totalketersediaan[] = round($n->totalketersediaan, 2);
            $kebutuhantahunan[] = round($n->kebutuhantahunan, 2);
            $neraca[] = round($n->neraca, 2);
            $stockakhir[] = round($n->stockakhir, 2);
            }

            $prognosa = prognosa::when($bulan, function ($query, $bulan) {
                return $query->where('id_bulan', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })->get();

        }else{
            $progno = DB::table('prognosa')->leftJoin('komoditas', 'prognosa.id_komoditas', '=', 'komoditas.id')
            ->select('komoditas.komoditas', DB::raw('SUM(totalketersediaan) as totalketersediaan'),
            DB::raw('SUM(kebutuhantahunan) as kebutuhantahunan'), DB::raw('SUM(neraca) as neraca'), 
            DB::raw('SUM(stockakhir) as stockakhir'))
            ->where('id_bulan', $b)->where('tahun', $t)
            ->groupBy('komoditas.komoditas')->orderBy('komoditas.id','ASC')->get();		
           
            foreach ($progno as $n){
                $komo[] = $n->komoditas;
                $totalketersediaan[] = round($n->totalketersediaan, 2);
                $kebutuhantahunan[] = round($n->kebutuhantahunan, 2);
                $neraca[] = round($n->neraca, 2);
                $stockakhir[] = round($n->stockakhir, 2);
                }

                $prognosa = prognosa::where('id_bulan', $b)->where('tahun', $t)->get();
        }

      

        return view('prognosa.dashboard',[
            'komo' => $komo,
            'prognosa' => $prognosa,
            'stockakhir' => $stockakhir,
            'neraca' =>$neraca,
            'kebutuhantahunan' => $kebutuhantahunan,
            'totalketersediaan' => $totalketersediaan,
            'ta' => $ta,
            'ba' => $ba,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

}
