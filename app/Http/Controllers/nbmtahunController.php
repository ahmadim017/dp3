<?php

namespace App\Http\Controllers;

use App\Models\bahanpangan;
use App\Models\kategori;
use App\Models\nbm;
use App\Models\nbmtahun;
use App\Models\tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class nbmtahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nbmhtahun = nbmtahun::all();
        return view('nbmtahun.index',['nbmtahun' => $nbmhtahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = tahun::all();
        return view('nbmtahun.create',['tahun' => $tahun]);
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
            Rule::unique('nbmtahuns', 'tahun')
        ],
       "filenbm" => "required",
        "kalori" => "required",
        "protein" => "required",
	"lemak" => "required",
        
    ]);
    if ($validation->fails()) {
        return redirect()->route('nbmtahun.create')
            ->withErrors($validation)
            ->withInput();
    }     
       	$nbmtahun = new nbmtahun();
	$nbmtahun->tahun= $request->get('tahun');
	$nbmtahun->kalori = $request->get('kalori');
	$nbmtahun->protein = $request->get('protein');  
	$nbmtahun->lemak = $request->get('lemak');
    if ($request->file('filenbm')) {
        $file = $request->file('filenbm')->store('filenbm','public');
        $nbmtahun->filenbm = $file;
    }
	$nbmtahun->save();    
	
    return redirect()->route('nbmtahun.index')->with('status','data Berhasil Disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nbmtahun = nbmtahun::findOrfail($id);
        $nbm = nbm::where('id_tahun',$id)->get();
        //dd($nbm);
        return view('nbmtahun.show',['nbmtahun' => $nbmtahun,'nbm' => $nbm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun = tahun::all();
        $nbmtahun = nbmtahun::findOrfail($id);
        return view('nbmtahun.edit',['nbmtahun' => $nbmtahun,'tahun' => $tahun]);
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
            "kalori" => "required",
            "protein" => "required",
	        "lemak" => "required",
        ])->validated();

    $nbmtahun = nbmtahun::findOrfail($id);
	//$nbmtahun->tahun= $request->get('tahun');
	$nbmtahun->kalori = $request->get('kalori');
	$nbmtahun->protein = $request->get('protein');  
	$nbmtahun->lemak = $request->get('lemak');
    	if ($request->file('filenbm')) {
       		if ($nbmtahun->filenbm && file_exists(storage_path('app/public/'.$nbmtahun->filenbm))){
            	Storage::delete('public/'.$nbmtahun->filenbm);
        	}
        $file = $request->file('filenbm')->store('filenbm','public');
        $nbmtahun->filenbm = $file;
    	}
	$nbmtahun->save();    
    return redirect()->route('nbmtahun.index')->with('status','data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nbmtahun = nbmtahun::findOrfail($id);
	if ($nbmtahun->filenbm && file_exists(storage_path('app/public/'.$nbmtahun->filenbm))){
            Storage::delete('public/'.$nbmtahun->filenbm);
        }
	$nbmtahun->nbm()->delete();
	$nbmtahun->delete();    
    	return redirect()->route('nbmtahun.index')->with('Status','data Berhasil Dihapus');


    }

    public function jenispangan($id)
    {
        $nbmtahun = nbmtahun::findOrfail($id);
        $nbm =nbm::where('id_tahun', $id)->get();
        $bahanpangan = bahanpangan::all();
        $kategori = kategori::all();
        $tahun = tahun::orderBy('tahun','asc')->get();
        return view('nbm.create',[
            'bahanpangan' => $bahanpangan,
            'kategori' => $kategori,
            'tahun' => $tahun,
            'nbm' => $nbm,
            'nbmtahun' => $nbmtahun
        ]);
    }

    public function download($id)
    {
        $nbmtahun = nbmtahun::findorfail($id);
        return response()->download(storage_path('app/public/'. $nbmtahun->filenbm));
    }

}
