@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Cadangan Pangan</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
	<form action="{{route('cadanganpangan.update',[$cadanganpangan->id])}}" method="POST" enctype="multipart/form-data">
	@csrf
  @method('PUT')
<div class="table-responsive">
<table class="table">
    <tr>
      <th class="bg-light">Stock Awal</th>
  <td colspan="3"><div class="input-group">
              		<input type="number" name="stockawal" value="{{$cadanganpangan->stockawal}}" placeholder="stock awal" class="form-control {{$errors->first('stockawal') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                			<span class="input-group-text">Kg</span>
              		</div>
			</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('stockawal')}}</div>
</td>
  </tr>
  <tr>
    <th class="bg-light">Pengadaan</th>
<td colspan="3"><div class="input-group">
              		<input type="number" name="pengadaan" value="{{$cadanganpangan->pengadaan}}" placeholder="pengadaan" class="form-control {{$errors->first('pengadaan') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">        		
			<div class="input-group-append">
                			<span class="input-group-text">Kg</span>
              		</div>
			</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('pengadaan')}}</div>
</td>
</tr>
    <tr>
      <th class="bg-light">Bulan</th>
  <td>  <div class="input-group">
	<select name="id_bulan" class="form-control {{$errors->first('id_bulan') ? "is-invalid" : ""}}" >
		@foreach($bulan as $b)
			<option @if ($cadanganpangan->id_bulan == $b->id) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
		@endforeach
	    </select>
            <div class="invalid-feedbeck"> {{$errors->first('id_bulan')}}</div>
	</div>

  </td>
  </tr>

      <tr>
      <th class="bg-light">Tahun</th>
  <td>  <div class="input-group">
	<select name="tahun" class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" >
		@foreach($tahun as $k)
			<option @if ($cadanganpangan->tahun == $k->tahun) selected @endif value="{{$k->tahun}}">{{$k->tahun}}</option>
		@endforeach
	    </select>
            <div class="invalid-feedbeck"> {{$errors->first('tahun')}}</div>
	</div>

  </td>
  </tr>
  <tr>
    <th class="bg-light">No Kontrak</th>
<td>  
    <div class="input-group">
        <input type="text" class="form-control {{$errors->first('nokontrak') ? "is-invalid" : ""}}" name="nokontrak" value="{{$cadanganpangan->nokontrak}}" placeholder="isi Nomor Kontrak">
    <div class="invalid-feedbeck"> {{$errors->first('nokontrak')}}</div>
</div>

</td>
</tr>
<tr>
  <th class="bg-light">Tanggal Kontrak</th>
<td>  
  <div class="input-group">
      <input type="date" class="form-control {{$errors->first('tglkontrak') ? "is-invalid" : ""}}" name="tglkontrak" value="{{$cadanganpangan->tglkontrak}}" placeholder="isi Tanggal Kontrak">
  <div class="invalid-feedbeck"> {{$errors->first('tglkontrak')}}</div>
</div>
<small class="text-muted">*kosongkan jika tidak merubah tanggal</small>
</td>
</tr>
<tr>
  <th class="bg-light">File Kontrak</th>
<td>  
  <div class="input-group">
      <input type="file" class="form-control {{$errors->first('filekontrak') ? "is-invalid" : ""}}" name="filekontrak" value="{{old('filekontrak')}}" placeholder="isi file kontrak">
  <div class="invalid-feedbeck"> {{$errors->first('filekontrak')}}</div>
</div>
<small class="text-muted">*kosongkan jika tidak merubah file *file max 2mb</small>
</td>
</tr>
</table>
</div>
<button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg> Simpan</button>
	<a href="{{route('cadanganpangan.index')}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
</svg> Kembali</a>
</form>

        </div>
      </div>
  

  </div>
</div>
@endsection