@extends('layouts.sbadmin')


@section('content')
<div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Edit User</h6>
      </div>
      
      <div class="card-body">
    
      @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
        @endif 
    
      <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('user.update',[$user->id])}}" method="POST">
    
          @csrf
          @method('PUT')
         
        <label for="name">Name</label>
      <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{$user->name}}" placeholder="Full Name" type="text" name="name" id="name"/>
        <div class="invalid-feedbeck">
        {{$errors->first('name')}}</div>  
        <br>
       
          <label for="email">Email</label>
          <input class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" value="{{$user->email}}" placeholder="user@mail.com" type="text" name="email" id="email" disabled/>
          <div class="invalid-feedbeck">
            {{$errors->first('email')}}
          </div><br>

          <label for="">Role User</label>
                <select name="role" class="form-control {{$errors->first('role') ? "is-invalid" : ""}}">
                    <option @if($user->role == "admin") selected @endif value="admin">ADMIN</option>
                    <option @if($user->role == "user") selected @endif value="user">USER</option>
                    <option @if($user->role == "operator") selected @endif value="operator">OPERATOR</option>
                </select>
                <div class="invalid-feedbeck">
                  {{$errors->first('role')}}
                </div>
          <br>
          @if ($user->role == 'operator')
          <label for="">Kelurahan</label>
          <select name="id_kelurahan" class="form-control {{$errors->first('id_kelurahan') ? "is-invalid" : ""}}">
           <option value=""></option>
            @foreach ($kelurahan as $item)
            <option @if($user->id_kelurahan == $item->id) selected @endif value="{{$item->id}}">{{$item->kelurahan}}</option>
            @endforeach
          </select>
          <div class="invalid-feedbeck">
            {{$errors->first('id_kelurahan')}}
          </div>
    <br>
          @endif
          
          <label for="status">Status</label>
          <select name="status" class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
            <option @if($user->status == "ACTIVE") selected @endif value="ACTIVE">ACTIVE</option>
            <option @if($user->status == "INACTIVE") selected @endif value="INACTIVE">INACTIVE</option>
          </select>
          <div class="invalid-feedbeck">
            {{$errors->first('status')}}
          </div>
          <br>
          @if ($user->role !== 'operator')
          <label for="">Menu</label>
         
            <div class="row"> 
              <div class="col-12">
               
        <table  class="table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Nama Menu</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($menu as $u)
                  <tr>
                  <td><input type="checkbox"  @if($usermenu->where('id_user', $user->id)->pluck('id_menu')->contains($u->id)) checked @endif
           class="checkbox" name="id_menu[]" value="{{$u->id}}"/></td>
                  <td>{{$u->name}}</td>
                  </tr>
              @endforeach
          </tbody>
          </table>
            </div>
            </div>
            @endif
          <button class="btn btn-primary btn-sm" type="submit" value="Save"><i class="fa fa-save fa-sm"></i> Simpan</button> 
          <a href="{{route('user.index')}}" class="btn btn-dark btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </form><br>
       
      </div>
      </div>
    </div>
@endsection