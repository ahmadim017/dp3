@extends('layouts.sbadmin')


@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Prognosa Pangan</h1>
    <a href="{{route('prognosa.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
Prognosa Pangan</a>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <form action="{{route('prognosa.dashboard')}}">
    <div class="d-flex justify-content-between">
    <div class="text-left">
        <select name="bulan" class="form-control" >
        <option value="">-semua data-</option>
        @foreach ($ba as $b)
              <option @if($b->id == $bulan) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
        @endforeach
        </select>
    </div>
    
    <div class="ml-2 text-left">
        <select name="tahun" class="form-control" >
        <option value="">-semua-</option>
        @foreach ($ta as $t)
        <option @if($t->tahun == $tahun) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
        @endforeach
        </select>
    </div>
    
      <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg></button>
    </div>
    </form>
    </div><br>

<div class="row">
    <div class="col-xl-12">
         <div class="card shadow mb-4">
           <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-secondary">Prognosa Pangan</h6>
           </div>
            
             <div class="card-body ">
                 <div id="container5"></div>
             </div>
   
         </div>
       </div>
 
   </div>

   <div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-secondary">Tabel Prognosa Pangan</h6>
            </div>

            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
    <thead class="bg-primary text-white">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Komoditas</th>
        <th scope="col">Stok Awal (Ton.)</th>
        <th scope="col">Perkiraan Produksi (Ton.)</th>
	<th scope="col">Barang Masuk (Ton.)</th>
	    <th scope="col">Total Ketersediaan (Ton.)</th>
        <th scope="col">Kebutuhan (Tahunan)(Ton.)</th>
	    <th scope="col">Kebutuhan (Bulanan)(Ton.)</th>
        <th scope="col">Neraca (Ton.)</th>
        <th scope="col">Rencana Impor (Ton.)</th>
        <th scope="col">Stock Akhir (Ton.)</th>
        <th scope="col">Bulan</th>
        <th scope="col">Tahun</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($prognosa as $u)
      <tr>
      <td>{{$loop->iteration}}</td>
      <td><a href="{{route('prognosa.show',[$u->id])}}">{{$u->komoditasid->komoditas}}</a></td>
      <td>{{$u->stockawal}}</td>
      <td>{{$u->produksi}}</td>
      <td>{{$u->barangmasuk}}</td>
	    <td>{{$u->totalketersediaan}}</td>
 	    <td>{{$u->kebutuhantahunan}}</td>
	    <td>{{$u->kebutuhanbulanan}}</td>
	    @if($u->neraca < 0)
	    <td class="bg-danger text-white">{{$u->neraca}}</td>
	    @else
	    <td class="bg-success text-white">{{$u->neraca}}</td>
	    @endif 
	     @if($u->rencanaimpor < 0)
	    <td class="bg-danger text-white">{{$u->rencanaimpor}}</td>
	    @else
	    <td class="bg-success text-white">{{$u->rencanaimpor}}</td>
	    @endif             
      	    @if($u->stockakhir < 0)
	    <td class="bg-danger text-white">{{$u->stockakhir}}</td>
	    @else
	    <td class="bg-success text-white">{{$u->stockakhir}}</td>
	    @endif 
        <td>{{$u->bulanid->bulan}}</td>
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
<script src="https://code.highcharts.com/modules/accessibility.js"></script><script type="text/javascript"> 
              
Highcharts.chart('container5', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Prognosa Pangan Jumlah dalam (Ton)'
    },
    xAxis: {
        categories:{!!json_encode($komo)!!},
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        column: {
            borderRadius: '25%'
        }
    },
    series: [{
 	name: 'Ketersediaan',
        data: {!!json_encode($totalketersediaan)!!}
    }, {
        name: 'Kebutuhan',
        data: {!!json_encode($kebutuhantahunan)!!}
    }, {
        name: 'Neraca',
        data: {!!json_encode($neraca)!!}
    }, {
        name: 'Stok Akhir',
        data: {!!json_encode($stockakhir)!!}
    }]
});

</script>

@endsection