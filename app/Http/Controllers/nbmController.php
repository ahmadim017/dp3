<?php

namespace App\Http\Controllers;

use App\Exports\nbmExport;
use App\Models\bahanpangan;
use App\Models\kategori;
use App\Models\nbm;
use App\Models\nbmtahun;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class nbmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = $request->get('ta');
        $tahun = tahun::orderBy('tahun','asc')->get();
        $t = Carbon::now()->year;
        if ($ta) {
            $nbm = nbm::where('tahun', $ta)->get();
        }else{
            $nbm = nbm::where('tahun', $t)->get(); 
        }

        return view('nbm.index',[
            'nbm' => $nbm,
            'ta' => $ta,
            'tahun' => $tahun
        ]);
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
            "nbm.*.id_bahanpangan" => "required",
            "nbm.*.id_kategori" => "required",
            "nbm.*.kalori" => "required",
            "nbm.*.protein" => "required",
            "nbm.*.tahun" => "required",
            "nbm.*.lemak" => "required",
        ])->validated();
        
        foreach ($request->nbm as $data) {
          
            $nbm = nbm::create([
                'id_bahanpangan' => $data['id_bahanpangan'],
                'id_kategori' => $data['id_kategori'],
                'id_tahun' => $data['id_tahun'],
                'kalori' => $data['kalori'],
                'protein' => $data['protein'],
                'lemak' =>$data['lemak'],
                'tahun' => $data['tahun'],
            ]);
          
        }
       
	
    return redirect()->route('nbmtahun.show',[$nbm->id_tahun])->with('status','data Berhasil Disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $nbm = nbm::findOrfail($id);
       return view('nbm.show',['nbm' => $nbm]);
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
        $kategori = kategori::all();
        $tahun = tahun::all();
        $nbm = nbm::findOrfail($id);
        return view('nbm.edit',['nbm' => $nbm,'bahanpangan' => $bahanpangan,'kategori' => $kategori,'tahun' => $tahun]);
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
            "id_kategori" => "required",
            "kalori" => "required",
            "protein" => "required",
	        "lemak" => "required",
        ])->validated();

	$nbm = nbm::findOrfail($id);
	$nbm->id_bahanpangan = $request->get('id_bahanpangan');
	$nbm->id_kategori = $request->get('id_kategori');
	$nbm->kalori = $request->get('kalori');
	$nbm->protein = $request->get('protein');  
	$nbm->lemak = $request->get('lemak');
	$nbm->tahun = $request->get('tahun');
	$nbm->save();    
	
    return redirect()->route('nbmtahun.show',[$nbm->id_tahun])->with('status','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nbm = nbm::findOrfail($id);
        $nbm->delete();
        return redirect()->back()->with('Status','Data Berhasil dihapus');
 
    }

    public function export_excel(Request $request) 
    {
	$ta = $request->get('ta');
	//dd($ta);
        return Excel::download(new nbmExport($ta), 'nbm.xlsx');
    }

    public function dash(Request $request)
    {
        $ta = $request->get('ta');
        $tahun = tahun::orderBy('tahun','asc')->get();
        $t = Carbon::now()->year;

        $kategori = [];
        $totalkalori = [];
        $totallemak = [];
        $totalprotein = [];

        if ($ta){
            $totalnbm = DB::table('nbm')->leftJoin('kategori','nbm.id_kategori', '=', 'kategori.id')->where('tahun', $ta)
	        ->select('kategori.kategori',DB::raw('SUM(kalori) as kalori'),DB::raw('SUM(lemak) as lemak'), DB::raw('SUM(protein) as protein'))->groupBy('kategori.kategori')->get();
            foreach ($totalnbm as $n){
                $kategori[] = $n->kategori;
                $totalkalori[] =  round($n->kalori, 2);
                $totallemak[] =  round($n->lemak, 2);
                $totalprotein[] =  round($n->protein, 2);
                }
                $nbm = nbm::where('tahun', $ta)->get();
                $nbmtahun = nbmtahun::where('tahun', $ta)->get();
		if (!$nbmtahun) {
		 return view('nbm.dashboard')->with('error', 'Data NBM tahun tidak ditemukan untuk tahun ');
        	 }
        }else{
            $totalnbm = DB::table('nbm')->leftJoin('kategori','nbm.id_kategori', '=', 'kategori.id')->where('tahun', $t)
	        ->select('kategori.kategori',DB::raw('SUM(kalori) as kalori'),DB::raw('SUM(lemak) as lemak'), DB::raw('SUM(protein) as protein'))->groupBy('kategori.kategori')->get();
            foreach ($totalnbm as $n){
                $kategori[] = $n->kategori;
                $totalkalori[] =  round($n->kalori, 2);
                $totallemak[] =  round($n->lemak, 2);
                $totalprotein[] =  round($n->protein, 2);
                }
                $nbm = nbm::where('tahun', $t)->get();
                $nbmtahun = nbmtahun::where('tahun', $t)->first();
                
        }
        
        //dd($nbmtahun);
    return view('nbm.dashboard',[
        'nbm' => $nbm,
        'kategori' => $kategori,
        'totalkalori' => $totalkalori,
        'totallemak' => $totallemak,
        'totalprotein' => $totalprotein,
        'ta' => $ta,
        'tahun' => $tahun,
        't' => $t,
        'nbmtahun' => $nbmtahun
        ]);
    }
}
