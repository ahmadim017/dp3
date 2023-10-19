<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Models\CentrePoint;
use App\Models\kecamatan;
use App\Models\neracapangan;
use Illuminate\Http\Request;

class welcomeController extends Controller
{

    public function index()
    {
        $neracapangan = neracapangan::where('minggu','Minggu Ke-1')->get();
        $berita = berita::where('status','ACTIVE')->latest()->get();
        return view('portal',['neracapangan' => $neracapangan,'berita' => $berita]);
        
    }
    public function map()
    {
        $centrePoint = CentrePoint::get()->first();
        $kecamatan = kecamatan::all();
        return view('map',['kecamatan' => $kecamatan,'centrePoint' => $centrePoint]);
    }
}
