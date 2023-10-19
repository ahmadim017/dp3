<table class="table">
    <thead>
        <tr><th colspan="5" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="5" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="5" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">Indeks Ketersediaan</th>
        <th scope="col">Indeks Akses</th>
	    <th scope="col">Indeks Pemanfaatan</th>
        <th scope="col">Skor Komposit</th>
	    <th scope="col">Keterangan</th>
        <th scope="col">Indek Komposit</th>
	    <th scope="col">bulan</th>
      </tr>
    </thead>
          <tbody>
            @foreach ($skpg as $u)
            <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$u->kecamatanid->kecamatan}}</td>
                  <td>{{$u->ketersediaan}}</td>
                  <td>{{$u->akses}}</td>
                  <td>{{$u->pemanfaatan}}</td>
                  <td>{{$u->skorkomposit}}</td>
                  <td>@if ($u->skorkomposit >= 1 && $u->skorkomposit <= 5)
                  <span class="badge badge-danger">Rawan</span>
                  @elseif ($u->skorkomposit >= 6 && $u->skorkomposit <= 7)
                  <span class="badge badge-warning">Waspada</span>
                  @else
                     <span class="badge badge-success">Aman</span>
                @endif
            </td> 
            <td>@if ($u->skorkomposit >= 1 && $u->skorkomposit <= 4)
                    <span class="badge badge-danger">1</span>
                @elseif ($u->skorkomposit >= 5 && $u->skorkomposit <= 7)
                    <span class="badge badge-warning">2</span>
                @else
                     <span class="badge badge-success">3</span>
                @endif
            </td> 
       
                    <td>{{$u->bulanid->bulan}}</td>
                  
            </tr>
            @endforeach
          </tbody>
  </table>