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
<div class="col-md-12">

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
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <a href="{{route('cadanganpangan.show',[$cadanganpangan->id])}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                </svg> Kembali</a></div>

        
<div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Penerima Penyaluran Cadangan Pangan</h6>
      </div>

     

<div class="collapse show" id="collapseCardExample">
  <div class="card-body">
<div class="table-responsive">    
  <table class="table table-striped" id="dataTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nik</th>
          <th scope="col">Nama</th>
          <th scope="col">Komoditas</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
            <tbody>
                @foreach ($penyaluran as $f)
              <tr>
                    <td>{{$loop->iteration}}</td>    
                    <td>{{$f->usulan->nik}}</td>
                    <td>{{$f->usulan->nama}}</td>
                    <td>{{$f->komoditasid->komoditas}}</td>
                    <td>{{$f->jumlah}}</td>
                                      <td>
                    <a href="{{route('penyaluran.edit',[$f->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg></a>  
                   </td>
              </tr>
              @endforeach
            </tbody>
    </table>
  </div>
 
  </div>
</div>
</div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    	</div>
    <div class="modal-body">
        <form action="{{route('penyaluran.import',[$cadanganpangan->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <input type="file" name="file" class="form-control bg-light border-0 small {{$errors->first('file') ? "is-invalid" : ""}}"aria-describedby="basic-addon2" required>
              <div class="invalid-feedbeck"> {{$errors->first('file')}}</div>
              <div class="input-group-append">
                <button class="btn btn-secondary" type="submit" >
                 Upload
                </button>
              </div>
	    </div>
        </form>
    </div>
    <div class="modal-footer">
        <h5 class="modal-title">Download Format CSV/Excel</h5>
        <a class="btn btn-primary btn-sm" href="#" target="_blank"><i class="fa-solid fa-download fa-sm"></i> Download</a>      
    </div>
    </div>
  </div>
</div>

  
@endsection
