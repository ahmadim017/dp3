<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\jenissampel;
use App\Models\keamananpangan;
use App\Models\keamananpanganmasyarakat;
use App\Models\sosialisasi;
use App\Models\tahun;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;


class keamananpanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = tahun::orderBy('tahun','asc')->get();
        $tahun = $request->get('tahun');
        $keamananpangan = keamananpangan::all();
        return view('keamananpangan.index',['keamananpangan' => $keamananpangan,'tahun' => $tahun,'ta' => $ta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = tahun::orderBy('tahun','asc')->get();
        $centrepoint = CentrePoint::get()->first();
        return view('keamananpangan.create', [ 'centrepoint' => $centrepoint, 'tahun' => $tahun ]);
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
            "lokasisampel" => "required",
	        "location" => "required",
	        "tglpengambilan" => "required",
            "file" => "file|max:15048",
         ])->validated();

         $keamananpangan = new keamananpangan();
         $keamananpangan->lokasisampel = $request->get('lokasisampel');
         $keamananpangan->alamat = $request->get('alamat');
         $keamananpangan->location = $request->get('location');
         $keamananpangan->tglpengambilan = $request->get('tglpengambilan');
         $keamananpangan->tahun = $request->get('tahun');
         if ($request->file('file')) {
            $file = $request->file('file')->store('file','public');
            $keamananpangan->file = $file;
        }
        $keamananpangan->save();
        return redirect()->route('keamananpangan.index')->with('status','Data Berhasil di Tambah');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keamananpangan = keamananpangan::findOrfail($id);
        return view('keamananpangan.show',['keamananpangan' => $keamananpangan]);
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
        $centrepoint = CentrePoint::get()->first();
        $keamananpangan = keamananpangan::findOrfail($id);
        $formattedDate = date('Y-m-d', strtotime($keamananpangan->tglpengambilan));
        return view('keamananpangan.edit', ['keamananpangan' => $keamananpangan, 'centrepoint' => $centrepoint, 'tahun' => $tahun,'formattedDate' => $formattedDate ]);
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
            "lokasisampel" => "required",
	        "location" => "required",
	        "tglpengambilan" => "required",
            "file" => "file|max:15048",
         ])->validated();

         $keamananpangan = keamananpangan::findOrfail($id);
         $keamananpangan->lokasisampel = $request->get('lokasisampel');
         $keamananpangan->alamat = $request->get('alamat');
         $keamananpangan->location = $request->get('location');
         $keamananpangan->tglpengambilan = $request->get('tglpengambilan');
         $keamananpangan->tahun = $request->get('tahun');
         if ($request->file('file')) {
            if ( $keamananpangan->file && file_exists(storage_path('app/public/'. $keamananpangan->file))){
                Storage::delete('public/'. $keamananpangan->file);
            }
            $file = $request->file('file')->store('file','public');
            $keamananpangan->file = $file;
        }
        $keamananpangan->save();
        return redirect()->route('keamananpangan.index')->with('status','Data Berhasil di Tambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keamananpangan = keamananpangan::findOrfail($id);
        $jenissampel =jenissampel::where('id_keamananpangan', $id)->get();
        if ( $keamananpangan->file && file_exists(storage_path('app/public/'. $keamananpangan->file))){
            Storage::delete('public/'. $keamananpangan->file);
        }
        $keamananpangan->jenissampel()->delete();
        $keamananpangan->delete();
        return redirect()->route('kemananpangan.index')->with('Status','Data Berhasil dihapus');
    }

    public function jenissampel($id)
    {
        $jenissampel =jenissampel::where('id_keamananpangan', $id)->get();
        $keamananpangan = keamananpangan::findOrfail($id);
        return view('jenissampel.create',['jenissampel' => $jenissampel,'keamananpangan' => $keamananpangan]);
    }

    public function download($id)
    {
        $keamananpangan = keamananpangan::findOrfail($id);
        return response()->download(storage_path('app/public/'. $keamananpangan->file));
    }

    public function cetak_pdf($id)
    {
       
        $keamananpangan = keamananpangan::findOrfail($id);
        $jenissampel =jenissampel::where('id_keamananpangan', $id)->get();
        set_time_limit(120);
        $pdf = PDF::loadview('keamananpangan.cetak',['keamananpangan' => $keamananpangan,'jenissampel' => $jenissampel]);
        return $pdf->stream();
    }
	
    public function map(Request $request)
    {
        /**
         *  Pada method index kita mengambil single data dari tabel centrepoint
         *  Selanjutnya kita mengambil seluruh data dari tabel space untuk menampilkan marker yang akan
         *  kita gtampilkan pada view map.blade 
         */
        
        $centrePoint = CentrePoint::get()->first();
        $tahun = tahun::orderBy('tahun','asc')->get();
        $ta = $request->get('ta');
        $t = Carbon::now()->year;
        $data = [];
        if ($ta){
	  $sosialisasipai = DB::table('sosialisasis')->leftJoin('kecamatan','sosialisasis.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
            ->where('kecamatan','<>',1)->whereYear('sosialisasis.created_at',$ta)->groupBy('kecamatan')->get();
           
            foreach ($sosialisasipai as $u) {
                $data[] = [$u->kecamatan,$u->total];
            }

        $keamananpangan = keamananpangan::whereYear('created_at', $ta)->get();
	$keamananpanganmasyarakat = keamananpanganmasyarakat::whereYear('created_at', $ta)->get();
        $sosialisasi = sosialisasi::whereYear('created_at', $ta)->get();
        }else{
	     $sosialisasipai = DB::table('sosialisasis')->leftJoin('kecamatan','sosialisasis.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
            ->where('kecamatan','<>',1)->whereYear('sosialisasis.created_at',$t)->groupBy('kecamatan')->get();
           
            foreach ($sosialisasipai as $u) {
                $data[] = [$u->kecamatan,$u->total];
            }

            $keamananpangan = keamananpangan::whereYear('created_at', $t)->get();
	    $keamananpanganmasyarakat = keamananpanganmasyarakat::whereYear('created_at', $t)->get();
            $sosialisasi = sosialisasi::whereYear('created_at', $t)->get();
        }
        return view('mapkeamananpangan.index',[
            'sosialisasi' => $sosialisasi,
	    'keamananpanganmasyarakat' => $keamananpanganmasyarakat,
            'keamananpangan' => $keamananpangan,
            'centrePoint' => $centrePoint,
            'tahun' => $tahun,
            'ta' => $ta,
	    'data' => $data
        ]);
        //return dd($spaces);
    }


}
