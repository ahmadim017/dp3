<?php

namespace App\Http\Controllers;

use App\Models\datakomoditas;
use App\Models\panelharga;
use App\Models\token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class panelhargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_komoditas = $request->get('id_komoditas');
        $tanggal = $request->get('tanggal');
        $stanggal = $request->get('stanggal');
        $etanggal = $request->get('etanggal');
        $b = Carbon::now()->month;
        $datakomoditas = datakomoditas::all();
    
        $panelharga = panelharga::query();
    
        $panelharga->when($id_komoditas, function ($query, $id_komoditas) {
            return $query->where('id_komoditas', $id_komoditas);
        }, function ($query) {
            // Callback for the false condition (can be empty)
        });
    
        $panelharga->when($tanggal, function ($query, $tanggal) {
            return $query->where('tanggal', $tanggal);
        }, function ($query) {
            // Callback for the false condition (can be empty)
        });
    
        $panelharga->when($stanggal && $etanggal, function ($query) use ($stanggal, $etanggal) {
            return $query->whereBetween('tanggal', [$stanggal, $etanggal]);
        }, function ($query) {
            // Callback for the false condition (can be empty)
        });
    
        $panelharga->latest('tanggal');
        $panelharga = $panelharga->get();
    
        return view('panelharga.index', [
            'panelharga' => $panelharga,
            'datakomoditas' => $datakomoditas,
            'id_komoditas' => $id_komoditas,
            'tanggal' => $tanggal,
            'stanggal' => $stanggal,
            'etanggal' => $etanggal,
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

     public function detail(Request $request, $id_komoditas)
    {
        //dd($id_komoditas);
        $stanggal = $request->get('stanggal');
        $etanggal = $request->get('etanggal');
        $datakomoditas = datakomoditas::findOrfail($id_komoditas);
        $komoditas = $datakomoditas->komoditas;
        
        if($stanggal && $etanggal){
            $hargakomoditas = DB::table('panelhargas')->where('id_komoditas',$id_komoditas)->whereBetween('tanggal',[$stanggal, $etanggal])->orderBy('tanggal','asc')->get();
        }else{
            $hargakomoditas = DB::table('panelhargas')->where('id_komoditas',$id_komoditas)->orderBy('tanggal','asc')->get();
        }
        
     
        //dd($panelharga);
        return view('panelharga.detail', [
            'hargakomoditas' => $hargakomoditas,
            'stanggal' => $stanggal,
            'etanggal' => $etanggal,
            'komoditas' => $komoditas,
        ]);
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

    public function dashboard(Request $request)
{
    $id_komoditas = $request->get('id_komoditas');
    $tanggal = $request->get('tanggal');
   
    $b = Carbon::now()->month;
    $today = Carbon::now();

    // Mengambil tanggal kemarin dan dua hari sebelumnya
    $yesterday = $today->subDay()->startOfDay()->toDateString();
    $twoDaysAgo = $today->subDays(1)->startOfDay()->toDateString();

    $datakomoditas = datakomoditas::all();
    $hargaKemarin = null;

    if ($id_komoditas != '' || $tanggal != '') {
        $panelharga = panelharga::when($id_komoditas, function ($query, $id_komoditas) {
            return $query->where('id_komoditas', $id_komoditas);
        })
        ->when($tanggal, function ($query, $tanggal) {
            return $query->where('tanggal', $tanggal);
        })
        ->get();
        if ($tanggal) {
            $tanggalSebelumnya = Carbon::parse($tanggal)->subDay()->toDateString();
            $hargaKemarin = panelharga::whereDate('tanggal', $tanggalSebelumnya)->get();
        }
    } else {
        $panelharga = panelharga::whereDate('tanggal', $yesterday)->get();

        // Membandingkan harga dengan data kemarin
        $hargaKemarin = panelharga::whereDate('tanggal', $twoDaysAgo)->get();
            //dd($hargaKemarin);
    }
   
    return view('panelharga.dashboard', [
        'panelharga' => $panelharga,
        'datakomoditas' => $datakomoditas,
        'id_komoditas' => $id_komoditas,
        'tanggal' => $tanggal,
        'hargaKemarin' => $hargaKemarin,
    ]);
}

    public function getDataFromAPI(Request $request)
{
    $currentDate = Carbon::now()->toDateString();
    //$last = panelharga::latest('tanggal')->first();
    //$tgllast = $last->tanggal;
    //$tgl= Carbon::parse($tgllast)->format('Y-m-d');
    $startDate = '2023-10-01';
    $endDate = $currentDate;    

    // Get the access token from the session or a secure place
    $token = Token::where('expires_at', '>', now())->first();

    if (!$token) {
        return response()->json(['error' => 'Token tidak tersedia'], 401);
    }

    $accessToken = $token->access_token;
    // API endpoint URL
    $apiUrl = "https://api-splp.layanan.go.id/panelharga/2.0/panelharga/data-harian/{$startDate}/{$endDate}/3/64.71";

    try {
        // Make an authenticated GET request with the access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Check the response from the API
        if ($response->successful()) {
            $data = $response->json();
    
            foreach ($data['data'] as $komoditasData) {
                // Cari atau buat data komoditas
                $komoditas = DataKomoditas::firstOrCreate(['komoditas' => $komoditasData['Komoditas']]);
    
                foreach ($komoditasData as $tanggal => $harga) {
                    // Periksa apakah nama kolom adalah tanggal
                    if (strtotime($tanggal)) {
                        // Simpan data harga
                        PanelHarga::updateOrInsert([
                            'id_komoditas' => $komoditas->id,
                            'tanggal' => $tanggal,
                            'harga' => $harga,
                        ]);
                    }
                }
            }

            return redirect()->route('panelharga.index')->with('status', 'Data Berhasil di tarik');
        } else {
            return redirect()->route('panelharga.index')->with('status', 'Gagal mengambil data dari API');
        }
    } catch (\Exception $e) {
        // Tangani exception jika terjadi kesalahan
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

    
}
