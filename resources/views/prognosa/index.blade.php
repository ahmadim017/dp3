@extends('layouts.sbadmin')
@section('header')
<link href="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

@endsection

@section('footer')
<script src="{{asset('sbadmin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript"> 
  $(document).ready(function () {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdf',
                orientation: 'landscape', // Atur orientasi ke landscape
                text: 'PDF',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            },
            'csv', 'excel'
        ]
    });
});
</script>

@endsection
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{route('prognosa.dashboard')}}" class="my-1 btn btn-primary btn-sm shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
  <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
</svg> Dashboard Prognosa Pangan</a>
    <a href="{{route('prognosa.create')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
 Tambah Data</a>

</div>
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <h6 class="m-0 font-weight-bold text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg> Cari Berdasarkan</h6>
    </a>
       <div class="card-body">
      <form action="{{route('prognosa.index')}}">
      <div class="row">
      <div class="col-6 mb-3">
	<label>Bulan</label>
               <select name="bulan" class="form-control" >
          <option value="">-semua data-</option>
          @foreach ($ba as $b)
          <option @if($b->id == $bulan) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
          @endforeach
            </select>
        </div>
      
      <div class="col-6 mb-3">
	<label>Tahun</label>
            <select name="tahun" class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" >
          <option value="">-semua-</option>
          @foreach ($ta as $t)
          <option @if($t->tahun == $tahun) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
          @endforeach
          </select>
        </div>
      </div>

       <div class="text-right">
        <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
</svg> Tampilkan</button>
	</div>
      </form>

</div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <h6 class="m-0 font-weight-bold text-secondary">Prognosa Pangan</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
      <div class="card-body">

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
        <th scope="col">Komoditas</th>
        <th scope="col">Stok Awal</th>
        <th scope="col">Perkiraan Produksi</th>
	<th scope="col">Barang Masuk</th>
	<th scope="col">Total Ketersediaan</th>
        <th scope="col">Kebutuhan (Tahunan)</th>
	<th scope="col">Kebutuhan (Bulanan)</th>
        <th scope="col">Neraca</th>
        <th scope="col">Rencana Impor</th>
        <th scope="col">Stock Akhir</th>
        <th scope="col">Bulan</th>
        <th scope="col">Tahun</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($prognosa as $u)
      <tr>
      <td>{{$loop->iteration}}</td>
      <td><a href="{{route('prognosa.show',[$u->id])}}">{{$u->komoditasid->komoditas}}</a></td>
      <td>{{$u->stockawal}}</td>
      <td>{{$u->produksi}}</td>
      <td>{{$u->barangmasuk}}</td>
      <td>{{$u->totalketersediaan}}</td>
      <td>{{$u->kebutuhantahunan}}</td>
      <td>{{$u->kebutuhanbulanan}}</td>
      <td>{{$u->neraca}}</td>             
      <td>{{$u->rencanaimpor}}</td>
      <td>{{$u->stockakhir}}</td>
      <td>{{$u->bulanid->bulan}}</td>
      <td>{{$u->tahun}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
    </div>
</div>
</div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    	</div>
    <div class="modal-body">
        <form action="{{route('prognosa.export')}}" method="get">
                <div class="form-group mb-3">
                  <label for="">Bulan</label>
                  <select name="bulan" class="form-control" >
                    <option value="">-semua data-</option>
                    @foreach ($ba as $b)
                    <option @if($b->id == $bulan) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
                    @endforeach
                      </select>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="">Tahun</label>
                  <select name="tahun" class="form-control {{$errors->first('minggu') ? "is-invalid" : ""}}" >
                    <option value="">-semua-</option>
                    @foreach ($ta as $t)
                    <option @if($t->tahun == $tahun) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success btn-sm ml-2">EXPORT</button>
                </div>
                
              </form>
    </div>
   
    </div>
  </div>
</div>
@endsection