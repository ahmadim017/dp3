@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Detail Prognosa Pangan</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="200">Komoditas</th>
      <td colspan="3"><strong>{{$prognosa->komoditasid->komoditas}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">Stok Awal</th>
  <td colspan="3"><strong>{{$prognosa->stockawal}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">Perkiraan Produksi</th>
<td><strong>{{$prognosa->produksi}}</strong></td>
</tr>
 <tr>
    <th class="bg-light">Barang Masuk</th>
<td><strong>{{$prognosa->barangmasuk}}</strong></td>
</tr>
  <tr>
      <th class="bg-light">Total Ketersediaan</th>
  <td><strong>{{$prognosa->totalketersediaan}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">Kebutuhan Tahunan</th>
  <td><strong>{{$prognosa->kebutuhantahunan}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">Kebutuhan Bulanan</th>
<td><strong>{{$prognosa->kebutuhanbulanan}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Neraca</th>
<td><strong>{{$prognosa->neraca}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Rencana Impor</th>
<td><strong>{{$prognosa->rencanaimpor}}</strong></td>
</tr>
<tr>
  <th class="bg-light">Stok Akhir</th>
<td><strong>{{$prognosa->stockakhir}}</strong></td>
</tr>
  <tr>
      <th class="bg-light">Tahun</th>
  <td><strong>{{$prognosa->tahun}}</strong></td>
  </tr>
</table>
</div>

<a href="{{route('prognosa.edit',[$prognosa->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a> 
              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('prognosa.destroy',[$prognosa->id])}}" class="d-inline" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
              </svg></button>
              </form>
<a href="{{route('prognosa.index')}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
</svg></a>
        </div>
      </div>
  

  </div>
</div>
@endsection