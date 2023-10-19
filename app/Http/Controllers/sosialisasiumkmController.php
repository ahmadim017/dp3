<?php

namespace App\Http\Controllers;

use App\Exports\sosialisasiumkmExport;
use App\Models\CentrePoint;
use App\Models\kecamatan;
use App\Models\sosialisasiumkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class sosialisasiumkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosialisasiumkm = sosialisasiumkm::whereYear('created_at', Carbon::now()->year)->get();
        return view('sosialisasiumkm.index',['sosialisasiumkm' => $sosialisasiumkm]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centrepoint = CentrePoint::get()->first();
        $kecamatan = kecamatan::all();
        return view('sosialisasiumkm.create',['centrepoint' => $centrepoint,'kecamatan' => $kecamatan]);
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
            'namausaha' => 'required',
            'namapelakuusaha' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'file' => 'file|mimes:pdf|max:2048',
            'alamat' => 'required',
            'nohp' => 'required|numeric',
            'location' => 'required',
            'produkohalan' => 'required',
            'komoditas' => 'required',
            ])->validated();

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $sosialisasiumkm = new sosialisasiumkm();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $imageName);
            $sosialisasiumkm->image = $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/filependukung', $fileName);
            $sosialisasiumkm->file = $fileName;
        }

        // Memasukkan nilai untuk masing-masing field pada tabel space berdasarkan inputan dari
        // form create 
       
       
        $sosialisasiumkm->namausaha = $request->input('namausaha');
        $sosialisasiumkm->namapelakuusaha = $request->input('namapelakuusaha');
        $sosialisasiumkm->alamat = $request->input('alamat');
        $sosialisasiumkm->kelurahan = $request->input('kelurahan');
        $sosialisasiumkm->id_kecamatan = $request->input('id_kecamatan');
        $sosialisasiumkm->nohp = $request->input('nohp');
        $sosialisasiumkm->nib = $request->input('nib');
        $sosialisasiumkm->pirt = $request->input('pirt');
        $sosialisasiumkm->halal = $request->input('halal');
        $sosialisasiumkm->higenis = $request->input('higenis');
        $sosialisasiumkm->npwp = $request->input('npwp');
        $sosialisasiumkm->location = $request->input('location');
        $sosialisasiumkm->komoditas = $request->input('komoditas');
        $sosialisasiumkm->produkolahan = $request->input('produkolahan');

        //return dd($spaces);

        // proses simpan data
        $sosialisasiumkm->save();

        // redirect ke halaman index space
        if ($sosialisasiumkm) {
            return redirect()->route('sosialisasiumkm.index')->with('status', 'Data berhasil disimpan');
        } else {
            return redirect()->route('sosialisasiumkm.index')->with('Status', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sosialisasiumkm = sosialisasiumkm::findOrfail($id);
        return view('sosialisasiumkm.show',['sosialisasiumkm' => $sosialisasiumkm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = kecamatan::all();
        $centrepoint = CentrePoint::get()->first();
        $sosialisasiumkm = sosialisasiumkm::findOrfail($id);
        return view('sosialisasiumkm.edit',['centrepoint' => $centrepoint,'sosialisasiumkm' => $sosialisasiumkm,'kecamatan' => $kecamatan]);
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
            'namausaha' => 'required',
            'namapelakuusaha' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'file' => 'file|mimes:pdf|max:2048',
            'alamat' => 'required',
            'nohp' => 'required|numeric',
            'location' => 'required',
            'produkohalan' => 'required',
            'komoditas' => 'required',
            ])->validated();

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $sosialisasiumkm = sosialisasiumkm::findOrfail($id);
        if ($request->hasFile('image')) {
            if (File::exists('uploads/imgCover/' .  $sosialisasiumkm->image)) {
                File::delete('uploads/imgCover/' .  $sosialisasiumkm->image);
            }
            $file = $request->file("image");
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/',  $imageName);
            $sosialisasiumkm->image = $imageName;
        }

        if ($request->hasFile('file')) {
            if ( $sosialisasiumkm->file && file_exists(storage_path('app/public/filependukung/' . $sosialisasiumkm->file))) {
                Storage::delete('public/filependukung/' . $sosialisasiumkm->file);
            }
        
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/filependukung', $fileName);
            $sosialisasiumkm->file = $fileName;
        }

        
        
        $sosialisasiumkm->namausaha = $request->input('namausaha');
        $sosialisasiumkm->namapelakuusaha = $request->input('namapelakuusaha');
        $sosialisasiumkm->alamat = $request->input('alamat');
        $sosialisasiumkm->kelurahan = $request->input('kelurahan');
        $sosialisasiumkm->id_kecamatan = $request->input('id_kecamatan');
        $sosialisasiumkm->nohp = $request->input('nohp');
        $sosialisasiumkm->nib = $request->input('nib');
        $sosialisasiumkm->pirt = $request->input('pirt');
        $sosialisasiumkm->halal = $request->input('halal');
        $sosialisasiumkm->higenis = $request->input('higenis');
        $sosialisasiumkm->npwp = $request->input('npwp');
        $sosialisasiumkm->location = $request->input('location');
        $sosialisasiumkm->komoditas = $request->input('komoditas');
        $sosialisasiumkm->produkolahan = $request->input('produkolahan');

         // proses simpan data
         $sosialisasiumkm->save();

         // redirect ke halaman index space
         if ($sosialisasiumkm) {
            return redirect()->route('sosialisasiumkm.index')->with('status', 'Data berhasil disimpan');
        } else {
            return redirect()->route('sosialisasiumkm.index')->with('Status', 'Data gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sosialisasiumkm = sosialisasiumkm::findOrfail($id);
        if ( $sosialisasiumkm->file && file_exists(storage_path('app/public/filependukung/' . $sosialisasiumkm->file))) {
            Storage::delete('public/filependukung/' . $sosialisasiumkm->file);
        }
        if (File::exists("uploads/imgCover/" .  $sosialisasiumkm->image)) {
            File::delete("uploads/imgCover/" .  $sosialisasiumkm->image);
        }
        $sosialisasiumkm->delete();

        return redirect()->route('sosialisasiumkm.index')->with('Status','Data Berhasil dihapus');
    }

    public function download($id)
    {
        $sosialisasiumkm = sosialisasiumkm::findOrfail($id);
        return response()->download(storage_path('app/public/filependukung/' . $sosialisasiumkm->file));
    }
	
    public function export_excel(Request $request) 
    {
	    $ta = $request->get('ta');
        return Excel::download(new sosialisasiumkmExport($ta), 'sosialisasiumkm.xlsx');
    }
}
