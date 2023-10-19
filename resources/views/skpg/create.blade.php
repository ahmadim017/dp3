@extends('layouts.sbadmin')

@section('content')

<div class="row">
  <div class="col-md-12">
     <div class="card shadow mb-4">
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Indeks Komposit Ketahanan Pangan Bulan</h6>
      </a>
        
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
	<form action="{{route('skpg.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
      <div class="row">
      <div class="col-12">
   
    <div class="table-responsive">
          <table class="table"> 
         <thead> 
              <tr class="">
                  <th>#</th>
                  <th>Kecamatan</th>
                  <th>Indeks Ketersediaan</th>
                  <th>Indeks Akses</th>
                  <th>Indeks Pemanfaatan</th>
              </tr>
          </thead>
          @foreach ($kecamatan as $k)
          <tr> 
            <td>
             {{$loop->iteration}}
            </td> 
            <td>
              <div class="input-group">
                <label for="">{{$k->kecamatan}}</label>
              </div>
                <input name="skpg[{{$loop->index}}][id_kecamatan]" value="{{$k->id}}" type="hidden">
                <input name="skpg[{{$loop->index}}][id_skpgbulan]" value="{{$skpgbulan->id}}" type="hidden">
                <input name="skpg[{{$loop->index}}][id_bulan]" value="{{$skpgbulan->id_bulan}}" type="hidden">
                <input name="skpg[{{$loop->index}}][tahun]" value="{{$skpgbulan->tahun}}" type="hidden">
            </td> 
            
              <td>
                <div class="input-group">
                  <input type="number" name="skpg[{{$loop->index}}][ketersediaan]" value="{{old('ketersediaan')}}" placeholder="indeks ketersediaan" class="form-control {{$errors->first('ketersediaan') ? "is-invalid" : ""}}" aria-describedby="basic-addon2" required>
                  </div>
                    <div class="invalid-feedbeck"> {{$errors->first('ketersediaan')}}</div>  
              </td> 
                  <td>
                    <div class="input-group">
                      <input type="number" name="skpg[{{$loop->index}}][akses]" value="{{old('akses')}}" placeholder="indeks akses" class="form-control {{$errors->first('akses') ? "is-invalid" : ""}}" aria-describedby="basic-addon2" required> 
                      </div>
                        <div class="invalid-feedbeck"> {{$errors->first('akses')}}</div>  
                  </td> 
                
                    <td>
                      <div class="input-group">
                        <input type="number" name="skpg[{{$loop->index}}][pemanfaatan]" value="{{old('pemanfaatan')}}" placeholder="indeks pemanfaatan" class="form-control {{$errors->first('skpg.' . $loop->index . '.pemanfaatan') ? "is-invalid" : ""}}" aria-describedby="basic-addon2" required>
                        </div>
                          <div class="invalid-feedbeck"> {{$errors->first('pemanfaatan')}}</div>  
                    </td> 
            @endforeach
          </table>
    </div>
      </div>
      </div>
      <button type="submit" class="btn btn-primary btn-sm" value="Simpan"><i class="fa fa-save fa-sm"></i> Simpan</button>
      <a href="{{route('skpgbulan.show',[$skpgbulan->id])}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
          </form>
        </div>
      </div>
     </div>
  </div>
</div>


@endsection