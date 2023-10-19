@extends('layouts.sbadmin')


@section('content')
<div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Edit Data menu</h6>
      </div>
      
      <div class="card-body">
    
      @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif 
    
      <form enctype="multipart/form-data"  class="bg-white shadow-sm p-3" action="{{route('menu.update',[$menu->id])}}" method="POST">
          @csrf
          @method('PUT')
          <label for="name">Nama Menu</label>
          <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{$menu->name}}" placeholder="nama menu" type="text" name="name" />
            <div class="invalid-feedbeck">
            {{$errors->first('name')}}</div>  
            <br>
            <label for="name">Route / Link</label>
            <input class="form-control {{$errors->first('route') ? "is-invalid" : ""}}" value="{{$menu->route}}" placeholder="route" type="text" name="route" />
              <div class="invalid-feedbeck">
              {{$errors->first('route')}}</div>  
              <br>
            <label for="name">Image</label>
            <input class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" type="file" name="image" />
              <div class="invalid-feedbeck">
              {{$errors->first('image')}}</div>  
              <br>
	    <label for="name">Status</label>
            <select class="form-control {{$errors->first('status') ? "is-invalid" : ""}}" name="status" />
			<option @if($menu->status == 'ACTIVE')selected @endif value="ACTIVE">ACTIVE</option>
			<option @if($menu->status == 'INACTIVE')selected @endif value="INACTIVE">INACTIVE</option>
	     </select>
              <div class="invalid-feedbeck">
              {{$errors->first('status')}}</div>  
              <br>
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button>
        <a href="{{route('menu.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form>
      </div>
      </div>
    </div>
@endsection