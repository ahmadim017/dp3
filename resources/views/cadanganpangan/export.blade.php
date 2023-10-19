<table class="table">
    <thead>
        <tr><th colspan="9" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="9" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="9" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Bulan</th>
        <th scope="col">Stok Awal</th>
        <th scope="col">Pengadaan</th>
        <th scope="col">Penyaluran</th>
        <th scope="col">Stok Akhir</th>
        <th scope="col">No Kontrak</th>
        <th scope="col">Tanggal Kontrak</th>
        <th scope="col">Tahun</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($cadanganpangan as $u)
      <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$u->bulanid->bulan}}</td>
            <td>{{$u->stockawal}}</td>
            <td>{{$u->pengadaan}}</td>
            <td>{{$u->penyaluran}}</td>
            <td>{{$u->stockakhir}}</td>
            <td>{{$u->nokontrak}}</td>
            <td>{{$u->tglkontrak}}</td>
            <td>{{$u->tahun}}</td>
            
      </tr>
      @endforeach
    </tbody>
  </table>