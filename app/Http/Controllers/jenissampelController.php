<?php

namespace App\Http\Controllers;

use App\Exports\jenissampelExport;
use App\Models\jenissampel;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Validator;
use Excel;
class jenissampelController extends Controller
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
        if ($ta) {
            $jenissampel = jenissampel::whereYear('created_at', $ta)->get();
        }else{
            $jenissampel = jenissampel::all();
        }
        return view('jenissampel.index',[
            'jenissampel' => $jenissampel,
            'tahun' => $tahun,
            'ta' => $ta,
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
        $validation = Validator::make($request->all(),[
	        "jenissampel" => "required",
	        "hasiluji" => "required",
            "keterangan" => "required",
         ])->validated();

         $jenissampel = new jenissampel();
         $jenissampel->id_keamananpangan = $request->get('id_keamananpangan');
         $jenissampel->jenissampel = $request->get('jenissampel');
         $jenissampel->hasiluji = $request->get('hasiluji');
         $jenissampel->keterangan = $request->get('keterangan');
         $jenissampel->save();
         return redirect()->back()->with('status','data berhasil ditambahkan');

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
        $jenissampel = jenissampel::findOrfail($id);
        return view('jenissampel.edit',['jenissampel' => $jenissampel]);
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
	        "jenissampel" => "required",
	        "hasiluji" => "required",
            "keterangan" => "required",
         ])->validated();

         $jenissampel = jenissampel::findOrfail($id);
         $jenissampel->jenissampel = $request->get('jenissampel');
         $jenissampel->hasiluji = $request->get('hasiluji');
         $jenissampel->keterangan = $request->get('keterangan');
         $jenissampel->save();
         return redirect()->route('jenissampel.create',[$jenissampel->id_keamananpangan])->with('status','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenissampel = jenissampel::findOrfail($id);
        $jenissampel->delete();
        return redirect()->back()->with('Status','Data Berhasil dihapus');
    }
    public function cetak_pdf(Request $request)
    {
        $ta = $request->get('ta');
	$t = Carbon::now()->year;
	if ($ta){
        $jenissampel = jenissampel::whereYear('created_at', $ta)->get();
        }else{
	$jenissampel = jenissampel::whereYear('created_at', $ta)->get();

	}
        set_time_limit(120);
        $pdf = PDF::loadView('jenissampel.cetak', ['jenissampel' => $jenissampel]);
        return $pdf->stream('hasil_uji_sampel.pdf');
    }

   public function export_excel(Request $request) 
    {
	$ta = $request->get('ta');
        //return Excel::download(new usulanExport($opd,$kategori,$date1,$date2), 'usulan.xlsx');
        return Excel::download(new jenissampelExport($ta), 'jenissampel.xlsx');
    }
}
