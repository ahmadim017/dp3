<table class="table">
    <thead>
        <tr><th colspan="10" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="10" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="10" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Komoditas</th>
        <th scope="col">Stok Minggu Lalu</th>
        <th scope="col">Pengadaan Minggu Berjalan</th>
        <th scope="col">Ketersediaan Awal</th>
        <th scope="col">Konsumsi (kg/kapita/tahun)</th>
        <th scope="col">Konsumsi /Minggu</th>
        <th scope="col">Harga</th>
        <th scope="col">Ketersediaan Akhir</th>
	    <th scope="col">Periode</th>
      </tr>
    </thead>
          <tbody>
            @foreach ($neracapangan as $u)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$u->komoditasid->komoditas}}</td>
                <td>{{$u->stockminggulalu}}</td>
                <td>{{$u->pengadaan}}</td>
                <td>{{$u->ketersediaanawal}}</td>
                <td>{{$u->konsumsihari}}</td>
                <td>{{$u->konsumsiminggu}}</td>
                <td>{{$u->harga}}</td>
                <td>{{$u->ketersediaanakhir}}</td>
                <td>{{$u->minggu}}, {{$u->bulanid->bulan}} {{$u->tahun}}</td>
            </tr>
            @endforeach
          </tbody>
  </table>