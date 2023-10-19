<?php

namespace App\Http\Controllers;

use App\Exports\skpgExport;
use App\Models\bulan;
use App\Models\kecamatan;
use App\Models\skpg;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class skpgController extends Controller
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
            "skpg.*.ketersediaan" => "required",
            "skpg.*.akses" => "required",
            "skpg.*.pemanfaatan" => "required",
        ])->validated();

        foreach ($request->skpg as $data) {
           
            $ketersediaan = isset($data['ketersediaan']) && is_numeric($data['ketersediaan']) ? $data['ketersediaan'] : 0;
            $akses = isset($data['akses']) && is_numeric($data['akses']) ? $data['akses'] : 0;
            $pemanfaatan = isset($data['pemanfaatan']) && is_numeric($data['pemanfaatan']) ? $data['pemanfaatan'] : 0;
            $skor = $ketersediaan + $akses + $pemanfaatan;
            
          
            Skpg::create([
                'id_kecamatan' => $data['id_kecamatan'],
                'ketersediaan' => $ketersediaan,
                'akses' => $akses,
                'pemanfaatan' => $pemanfaatan,
                'id_bulan' => $data['id_bulan'],
                'id_skpgbulan' => $data['id_skpgbulan'],
                'skorkomposit' => $skor,
                'tahun' => $data['tahun'],
            ]);
        }

         return redirect()->route('skpgbulan.show',$data['id_skpgbulan'])->with('success', 'Data berhasil disimpan');
         
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
        $tahun = tahun::all();
	    $bulan = bulan::all();
	    $kecamatan = kecamatan::all();
	    $skpg = skpg::findOrfail($id);
        return view('skpg.edit',['skpg' => $skpg,'tahun' => $tahun,'kecamatan' => $kecamatan,'bulan' => $bulan]);
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
            "id_kecamatan" => "required",
            "ketersediaan" => "required",
	        "akses" => "required",
            "pemanfaatan" => "required",
	        "tahun" => "required",
	        "id_bulan" => "required",
         ])->validated();
        
	    $skor = $request->get('ketersediaan') + $request->get('akses') + $request->get('pemanfaatan');	

        $skpg = skpg::findOrfail($id);
        $skpg->id_kecamatan = $request->get('id_kecamatan');
        $skpg->ketersediaan = $request->get('ketersediaan');
        $skpg->akses = $request->get('akses');
	    $skpg->pemanfaatan =$request->get('pemanfaatan');
       	$skpg->skorkomposit = $skor;
	    $skpg->id_bulan = $request->get('id_bulan');
	    $skpg->tahun = $request->get('tahun');
       	$skpg->save();
        return redirect()->route('skpg.index')->with('status','Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skpg = skpg::findOrfail($id);
	    $skpg->delete();
	    return redirect()->route('skpgbulan.show',[$skpg->id_skpgbulan])->with('Status','Data Berhasil diHapus');
    }

    public function export_excel(Request $request) 
    {
	    $ba = $request->get('ba');
        return Excel::download(new skpgExport($ba), 'skpg.xlsx');
    }


    public function dash(Request $request)
    {
        $ta = tahun::orderBy('tahun','asc')->get();
        $ba = bulan::all();
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
            $t = Carbon::now()->year;
        $kn = skpg::latest()->first();
            if ($kn){
        $b = $kn->id_bulan;
        } else{
            $b =  Carbon::now()->month;
        }
          //dd($t);
        if($bulan||$tahun){
        $skpg = skpg::when($bulan, function ($query, $bulan) {
                      return $query->where('id_bulan', $bulan);
                       })
                        ->when($tahun, function ($query, $tahun) {
                        return $query->where('tahun', $tahun);
                    })->get();
        }else{
            $skpg = skpg::where('id_bulan',$b)->where('tahun',$t)->get();
        }
           
            return view('skpg.dashboard',[
                'skpg' => $skpg,
                'ta' => $ta,
                'ba' => $ba,
                'tahun' => $tahun,
                'bulan' => $bulan
            ]);
        }
    
}
