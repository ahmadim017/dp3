@extends('layouts.sbadmin')

@section('header')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #map {
            height: 500px;
        }
    </style>
   

@endsection

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Keamanan Pangan</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
	<form action="{{route('keamananpangan.update',[$keamananpangan->id])}}" method="POST" enctype="multipart/form-data">
	@csrf
  @method('PUT')
   			<div class="form-group mb-3">
			<label for="">Lokasi Pengambilan Sampel</label>
              		<input type="text" name="lokasisampel" value="{{$keamananpangan->lokasisampel}}" placeholder="lokasi sampel" class="form-control {{$errors->first('lokasisampel') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
			</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('lokasisampel')}}</div>
               <div class="form-group mb-3">
                <label for="">Alamat</label>
                          <input type="text" name="alamat" value="{{$keamananpangan->alamat}}" placeholder="alamat" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                </div>
                   <div class="invalid-feedbeck"> {{$errors->first('alamat')}}</div>
			<div class="form-group mb-3">
			<label for="">Location Cordinate</label>
              <input type="text" name="location" value="{{$keamananpangan->location}}" placeholder="location" class="form-control {{$errors->first('location') ? "is-invalid" : ""}}" aria-describedby="basic-addon2" readonly>
               <button id="currentLocationBtn" type="button" class="btn btn-primary btn-sm mt-3">Current Location</button>
 	       </div>
     	       <div class="invalid-feedbeck"> {{$errors->first('location')}}</div>
	           		   <div id="map" class="mb-3"></div>
  	          
      <div class="form-group mb-3">
	<label for="">Tanggal Pengambilan Sampel</label>
      <input type="date" class="form-control {{$errors->first('tglpengambilan') ? "is-invalid" : ""}}" name="tglpengambilan" value="{{$formattedDate}}">
      <div class="invalid-feedbeck"> {{$errors->first('tglpengambilan')}}</div>
      </div>
<div class="form-group mb-3">
	<label for="">File Pendukung</label>
      <input type="file" class="form-control {{$errors->first('file') ? "is-invalid" : ""}}" name="file" value="{{old('file')}}" >
  <div class="invalid-feedbeck"> {{$errors->first('file')}}</div>
</div>

<div class="form-group mb-3">
			<label for="">Tahun</label>
<select name="tahun" class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" >
@foreach($tahun as $k)
  <option @if ($keamananpangan->tahun == $k->tahun) selected
      
  @endif value="{{$k->tahun}}">{{$k->tahun}}</option>
@endforeach
  </select>
        <div class="invalid-feedbeck"> {{$errors->first('tahun')}}</div>
</div>

<button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg> Simpan</button>
	<a href="{{route('keamananpangan.index')}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
</svg> Kembali</a>
</form>

        </div>
      </div>
  

  </div>
</div>

@endsection

@section('footer')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);
        });
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
        var map = L.map('map', {
            center: [{{ $keamananpangan->location }}],
            zoom: 14,
            layers: [streets]
        });
        var baseLayers = {
            //"Grayscale": grayscale,
            "Streets": streets,
            "Satellite": satellite
        };
        var overlays = {
            "Streets": streets,
            "Satellite": satellite,
        };
        L.control.layers(baseLayers, overlays).addTo(map);
        var curLocation = [{{$keamananpangan->location }}];
        map.attributionControl.setPrefix(false);
        var marker = new L.marker(curLocation, {
            draggable: 'true',
        });
        map.addLayer(marker);
        marker.on('dragend', function(event) {
            var location = marker.getLatLng();
            marker.setLatLng(location, {
                draggable: 'true',
            }).bindPopup(location).update();
            $('#location').val(location.lat + "," + location.lng).keyup()
        });
        var loc = document.querySelector("[name=location]");
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }
            loc.value = lat + "," + lng;
        });
    </script>

<script>
  const checkboxes = document.querySelectorAll('.myCheckbox');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      const targetId = this.dataset.target;
      const inputElement = document.getElementById(targetId);

      if (this.checked) {
        inputElement.style.display = 'block';
      } else {
        inputElement.style.display = 'none';
      }
    });
  });
</script>
@endsection