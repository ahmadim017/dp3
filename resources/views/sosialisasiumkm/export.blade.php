<table class="table">
    <thead>
        <tr><th colspan="14" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="14" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="14" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
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
        <th scope="col">PIRT</th>
        <th scope="col">Sertifikat Halal</th>
        <th scope="col">Sertifikat Laik Higieni</th>
        <th scope="col">NPWP</th>
        <th scope="col">Komoditas Pangan Lokal</th>
        <th scope="col">Jenis Produk Olahan</th>
      </tr>
    </thead>
          <tbody>
            @foreach ($sosialisasiumkm as $u)
            <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$u->namausaha}}</td>
                  <td>{{$u->namapelakuusaha}}</td>
                  <td>{{$u->nohp}}</td>
                  <td>{{$u->alamat}}</td>
                  <td>{{$u->kelurahan}}</td>
                  <td>{{$u->kecamatanid->kecamatan}}</td>
                  <td>{{$u->nib}}</td>
                  <td>{{$u->pirt}}</td>
                  <td>{{$u->halal}}</td>
                  <td>{{$u->higenis}}</td>
                  <td>{{$u->npwp}}</td>
                  <td>{{$u->komoditas}}</td>
                  <td>{{$u->produkolahan}}</td>
            </tr>
            @endforeach
          </tbody>
  </table>