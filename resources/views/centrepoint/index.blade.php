@extends('layouts.sbadmin')

@section('header')
    {{-- load jquery datatable untuk menggunakannya --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route('centre-point.create') }}" class="btn btn-primary btn-sm shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg> Tambah Data</a>
    </div>
</div>
<br>
        
                <div class="card shadow mb-4">
                    <div class="card-header">{{ __('Set Centre Point') }}</div>
                    <div class="card-body">
                        
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                        <table class="table" id="dataCentrePoint">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Titik Koordinat</th>
                                    <th>Opsi</th>
                                </tr>
                            <tbody></tbody>
                            </thead>
                        </table>
                        
                        {{-- tag form di gunakan untuk melakukan hapus data centrepoint yang di pilih
                        jadi ketika button yang ada pada view action.blade di klik akan menjalankan
                        fungsi javascript sweet alert2  --}}
                        <form action="" method="POST" id="deleteForm">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Hapus" style="display: none">
                        </form>
                    </div>
                </div>
                </div>
@endsection

@section('footer')
    {{-- load jquery dan jquery datatable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script>
    // ajaxserver side  datatable untuk menampilkan data centrepoint
        $(function() {
            $('#dataCentrePoint').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                ajax: '{{ route('centre-point.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'location'
                    },
                    {
                        data: 'action'
                    }
                ]
            })
        })
    </script>
@endsection