@extends('layouts.sbadmin')


@section('content')
<div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Edit Data</h6>
      </div>
      
      <div class="card-body">
    
      @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif 
    
      <form enctype="multipart/form-data"  class="bg-white shadow-sm p-3" action="{{route('tahun.update',[$tahun->id])}}" method="POST">
          @csrf
          @method('PUT')
          <label for="name">Tahun</label>
          <input class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" value="{{$tahun->tahun}}" placeholder="tahun" type="text" name="tahun" />
            <div class="invalid-feedbeck">
            {{$errors->first('tahun')}}</div>  
            <br>
            <label for="name">Jumlah Penduduk</label>
          <input class="form-control {{$errors->first('jmlpenduduk') ? "is-invalid" : ""}}" value="{{$tahun->jmlpenduduk}}" placeholder="jmlpenduduk" type="text" name="jmlpenduduk" />
            <div class="invalid-feedbeck">
            {{$errors->first('jmlpenduduk')}}</div>  
            <br>
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button>
        <a href="{{route('tahun.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form>
      </div>
      </div>
    </div>
@endsection