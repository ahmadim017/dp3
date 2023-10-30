<?php

namespace App\Http\Controllers;

use App\Models\datakomoditas;
use App\Models\token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class datakomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datakomoditas = datakomoditas::all();
        return view('datakomoditas.index',['datakomoditas' => $datakomoditas]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datakomoditas = datakomoditas::findOrfail($id);
        return view('datakomoditas.edit',['datakomoditas' => $datakomoditas]);
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
        $datakomoditas = datakomoditas::findOrfail($id);
        if ($request->file('image')) {

            if ($datakomoditas->image && file_exists(storage_path('app/public/'.$datakomoditas->image))){
                Storage::delete('public/'.$datakomoditas->image);
            }
            $file = $request->file('image')->store('image','public');
            $datakomoditas->image = $file;
        }
        $datakomoditas->save();
        return redirect()->route('datakomoditas.index')->with('status','Data Berhasil diupdate');
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

    public function getDataFromAPI()
{

    $token = token::where('expires_at', '>', now())->first();

    if (!$token) {
        return response()->json(['error' => 'Token tidak tersedia'], 401);
    }

    $accessToken = $token->access_token;
        $apiUrl = "https://api-splp.layanan.go.id/panelharga/2.0/api/panel-harga-pangan/daftar-komoditas/3";

        try {
            // Make an authenticated GET request with the access token
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get($apiUrl);
    
            // Check the response from the API
            if ($response->successful()) {
                $data = $response->json();
     
            //dd($data);
            foreach ($data['data'] as $item) {
                datakomoditas::updateOrInsert(
                    ['komoditas' => $item['komoditas']],
                    ['level_harga' => $item['level_harga']]
                );
            }
            
// ...


            return redirect()->route('datakomoditas.index')->with('status','Data Berhasil di tarik');
        } else {
            return redirect()->route('datakomoditas.index')->with('Status','Gagal mengambil data dari API');
        }
    } catch (\Exception $e) {
        // Tangani exception jika terjadi kesalahan
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

}
