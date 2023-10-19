@extends('layouts.sbadmin')


@section('content')
<div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Edit Data Komoditas</h6>
      </div>
      
      <div class="card-body">
    
      @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif 
    
      <form enctype="multipart/form-data"  class="bg-white shadow-sm p-3" action="{{route('datakomoditas.update',[$datakomoditas->id])}}" method="POST">
          @csrf
          @method('PUT')
        <label for="name">Nama Komoditas</label>
      <input class="form-control {{$errors->first('komoditas') ? "is-invalid" : ""}}" value="{{$datakomoditas->komoditas}}" placeholder="komoditas" type="text" name="komoditas" />
        <div class="invalid-feedbeck">
        {{$errors->first('komoditas')}}</div>  
        <br>
        <label for="name">Image</label>
      <input class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" type="file" name="image" />
        <div class="invalid-feedbeck">
        {{$errors->first('image')}}</div>  
        <br>
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button>
        <a href="{{route('datakomoditas.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form>
      </div>
      </div>
    </div>
@endsection