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
        <th scope="col">Tanggal Lahir</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Alamat</th>
	<th scope="col">Kelurahan</th>
      </tr>
    </thead>
          <tbody>
              @foreach ($usulan as $f)
            <tr>
                  <td>{{$loop->iteration}}</td>    
                  <td>{{$f->nik}}</td>
                  <td>{{$f->nama}}</td>
                  <td>{{$f->tgllahir}}</td>
                  <td>{{$f->jeniskelamin}}</td>
                  <td>{{$f->alamat}}</td>
		  <td>{{$f->kelurahan}}</td>
            </tr>
            @endforeach
          </tbody>
  </table>