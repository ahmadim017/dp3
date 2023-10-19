@extends('layouts.sbadmin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Usulan Penerima Bantuan</h1>
    <div class="lg:text-right">
<a href="{{route('usulan.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
Usulan Penerima Bantuan</a>
    </div>
</div>
    <div class="row">
        <form action="{{route('usulan.dashboard')}}">
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

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card bg-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-s font-weight-bold text-white text-uppercase mb-1">Total Permohonan Masuk</div>
              <div class="h6 mb-0 font-weight-bold text-white">{{$usulan}}</div>
            </div>
            <div class="col-auto">
              <i class="fa fa-bar-chart fa-2x  text-gray-300" ></i>
            </div>
          </div>
        
        </div>
      </div>
    </div>


      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-s font-weight-bold text-white text-uppercase mb-1">Tidak Sesuai</div>
                <div class="h6 mb-0 font-weight-bold text-white">{{$ditolak}}</div>
              </div>
              <div class="col-auto">
                <i class="fa fa-bar-chart fa-2x  text-gray-300" ></i>
              </div>
            </div>
           
          </div>
        </div>
      </div>
  

  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-light shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-s font-weight-bold text-gray-800 text-uppercase mb-1">Total Diterima</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800">{{$diterima}}</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-bar-chart fa-2x  text-gray-800"></i>
          </div>
        </div>
       
      </div>
    </div>
  </div>
</div>
  
<div class="row">
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-secondary">Data Permohonan Yang Diterima Beradasarkan Kecamatan</h6>
        </div>
        <div class="card-body">
          <div id="container"></div>
          </div>
      </div>
    </div>

    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-secondary">Data Permohonan Yang Ditolak Beradasarkan Kecamatan</h6>
        </div>
        <div class="card-body">
          <div id="container2"></div>
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
<script>

    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y} Jumlah Usulan Penerima Bantuan</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} Jumlah Usulan Penerima Bantuan'
            }
        }
    },
    credits: {
    enabled: false
  },
    series: [{
        name: 'Kecamatan',
        colorByPoint: true,
        data: {!!json_encode($data)!!}
    }]
});

Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y} Jumlah Usulan Penerima Bantuan</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} Jumlah Usulan Penerima Bantuan'
            }
        }
    },
    credits: {
    enabled: false
  },
    series: [{
        name: 'Kecamatan',
        colorByPoint: true,
        data: {!!json_encode($datat)!!}
    }]
});

</script>
@endsection
    
