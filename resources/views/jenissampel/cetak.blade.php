<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Hasil Uji Sampel</title>
</head>
<body>
    <div class="container">
        <table width="100%">
            <tr>
                
                <td><center><font size="3"><b> PEMERINTAH KOTA BALIKPAPAN</b></font><br>
                    <font size="3"><b> DINAS PANGAN, PERTANIAN DAN PERIKANAN</font></b><br>
                    <font size ="2">Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</font></center>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
        </table><br>
        <h3 align="center">Daftar Hasil Sampel yang Diuji</h3>
         <table class="table" width="100%" border="1" cellspacing="0" cellpadding="0">
  <thead class="table-light">
    <tr>
      <th scope="col" align="center">No.</th>
      <th scope="col" align="center">Jenis Sampel</th>
      <th scope="col" align="center">Hasil Uji Sampel</th>
      <th scope="col" align="center">Keterangan</th>
      <th scope="col" align="center">Lokasi</th>
      <th scope="col" align="center">Tanggal Pengambilan Sampel</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($jenissampel as $u)
    <tr>
          <td align="center">{{$loop->iteration}}</td>
          <td align="center">{{$u->jenissampel}}</a></td>
          <td align="center">{{$u->hasiluji}}</td>
          <td align="center">{{$u->keterangan}}</td>
	 	@if($u->keamananpanganid)
		  <td align="center">{{$u->keamananpanganid->lokasisampel}}</td>
		  @else
		  <td></td>
		  @endif
          <td align="center">{{$u->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
            
          
          
          
          
    </div>
        
</body>
</html>