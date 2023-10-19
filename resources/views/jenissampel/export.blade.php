<table class="table">
    <thead>
        <tr><th colspan="5" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="5" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="5" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Jenis Sampel</th>
        <th scope="col">Hasil Uji</th>
        <th scope="col">Keterangan</th>
	<th scope="col">Lokasi</th>
        <th scope="col">Tanggal Pengujian</th>
      </tr>
    </thead>
          <tbody>
              @foreach ($jenissampel as $f)
            <tr>
                  <td>{{$loop->iteration}}</td>    
                  <td>{{$f->jenissampel}}</td>
                  <td>{{$f->hasiluji}}</td>
                  <td>{{$f->keterangan}}</td>
		  @if($f->keamananpanganid)
		  <td>{{$f->keamananpanganid->lokasisampel}}</td>
		  @else
		  <td></td>
		  @endif
		  <td>{{$f->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
  </table>