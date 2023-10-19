@extends('layouts.sbadmin')

@section('header')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin="" />

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
crossorigin="">
</script>


{{-- cdn leaflet full screen --}}
<script src="
https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.0.2/dist/Leaflet.fullscreen.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.0.2/dist/leaflet.fullscreen.min.css
" rel="stylesheet">

<style>
    .legend {
      background-color: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      line-height: 1.5;
      font-size: 12px;
      text-align: left;
    }
    .legend h4 {
      margin: 0 0 5px;
    }
    .legend i {
      width: 18px;
      height: 18px;
      float: left;
      margin-right: 8px;
      opacity: 0.7;
    }
  </style>
  <style>
    .tooltip {
      position: absolute;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      pointer-events: none;
      display: none;
    }
  </style>
@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Sistem Kewaspadaan Pangan dan Gizi</h1>
    <a href="{{route('skpgbulan.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
 Sistem Kewaspadaan Pangan dan Gizi</a>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <form action="{{route('skpg.dashboard')}}">
  <div class="d-flex justify-content-between">
  <div class="text-left">
      <select name="bulan" class="form-control  w-auto" >
      <option value="">-semua data-</option>
      @foreach ($ba as $b)
            <option @if($b->id == $bulan) selected @endif value="{{$b->id}}">{{$b->bulan}}</option>
      @endforeach
      </select>
  </div>
  
  <div class="ml-2 text-left">
      <select name="tahun" class="form-control {{$errors->first('minggu') ? "is-invalid" : ""}}" >
      <option value="">-semua-</option>
      @foreach ($ta as $t)
      <option @if($t->tahun == $tahun) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
      @endforeach
      </select>
  </div>
  
    <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </svg></button>
  </div>
  </form>
  </div><br>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="map" style="height: 700px; width: 100%;"></div>
            </div>
        </div>
    </div>
    
</div>

 @endsection

@section('footer')

<script>
    var data = [
        @foreach ($skpg as $key => $value) 
            {"kecamatan": "{!! $value->kecamatanid->kecamatan !!}", "skorkomposit": {!! $value->skorkomposit !!}, "ketersediaan": {!! $value->ketersediaan !!}, "pemanfaatan": {!! $value->pemanfaatan !!}, "akses": {!! $value->akses !!} },
        @endforeach            
    ];
var latitude = -1.1709923847739967;
var longitude = 116.88663482666017;

var map = L.map('map').setView([latitude, longitude], 11);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: ''
}).addTo(map);

var baseLayers = {
    "Satellite": L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA', {
        id: 'mapbox/satellite-v9',
        tileSize: 512,
        zoomOffset: -1,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
    }),
    "Dark": L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA', {
        id: 'mapbox/dark-v10',
        tileSize: 512,
        zoomOffset: -1,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
    }),
    "Streets": L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA', {
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
    })
};

var overlays = {};

L.control.layers(baseLayers, overlays).addTo(map);
map.scrollWheelZoom.disable();
var tooltip = L.DomUtil.create('div', 'tooltip');
  map.getContainer().appendChild(tooltip);

var geojsonLayer = L.geoJSON(null, {
    style: function(feature) {
        var kecamatan = feature.properties.name;
        var skorkomposit = null;
       
        // Cari nilai indexkomposit berdasarkan nama kecamatan
        for (var i = 0; i < data.length; i++) {
            if (data[i].kecamatan === kecamatan) {
                skorkomposit = data[i].skorkomposit;
                break;
            }
        }

        // Menentukan warna berdasarkan nilai indexkomposit
        var color = "";
          if (skorkomposit >= 1 && skorkomposit <= 5) {
              color = "#991b1b";
          } else if (skorkomposit >= 6 && skorkomposit <= 7) {
              color = "#fcd34d";
          } else if (skorkomposit >= 8) {
              color = "#15803d";
          } else {
              color = "gray";
          }


        return {
            fillColor: color,
            weight: 1,
            opacity: 1,
            color: 'white',
            fillOpacity: 0.7
        };
    },

    
   
    onEachFeature: function(feature, layer) {
        // Menambahkan popup dengan nama kecamatan
        var kecamatan = feature.properties.name;
	var skorkomposit = null;
        var akses = null;
        var pemanfaatan = null;
        var ketersediaan = null;
       for (var i = 0; i < data.length; i++) {
            if (data[i].kecamatan === kecamatan) {
                skorkomposit = data[i].skorkomposit;
                ketersediaan = data[i].ketersediaan;
                akses = data[i].akses;
                pemanfaatan = data[i].pemanfaatan;
                break;
            }
        }

        var popupContent = `
        <table class="table" border="1">
	<thead class="bg-primary text-white">
     		<tr>
		<th scope="col">Kecamatan</th>
        	<th scope="col">IK</th>
        	<th scope="col">IA</th>
        	<th scope="col">IP</th>
		<th scope="col">Skor Komposit</th>
        	</tr>
    </thead>
    <tbody>
            <tr>
                <td>${kecamatan}</td>
		<td>${ketersediaan}</td>
		<td>${akses}</td>
		<td>${pemanfaatan}</td>
                <td>${skorkomposit}</td>
            </tr>
           	</tbody>
        </table>
    `;
    
    layer.bindPopup(popupContent);
}}).addTo(map);
var geojsonFiles = [
    'balikpapan.geojson'
];

geojsonFiles.forEach(function (file) {
    fetch('/geojson/' + file)
        .then(response => response.json())
        .then(data => {
            geojsonLayer.addData(data);
        });
});

var legend = L.control({ position: "bottomright" });

legend.onAdd = function(map) {
  var div = L.DomUtil.create("div", "legend");
  div.innerHTML += "<h6>Keterangan Berdasarkan Indek Komposit Ketahanan Pangan:</h6>";
  div.innerHTML += '<i style="background: #15803d"></i>Aman<br>';
  div.innerHTML += '<i style="background: #fcd34d"></i>Waspada<br>';
  div.innerHTML += '<i style="background: #991b1b"></i>Rentan<br>';
  div.innerHTML += '<i style="background: gray"></i>Tidak Tersedia<br>';
  return div;
};


legend.addTo(map);
L.control.fullscreen({
            position: 'topleft' // Atur posisi kontrol fullscreen (opsional)
    }).addTo(map);
</script>
@endsection

