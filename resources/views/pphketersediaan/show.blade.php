@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Detail SKOR PPH Ketersediaan</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="200">Kelompok Bahan Pangan</th>
      <td colspan="3"><strong>{{$pphketersediaan->bahanpanganid->bahanpangan}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">Energi</th>
<td colspan="3"><strong>{{$pphketersediaan->energi}}</strong></td>
</tr>
<tr>
  <th class="bg-light">% AKE</th>
<td colspan="3"><strong>{{$pphketersediaan->ake}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Bobot</th>
<td colspan="3"><strong>{{$pphketersediaan->bobot}}</strong></td>
</tr>
  <tr>
      <th class="bg-light">Skor Riil</th>
  <td colspan="3"><strong>{{$pphketersediaan->skorriil}}</strong></td>
  </tr>
<tr>
      <th class="bg-light">Skor PPH</th>
  <td colspan="3"><strong>{{$pphketersediaan->skorpph}}</strong></td>
  </tr>

  <tr>
    <th class="bg-light">Skor Maks</th>
<td><strong>{{$pphketersediaan->skormaks}}</strong></td>
</tr>
  <tr>
    <th class="bg-light">Tahun</th>
<td><strong>{{$pphketersediaan->tahun}}</strong></td>
</tr>
</table>
</div>

<a href="{{route('pphketersediaan.edit',[$pphketersediaan->id])}}" class="btn btn-primary btn-sm">Edit</a> 
              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('pphketersediaan.destroy',[$pphketersediaan->id])}}" class="d-inline" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
<a href="{{route('pphketersediaan.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </div>
      </div>
  

  </div>
</div>
@endsection