@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Detail Neraca Pangan</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="250">Komoditas</th>
      <td colspan="3"><strong>{{$neracapangan->komoditasid->komoditas}}</strong></td>
  </tr>
  
  <tr>
    <th class="bg-light">Pengadaan Minggu Berjalan </th>
<td><strong>{{$neracapangan->pengadaan}} Ton</strong></td>
</tr>
<tr>
    <th class="bg-light">Barang Masuk</th>
<td><strong>{{$neracapangan->barangmasuk}} Ton</strong></td>
</tr>

  <tr>
      <th class="bg-light">Ketersediaan (Stock Awal)</th>
  <td><strong>{{$neracapangan->ketersediaanawal}} Ton</strong></td>
  </tr>
  <tr>
    <th class="bg-light">Konsumsi (kg/kapita/tahun)</th>
<td><strong>{{$neracapangan->konsumsihari}} Ton</strong></td>
</tr>
<tr>
  <th class="bg-light">Konsumsi Per Minggu</th>
<td><strong>{{$neracapangan->konsumsiminggu}} Ton</strong></td>
</tr>
  <tr>
      <th class="bg-light">Harga (Rp/Kg)</th>
  <td><strong>Rp.{{number_format($neracapangan->harga)}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">ketersediaan Akhir (Stok Akhir)</th>
  <td><strong>{{$neracapangan->ketersediaanakhir}} Ton</strong></td>
  </tr>
  <tr>
      <th class="bg-light">Periode</th>
  <td><strong>{{$neracapangan->minggu}}, {{$neracapangan->bulanid->bulan}} {{$neracapangan->tahun}}</strong></td>
  </tr>

</table>
</div>

<a href="{{route('neracapangan.edit',[$neracapangan->id])}}" class="btn btn-primary btn-sm">Edit</a> 
              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('neracapangan.destroy',[$neracapangan->id])}}" class="d-inline" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
<a href="{{route('neracapangan.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </div>
      </div>
  

  </div>
</div>
@endsection