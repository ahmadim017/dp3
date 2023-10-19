@extends('layouts.sbadmin')


@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Cadangan Pangan</h1>
    <a href="{{route('cadanganpangan.index')}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
 Cadangan Pangan</a>
</div>
    <div class="row">
        <form action="{{route('cadanganpangan.dashboard')}}">
        <div class="d-flex justify-content-between">
        
        <div class="ml-2 text-left">
              <select name="ta" class="form-control {{$errors->first('minggu') ? "is-invalid" : ""}}" >
                <option value="">-pilih-</option>
                @foreach ($tahun as $t)
                <option @if($t->tahun == $ta) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
                @endforeach
            </select>
          </div>
        
          <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </div>
        </form>
        </div>  
<br>

<div class="row">
    <div class="col-xl-12">
         <div class="card shadow mb-4">
           <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-secondary">Cadangan Pangan</h6>
           </div>
            
             <div class="card-body ">
      				<div id="container7"></div>
      		</div>
         </div>
       </div>
   </div>

   <div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-secondary">Cadangan Pangan</h6>
            </div>

            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead class="bg-primary text-white">
                          <tr>
                            <th scope="col">No</th>
                              <th scope="col">Bulan</th>
                            <th scope="col">Stok Awal</th>
                            <th scope="col">Pengadaan</th>
                            <th scope="col">Penyaluran</th>
			     <th scope="col">Pelepasan</th>
                              <th scope="col">Stok Akhir</th>
                   
                              <th scope="col">Tahun</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($cadanganpangan as $u)
                          <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{route('cadanganpangan.show',[$u->id])}}">{{$u->bulanid->bulan}}</a></td>
                                  <td>{{$u->stockawal}}</td>
                                <td>{{$u->pengadaan}}</td>
                                  <td>{{$u->penyaluran}}</td>
				  <td>{{$u->pelepasan}}</td>
                                   <td>{{$u->stockakhir}}</td>
                                
                                  <td>{{$u->tahun}}</td>
                                
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
            
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection
@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script type="text/javascript"> 
Highcharts.chart('container7', {
    chart: {
        type: 'column',
	height: 310 
    },
    title: {
        text: 'Data Cadangan Pangan di Kota Balikpapan'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: {!!json_encode($cbulan)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah (Kg)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Kg</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    credits: {
    enabled: false
  	},
    series: [{
        name: 'Stok Awal',
        data: {!!json_encode($cstockawal)!!}
    }, {
        name: 'Pengadaan',
        data: {!!json_encode($cpengadaan)!!}
    }, {
        name: 'Penyaluran',
        data: {!!json_encode($cpenyaluran)!!}
    }, {
     name: 'Pelepasan',
        data: {!!json_encode($cpelepasan)!!}
    }, {

        name: 'Stok Akhir',
        data: {!!json_encode($cstockakhir)!!}
    }]
});



</script>

@endsection