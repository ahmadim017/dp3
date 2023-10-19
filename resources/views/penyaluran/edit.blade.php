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
    <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Penerima</h6>
          </div>
      
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
              <form action="{{route('penyaluran.update',[$penyaluran->id])}}" enctype="multipart/form-data" method="POST">
              @csrf
              @method('PUT')
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th class="bg-light">Jumlah Yang di terima</th>
                <td>  
                    <div class="input-group">
                        <input type="text" class="form-control {{$errors->first('jumlah') ? "is-invalid" : ""}}" name="jumlah" value="{{$penyaluran->jumlah}}" placeholder="jumlah">
                    <div class="invalid-feedbeck"> {{$errors->first('jumlah')}}</div>
                </div>
                
                </td>
                </tr>
                 </table>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg> Simpan</button>
                  <a href="{{route('cadanganpangan.show',[$penyaluran->id_cadanganpangan])}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                </svg> Kembali</a>
                </form>
              </div>
        </div>



</div>

  
@endsection