@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Detail SKOR PPH Konsumsi</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="200">Kelompok Bahan Pangan</th>
      <td colspan="3"><strong>{{$pphkonsumsi->bahanpanganid->bahanpangan}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">KKAL/Kapita</th>
<td colspan="3"><strong>{{$pphkonsumsi->kkal}}</strong></td>
</tr>
<tr>
  <th class="bg-light">%</th>
<td colspan="3"><strong>{{$pphkonsumsi->persen}}</strong></td>
</tr>
<tr>
  <th class="bg-light">% Ake</th>
<td colspan="3"><strong>{{$pphkonsumsi->ake}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Bobot</th>
<td colspan="3"><strong>{{$pphkonsumsi->bobot}}</strong></td>
</tr>
  <tr>
      <th class="bg-light">Skor Aktual</th>
  <td colspan="3"><strong>{{$pphkonsumsi->skoraktual}}</strong></td>
  </tr>
 <tr>
      <th class="bg-light">Skor Ake</th>
  <td colspan="3"><strong>{{$pphkonsumsi->skorake}}</strong></td>
  </tr>

<tr>
      <th class="bg-light">Skor PPH</th>
  <td colspan="3"><strong>{{$pphkonsumsi->skorpph}}</strong></td>
  </tr>

  <tr>
    <th class="bg-light">Skor Maks</th>
<td><strong>{{$pphkonsumsi->skormaks}}</strong></td>
</tr>
  <tr>
    <th class="bg-light">Tahun</th>
<td><strong>{{$pphkonsumsi->tahun}}</strong></td>
</tr>
</table>
</div>

<a href="{{route('pphkonsumsi.edit',[$pphkonsumsi->id])}}" class="btn btn-primary btn-sm">Edit</a> 
              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('pphkonsumsi.destroy',[$pphkonsumsi->id])}}" class="d-inline" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
<a href="{{route('pphkonsumsi.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </div>
      </div>
  

  </div>
</div>
@endsection