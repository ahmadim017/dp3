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
        <div class="col-md-6 col-xs-6 mb-2">
            <div class="card shadow">
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th  class="bg-light"  width="200"><strong>Nama Kegiatan</strong></th>
                            <td>{{ $spaces->name }}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Tanggal Kegiatan</strong></th>
                            <td>{{ $spaces->created_at }}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Jumlah yang Di Sosialisasikan</strong></th>
                            <td>{{ $spaces->jumlah}}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Keterangan</strong></th>
                            <td>{{ $spaces->content}}</td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Foto Kegiatan</strong></th>
                            <td><img class="img-fluid" width="200" src="{{ asset('uploads/imgCover/' . $spaces->image) }}" alt=""></td>
                        </tr>
                        <tr>
                            <th  class="bg-light"><strong>Daftar Peserta Sosialisasi</strong></th>
                            <td><a href="" class="btn btn-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                              </svg> Daftar</a></td>
                        </tr>
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('map.index') }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                        <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                        <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                      </svg> Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-6">
            <div class="card shadow">
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
    var data{{ $spaces->id }} = L.layerGroup()
    var map = L.map('map', {
        center: [{{ $spaces->location }}],
        zoom: 20,
        fullscreenControl: {
            pseudoFullscreen: false
        },
        layers: [streets, data{{ $spaces->id }}]
    });
    var baseLayers = {
        "Streets": streets,
        "Satellite": satellite,
        "Dark": dark,
    };
    var overlays = {
        //"Streets": streets
        "{{ $spaces->name }}": data{{ $spaces->id }},
    };
    L.control.layers(baseLayers, overlays).addTo(map);
    var curLocation = [{{ $spaces->location }}];
    map.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'false',
    });
    map.addLayer(marker);
</script>
   @endsection
   
