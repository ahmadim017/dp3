@extends('layouts.sbadmin')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Neraca Pangan</h1>
    <a href="{{route('neracapangan.index')}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg> Neraca Pangan</a>
</div>

<div class="card shadow mb-4">
           <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg> Cari Berdasarkan</h6>
           </div>
            
             <div class="card-body ">

    <form action="{{route('neracapangan.dashboard')}}">
    <div class="row">
    <div class="col-6 mb-3">
             <select name="bulan" class="form-control" >
            <option value="">-semua data-</option>
        @foreach ($ba as $b)
            <option @if($b->id == $bulan) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
        @endforeach
            </select>
      </div>
    <div class="col-6 mb-3">
          <select name="tahun" class="form-control {{$errors->first('minggu') ? "is-invalid" : ""}}" >
            <option value="">-semua-</option>
            @foreach ($ta as $t)
            <option @if($t->tahun == $tahun) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
            @endforeach
        </select>
      </div>
</div>
    <div class="text-right">
       <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
  	<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  	<path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
	</svg> Tampilkan</button>
    </div>
    </form>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
         <div class="card shadow mb-4">
           <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-secondary">Ketersediaan Pangan Mingguan</h6>
           </div>
            
             <div class="card-body ">
                 <div id="container5"></div>
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
Highcharts.chart('container5', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ketersediaan Pangan Mingguan'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: {!!json_encode($komo)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Kondisi Stock'
        }
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name}: </td>' +
            '<td style="padding:0"><b> {point.y} Ton</b></td></tr>',
        footerFormat: '</table>',
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
        name: 'Minggu Ke-1',
        data: {!!json_encode($mingguke1)!!}
    }, {
        name: 'Minggu Ke-2',
        data: {!!json_encode($mingguke2)!!}


    }, {
        name: 'Minggu Ke-3',
        data: {!!json_encode($mingguke3)!!}

    }, {
        name: 'Minggu Ke-4',
        data: {!!json_encode($mingguke4)!!}

    }]
});

Highcharts.chart('container4', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'AVG Harga Bulanan'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: {!!json_encode($komo)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Kondisi Harga'
        }
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name}: </td>' +
            '<td style="padding:0"><b>Rp {point.y}</b></td></tr>',
        footerFormat: '</table>',
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
        name: 'AVG Harga /bulan',
        data: {!!json_encode($rataBulan)!!}

    }]
});

Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'AVG Harga Tahunan'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        categories: {!!json_encode($komo)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Kondisi Harga'
        }
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name}: </td>' +
            '<td style="padding:0"><b>Rp {point.y}</b></td></tr>',
        footerFormat: '</table>',
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
        name: 'AVG Harga /Tahun',
        data: {!!json_encode($rataRataTahun)!!}
    }]
});

              

</script>

@endsection