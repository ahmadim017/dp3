<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentrePoint;
use App\Models\keamananpanganmasyarakat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class keamananpanganmasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keamananpanganmasyarakat = keamananpanganmasyarakat::all();
        return view('keamananpanganmasyarakat.index',['keamananpanganmasyarakat' => $keamananpanganmasyarakat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Memanggil model CentrePoint untuk mendapatkan data yang akan dikirimkan ke form create
        // space
        $centrepoint = CentrePoint::get()->first();
        return view('keamananpanganmasyarakat.create', [
            'centrepoint' => $centrepoint,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lakukan validasi data
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'alamat' => 'required',
            'jumlah' => 'required',
            'location' => 'required'
        ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $keamananpanganmasyarakat = new keamananpanganmasyarakat;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $imageName);
	    $keamananpanganmasyarakat->image = $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/filependukung', $fileName);
	    $keamananpanganmasyarakat->file = $fileName;
        }

        // Memasukkan nilai untuk masing-masing field pada tabel space berdasarkan inputan dari
        // form create 
        
        
        $keamananpanganmasyarakat->name = $request->input('name');
	$keamananpanganmasyarakat->tglpelaksanaan = $request->input('tglpelaksanaan');
        $keamananpanganmasyarakat->jumlah = $request->input('jumlah');
        $keamananpanganmasyarakat->alamat = $request->input('alamat');
        $keamananpanganmasyarakat->slug = Str::slug($request->name, '-');
        $keamananpanganmasyarakat->location = $request->input('location');
        $keamananpanganmasyarakat->content = $request->input('content');

        //return dd($spaces);

        // proses simpan data
        $keamananpanganmasyarakat->save();

        // redirect ke halaman index space
        if ($keamananpanganmasyarakat) {
            return redirect()->route('keamananpanganmasyarakat.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('keamananpanganmasyarakat.index')->with('error', 'Data gagal disimpan');
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
        $keamananpanganmasyarakat = keamananpanganmasyarakat::findOrfail($id);
	return view('keamananpanganmasyarakat.show',['keamananpanganmasyarakat' => $keamananpanganmasyarakat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $keamananpanganmasyarakat = keamananpanganmasyarakat::findOrFail($id);
	$formattedDate = date('Y-m-d', strtotime($keamananpanganmasyarakat->tglpelaksanaan));
        return view('keamananpanganmasyarakat.edit', ['keamananpanganmasyarakat' => $keamananpanganmasyarakat,'formattedDate' =>$formattedDate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keamananpanganmasyarakat $keamananpanganmasyarakat)
    {
        // Menjalankan validasi
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'file' => 'file|max:2048',
            'alamat' => 'required',
            'jumlah' => 'required',
            'location' => 'required'
        ]);
          $fileName = null;
        // Jika data yang akan diganti ada pada tabel space
        // cek terlebih dahulu apakah akan mengganti gambar atau tidak
        // jika gambar diganti hapus terlebuh dahulu gambar lama
        $keamananpanganmasyarakat = keamananpanganmasyarakat::findOrFail($keamananpanganmasyarakat->id);
        if ($request->hasFile('image')) {
            if (File::exists("uploads/imgCover/" . $keamananpanganmasyarakat->image)) {
                File::delete("uploads/imgCover/" . $keamananpanganmasyarakat->image);
            }
            $file = $request->file("image");
            $keamananpanganmasyarakat->image = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $keamananpanganmasyarakat->image);
            $request['image'] = $keamananpanganmasyarakat->image;
        }

        if ($request->hasFile('file')) {
            if ($keamananpanganmasyarakat->file && file_exists(storage_path('app/public/filependukung/' . $keamananpanganmasyarakat->file))) {
                Storage::delete('public/' . $keamananpanganmasyarakat->file);
            }
        
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/filependukung', $fileName);
            $request->merge(['file' => $fileName]);
        }

        // Lakukan Proses update data ke tabel space
        $keamananpanganmasyarakat->update([
            'name' => $request->name,
	    'tglpelaksanaan' => $request->tglpelaksanaan,
            'jumlah' => $request->jumlah,
            'alamat' => $request->alamat,
	    'file' => $fileName,
            'location' => $request->location,
            'content' => $request->content,
            'slug' => Str::slug($request->name, '-'),
        ]);
       
        // redirect ke halaman index space
        if ($keamananpanganmasyarakat) {
            return redirect()->route('keamananpanganmasyarakat.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('keamananpanganmasyarakat.index')->with('error', 'Data gagal diupdate');
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
        // hapus keseluruhan data pada tabel space begitu juga dengan gambar yang disimpan
        $keamananpanganmasyarakat = keamananpanganmasyarakat::findOrFail($id);
        if (File::exists("uploads/imgCover/" . $keamananpanganmasyarakat->image)) {
            File::delete("uploads/imgCover/" . $keamananpanganmasyarakat->image);
        }
        if ($keamananpanganmasyarakat->file && file_exists(storage_path('app/public/filependukung/' . $keamananpanganmasyarakat->file))) {
            Storage::delete('public/filependukung/' . $keamananpanganmasyarakat->file);
        }
        $keamananpanganmasyarakat->delete();
        return redirect()->route('keamananpanganmasyarakat.index');
    }

}
