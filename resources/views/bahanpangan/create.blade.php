@extends('layouts.sbadmin')


@section('content')
<div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Tambah Data Bahan Pangan</h6>
      </div>
      
      <div class="card-body">
    
      @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif 
    
      <form enctype="multipart/form-data"  class="bg-white shadow-sm p-3" action="{{route('bahanpangan.store')}}" method="POST">
    
          @csrf
        <label for="name">Nama Bahan Pangan</label>
      <input class="form-control {{$errors->first('bahanpangan') ? "is-invalid" : ""}}" value="{{old('bahanpangan')}}" placeholder="bahanpangan" type="text" name="bahanpangan" />
        <div class="invalid-feedbeck">
        {{$errors->first('bahanpangan')}}</div>  
        <br>
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button>
        <a href="{{route('bahanpangan.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form>
      </div>
      </div>
    </div>
@endsection