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
    <a href="{{route('mapkeamananpangan.index')}}" class="my-1 btn btn-primary btn-sm shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
  <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
</svg> Dashboard Keamanan Pangan</a>
    <a href="{{ route('keamananpanganmasyarakat.create') }}" class="my-1 btn btn-primary btn-sm shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg> Tambah Data</a>

</div>

                <div class="card shadow mb-4">
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-secondary">Sosialisasi Keamanan Pangan Kepada Masyarakat</h6>
                      </a>
                      <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kegiatan</th>
				    <th>Tanggal Pelaksanaan</th>
                                    <th>Target Jumlah Peserta (orang)</th>
                                    <th>Alamat</th>
                                </tr>
                            <tbody>
				@foreach ($keamananpanganmasyarakat as $u)
      				<tr>
            			<td>{{$loop->iteration}}</td>
            			<td><a href="{{route('keamananpanganmasyarakat.show',[$u->id])}}">{{$u->name}}</a></td>
	                        <td>{{$u->tglpelaksanaan}}</td>
            			<td>{{$u->jumlah}}</td>
            			<td>{{$u->alamat}}</td>
      				</tr>
      				@endforeach
			    </tbody>
                            </thead>
                        </table>
                                            </div>
                    </div>
                </div>
                </div>
@endsection

