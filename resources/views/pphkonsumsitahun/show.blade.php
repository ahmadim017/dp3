@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Detail</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="300">Tahun</th>
      <td ><strong>{{$pphkonsumsitahun->tahun}}</strong></td>
  </tr>
  <tr>
      <th class="bg-light">AKE (KKAL/KAP/Hari)</th>
  <td ><strong>{{$pphkonsumsitahun->ake}}</strong></td>
  </tr>
<tr>
      <th class="bg-light">AKP (Gram/KAP/Hari)</th>
  <td ><strong>{{$pphkonsumsitahun->akp}}</strong></td>
  </tr>

<tr>
    <th class="bg-light">File Pendukung Lainnya</th>
<td >
  @if($pphkonsumsitahun->filepph)
  <strong><a href="{{route('pphkonsumsitahun.download',[$pphkonsumsitahun->id])}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
  <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
  <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
</svg> Unduh File</a></strong>
@else
<strong><a href="#" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
  <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
  <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
</svg> FIle Belum di upload</a></strong>
@endif
</td>
</tr>
<tr>
  <th class="bg-light">Detail PPH Konsumsi</th>
<td>
@if($pphkecukupangizi->count() > 0)
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<p><a href="{{route('kecukupangizi.create',[$pphkonsumsitahun->id])}}" class="btn btn-light btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
</svg> Tambah Data PPH Konsumsi & Kecukupan Gizi</a></p>
@endif
@if($pphkecukupangizi->count() > 0)
<div class="mb-2 text-right">
  <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus?')" action="{{route('pphkecukupangizi.destroy',[$pphkonsumsitahun->id])}}" class="d-inline" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
</div>
@endif
</div>
  <div class="breadcrumb">
   Tabel PPH Konsumsi
</div>
  @if($pphkecukupangizi->count() > 0)
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

  <div class="table-responsive">
    <table class="table table-striped" id="dataTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kelompok Bahan Pangan</th>
            <th scope="col">KKAL/Kapita</th>
            <th scope="col">%</th>
            <th scope="col">% AKE</th>
            <th scope="col">Bobot</th>
            <th scope="col">Skor Aktual</th>
            <th scope="col">Skor Ake</th>
            <th scope="col">Skor PPH</th>
            <th scope="col">Skor Maks</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
	 @php
                        $skormaksValues = $pphkecukupangizi->pluck('bahanpanganpphid.skormaks');
                        $totalSkormaks = $skormaksValues->sum();
                        @endphp

        <tbody>
            @foreach ($pphkecukupangizi as $u)
          <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$u->bahanpanganpphid->bahanpangan}}</td>
                <td>{{$u->kkal}}</td>
                <td>{{$u->persen}}</td>
                <td>{{$u->ake}}</td>
                <td>{{$u->bahanpanganpphid->bobot}}</td>
                <td>{{$u->skoraktual}}</td>
                <td>{{$u->skorake}}</td>
                <td>{{$u->skorpph}}</td>
                <td>{{$u->bahanpanganpphid->skormaks}}</td>
                <td> 
                  
                </td>             
          </tr>
	  

          @endforeach
	  <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{$pphkecukupangizi->sum('kkal')}}</td>
                        <td>{{$pphkecukupangizi->sum('persen')}}</td>
                        <td>{{$pphkecukupangizi->sum('ake')}}</td>
                        <td></td>
                        <td>{{$pphkecukupangizi->sum('skoraktual')}}</td>
                        <td>{{$pphkecukupangizi->sum('skorake')}}</td>
                        <td>{{$pphkecukupangizi->sum('skorpph')}}</td>
                        <td>{{$totalSkormaks}}</td>
                        </tr>
        </tbody>
      </table>
        </div>
  
  @endif
</td>
</tr>
<tr>
  <th class="bg-light">Detail Kecukupan Gizi</th>
<td>
  <div class="breadcrumb">
   Tabel Kecukupan Gizi
</div>
  @if($pphkecukupangizi->count() > 0)
   <div class="table-responsive">
    <table class="table table-striped" id="dataTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kelompok Bahan Pangan</th>
            <th scope="col">KKAL/Kapita</th>
            <th scope="col">%</th>
            <th scope="col">% AKE</th>
            <th scope="col">Gram/Kapita</th>
            <th scope="col">%</th>
            <th scope="col">% AKP</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($pphkecukupangizi as $u)
          <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$u->bahanpanganpphid->bahanpangan}}</td>
                <td>{{$u->kkal}}</td>
                <td>{{$u->persen}}</td>
                <td>{{$u->ake}}</td>
                <td>{{$u->gram}}</td>
                <td>{{$u->persenprotein}}</td>
                <td>{{$u->akp}}</td>
                            
          </tr>
          @endforeach
	  <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{$pphkecukupangizi->sum('kkal')}}</td>
                        <td>{{$pphkecukupangizi->sum('persen')}}</td>
                        <td>{{$pphkecukupangizi->sum('ake')}}</td>
                        <td>{{$pphkecukupangizi->sum('gram')}}</td>
                        <td>{{$pphkecukupangizi->sum('persenprotein')}}</td>
                        <td>{{$pphkecukupangizi->sum('akp')}}</td>
                        </tr>

        </tbody>
      </table>
        </div>
  
@endif
</td>
</tr>
</table>
</div>

<a href="{{route('pphkonsumsitahun.edit',[$pphkonsumsitahun->id])}}" class="btn btn-primary btn-sm">Edit</a> 
<form action="{{route('pphkonsumsitahun.destroy',[$pphkonsumsitahun->id])}}" class="d-inline" method="POST">
  @csrf
@method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>  

  @if($pphkonsumsi->count() > 0)
<form action="{{route('pphkonsumsi.export')}}" class="d-inline" method="POST">
  @csrf
  <input type="hidden" value="{{$pphkonsumsitahun->tahun}}" name="ta">
<button type="submit" class="btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
</svg>
Export Excel</button>
</form>  
@endif         
<a href="{{route('pphkonsumsitahun.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left fa-fw fa-sm"></i>Kembali</a>
        </div>
      </div>
  

  </div>
</div>
@endsection