<?php

namespace App\Http\Controllers;

use App\Imports\fsvaImport;
use App\Models\CentrePoint;
use App\Models\fsva;
use App\Models\fsvatahun;
use App\Models\tahun;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class fsvaController extends Controller
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
    public function import($id)
    {
		
        $id_tahun = $id;
        Excel::import(new fsvaImport($id_tahun), request()->file('file'));

        return redirect()->back()->with('status', 'Import Successful');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function dash(Request $request)
    {	
	$centrePoint = CentrePoint::get()->first();
        $ta = tahun::orderBy('tahun','asc')->get();
        $tahun = $request->get('tahun');
	//dd($tahun);
	if($tahun && is_numeric($tahun)){
        $fsvatahun = fsvatahun::where('tahun', $tahun)->first();

        if($fsvatahun){
            $fsva = fsva::where('id_tahun', $fsvatahun->id)->get();
        }else{
            // Handle jika tahun tidak ditemukan
            $fsva = []; // Misalnya, set $fsva menjadi array kosong
        }
    }else{
        // Jika $tahun tidak valid atau tidak ada
        $fsvatahun = fsvatahun::get()->first();
        $fsva = fsva::where('id_tahun', $fsvatahun->id)->get();
    }
        return view('fsva.dashboard',['fsva' => $fsva,'centrePoint' => $centrePoint,'ta' => $ta,'tahun' => $tahun]);
    }
}
