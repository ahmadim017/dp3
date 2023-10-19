<table class="table">
    <thead>
        <tr><th colspan="5" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="5" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="5" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nik</th>
        <th scope="col">Nama</th>
        <th scope="col">Komoditas</th>
        <th scope="col">Jumlah</th>
      </tr>
    </thead>
          <tbody>
              @foreach ($penyaluran as $f)
            <tr>
                  <td>{{$loop->iteration}}</td>    
                  <td>{{$f->usulan->nik}}</td>
                  <td>{{$f->usulan->nama}}</td>
                  <td>{{$f->komoditasid->komoditas}}</td>
                  <td>{{$f->jumlah}}</td>
            </tr>
            @endforeach
          </tbody>
  </table>