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
    <a href="{{route('skpg.dashboard')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
  <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
</svg>
Dashboard Sistem Kewaspadaan Gizi dan Pangan</a>
<div class="lg:text-right">
  <form action="{{route('skpg.export')}}" class="d-inline" method="POST">
    @csrf
  <button type="submit" class="btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
  </svg>
Export Excel</button>
  </form>
<a href="{{route('skpg.create')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
 Tambah Data</a>
</div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <h6 class="m-0 font-weight-bold text-secondary">Sistem Kewaspadaan Pangan dan Gizi</h6>
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

<div class="row">
<form action="{{route('skpg.index')}}">
<div class="d-flex justify-content-between">
<div class="mx-2 text-right">
	<select name="kecamatan" class="form-control {{$errors->first('kecamatan') ? "is-invalid" : ""}}" >
		<option value="">-semua data-</option>
	        @foreach ($kec as $k)
		        <option @if($k->id == $kecamatan) selected @endif value="{{$k->id }}">{{$k->kecamatan}}</option>
		      @endforeach
	</select>
</div>

<div class="text-left">
    <select name="bulan" class="form-control  w-auto" >
		<option value="">-semua data-</option>
		@foreach ($ba as $b)
		      <option @if($b->id == $bulan) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
		@endforeach
		</select>
</div>

<div class="ml-2 text-left">
    <select name="tahun" class="form-control {{$errors->first('minggu') ? "is-invalid" : ""}}" >
		<option value="">-semua-</option>
		@foreach ($ta as $t)
		<option @if($t->tahun == $tahun) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
		@endforeach
    </select>
</div>

  <button type="submit" class="btn btn-light btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
  </svg></button>
</div>
</form>
</div><br>
	
    <div class="table-responsive">
<table class="table table-striped" id="dataTable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">Indeks Ketersediaan</th>
        <th scope="col">Indeks Akses</th>
	      <th scope="col">Indeks Pemanfaatan</th>
        <th scope="col">Skor Komposit</th>
	      <th scope="col">Keterangan</th>
        <th scope="col">Indek Komposit</th>
	      <th scope="col">bulan</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($skpg as $u)
      <tr>
            <td>{{$loop->iteration}}</td>
            <td><a href="{{route('skpg.show',[$u->id])}}">{{$u->kecamatanid->kecamatan}}</a></td>
	          <td>{{$u->ketersediaan}}</td>
            <td>{{$u->akses}}</td>
	          <td>{{$u->pemanfaatan}}</td>
 	          <td>{{$u->skorkomposit}}</td>
	           <td>@if ($u->skorkomposit >= 1 && $u->skorkomposit <= 5)
              <span class="badge badge-danger">Rawan</span>
          @elseif ($u->skorkomposit >= 6 && $u->skorkomposit <= 7)
              <span class="badge badge-warning">Waspada</span>
          @elseif ($u->skorkomposit >= 8)
               <span class="badge badge-success">Aman</span>
          @else
          <span class="badge badge-secondary">Tidak Ada Data</span>
          @endif
      </td> 
      <td>@if ($u->skorkomposit >= 1 && $u->skorkomposit <= 4)
              <span class="badge badge-danger">1</span>
          @elseif ($u->skorkomposit >= 5 && $u->skorkomposit <= 7)
              <span class="badge badge-warning">2</span>
          @elseif ($u->skorkomposit >= 8)
               <span class="badge badge-success">3</span>
          @else
          <span class="badge badge-secondary">0</span>
          @endif
      </td> 
 
	          <td>{{$u->bulanid->bulan}}</td>
            
      </tr>
      @endforeach
    </tbody>
  </table>
    </div>
</div>
</div>
</div>
@endsection