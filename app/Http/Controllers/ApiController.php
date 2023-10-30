<?php

namespace App\Http\Controllers;

use App\Models\token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{
    public function requestToken()
    {
        // Basic Auth credentials
        $username = 'Xb3V7Tg6usRsUG2xM7rxAqBYoMIa';
        $password = 'x9DBBUYkBLF7eyKDy_pbHZnmml0a';

        // Token endpoint URL
        $tokenUrl = 'https://splp.layanan.go.id/oauth2/token';

        // Create the Basic Auth header
        $base64Credentials = base64_encode($username . ':' . $password);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $base64Credentials,
            'Accept' => 'application/json',
        ])->post($tokenUrl, [
            'grant_type' => 'client_credentials',
        ]);

        // Check the response
        if ($response->successful()) {
            $data = $response->json();
            $accessToken = $data['access_token'];
    
            // Simpan token ke dalam database
            $token = new token([
                'access_token' => $accessToken,
                'expires_at' => now()->addSeconds($data['expires_in']), // Sesuaikan dengan waktu kadaluarsa token
            ]);
    
            $token->save();
            return response()->json(['success' => 'berhasil mendapatkan token'], $response->status());
        } else {
            // Log the response for debugging
            Log::error('Error response from token endpoint: ' . $response->body());
            return response()->json(['error' => 'Gagal mendapatkan token'], $response->status());
        }
    }

    public function getData(Request $request)
    {
	$currentDate = Carbon::now()->toDateString();
        $startDate = '2023-10-01';
        //$endDate = $currentDate;
        // Get the access token from the session or a secure place
        $token = Token::where('expires_at', '>', now()) // Pastikan token masih berlaku
        ->first();

    if (!$token) {
        return response()->json(['error' => 'Token tidak tersedia'], 401);
    }

    $accessToken = $token->access_token;
	//dd($accessToken);
        // API endpoint URL
        $apiUrl = "https://api-splp.layanan.go.id/panelharga/2.0/panelharga/data-harian/{$startDate}/{$currentDate}/3/64.09";

        // Make an authenticated GET request with the access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Check the response from the API
        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            // Log the response for debugging
            Log::error('Error response from API: ' . $response->body());
            return response()->json(['error' => 'Gagal mengambil data'], $response->status());
        }
    
    }

    public function getDatabulan(Request $request)
    {
        $year = $request->input('tahun');
        // Get the access token from the session or a secure place
        $token = Token::where('expires_at', '>', now()) // Pastikan token masih berlaku
        ->first();

    if (!$token) {
        return response()->json(['error' => 'Token tidak tersedia'], 401);
    }

    $accessToken = $token->access_token;
        // API endpoint URL
        $apiUrl = 'https://api-splp.layanan.go.id/panelharga/2.0/panelharga/data-bulanan/{{$year}}/3/64.71';

        // Make an authenticated GET request with the access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Check the response from the API
        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            // Log the response for debugging
            Log::error('Error response from API: ' . $response->body());
            return response()->json(['error' => 'Gagal mengambil data'], $response->status());
        }
    
    }

    public function getkomoditas()
    {
        // Get the access token from the session or a secure place
        $token = Token::where('expires_at', '>', now()) // Pastikan token masih berlaku
        ->first();

    if (!$token) {
        return response()->json(['error' => 'Token tidak tersedia'], 401);
    }

    $accessToken = $token->access_token;

        // API endpoint URL
        $apiUrl = 'https://api-splp.layanan.go.id/panelharga/2.0/api/panel-harga-pangan/daftar-komoditas/3';

        // Make an authenticated GET request with the access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Check the response from the API
        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            // Log the response for debugging
            Log::error('Error response from API: ' . $response->body());
            return response()->json(['error' => 'Gagal mengambil data'], $response->status());
        }
    
    }
}
