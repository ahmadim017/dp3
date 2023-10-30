@extends('layouts.sbadmin')
    <!-- CSS only -->

    @section('header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin="" />

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>

    @endsection
    
@section('content')
    <div class="row">
        <div class="col-md-7 col-xs-7 mb-2">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Detail Kegiatan Sosialisasi Penganekaragaman Pangan</h6>
                  </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th  class="bg-light"  width="200"><strong>Nama Kegiatan</strong></th>
                            <td>{{ $space->name }}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"  width="200"><strong>Alamat Kegiatan</strong></th>
                            <td>{{ $space->alamat }}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Tanggal Kegiatan</strong></th>
                            <td>{{ $space->created_at }}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Jumlah yang Di Sosialisasikan</strong></th>
                            <td>{{ $space->jumlah}}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>DeskripsiKeterangan</strong></th>
                            <td>{{ $space->content}}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Foto Kegiatan</strong></th>
                            <td><img class="img-fluid" width="200" src="{{ asset('uploads/imgCover/' . $space->image) }}" alt=""></td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>File Materi/Pendukung lainnya</strong></th>
                            <td>
                                @if($space->file)
                                <strong><a href="{{asset('storage/filependukung/'.$space->file)}}" target="_blank" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                              </svg> File Materi/Pendukung lainnya</a></strong>
                              @else
                              <strong><a href="#" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                              </svg> FIle Materi/Pendukung Belum di upload</a></strong>
                              @endif
                              </td>
                        </tr>
                       
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('space.edit',[$space->id])}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('space.destroy',[$space->id])}}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('space.index') }}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                        <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                        <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                      </svg> Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Detail Lokasi Kegiatan Sosialisasi Penganekaragaman Pangan</h6>
                  </div>
                <div class="card-body">
                    <div id="map" style="height: 600px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
    
   @section('footer')
   <script>
    var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
         mbUrl =
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA';
    var satellite = L.tileLayer(mbUrl, {
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        }),
        dark = L.tileLayer(mbUrl, {
            id: 'mapbox/dark-v10',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        }),
        streets = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });
    var data{{ $space->id }} = L.layerGroup()
    var map = L.map('map', {
        center: [{{ $space->location }}],
        zoom: 20,
        fullscreenControl: {
            pseudoFullscreen: false
        },
        layers: [streets, data{{ $space->id }}]
    });
    var baseLayers = {
        "Streets": streets,
        "Satellite": satellite,
        "Dark": dark,
    };
    var overlays = {
        //"Streets": streets
        "{{ $space->name }}": data{{ $space->id }},
    };
    L.control.layers(baseLayers, overlays).addTo(map);
    var curLocation = [{{ $space->location }}];
    map.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'false',
    });
    map.addLayer(marker);
</script>
   @endsection
   
