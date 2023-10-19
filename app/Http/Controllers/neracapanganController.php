<?php

namespace App\Http\Controllers;

use App\Models\bulan;
use App\Models\komoditas;
use App\Models\minggu;
use App\Models\neracapangan;
use App\Models\satuan;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\neracapanganExport;
use Maatwebsite\Excel\Facades\Excel;

class neracapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $ta = tahun::orderBy('tahun','asc')->get();
    $ba = bulan::all();
    $mi = minggu::all();
	$tahun = $request->get('tahun');
	$bulan = $request->get('bulan');
	$minggu = $request->get('minggu');
	if($bulan !='' || $minggu !='' || $tahun !=''){
	 $neracapangan = neracapangan::when($minggu, function ($query, $minggu) {
                    return $query->where('minggu',$minggu);
                })
                ->when($bulan, function ($query, $bulan) {
                    return $query->where('id_bulan', $bulan);
                })
                ->when($tahun, function ($query, $tahun) {
                    return $query->where('tahun', $tahun);
                })
                ->get();
       	}else{
	$neracapangan = neracapangan::all();
	}    
        return view('neracapangan.index',['neracapangan' => $neracapangan ,'bulan' => $bulan,'minggu' => $minggu,'tahun' => $tahun,'ta' => $ta,'ba' => $ba,'mi' => $mi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = tahun::orderBy('tahun','asc')->get();
        $bulan = bulan::all();
        $minggu = minggu::all();
        $satuan = satuan::all();
        $komoditas = komoditas::all();
        return view('neracapangan.create',['tahun' => $tahun,'bulan' => $bulan,'minggu' => $minggu,'komoditas' => $komoditas]);
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

            "neraca.*.id_komoditas" => "required",
            "neraca.*.stockminggulalu" => "required",
            "neraca.*.konsumsihari" => "required",
	        "neraca.*.harga" => "required",
	        "neraca.*.minggu" => "required",
	        "neraca.*.id_bulan" => "required",
	        "neraca.*.tahun" => "required",
        ])->validated();

        foreach ($request->neraca as $data) {
           
            $t = $data['tahun']; 

            $tahun = tahun::where('tahun', $t)->firstOrfail(); 
             if ($tahun) {
                $ta = $tahun->jmlpenduduk; // Mendapatkan jumlah penduduk dari model tahun
                // Gunakan $ta sesuai kebutuhan Anda dalam perulangan foreach
            }
            $stockminggulalu = isset($data['stockminggulalu']) && is_numeric($data['stockminggulalu']) ? $data['stockminggulalu'] : 0;
            $pengadaan = isset($data['pengadaan']) && is_numeric($data['pengadaan']) ? $data['pengadaan'] : 0;
	    $barangmasuk = isset($data['barangmasuk']) && is_numeric($data['barangmasuk']) ? $data['barangmasuk'] : 0;
            $ketersediaanawal = $stockminggulalu + $pengadaan + $barangmasuk;
            $konsumsiminggu = $data['konsumsihari'] * $ta / 1000 / 48;
            $ketersediaanakhir = $ketersediaanawal - $konsumsiminggu;

          
            neracapangan::create([
                'id_komoditas' => $data['id_komoditas'],
                'stockminggulalu' => $stockminggulalu,
                'pengadaan' =>  $pengadaan,
	        'barangmasuk' =>  $barangmasuk,
                'ketersediaanawal' => $ketersediaanawal,
                'konsumsiminggu'  => $konsumsiminggu,
                'konsumsihari' =>$data['konsumsihari'],
                'ketersediaanakhir' => $ketersediaanakhir,
                'harga' => $data['harga'],
                'minggu' => $data['minggu'],
                'id_bulan' => $data['id_bulan'],
                'tahun' => $data['tahun'],
                
            ]);
        }

        return redirect()->route('neracapangan.index')->with('status','data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $neracapangan = neracapangan::findOrfail($id);
        return view('neracapangan.show',['neracapangan' => $neracapangan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $minggu = minggu::all();
        $bulan = bulan::all();
        $tahun = tahun::orderBy('tahun','asc')->get();
        $komoditas = komoditas::all();
        $neracapangan = neracapangan::findOrfail($id);
        return view('neracapangan.edit',['neracapangan' => $neracapangan,'minggu' => $minggu,'bulan' => $bulan,'tahun' => $tahun,'komoditas' => $komoditas]);
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
            "id_komoditas" => "required",
            "stockminggulalu" => "required",
            "pengadaan" => "required",
            "konsumsihari" => "required",
	        "harga" => "required",
	        "minggu" => "required",
	        "id_bulan" => "required",
	         "tahun" => "required",
        ])->validated();
        
        $tahun = tahun::all();
        foreach($tahun as $t){
        $ta = $t->jmlpenduduk;
        }
        $neracapangan = neracapangan::findOrfail($id);
        $neracapangan->id_komoditas = $request->get('id_komoditas');
        $neracapangan->stockminggulalu = $request->get('stockminggulalu');
        $neracapangan->pengadaan = $request->get('pengadaan');
	$neracapangan->barangmasuk = $request->get('barangmasuk');
        $neracapangan->ketersediaanawal =  $request->get('stockminggulalu') + $request->get('pengadaan') + $request->get('barangmasuk');
        $neracapangan->konsumsihari = $request->get('konsumsihari');
        $neracapangan->konsumsiminggu =  $request->get('konsumsihari') * $ta / 1000 / 48;
        $neracapangan->ketersediaanakhir = $neracapangan->ketersediaanawal -  $neracapangan->konsumsiminggu;
        $neracapangan->harga = $request->get('harga');
        $neracapangan->minggu = $request->get('minggu');
        $neracapangan->id_bulan = $request->get('id_bulan');
        $neracapangan->tahun = $request->get('tahun');
        $neracapangan->save();
        
        return redirect()->route('neracapangan.index')->with('status','Data Berhasil Diupdate');

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $neracapangan = neracapangan::findOrfail($id);
       $neracapangan->delete();
       return redirect()->route('neracapangan.index')->with('Status','Data Berhasil di hapus');
    }

    public function export_excel(Request $request) 
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        $minggu = $request->get('minggu');
        //dd($tahun);
        //return Excel::download(new usulanExport($opd,$kategori,$date1,$date2), 'usulan.xlsx');
        return Excel::download(new neracapanganExport($minggu,$bulan,$tahun), 'neracapangan.xlsx');
    }

    public function dash(Request $request)
    {
    $ta = tahun::orderBy('tahun','asc')->get();
    $ba = bulan::all();
    $tahun = $request->get('tahun');
	$bulan = $request->get('bulan');
    $kn = neracapangan::latest()->first();
    if ($kn){
	$kbulan = $kn->id_bulan;
	$ktahun = $kn->tahun;
    $b = $kn->bulanid->bulan;
    } else{
        $kbulan = Carbon::now()->month;
        $ktahun = Carbon::now()->year;
        $b =  Carbon::now()->month;
    }
	
    $komo = [];
    $mingguke1 = [];
    $mingguke2 = [];
    $mingguke3 = [];
    $mingguke4 = [];
    $rataBulan = [];
    $rataRataTahun = [];

    if( $bulan||$tahun ){
        $neraca = DB::table('neracapangan')->leftJoin('komoditas', 'neracapangan.id_komoditas', '=', 'komoditas.id')
        ->select('komoditas.komoditas', DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-1" THEN ketersediaanakhir END) AS mingguke1'),
        DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-2" THEN ketersediaanakhir END) AS mingguke2')
        ,DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-3" THEN ketersediaanakhir END) AS mingguke3'),
        DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-4" THEN ketersediaanakhir END) AS mingguke4'))
        ->when($bulan, function ($query, $bulan) {
            return $query->where('id_bulan', $bulan);
        })
        ->when($tahun, function ($query, $tahun) {
            return $query->where('tahun', $tahun);
        })->groupBy('komoditas.komoditas')->orderBy('komoditas.id','ASC')->get();	
       
        foreach ($neraca as $n){
            $komo[] = $n->komoditas;
            $mingguke1[] = round($n->mingguke1, 2);
            $mingguke2[] = round($n->mingguke2, 2);
            $mingguke3[] = round($n->mingguke3, 2);
            $mingguke4[] = round($n->mingguke4, 2);
            $jumlah_minggu = 0;
            $total_minggu = 0;
            
            if (!is_null($n->mingguke1)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke1;
            }
        
            if (!is_null($n->mingguke2)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke2;
            }
        
            if (!is_null($n->mingguke3)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke3;
            }
        
            if (!is_null($n->mingguke4)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke4;
            }
        
            // Menghitung rata-rata bulan berdasarkan jumlah minggu yang ada
            if ($jumlah_minggu > 0) {
                $rataBulan[] = ($n->mingguke1 + $n->mingguke2 + $n->mingguke3 + $n->mingguke4) / $jumlah_minggu;
                $rataRataTahun[] = $total_minggu / $jumlah_minggu;
            } else {
                $rataBulan[] = null; // Jika tidak ada data minggu, rata-rata bulan diisi null
                $rataRataTahun[] = null;
            }
          
            }
            $neracapangan = neracapangan::where('id_bulan', $bulan)->where('tahun', $tahun)->paginate(10);
    }else{
        $neraca = DB::table('neracapangan')->leftJoin('komoditas', 'neracapangan.id_komoditas', '=', 'komoditas.id')
        ->select('komoditas.komoditas', DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-1" THEN ketersediaanakhir END) AS mingguke1'),
        DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-2" THEN ketersediaanakhir END) AS mingguke2')
        ,DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-3" THEN ketersediaanakhir END) AS mingguke3'),
        DB::raw('MIN(CASE WHEN minggu = "Minggu Ke-4" THEN ketersediaanakhir END) AS mingguke4'))
        ->where('id_bulan', $kbulan)->where('tahun', $ktahun)->groupBy('komoditas.komoditas')->orderBy('komoditas.id','ASC')->get();	
       
        foreach ($neraca as $n){
            $komo[] = $n->komoditas;
            $mingguke1[] = round($n->mingguke1, 2);
            $mingguke2[] = round($n->mingguke2, 2);
            $mingguke3[] = round($n->mingguke3, 2);
            $mingguke4[] = round($n->mingguke4, 2);
            $jumlah_minggu = 0;
            $total_minggu = 0;
            
            if (!is_null($n->mingguke1)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke1;
            }
        
            if (!is_null($n->mingguke2)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke2;
            }
        
            if (!is_null($n->mingguke3)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke3;
            }
        
            if (!is_null($n->mingguke4)) {
                $jumlah_minggu++;
                $total_minggu += $n->mingguke4;
            }
        
            // Menghitung rata-rata bulan berdasarkan jumlah minggu yang ada
            if ($jumlah_minggu > 0) {
                $rataBulan[] = ($n->mingguke1 + $n->mingguke2 + $n->mingguke3 + $n->mingguke4) / $jumlah_minggu;
                $rataRataTahun[] = $total_minggu / $jumlah_minggu;
            } else {
                $rataBulan[] = null; // Jika tidak ada data minggu, rata-rata bulan diisi null
                $rataRataTahun[] = null;
            }
            }
            $neracapangan = neracapangan::where('id_bulan', $kbulan)->where('tahun', $ktahun)->paginate(10);
    }
  
        return view('neracapangan.dashboard',[
            'rataBulan' =>  $rataBulan,
            'rataRataTahun' => $rataRataTahun,
            'b' => $b,
            'ta' => $ta,
            'ba' => $ba,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'neracapangan' => $neracapangan,
            'komo' => $komo,
            'mingguke1' => $mingguke1,
            'mingguke2' => $mingguke2,
            'mingguke3' => $mingguke3,
            'mingguke4' => $mingguke4,
            'kbulan' => $kbulan,
            'ktahun' => $ktahun
        ]);
    }

   
}
