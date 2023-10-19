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
    <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Tambah Sampel</h6>
          </div>
      
      <div class="card-body">
    
          
              <form action="{{route('jenissampel.store')}}" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" value="{{$keamananpangan->id}}" name="id_keamananpangan">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th class="bg-light" width="300">Jenis Sampel yang Di Uji</th>
                <td colspan="3"><div class="input-group">
                                  <input type="text" name="jenissampel" value="{{old('jenissampel')}}" placeholder="jenis sampel" class="form-control {{$errors->first('jenissampel') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">        		
                      </div>
                         <div class="invalid-feedbeck"> {{$errors->first('jenissampel')}}</div>
                </td>
                <tr>
                  <th class="bg-light">Hasil Uji</th>
              <td colspan="3">
                <div class="input-group col-6">
                <div class="form-check mx-2">
                  <input class="form-check-input {{$errors->first('hasiluji') ? "is-invalid" : ""}}" value="POSITIF" type="radio" name="hasiluji" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Positif
                  </label>
                </div>
                <div class="form-check mx-2">
                  <input class="form-check-input {{$errors->first('hasiluji') ? "is-invalid" : ""}}" value="NEGATIF" type="radio" name="hasiluji" id="flexRadioDefault2" checked>
                  <label class="form-check-label" for="flexRadioDefault2">
                    Negatif
                  </label>
                </div>
                    
                    </div>
                       <div class="invalid-feedbeck"> {{$errors->first('hasiluji')}}</div>
              </td>
              </tr>
                  <tr>
                    <th class="bg-light">Keterangan</th>
                <td>  
                    <div class="input-group">
                        <input type="text" class="form-control {{$errors->first('keterangan') ? "is-invalid" : ""}}" name="keterangan" value="{{old('keterangan')}}" placeholder="keterangan">
                    <div class="invalid-feedbeck"> {{$errors->first('keterangan')}}</div>
                </div>
                
                </td>
                </table>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg> Simpan</button>
                  <a href="{{route('keamananpangan.show',[$keamananpangan->id])}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                </svg> Kembali</a>
                </form>
              </div>
        </div>


        
<div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Sampel Yang Diuji</h6>
      </div>

      
<div class="collapse show" id="collapseCardExample">
  <div class="card-body">
<div class="table-responsive">    
  <table class="table table-striped" id="dataTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Jenis Sampel</th>
          <th scope="col">Hasil Uji</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
            <tbody>
                @foreach ($jenissampel as $f)
              <tr>
                    <td>{{$loop->iteration}}</td>    
                    <td>{{$f->jenissampel}}</td>
                    <td>{{$f->hasiluji}}</td>
                    <td>{{$f->keterangan}}</td>
                    <td>
                    <a href="{{route('jenissampel.edit',[$f->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg></a>  
                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')"  action="{{route('jenissampel.destroy',[$f->id])}}" class="d-inline" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg></button>
                    </form></td>
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
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <input type="file" name="file" class="form-control bg-light border-0 small"aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-secondary" type="button">
                 Upload
                </button>
              </div>
        </form>
    </div>
    </div>
  </div>
</div>
  
@endsection