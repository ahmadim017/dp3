@extends('layouts.sbadmin')


@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Sosialisasi Keamanan Pangan Segar Asal Tumbuhan kepada Pelaku Usaha</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="200">Nama Usaha</th>
      <td colspan="3"><strong>{{$sosialisasi->namausaha}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">NIB</th>
  <td colspan="3"><strong>{{$sosialisasi->nib}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">Nama Pelaku Usaha</th>
<td colspan="3"><strong>{{$sosialisasi->namapelakuusaha}}</strong></td>
</tr>
<tr>
    <th class="bg-light">No Telp/HP</th>
<td colspan="3"><strong>{{$sosialisasi->nohp}}</strong></td>
</tr>
<tr>
    <th class="bg-light">Alamat</th>
<td colspan="3"><strong>{{$sosialisasi->alamat}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Kelurahan</th>
<td colspan="3"><strong>{{$sosialisasi->kelurahan}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Kecamatan</th>
<td colspan="3"><strong>{{$sosialisasi->kecamatanid->kecamatan}}</strong></td>
</tr>
<tr>
    <th class="bg-light">Nomor Registrasi/Sertifikat</th>
<td colspan="3"><strong>{{$sosialisasi->sertifikat}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Tanggal</th>
<td colspan="3"><strong>{{$sosialisasi->created_at}}</strong></td>
</tr>
  <tr>
      <th class="bg-light">File Pendukung</th>
  <td> @if($sosialisasi->file)
    <strong><a href="{{route('sosialisasipsat.download',[$sosialisasi->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
    <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
    <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
  </svg> FIle Pendukung</a></strong>
  @else
  <strong><a href="#" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
    <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
    <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
  </svg> Tidak ada FIle Pendukung</a></strong>
  @endif</td>
  </tr>
  
<tr>
  <th class="bg-light">Daftar PSAT Yang Ditangani</th>
<td><a href="{{route('jenispsat.create',[$sosialisasi->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
</svg> PSAT yang Ditangani</a></td>
</tr>

</table>
</div>

<a href="{{route('sosialisasipsat.edit',[$sosialisasi->id])}}" class="btn btn-primary btn-sm">Edit</a> 
              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('sosialisasipsat.destroy',[$sosialisasi->id])}}" class="d-inline" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
<a href="{{route('sosialisasipsat.cetak',[$sosialisasi->id])}}" target="_blank" class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
  </svg> Cetak</a>
<a href="{{route('sosialisasipsat.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </div>
      </div>
  

  </div>
</div>
@endsection

