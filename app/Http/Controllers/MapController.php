<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\sosialisasiumkm;
use App\Models\Space;
use App\Models\tahun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index(Request $request)
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

            $sosialisasiumkms = DB::table('sosialisasiumkms')->leftJoin('kecamatan','sosialisasiumkms.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
            ->where('kecamatan','<>',1)->whereYear('sosialisasiumkms.created_at',$ta)->groupBy('kecamatan')->get();
           
            foreach ($sosialisasiumkms as $u) {
                $data[] = [$u->kecamatan,$u->total];
            }
            $spaces = Space::whereYear('created_at',$ta)->get();
            $sosialisasiumkm = sosialisasiumkm::whereYear('created_at',$ta)->get();
        }else{

            $sosialisasiumkms = DB::table('sosialisasiumkms')->leftJoin('kecamatan','sosialisasiumkms.id_kecamatan','=','kecamatan.id')->select(DB::raw('count(*) as total, kecamatan'))
            ->where('kecamatan','<>',1)->whereYear('sosialisasiumkms.created_at',$t)->groupBy('kecamatan')->get();
           
            foreach ($sosialisasiumkms as $u) {
                $data[] = [$u->kecamatan,$u->total];
            }
            $spaces = Space::whereYear('created_at',$t)->get();
            $sosialisasiumkm = sosialisasiumkm::whereYear('created_at',$t)->get();
        }
        //dd($data);
        return view('map.index',[
            'spaces' => $spaces,
            'centrePoint' => $centrePoint,
            'sosialisasiumkm' => $sosialisasiumkm,
            'tahun' => $tahun,
            'ta' => $ta,
            't' => $t,
            'data' => $data
        ]);
        //return dd($spaces);
    }

    public function show($slug)
    {
        /**
         * Hampir sama dengam method index diatas
         * tapi disini kita hanya akan menampilkan single data saja untuk space
         * yang kita pilih pada view map dan selanjutnya kita akan di arahkan 
         * ke halaman detail untuk melihat informasi lebih lengkap dari space
         * yang kita pilih
         */
        $centrePoint = CentrePoint::get()->first();
        $spaces = Space::where('slug',$slug)->first();
        return view('map.show',['centrePoint' => $centrePoint,'spaces' => $spaces]);
    }
}
