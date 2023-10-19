<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="
https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css
" rel="stylesheet">
    <style>
        #map {
            height: 500px;
            width: 80%;
        }
    </style>
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

</head>
<body>
    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
<script>
    var data = [
    {"kecamatan": "Balikpapan Selatan", "indekskomposit": 3},
    {"kecamatan": "Balikpapan Timur", "indekskomposit": 5},
    {"kecamatan": "Balikpapan Utara", "indekskomposit": 2},
    {"kecamatan": "Balikpapan Tengah", "indekskomposit": 4},
    {"kecamatan": "Balikpapan Kota", "indekskomposit": 7},
    {"kecamatan": "Balikpapan Barat", "indekskomposit": 1}
];

var latitude = -1.1709923847739967;
var longitude = 116.88663482666017;

var map = L.map('map').setView([latitude, longitude], 11);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
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

var geojsonLayer = L.geoJSON(null, {
    style: function(feature) {
        var kecamatan = feature.properties.name;
        var indexkomposit = null;

        // Cari nilai indexkomposit berdasarkan nama kecamatan
        for (var i = 0; i < data.length; i++) {
            if (data[i].kecamatan === kecamatan) {
                indexkomposit = data[i].indekskomposit;
                break;
            }
        }

        // Menentukan warna berdasarkan nilai indexkomposit
        var color = "";
if (indexkomposit >= 1 && indexkomposit <= 3) {
    color = "red";
} else if (indexkomposit >= 4 && indexkomposit <= 6) {
    color = "yellow";
} else if (indexkomposit >= 7) {
    color = "green";
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
        layer.bindPopup("<b>Kecamatan:</b> " + kecamatan);
    }
}).addTo(map);

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
  div.innerHTML += "<h4>Keterangan:</h4>";
  div.innerHTML += '<i style="background: green"></i>Aman<br>';
  div.innerHTML += '<i style="background: yellow"></i>Waspada<br>';
  div.innerHTML += '<i style="background: red"></i>Rawan<br>';
  div.innerHTML += '<i style="background: gray"></i>Tidak Tersedia<br>';
  return div;
};

legend.addTo(map);
        
    </script>
</body>
</html>
