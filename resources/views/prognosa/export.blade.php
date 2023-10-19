<table class="table">
    <thead>
        <tr><th colspan="12" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="12" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="12" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Komoditas</th>
        <th scope="col">Stok Awal (Ton.)</th>
        <th scope="col">Perkiraan Produksi (Ton.)</th>
	    <th scope="col">Total Ketersediaan (Ton.)</th>
        <th scope="col">Kebutuhan (Tahunan)(Ton.)</th>
	    <th scope="col">Kebutuhan (Bulanan)(Ton.)</th>
        <th scope="col">Neraca (Ton.)</th>
        <th scope="col">Rencana Impor (Ton.)</th>
        <th scope="col">Stock Akhir (Ton.)</th>
        <th scope="col">Bulan</th>
        <th scope="col">Tahun</th>
      </tr>
    </thead>
          <tbody>
            @foreach ($prognosa as $u)
      <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$u->komoditasid->komoditas}}</td>
      <td>{{$u->stockawal}}</td>
      <td>{{$u->produksi}}</td>
	    <td>{{$u->totalketersediaan}}</td>
 	    <td>{{$u->kebutuhantahunan}}</td>
	    <td>{{$u->kebutuhanbulanan}}</td>
	    <td>{{$u->neraca}}</td>
	    <td>{{$u->rencanaimpor}}</td>
	    <td>{{$u->stockakhir}}</td>
        <td>{{$u->bulanid->bulan}}</td>
        <td>{{$u->tahun}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>