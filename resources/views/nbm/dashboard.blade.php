@extends('layouts.sbadmin')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Neraca Bahan Makanan</h1>
    <a href="{{route('nbmtahun.index')}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
 Neraca Bahan Makanan</a>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <form action="{{route('nbm.dashboard')}}">
    <div class="d-flex justify-content-between">
    <div class="ml-2 text-left">
          <select name="ta" class="form-control {{$errors->first('ta') ? "is-invalid" : ""}}" >
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


<div class="row">
    <div class="col-xl-12">
         <div class="card shadow mb-4">
           <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-secondary">Neraca Bahan Makanan</h6>
           </div>
             <div class="card-body ">
      				<div id="container1"></div>
      		 </div>
         </div>
       </div>
   </div>

   <div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-secondary">NERACA BAHAN MAKANAN</h6>
            </div>

            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                          <tr class="bg-primary text-white">
                            <th scope="col">No</th>
                            <th scope="col">Jenis Bahan Makanan</th>
                            <th scope="col">Kalori (kkal/hari)</th>
                            <th scope="col">Protein (gram/hari)</th>
                            <th scope="col">Lemak (gram/hari)</th>
                          </tr>
                        </thead>
                        <tbody>
                    @foreach ($nbm as $u)
                  <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$u->bahanpanganid->bahanpangan}}</td>
                        <td>{{round($u->kalori,3)}}</td>
                        <td >{{round($u->protein,3)}}</td>
                        <td>{{round($u->lemak,3)}}</td>         
                  </tr>
                  @endforeach
                <tr class="bg-secondary text-white">
                <td colspan="2">Jumlah</td>
                <td>{{$nbm->sum('kalori')}}</td>
                <td >{{$nbm->sum('protein')}}</td>
                <td>{{$nbm->sum('lemak')}}</td>
                </tr>
                <tr class="bg-secondary text-white">
                <td colspan="2">Rata-rata AKG (WNPG)</td>
                    <td>{{$nbmtahun->kalori}}</td>
                    <td >{{$nbmtahun->protein}}</td>
                    <td>{{$nbmtahun->lemak}}</td>
                </tr>
                <tr class="bg-secondary text-white">
                <td colspan="2">Persentase Ketersediaan AKG %</td>
                <td>{{round($nbm->sum('kalori') / ($nbmtahun->kalori) * 100,2)}}</td>
                <td>{{round($nbm->sum('protein') /($nbmtahun->protein) * 100,2)}}</td>
                <td>{{round($nbm->sum('protein') /($nbmtahun->lemak) * 100,2)}}</td>
                </tr>
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
Highcharts.chart('container1', {
    chart: {
        type: 'bar',
	height: 320+80
    },
    title: {
        text: 'SITUASI KETERSEDIAAN PANGAN DAN GIZI BERDASARKAN NERACA BAHAN MAKANAN',
        align: 'left'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    xAxis: {
        categories: {!!json_encode($kategori)!!},

        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Ketersediaan Harian',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'KALORI kkal/hari',
        data: {!!json_encode($totalkalori)!!}
    }, {
        name: 'PROTEIN gram/hari',
        data: {!!json_encode($totalprotein)!!}
    }, {
        name: 'LEMAK gram/hari',
        data: {!!json_encode($totallemak)!!}
    }]
});



</script>

@endsection