<?php

namespace App\Http\Controllers;

use App\Exports\usulanExport;
use App\Models\kecamatan;
use App\Models\tahun;
use App\Models\usulan;
use App\Models\penyaluran;
use App\Models\cadanganpangan;
use App\Models\pelepasan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class usulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ta = Carbon::now()->year;
        $usulan = usulan::whereYear('created_at',$ta)->get();
        return view('usulan.index',['usulan' => $usulan]);
    }

    public function laporan(Request $request)
    {
        $ta = $request->get('ta');
        $tahun = tahun::orderBy('tahun','asc')->get();
        return view('usulan.laporan',['tahun' => $tahun,'ta' => $ta]);
    }

    public function dashboard(Request $request)
    {
        $t = Carbon::now()->year;
        $ta = $request->get('ta');
        $tahun = tahun::orderBy('tahun','asc')->get();

        $data = [];
        $datat = [];
        if ($ta){
        $dash = DB::table('usulans')->leftJoin('kecamatan','usulans.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
        ->where('kecamatan','<>',1)->whereYear('usulans.created_at',$ta)->where('status','diterima')->groupBy('kecamatan')->get();
       
        foreach ($dash as $u) {
            $data[] = [$u->kecamatan,$u->total];
        }

        $dasht = DB::table('usulans')->leftJoin('kecamatan','usulans.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
        ->where('kecamatan','<>',1)->whereYear('usulans.created_at',$ta)->where('status','ditolak')->groupBy('kecamatan')->get();
       
        foreach ($dasht as $u) {
            $datat[] = [$u->kecamatan,$u->total];
        }

        $usulan = usulan::whereYear('created_at',$ta)->count();
        $diterima = usulan::whereYear('created_at',$ta)->where('status','diterima')->count();
        $ditolak = usulan::whereYear('created_at',$ta)->where('status','ditolak')->count();
        }else{

        $dash = DB::table('usulans')->leftJoin('kecamatan','usulans.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
        ->where('kecamatan','<>',1)->whereYear('usulans.created_at',$t)->where('status','diterima')->groupBy('kecamatan')->get();
       
        foreach ($dash as $u) {
            $data[] = [$u->kecamatan,$u->total];
        }

        $dasht = DB::table('usulans')->leftJoin('kecamatan','usulans.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
        ->where('kecamatan','<>',1)->whereYear('usulans.created_at',$t)->where('status','ditolak')->groupBy('kecamatan')->get();
       
        foreach ($dasht as $u) {
            $datat[] = [$u->kecamatan,$u->total];
        }
        $usulan = usulan::whereYear('created_at',$t)->count();
        $diterima = usulan::whereYear('created_at',$t)->where('status','diterima')->count();
        $ditolak = usulan::whereYear('created_at',$t)->where('status','ditolak')->count();
        }
        //dd($data);
       
        return view('usulan.dashboard',[
            'tahun' => $tahun,
            'ta' => $ta,
            'usulan' => $usulan,
            'diterima' => $diterima,
            'ditolak' => $ditolak,
            'data' => $data,
            'datat' => $datat
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usulan = usulan::where('created_by',Auth::user()->id)->get();
        $kecamatan = kecamatan::all();
        return view('usulan.create',['usulan' => $usulan,'kecamatan' => $kecamatan]);
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
            "nik" => "required|numeric|digits_between:16,16",
	        "nama" => "required",
	        "jeniskelamin" => "required",
            "tgllahir" => "required",
            "alamat" => "required",
            "keterangan" => "keterangan",
         ])->validated();

         $usulan = new usulan();
         $usulan->nik = $request->input('nik');
         $usulan->nama = $request->input('nama');
         $usulan->jeniskelamin = $request->input('jeniskelamin');
         $usulan->tgllahir = $request->input('tgllahir');
         $usulan->alamat = $request->input('alamat');
         $usulan->kelurahan = $request->input('kelurahan');
         $usulan->id_kecamatan = $request->input('id_kecamatan');
         $usulan->keterangan = $request->input('keterangan');
	 $usulan->status = 'verifikasi';
         $usulan->created_by = Auth::user()->id;
         if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fileusulan', $fileName);
            $usulan->file = $fileName;
        }
        $usulan->save();
        return redirect()->route('usulan.create')->with('status','Data Berhasil disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	$cadanganpangan = cadanganpangan::all();
        $usulan = usulan::findOrfail($id);
        return view('usulan.show',['usulan' => $usulan,'cadanganpangan' => $cadanganpangan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usulan = usulan::findOrfail($id);
        $kecamatan = kecamatan::all();
        $formattedDate = date('Y-m-d', strtotime($usulan->tgllahir));
        return view('usulan.edit',['usulan' => $usulan,'kecamatan' => $kecamatan,'formattedDate' => $formattedDate ]);
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
            "nik" => "required|numeric|digits_between:16,16",
	        "nama" => "required",
	        "jeniskelamin" => "required",
            "tgllahir" => "required",
            "alamat" => "required",
            "keterangan" => "keterangan",
         ])->validated();

         $usulan = usulan::findOrfail($id);
         $usulan->nik = $request->input('nik');
         $usulan->nama = $request->input('nama');
         $usulan->jeniskelamin = $request->input('jeniskelamin');
         $usulan->tgllahir = $request->input('tgllahir');
         $usulan->alamat = $request->input('alamat');
         $usulan->kelurahan = $request->input('kelurahan');
         $usulan->id_kecamatan = $request->input('id_kecamatan');
         $usulan->keterangan = $request->input('keterangan');
        if ($request->hasFile('file')) {
            if (  $usulan->file && file_exists(storage_path('app/public/fileusulan/' .  $usulan->file))) {
                Storage::delete('public/fileusulan/' .  $usulan->file);
            }
        
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fileusulan', $fileName);
            $usulan->file = $fileName;
        }
        $usulan->save();
        return redirect()->route('usulan.create')->with('status','Data Berhasil disimpan');
    }

    public function reject(Request $request, $id)
    {
        $usulan = usulan::findOrFail($id);
        $status = $request->input('status');
        
        // Gabungkan data dari tabel penyaluran dan pelepasan yang memiliki ID usulan yang sama
        $penyaluran = penyaluran::where('id_usulan', $id)
            ->select('id_usulan', 'jumlah', 'id_cadanganpangan')
            ->get();
        
        $pelepasan = pelepasan::where('id_usulan', $id)
            ->select('id_usulan', 'jumlah', 'id_cadanganpangan')
            ->get();
            //dd($pelepasan);
        
        // Lakukan pengecekan apakah ada data di penyaluran atau pelepasan
        if ($penyaluran->isEmpty() && $pelepasan->isEmpty()) {
            return redirect()->route('usulan.index')->with('error', 'ID usulan tidak ditemukan dalam penyaluran atau pelepasan.');
        }
        
        // Proses penolakan
        $usulan->status = $status;
        $usulan->id_cadanganpangan = null;
        $usulan->save();
        
        if ($status == 'ditolak') {
            // Kurangi jumlah penyaluran dari 'cadanganpangan' dan hapus penyaluran
            foreach ($penyaluran as $item) {
                $cadanganpangan = cadanganpangan::find($item->id_cadanganpangan);
                $cadanganpangan->penyaluran -= $item->jumlah;
                $cadanganpangan->stockakhir += $item->jumlah;
                $cadanganpangan->save();
                $item->delete();
            }
            
            // Hapus pelepasan
            foreach ($pelepasan as $item) {
                $cadanganpangan = cadanganpangan::find($item->id_cadanganpangan);
                $cadanganpangan->pelepasan -= $item->jumlah;
                $cadanganpangan->stockakhir += $item->jumlah;
                $cadanganpangan->save();
                
                $item->delete();
                //$item->delete();
            }
        }
	
        return redirect()->route('usulan.index')->with('Status','Data Ditolak');
    }



    public function proses(Request $request, $id)
    {
        $usulan = usulan::findOrfail($id);
    
    if($request->input('penerima') == 'penyaluran'){
        $cadanganpangan = cadanganpangan::latest()->first();
        $usulan->id_cadanganpangan = $cadanganpangan->id;
	    $usulan->status = $request->input('status');

	    $penyaluran = new penyaluran();
	    $penyaluran->id_cadanganpangan = $cadanganpangan->id;
	    $penyaluran->id_usulan = $id;
	    $penyaluran->id_komoditas = '1';
        $penyaluran->save();
    }else{
        $cadanganpangan = cadanganpangan::latest()->first();
        $usulan->id_cadanganpangan = $cadanganpangan->id;
	    $usulan->status = $request->input('status');

	    $pelepasan = new pelepasan();
	    $pelepasan->id_cadanganpangan = $cadanganpangan->id;
	    $pelepasan->id_usulan = $id;
        $pelepasan->id_komoditas = '1';
        $pelepasan->save();
    }
	
	    $usulan->save();
	
        return redirect()->route('usulan.index')->with('status','Data Berhasil diproses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usulan = usulan::findOrfail($id);
        if (  $usulan->file && file_exists(storage_path('app/public/fileusulan/' .  $usulan->file))) {
            Storage::delete('public/fileusulan/' .  $usulan->file);
        }
        $usulan->delete();
        return redirect()->route('usulan.create')->with('Status','Data Berhasil dihapus');
    }

    public function cetak_pdf(Request $request)
    {
    $ta = $request->get('ta');
	$t = Carbon::now()->year;
	if ($ta){
        $usulan = usulan::whereYear('created_at', $ta)->get();
        }else{
        $usulan = usulan::whereYear('created_at', $ta)->get();

	}
        set_time_limit(120);
        $pdf = Pdf::loadView('usulan.cetak', ['usulan' => $usulan]);
        return $pdf->stream('usulan_penerima_bantuan.pdf');
    }

   public function export_excel(Request $request) 
    {
	$ta = $request->get('ta');
        //return Excel::download(new usulanExport($opd,$kategori,$date1,$date2), 'usulan.xlsx');
        return Excel::download(new usulanExport($ta), 'usulan_penerima_bantuan.xlsx');
    }

    public function download($id)
    {
        $usulan = usulan::findorfail($id);
        return response()->download(storage_path('app/public/'. $usulan->file));
    }


}
