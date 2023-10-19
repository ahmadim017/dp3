<?php

namespace App\Http\Controllers;
use App\Models\jenispsat;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Validator;
use Excel;


class jenispsatController extends Controller
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
	    "jenispsat" => "required",
         ])->validated();

         $jenispsat = new jenispsat();
         $jenispsat->id_sosialisasi = $request->get('id_sosialisasi');
         $jenispsat->jenispsat = $request->get('jenispsat');
	 $jenispsat->namadagang = $request->get('namadagang');
	 $jenispsat->namamerek = $request->get('namamerek');
	 $jenispsat->noperizinan = $request->get('noperizinan');
         $jenispsat->kewenangan = $request->get('kewenangan');
         $jenispsat->keterangan = $request->get('keterangan');
         $jenispsat->save();
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
         $jenispsat = jenispsat::findOrfail($id);
         return view('jenispsat.edit',['jenispsat' => $jenispsat]);

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
	    "jenispsat" => "required",
         ])->validated();

         $jenispsat = jenispsat::findOrfail($id);
         $jenispsat->jenispsat = $request->get('jenispsat');
	 $jenispsat->namadagang = $request->get('namadagang');
	 $jenispsat->namamerek = $request->get('namamerek');
	 $jenispsat->noperizinan = $request->get('noperizinan');
         $jenispsat->kewenangan = $request->get('kewenangan');
         $jenispsat->keterangan = $request->get('keterangan');
         $jenispsat->save();
         return redirect()->back()->with('status','data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenispsat = jenispsat::findOrfail($id);
	$jenispsat->delete();
	return redirect()->back()->with('Status','data berhasil dihapus');

    }
}
