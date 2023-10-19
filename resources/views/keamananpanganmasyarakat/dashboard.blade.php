@extends('layouts.sbadmin')
@section('header')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin="" />

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
crossorigin="">
</script>

{{-- cdn leaflet search --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.src.js"></script>

{{-- cdn leaflet full screen --}}
<script src="
https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.0.2/dist/Leaflet.fullscreen.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.0.2/dist/leaflet.fullscreen.min.css
" rel="stylesheet">

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
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
       
    var mbAttr = '',
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
    var map = L.map('map', {
                   
        center: [{{ $centrePoint->location }}],
        zoom: 12,
        layers: [streets]
        
    });
    var baseLayers = {
        "Grayscale": dark,
        "Satellite": satellite,
        "Streets": streets
    };
    var overlays = {
        "Streets": streets,
        "Grayscale": dark,
        "Satellite": satellite,
    };
    L.control.layers(baseLayers, overlays).addTo(map);
    
    // Menampilkan popup data ketika marker di klik 
    @foreach ($spaces as $item)
        L.marker([{{ $item->location }}])
            .bindPopup(
                "<div class='my-2'><strong>Nama Kegiatan:</strong> <br>{{ $item->name }}</div>" + 
                "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Kegiatan</a></div>" +
                "<div class='my-2'></div>"
            ).addTo(map);
    @endforeach

    var datas = [    
    @foreach ($spaces as $key => $value) 
        {"loc":[{{$value->location }}], "title": '{!! $value->name !!}'},
    @endforeach            
    ];
    // pada koding ini kita menambahkan control pencarian data        
    var markersLayer = new L.LayerGroup();
    map.addLayer(markersLayer);
    var controlSearch = new L.Control.Search({
        position:'topleft',
        layer: markersLayer,
        initial: false,
        zoom: 17,
        markerLocation: true
    })

//menambahkan variabel controlsearch pada addControl
   map.addControl( controlSearch );
    // looping variabel datas utuk menampilkan data space ketika melakukan pencarian data
    for(i in datas) {
      
        var title = datas[i].title,	
            loc = datas[i].loc,		
            marker = new L.Marker(new L.latLng(loc), {title: title} );
        markersLayer.addLayer(marker);
        // melakukan looping data untuk memunculkan popup dari space yang dipilih
        @foreach ($spaces as $item)
        L.marker([{{ $item->location }}]
            )
            .bindPopup(
                "<div class='my-2'><strong>Nama Spot:</strong> <br>{{ $item->name }}</div>" +
                "<a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
                "<div class='my-2'></div>"
            ).addTo(map);
        @endforeach
    }
    L.control.layers(baseLayers, overlays).addTo(map);

    L.control.fullscreen({
            position: 'topleft' // Atur posisi kontrol fullscreen (opsional)
    }).addTo(map);
</script>
@endsection
    
