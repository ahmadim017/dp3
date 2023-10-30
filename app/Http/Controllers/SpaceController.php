<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentrePoint;
use App\Models\Space;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = Carbon::now()->year;
        $space = Space::whereYear('created_at', $tahun)->get();
        return view('space.index',['space' => $space]);
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
        return view('space.create', [
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
        $spaces = new Space;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $imageName);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/filependukung', $fileName);
        }

        // Memasukkan nilai untuk masing-masing field pada tabel space berdasarkan inputan dari
        // form create 
        $spaces->image = $imageName;
        $spaces->file = $fileName;
        $spaces->name = $request->input('name');
        $spaces->jumlah = $request->input('jumlah');
        $spaces->alamat = $request->input('alamat');
        $spaces->slug = Str::slug($request->name, '-');
        $spaces->location = $request->input('location');
        $spaces->content = $request->input('content');

        //return dd($spaces);

        // proses simpan data
        $spaces->save();

        // redirect ke halaman index space
        if ($spaces) {
            return redirect()->route('space.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('spaceI.index')->with('error', 'Data gagal disimpan');
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
        $space = Space::findOrfail($id);
        return view('space.show',['space' => $space]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        // mencari data space yang dipilih berdasarkan id
        // kemudian menampilkan data tersebut ke form edit space
        $space = Space::findOrFail($space->id);
        return view('space.edit', ['space' => $space]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        // Menjalankan validasi
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'file' => 'file|mimes:pdf|max:2048',
            'alamat' => 'required',
            'jumlah' => 'required',
            'location' => 'required'
        ]);
        $fileName = null;
        
        $space = Space::findOrFail($space->id);
        if ($request->hasFile('image')) {
            if (File::exists("uploads/imgCover/" . $space->image)) {
                File::delete("uploads/imgCover/" . $space->image);
            }
            $file = $request->file("image");
            $space->image = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $space->image);
            $request['image'] = $space->image;
        }

        if ($request->hasFile('file')) {
            if ($space->file && file_exists(storage_path('app/public/filependukung/' .$space->file))) {
                Storage::delete('public/filependukung/' .$space->file);
            }
        
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/filependukung', $fileName);
            $space->file = $fileName;
        }
        // Lakukan Proses update data ke tabel space
        $space->update([
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'alamat' => $request->alamat,
            'location' => $request->location,
            'content' => $request->content,
            'slug' => Str::slug($request->name, '-'),
        ]);
       
        // redirect ke halaman index space
        if ($space) {
            return redirect()->route('space.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('space.index')->with('error', 'Data gagal diupdate');
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
        $space = Space::findOrFail($id);
        if (File::exists("uploads/imgCover/" . $space->image)) {
            File::delete("uploads/imgCover/" . $space->image);
        }
        if ($space->file && file_exists(storage_path('app/public/filependukung/' . $space->file))) {
            Storage::delete('public/filependukung/' . $space->file);
        }
        $space->delete();
        return redirect()->route('space.index');
    }

    public function download($id)
    {
        $space = Space::findOrFail($id);
        return response()->download(storage_path('app/public/filependukung'. $space->file));
    }
}
