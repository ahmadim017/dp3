<?php

namespace App\Http\Controllers;


use App\Models\CentrePoint;
use App\Models\fsvaapi;
use App\Models\token;
use App\Models\tahun;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class fsvaapiController extends Controller
{
    public function index(Request $request)
    {
        $tahun = tahun::orderBy('tahun','asc')->get();
        $fsvaapi = fsvaapi::OrderBy('tahun','desc')->get();
        return view('fsvaapi.index',['fsvaapi' => $fsvaapi,'tahun' => $tahun]);
    }
    public function dash(Request $request)
    {	
	    $centrePoint = CentrePoint::get()->first();
        $ta = tahun::orderBy('tahun','asc')->get();
        $tahun = $request->get('tahun');
        $latest = fsvaapi::latest('tahun')->first();
        $tahunlatest = $latest->tahun;
	  // dd($tahunlatest);
	

        if($tahun && is_numeric($tahun)){
            $fsva = fsvaapi::where('tahun', $tahun)->get();
        }else{
            // Handle jika tahun tidak ditemukan
            $fsva = []; // Misalnya, set $fsva menjadi array kosong
        
        // Jika $tahun tidak valid atau tidak ada
        $fsva = fsvaapi::where('tahun',$tahunlatest)->get();
    }
        return view('fsvaapi.dashboard',['fsva' => $fsva,'centrePoint' => $centrePoint,'ta' => $ta,'tahun' => $tahun]);
    }

    public function getDataFromAPI(Request $request)
{
    $tahun = $request->input('tahun');
    
    $token = Token::where('expires_at', '>', now())->first();

    if (!$token) {
        return response()->json(['error' => 'Token tidak tersedia'], 401);
    }

    $accessToken = $token->access_token;
    $apiUrl = "https://api-splp.layanan.go.id/fsva/2.0/api.php/app_data/{$tahun}/626471";

    $client = new Client();

    try {
        $response = $client->post($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);

            // Log the data to inspect it
            Log::info('API Response Data:', ['data' => $data]);

            if (is_array($data)) {
                foreach ($data as $item) {
                    if (is_array($item) && isset($item['Desa/Kelurahan'])) {
                        // Assuming 'Desa/Kelurahan' might contain prefix 'Kelurahan '
                        $kelurahan = $item['Desa/Kelurahan'];
                        $prefix = 'Kelurahan ';
                        if (strpos($kelurahan, $prefix) === 0) {
                            $kelurahan = trim(substr($kelurahan, strlen($prefix)));
                        }

                        Fsvaapi::updateOrInsert([
                            'kelurahan' => $kelurahan,
                            'tahun' => $tahun,
                        ], [
                            'indexprioritas' => $item['Komposit'] ?? null,
                            'penyediaanpangan' => $item['Rasio Sarana Pangan'] ?? null,
                            'kesejahteraanrendah' => $item['Rasio Penduduk Miskin Desil 1'] ?? null,
                            'aksespenghubung' => $item['Desa Tanpa Akses Penghubung'] ?? null,
                            'aksesairbersih' => $item['Rasio Rumah Tangga Tanpa Air Bersih'] ?? null,
                            'jmltenagakesehatan' => $item['Rasio Tenaga Kesehatan'] ?? null,
                            'luaslahanpertanian' => $item['Rasio Luas Lahan Pertanian'] ?? null,
                        ]);
                    } else {
                        Log::warning('Item tidak valid:', ['item' => $item]);
                    }
                }

                return redirect()->route('fsvaapi.index')->with('status', 'Data Berhasil ditarik');
            } else {
                Log::error('Data dari API tidak dalam format array:', ['data' => $data]);
                return redirect()->route('fsvaapi.index')->with('status', 'Data dari API tidak valid.');
            }
        } else {
            Log::error('Gagal mengambil data dari API:', ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()]);
            return redirect()->route('fsvaapi.index')->with('status', 'Gagal mengambil data dari API. Status code: ' . $response->getStatusCode());
        }
    } catch (RequestException $e) {
        Log::error('Guzzle Exception:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Terjadi kesalahan dalam request: ' . $e->getMessage()], 500);
    } catch (\Exception $e) {
        Log::error('Exception occurred:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}


}
