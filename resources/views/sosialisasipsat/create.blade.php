@extends('layouts.sbadmin')



@section('content')
<div class="col-md-7">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Sosialisasi Keamanan Pangan Segar Asal Tumbuhan kepada Pelaku Usaha</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
	<form action="{{route('sosialisasipsat.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
   			<div class="form-group mb-3">
			<label for="">Nama Usaha</label>
              		<input type="text" name="namausaha" value="{{old('namausaha')}}" placeholder="namausaha" class="form-control {{$errors->first('namausaha') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
			</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('namausaha')}}</div>

			<div class="form-group mb-3">
			<label for="">NIB</label>
              <input type="text" name="nib" value="{{old('nib')}}" placeholder="nib" class="form-control {{$errors->first('nib') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              <div class="invalid-feedbeck"> {{$errors->first('nib')}}</div>
 	       </div>
            <div class="form-group mb-3">
                <label for="">Np HP</label>
                  <input type="number" name="nohp" value="{{old('nohp')}}" placeholder="nohp" class="form-control {{$errors->first('nohp') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                  <div class="invalid-feedbeck"> {{$errors->first('nohp')}}</div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Nama Pelaku Usaha</label>
                      <input type="text" name="namapelakuusaha" value="{{old('namapelakuusaha')}}" placeholder="nama pelaku usaha" class="form-control {{$errors->first('namapelakuusaha') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                      <div class="invalid-feedbeck"> {{$errors->first('namapelakuusaha')}}</div>
                    </div>
            <div class="form-group mb-3">
                <label for="">Nomor Registrasi/Sertifikasi</label>
                    <input type="text" name="sertifikat" value="{{old('sertifikat')}}" placeholder="sertifikat" class="form-control {{$errors->first('sertifikat') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                    <div class="invalid-feedbeck"> {{$errors->first('sertifikat')}}</div>
            </div>
      <div class="form-group mb-3">
	<label for="">Alamat</label>
      <input type="text" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}" name="alamat" value="{{old('alamat')}}" placeholder="Alamat">
      <div class="invalid-feedbeck"> {{$errors->first('alamat')}}</div>
      </div>

      <div class="form-group mb-3">
        <label for="">Kelurahan</label>
            <input type="text" class="form-control {{$errors->first('kelurahan') ? "is-invalid" : ""}}" name="kelurahan" value="{{old('kelurahan')}}" placeholder="kelurahan">
            <div class="invalid-feedbeck"> {{$errors->first('kelurahan')}}</div>
            </div>

      <div class="form-group mb-3">
        <label for="">Kecamatan</label>
  <select name="id_kecamatan" class="form-control {{$errors->first('id_kecamatan') ? "is-invalid" : ""}}" >
  @foreach($kecamatan as $k)
    <option value="{{$k->id}}">{{$k->kecamatan}}</option>
  @endforeach
    </select>
          <div class="invalid-feedbeck"> {{$errors->first('id_kecamatan')}}</div>
  </div>

<div class="form-group mb-3">
	<label for="">File Pendukung</label>
      <input type="file" class="form-control {{$errors->first('file') ? "is-invalid" : ""}}" name="file" value="{{old('file')}}" >
  <div class="invalid-feedbeck"> {{$errors->first('file')}}</div>
</div>



<button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg> Simpan</button>
	<a href="{{route('sosialisasipsat.index')}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
</svg> Kembali</a>
</form>

        </div>
      </div>
  

  </div>
</div>

@endsection

