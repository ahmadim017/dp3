@extends('layouts.sbadmin')

@section('header')
<link href="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('footer')
<script src="{{asset('sbadmin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('sbadmin/js/demo/datatables-demo.js')}}"></script>
@endsection
@section('content')
<div class="col-md-12">

  @if(session('status'))
  <div class="alert alert-success">
    {{session('status')}}
  </div>
@endif 

@if(session('Status'))
  <div class="alert alert-danger">
    {{session('Status')}}
  </div>
@endif
    <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Penerima</h6>
          </div>
      
      <div class="card-body">
    
          
              <form action="{{route('usulan.store')}}" enctype="multipart/form-data" method="POST">
              @csrf
            
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th class="bg-light">Nik</th>
                <td colspan="3"><div class="input-group">
                                  <input type="number" name="nik" value="{{old('nik')}}" placeholder="nik" class="form-control {{$errors->first('nik') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">        		
                      </div>
                         <div class="invalid-feedbeck"> {{$errors->first('nik')}}</div>
                </td>
                </tr>
                  <tr>
                      <th class="bg-light">Nama</th>
                  <td colspan="3"><div class="input-group">
                                  <input type="text" name="nama" value="{{old('nama')}}" placeholder="nama" class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                                       
                      </div>
                         <div class="invalid-feedbeck"> {{$errors->first('nama')}}</div>
                
                </td>
                  </tr>
                
                    
                  <tr>
                    <th class="bg-light">Tanggal Lahir</th>
                <td>  
                    <div class="input-group">
                        <input type="date" class="form-control {{$errors->first('tgllahir') ? "is-invalid" : ""}}" name="tgllahir" value="{{old('tgllahir')}}" required>
                    <div class="invalid-feedbeck"> {{$errors->first('tgllahir')}}</div>
                </div>
                </td>
                </tr>
                <tr>
                  <th class="bg-light">Jenis Kelamin</th>
                  <td>  
                    <div class="input-group">
                       <select name="jeniskelamin"class="form-control">
                        <option value=""></option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                       </select>
                    <div class="invalid-feedbeck"> {{$errors->first('jeniskelamin')}}</div>
                </div>
                
                </td>
                </tr>

              <tr>
                <th class="bg-light">Alamat</th>
                <td>  
                  <div class="input-group">
                      <input type="text" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}" name="alamat" value="{{old('alamat')}}" placeholder="alamat">
                  <div class="invalid-feedbeck"> {{$errors->first('alamat')}}</div>
              </div>
              </td>
              </tr>

            <tr>
              <th class="bg-light">Kelurahan</th>
              <td>  
                <div class="input-group">
                    <input type="text" class="form-control {{$errors->first('kelurahan') ? "is-invalid" : ""}}" name="kelurahan" value="{{old('kelurahan')}}" placeholder="kelurahan">
                <div class="invalid-feedbeck"> {{$errors->first('kelurahan')}}</div>
            </div>
            
            </td>
            </tr>

          <tr>
            <th class="bg-light">Kecamatan</th>
            <td>  
              <div class="input-group">
                 <select name="id_kecamatan"class="form-control">
                  <option value=""></option>
                  @foreach ($kecamatan as $k)
                  <option value="{{$k->id}}">{{$k->kecamatan}}</option>
                  @endforeach
                 </select>
              <div class="invalid-feedbeck"> {{$errors->first('id_kecamatan')}}</div>
          </div>
          </td>
          </tr>

        <tr>
          <th class="bg-light">File Pendukung</th>
          <td>  
            <div class="input-group">
              <input type="file" name="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
              <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Upload</button>
            </div>
          </td>
          </tr>
                 </table>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg> Simpan</button>
                  
                </form>
              </div>
        </div>


    
<div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Usulan Kelurahan</h6>
      </div>

      
<div class="collapse show" id="collapseCardExample">
  <div class="card-body">
<div class="table-responsive">    
  <table class="table table-striped" id="dataTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nik</th>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Alamat</th>
	  <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
            <tbody>
                @foreach ($usulan as $f)
              <tr>
                    <td>{{$loop->iteration}}</td>    
                    <td>{{$f->nik}}</td>
                    <td>{{$f->nama}}</td>
                    <td>{{$f->tgllahir}}</td>
                    <td>{{$f->alamat}}</td>
		    <td>@if($f->status == 'diterima')
			<span class="badge badge-success">{{$f->status}}</span>
			@elseif($f->status == 'ditolak')
			<span class="badge badge-danger">{{$f->status}}</span>
			@else
			<span class="badge badge-warning">{{$f->status}}</span>
			@endif
		    </td>
                                      <td>
		    @if ($f->status == 'diterima')
		     <button type="submit" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-lock" viewBox="0 0 16 16">
  <path d="M8 5a1 1 0 0 1 1 1v1H7V6a1 1 0 0 1 1-1zm2 2.076V6a2 2 0 1 0-4 0v1.076c-.54.166-1 .597-1 1.224v2.4c0 .816.781 1.3 1.5 1.3h3c.719 0 1.5-.484 1.5-1.3V8.3c0-.627-.46-1.058-1-1.224zM6.105 8.125A.637.637 0 0 1 6.5 8h3a.64.64 0 0 1 .395.125c.085.068.105.133.105.175v2.4c0 .042-.02.107-.105.175A.637.637 0 0 1 9.5 11h-3a.637.637 0 0 1-.395-.125C6.02 10.807 6 10.742 6 10.7V8.3c0-.042.02-.107.105-.175z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg></button>
		    
		    @else
                    <a href="{{route('usulan.edit',[$f->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg></a>  
                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')"  action="{{route('usulan.destroy',[$f->id])}}" class="d-inline" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg></button>
                    </form>
		    @endif	
		</td>
              </tr>
              @endforeach
            </tbody>
    </table>
  </div>
 
  </div>
</div>
</div>
</div>


  
@endsection
