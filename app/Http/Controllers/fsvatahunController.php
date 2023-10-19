<?php

namespace App\Http\Controllers;

use App\Models\fsva;
use App\Models\fsvatahun;
use App\Models\tahun;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class fsvatahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = tahun::orderBy('tahun','asc')->get();
        $fsvatahun = fsvatahun::all();
        return view('fsvatahun.index',['fsvatahun' => $fsvatahun,'tahun' => $tahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = tahun::orderBy('tahun','asc')->get();
        return view('fsvatahun.create',['tahun' => $tahun]); 
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
                Rule::unique('fsvatahuns', 'tahun')
            ],
            
        ]);
        if ($validation->fails()) {
            return redirect()->route('fsvatahun.create')
                ->withErrors($validation)
                ->withInput();
        }         
	    $fsvatahun = new fsvatahun();
	    $fsvatahun->tahun= $request->get('tahun');
        if ($request->file('filefsva')) {
            $file = $request->file('filefsva')->store('filefsva','public');
            $fsvatahun->filefsva = $file;
        }
	    $fsvatahun->save();    
	
        return redirect()->route('fsvatahun.index')->with('status','data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fsvatahun = fsvatahun::findOrfail($id);
        return view('fsvatahun.show',['fsvatahun' => $fsvatahun]);
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
        $fsvatahun = fsvatahun::findOrfail($id);
	if ($fsvatahun->filefsva && file_exists(storage_path('app/public/'.$fsvatahun->filefsva))){
                Storage::delete('public/'.$fsvatahun->filefsva);
            }

	$fsvatahun->fsva()->delete();
	$fsvatahun->delete();
	return redirect()->route('fsvatahun.index')->with('Status','data Berhasil Dihapus');
 
    }
    public function fsva($id)
    {
        $fsvatahun = fsvatahun::findOrfail($id);
        $fsva = fsva::where('id_tahun', $id)->get();
        return view('fsva.create',[
            'fsva' => $fsva,
            'fsvatahun' => $fsvatahun
        ]);
    }
}
