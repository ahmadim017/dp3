@extends('layouts.sbadmin')


@section('content')
<div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Edit Data kecamatan</h6>
      </div>
      
      <div class="card-body">
    
      @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif 
    
      <form enctype="multipart/form-data"  class="bg-white shadow-sm p-3" action="{{route('kecamatan.update',[$kecamatan->id])}}" method="POST">
    
          @csrf
          @method('PUT')
        <label for="name">Nama kecamatan</label>
      <input class="form-control {{$errors->first('kecamatan') ? "is-invalid" : ""}}" value="{{$kecamatan->kecamatan}}" placeholder="kecamatan" type="text" name="kecamatan" />
        <div class="invalid-feedbeck">
        {{$errors->first('kecamatan')}}</div>  
        <br>
        <label for="name">File GeoJSON</label>
      <input class="form-control {{$errors->first('kecamatan') ? "is-invalid" : ""}}" placeholder="filegeojson" type="file" name="filegeojson" />
      <small class="text-muted">*kosongkan jika tidak merubah file</small>
        <div class="invalid-feedbeck">
        {{$errors->first('filegeojson')}}</div>  
        <br>
        <label for="name">Warna</label>
        <input class="form-control {{$errors->first('kecamatan') ? "is-invalid" : ""}}" value="{{$kecamatan->color}}" placeholder="color" type="color" name="color" />
          <div class="invalid-feedbeck">
          {{$errors->first('color')}}</div>  
          <br>
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button>
        <a href="{{route('kecamatan.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form>
      </div>
      </div>
    </div>
@endsection