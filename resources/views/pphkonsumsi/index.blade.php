@extends('layouts.sbadmin')
@section('header')
<link href="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('footer')
<script src="{{asset('sbadmin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('sbadmin/js/demo/datatables-demo.js')}}"></script>
@endsection
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{route('pphkonsumsi.dashboard')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
  <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
</svg>
Dashboard PPH Ketersediaan dan PPH Konsumsi</a>
<div class="lg:text-right">
  <form action="{{route('pphkonsumsi.export')}}" class="d-inline" method="POST">
    @csrf
  <button type="submit" class="btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
  </svg>
Export Excel</button>
  </form>
<a href="{{route('pphkonsumsi.create')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
 Tambah Data</a>
</div>
</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <form action="{{route('pphkonsumsi.index')}}">
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
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <h6 class="m-0 font-weight-bold text-secondary">Data SKOR PPH Konsumsi</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
      <div class="card-body">

    @if(session('status'))
      <div class="alert alert-success">
        {{session('status')}}
      </div>
    @endif 
  
    @if(session('Status'))
      <div class="alert alert-danger">
      {{session('Status')}}
    </div>
    @endif

	
    <div class="table-responsive">
<table class="table table-striped" id="dataTable">
    <thead>
      <tr>
        <th scope="col">No</th>
                            <th scope="col">Kelompok Bahan Pangan</th>
                            <th scope="col">KKAL/Kapita</th>
                            <th scope="col">%</th>
                            <th scope="col">% AKE</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Skor Aktual</th>
                            <th scope="col">Skor Ake</th>
                            <th scope="col">Skor PPH</th>
                            <th scope="col">Skor Maks</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pphkonsumsi as $u)
      <tr>
            <td>{{$loop->iteration}}</td>
            <td><a href="{{route('pphkonsumsi.show',[$u->id])}}">{{$u->bahanpanganid->bahanpangan}}</a></td>
            <td>{{$u->kkal}}</td>
            <td>{{$u->persen}}</td>
            <td>{{$u->ake}}</td>
            <td>{{$u->bobot}}</td>
            <td>{{$u->skoraktual}}</td>
            <td>{{$u->skorake}}</td>
            <td class="bg-warning text-white">{{$u->skorpph}}</td>
            <td>{{$u->skormaks}}</td>              
      </tr>
      @endforeach
    </tbody>
  </table>
    </div>
</div>
</div>
</div>
@endsection