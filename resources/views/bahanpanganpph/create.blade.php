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
    
      <form class="bg-white shadow-sm p-3" action="{{route('bahanpanganpph.store')}}" method="POST">
          @csrf
        <label for="name">Nama Bahan Pangan</label>
      <input class="form-control {{$errors->first('bahanpangan') ? "is-invalid" : ""}}" value="{{old('bahanpangan')}}" placeholder="bahanpangan" type="text" name="bahanpangan" />
        <div class="invalid-feedbeck">
        {{$errors->first('bahanpangan')}}</div>  
        <br>
        <label for="name">Bobot</label>
        <input class="form-control {{$errors->first('bobot') ? "is-invalid" : ""}}" value="{{old('bobot')}}" placeholder="bobot" type="text" name="bobot" />
          <div class="invalid-feedbeck">
          {{$errors->first('bobot')}}</div>  
          <br>
          <label for="name">Skor Maks</label>
          <input class="form-control {{$errors->first('skormaks') ? "is-invalid" : ""}}" value="{{old('skormaks')}}" placeholder="skormaks" type="text" name="skormaks" />
            <div class="invalid-feedbeck">
            {{$errors->first('skormaks')}}</div>  
            <br>
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button>
        <a href="{{route('bahanpangan.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form>
      </div>
      </div>
    </div>
@endsection