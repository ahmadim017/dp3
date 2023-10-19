<table class="table">
    <thead>
        <tr><th colspan="9" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="9" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="9" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Usaha</th>
        <th scope="col">Nama Pelaku Usaha</th>
        <th scope="col">No Hp/WA</th>
        <th scope="col">Alamat</th>
        <th scope="col">Keluran</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">NIB</th>
        <th scope="col">Sertifikat</th>
      </tr>
    </thead>
          <tbody>
            @foreach ($sosialisasi as $u)
            <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$u->namausaha}}</td>
                  <td>{{$u->namapelakuusaha}}</td>
                  <td>{{$u->nohp}}</td>
                  <td>{{$u->alamat}}</td>
                  <td>{{$u->kelurahan}}</td>
                  <td>{{$u->kecamatanid->kecamatan}}</td>
                  <td>{{$u->nib}}</td>
                  <td>{{$u->sertifikat}}</td>
            </tr>
            @endforeach
          </tbody>
  </table>