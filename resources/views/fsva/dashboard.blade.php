@extends('layouts.sbadmin')

@section('header')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="crossorigin="" />

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="">
</script>

{{-- cdn leaflet full screen --}}
<script src="https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.0.2/dist/Leaflet.fullscreen.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.0.2/dist/leaflet.fullscreen.min.css" rel="stylesheet">

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
@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard FSVA</h1>
    <a href="{{route('fsvatahun.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
 FSVA</a>
</div>

 <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <form action="{{route('fsva.dashboard')}}">
<div class="d-flex justify-content-between">
  <div class="">
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
  </div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">Peta FSVA Kota Balikpapan</h6>
          </div>
            <div class="card-body">
                <div id="map" style="height: 700px; width: 100%;"></div>
            </div>
        </div>
    </div>
    
</div>

@endsection

@section('footer')

<script>
   
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

    var data = [
        @foreach ($fsva as $key => $value) 
            {"kelurahan": "{!! $value->kelurahan !!}", "indexprioritas": {!! $value->indexprioritas !!},"penyediaanpangan": {!! $value->penyediaanpangan !!},"kesejahteraanrendah": {!! $value->kesejahteraanrendah !!},"aksespenghubung": {!! $value->aksespenghubung !!},"aksesairbersih": {!! $value->aksesairbersih !!},"jmltenagakesehatan": {!! $value->jmltenagakesehatan !!}  },
        @endforeach            
    ];





var geojsonLayer = L.geoJSON(null, {
    style: function(feature) {
        var kelurahan = feature.properties.DESA_KEL;
        var indexprioritas = null;

        // Cari nilai indexkomposit berdasarkan nama kecamatan
        for (var i = 0; i < data.length; i++) {
            if (data[i].kelurahan === kelurahan) {
                indexprioritas = data[i].indexprioritas;
                break;
            }
        }

        // Menentukan warna berdasarkan nilai indexkomposit
        var color = "";
        if (indexprioritas === 1) {
         color = "#6e1f1f";
        } else if (indexprioritas === 2) {
            color = "#e85961";
        } else if (indexprioritas === 3) {
            color = "#f4a1a7";
        } else if (indexprioritas === 4) {
            color = "#c9e077";
        } else if (indexprioritas === 5) {
            color = "#94c945";
        } else if (indexprioritas === 6) {
            color = "#3b703b";
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
        var kelurahan = feature.properties.DESA_KEL;
	var indexprioritas = null;
        var penyediaanpangan = null;
        var kesejahteraanrendah = null;
        var aksespenghubung = null;
        var aksesairbersih = null;
        var jmltenagakesehatan = null;
       for (var i = 0; i < data.length; i++) {
            if (data[i].kelurahan === kelurahan) {
                indexprioritas = data[i].indexprioritas;
                penyediaanpangan = data[i].penyediaanpangan;
                kesejahteraanrendah = data[i].kesejahteraanrendah;
                aksespenghubung = data[i].aksespenghubung;
                aksesairbersih = data[i].aksesairbersih;
                jmltenagakesehatan = data[i].jmltenagakesehatan;
                break;
            }
        }

        var popupContent = `
        <div class="table-responsive">
        <table class="table table-striped" border="0">
            <thead class="bg-primary text-white">
                <tr>
                    <th colspan="2">Informasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Kelurahan</b></td>
                    <td>${kelurahan}</td>
                </tr>
                <tr>
                    <td><b>Index Prioritas</b></td>
                    <td>${indexprioritas}</td>
                </tr>
                <tr>
                    <td><b>Sarana Penyediaan Pangan</b></td>
                    <td>${penyediaanpangan}</td>
                </tr>
                <tr>
                    <td><b>Jumlah Penduduk Tingkat Kesejahteraan Rendah</b></td>
                    <td>${kesejahteraanrendah}</td>
                </tr>
                <tr>
                    <td><b>Akses Penghubung Tidak Memadai</b></td>
                    <td>${aksespenghubung}</td>
                </tr>
                <tr>
                    <td><b>Rumah Tangga Tanpa Akses Air Bersih</b></td>
                    <td>${aksesairbersih}</td>
                </tr>
                <tr>
                    <td><b>Jumlah Tenaga Kesehatan</b></td>
                    <td>${jmltenagakesehatan}</td>
                </tr>
            </tbody>
        </table>
    </div>
`;
    
    layer.bindPopup(popupContent);
}}).addTo(map);

    

var geojsonFiles = [
    'kelurahanbalikpapan.geojson'
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
    div.innerHTML += "<h6>Kerentanan Berdasarkan Indeks Ketahanan Pangan Komposit:</h6>";
    div.innerHTML += '<i style="background: #6e1f1f"></i>Sangat Rentan<br>'; // Warna merah tua
    div.innerHTML += '<i style="background: #e85961"></i>Rentan<br>'; // Warna merah
    div.innerHTML += '<i style="background: #f4a1a7"></i>Agak Rentan<br>'; // Warna merah muda
    div.innerHTML += '<i style="background: #c9e077"></i>Agak Tahan<br>'; // Warna kuning
    div.innerHTML += '<i style="background: #94c945"></i>Tahan<br>'; // Warna hijau muda
    div.innerHTML += '<i style="background: #3b703b"></i>Sangat Tahan<br>'; // Warna hijau tua
    div.innerHTML += '<i style="background: gray"></i>Tidak Tersedia<br>';
    return div;
};

legend.addTo(map);

L.control.fullscreen({
            position: 'topleft' // Atur posisi kontrol fullscreen (opsional)
    }).addTo(map);

</script>
@endsection

