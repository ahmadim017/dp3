<?php

namespace App\Http\Controllers;

use App\Models\bahanpanganpph;
use App\Models\pphkonsumsi;
use App\Models\pphkecukupangizi;
use App\Models\pphkonsumsitahun;
use App\Models\tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class pphkonsumsitahunController extends Controller
{
    public function index()
    {
        $pphkonsumsitahun = pphkonsumsitahun::all();
        return view('pphkonsumsitahun.index',['pphkonsumsitahun' => $pphkonsumsitahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = tahun::orderBy('tahun', 'asc')->get();
        return view('pphkonsumsitahun.create',['tahun' => $tahun]);
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
            Rule::unique('pphkonsumsitahuns', 'tahun')
        ],
        "ake" => "required",
        
    ]);
    if ($validation->fails()) {
        return redirect()->route('pphkonsumsitahun.create')
            ->withErrors($validation)
            ->withInput();
    }               
         $pphkonsumsitahun = new pphkonsumsitahun();
            $pphkonsumsitahun->tahun = $request->get('tahun');
            $pphkonsumsitahun->ake = $request->get('ake'); 
	    $pphkonsumsitahun->akp = $request->get('akp');   
            if ($request->file('filepph')) {
            $file = $request->file('filepph')->store('filepph','public');
            $pphkonsumsitahun->filepph = $file;
            }
            $pphkonsumsitahun->save();
        return redirect()->route('pphkonsumsitahun.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pphkonsumsitahun = pphkonsumsitahun::findOrfail($id);
        $pphkonsumsi = pphkonsumsi::where('id_tahun', $id)->get();
        $pphkecukupangizi = pphkecukupangizi::where('id_tahun', $id)->get();
        return view('pphkonsumsitahun.show',['pphkonsumsitahun' => $pphkonsumsitahun,'pphkonsumsi' => $pphkonsumsi,'pphkecukupangizi' => $pphkecukupangizi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pphkonsumsitahun = pphkonsumsitahun::findOrfail($id);
        $tahun = tahun::orderBy('tahun', 'asc')->get();
        return view('pphkonsumsitahun.edit',['pphkonsumsitahun' =>$pphkonsumsitahun, 'tahun' =>$tahun]);
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
            "ake" => "required",
        ])->validated();
        
        $pphkonsumsitahun =pphkonsumsitahun::findOrfail($id);
        //$pphkonsumsitahun->tahun = $request->get('tahun');
        $pphkonsumsitahun->ake = $request->get('ake');
	$pphkonsumsitahun->akp = $request->get('akp'); 
	 if ($request->file('filepph')) {
            if ( $pphkonsumsitahun->filepph && file_exists(storage_path('app/public/'.$pphkonsumsitahun->filepph))){
                Storage::delete('public/'.$pphkonsumsitahun->filepph);
            }
            $file = $request->file('filepph')->store('filepph','public');
            $pphkonsumsitahun->filepph = $file;
        }
        $pphkonsumsitahun->save();

        return redirect()->route('pphkonsumsitahun.index')->with('status','Data Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pphkonsumsitahun = pphkonsumsitahun::findOrfail($id);
	$pphkonsumsitahun->pphkonsumsi()->delete();
	if ( $pphkonsumsitahun->filepph && file_exists(storage_path('app/public/'.$pphkonsumsitahun->filepph))){
                Storage::delete('public/'.$pphkonsumsitahun->filepph);
            }
	$pphkonsumsitahun->delete();
        return redirect()->route('pphkonsumsitahun.index')->with('Status','Data Berhasil dihapus');


    }
     public function download($id)
    {
        $pphkonsumsitahun = pphkonsumsitahun::findOrfail($id);
        return response()->download(storage_path('app/public/'. $pphkonsumsitahun->filepph));
    }
    public function konsumsi($id)
    {
        $pphkonsumsitahun = pphkonsumsitahun::findOrfail($id);
        $pphkonsumsi = pphkonsumsi::where('id_tahun', $id)->get();
        $bahanpanganpph = bahanpanganpph::all();
        $tahun = tahun::orderBy('tahun', 'asc')->get();
        return view('pphkonsumsi.create',[
            'bahanpanganpph' => $bahanpanganpph,
            'tahun' => $tahun,
            'pphkonsumsi' => $pphkonsumsi,
            'pphkonsumsitahun' => $pphkonsumsitahun
        ]);
    }
	
     public function kecukupangizi($id)
    {
        $pphkonsumsitahun = pphkonsumsitahun::findOrfail($id);
        $pphkecukupangizi = pphkecukupangizi::where('id_tahun', $id)->get();
        $bahanpanganpph = bahanpanganpph::all();
        $tahun = tahun::all();
        return view('pphkecukupangizi.create',[
            'bahanpanganpph' => $bahanpanganpph,
            'tahun' => $tahun,
            'pphkecukupangizi' => $pphkecukupangizi,
            'pphkonsumsitahun' => $pphkonsumsitahun
        ]);
    }

}
