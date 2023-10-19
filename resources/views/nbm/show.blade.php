@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Detail Neraca Bahan Makanan</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="200">Jenis Bahan Pangan</th>
      <td colspan="3"><strong>{{$nbm->bahanpanganid->bahanpangan}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">Kategori</th>
  <td colspan="3"><strong>{{$nbm->kategoriid->kategori}}</strong></td>
  </tr>
  <tr>
    <th class="bg-light">Kalori</th>
<td><strong>{{$nbm->kalori}}</strong></td>
</tr>
  <tr>
      <th class="bg-light">Protein</th>
  <td><strong>{{$nbm->protein}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">Lemak</th>
  <td><strong>{{$nbm->lemak}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">Tahun</th>
  <td><strong>{{$nbm->tahun}}</strong></td>
  </tr>
</table>
</div>

<a href="{{route('nbm.edit',[$nbm->id])}}" class="btn btn-primary btn-sm">Edit</a> 
              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('nbm.destroy',[$nbm->id])}}" class="d-inline" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
<a href="{{route('nbm.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </div>
      </div>
  

  </div>
</div>
@endsection