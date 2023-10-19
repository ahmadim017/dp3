<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Hasil Uji Sampel Pelaku Usaha</title>
</head>
<body>
    <div class="container">
        <table width="100%">
            <tr>
                <td width="80" height="80" align="center"><img src="{{asset('image/logo.png')}}" width="60px"></td>
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
        <p>Pelaku Usaha : {{$sosialisasi->namausaha}}</p>
         <table class="table" width="100%" border="1" cellspacing="0" cellpadding="0">
  <thead class="table-light">
    <tr>
	  <th scope="col">No.</th>
          <th scope="col">Jenis PSAT</th>
          <th scope="col">Nama Dagang</th>
          <th scope="col">Nama Merek</th>
          <th scope="col">Nomor Perizinan</th>
          <th scope="col">Kewenangan</th>
          <th scope="col">Keterangan</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($jenispsat as $f)
    <tr>
           <td>{{$loop->iteration}}</td>    
                    <td>{{$f->jenispsat}}</td>
                    <td>{{$f->namadagang}}</td>
                    <td>{{$f->namamerek}}</td>
	            <td>{{$f->noperizinan}}</td>
		    <td>{{$f->kewenangan}}</td>
		    <td>{{$f->keterangan}}</td>
          
    </tr>
    @endforeach
  </tbody>
</table>
            
          
          
          
          
    </div>
        
</body>
</html>