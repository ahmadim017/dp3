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
        <h6 class="m-0 font-weight-bold text-secondary">Sosialisasi Penganekaragaman Pangan UMKM</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
	<form action="{{route('sosialisasiumkm.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
   			<div class="form-group mb-3">
			<label for="">Nama Usaha</label>
              		<input type="text" name="namausaha" value="{{old('namausaha')}}" placeholder="nama usaha" class="form-control {{$errors->first('namausaha') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
			</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('namausaha')}}</div>
         <div class="form-group mb-3">
          <label for="">Nama Pelaku Usaha</label>
                      <input type="text" name="namapelakuusaha" value="{{old('namapelakuusaha')}}" placeholder="nama pelaku usaha" class="form-control {{$errors->first('namapelakuusaha') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
          </div>
             <div class="invalid-feedbeck"> {{$errors->first('namapelakuusaha')}}</div>

             <div class="form-group mb-3">
              <label for="">Foto</label><br>
              <img id="previewImage" class="mb-2" src="#" width="20%" alt="">
              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                  id="image">
              @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

             <div class="form-group mb-3">
             <label for="">Alamat</label>
              <input type="text" name="alamat" value="{{old('alamat')}}" placeholder="alamat" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              <div class="invalid-feedbeck"> {{$errors->first('alamat')}}</div>
 	       </div>
          <div class="form-group mb-3">
          <label for="">Kelurahan</label>
              <input type="text" name="kelurahan" value="{{old('kelurahan')}}" placeholder="kelurahan" class="form-control {{$errors->first('kelurahan') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              <div class="invalid-feedbeck"> {{$errors->first('kelurahan')}}</div>
 	       </div>
          <div class="form-group mb-3">
            <label for="">Kecamatan</label>
      <select name="id_kecamatan" class="form-control {{$errors->first('id_kecamatan') ? "is-invalid" : ""}}" >
      @foreach($kecamatan as $k)
        <option value="{{$k->id}}">{{$k->kecamatan}}</option>
      @endforeach
        </select>
              <div class="invalid-feedbeck"> {{$errors->first('id_kecamatan')}}</div>
      </div>

             <div class="form-group mb-3">
              <label for="">Location Cordinate</label>
                      <input type="text" name="location" value="{{old('location')}}" placeholder="location" class="form-control {{$errors->first('location') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                       <button id="currentLocationBtn" type="button" class="btn btn-primary btn-sm mt-3">Current Location</button>
                  </div>
                      <div class="invalid-feedbeck"> {{$errors->first('location')}}</div>
                            <div id="map" class="mb-3"></div>

			<div class="form-group mb-3">
			
            <div class="form-group mb-3">
                <label for="">Np HP</label>
                  <input type="number" name="nohp" value="{{old('nohp')}}" placeholder="nohp" class="form-control {{$errors->first('nohp') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                  <div class="invalid-feedbeck"> {{$errors->first('nohp')}}</div>
                </div>
               
                <div class="form-group mb-3">
                  <label>
                    <input type="checkbox" class="myCheckbox" data-target="nibInput"> NIB
                  </label>
                
                  <label>
                    <input type="checkbox" class="myCheckbox" data-target="pirtInput"> PIRT
                  </label>

                  <label>
                    <input type="checkbox" class="myCheckbox" data-target="halalInput"> Sertifikat Halal
                  </label>

                  <label>
                    <input type="checkbox" class="myCheckbox" data-target="higenisInput"> Sertifikat Laik Higieni
                  </label>

                  <label>
                    <input type="checkbox" class="myCheckbox" data-target="npwpInput"> NPWP
                  </label>
                
                  <div id="inputTextContainer">
                    <input type="text" name="nib" class="form-control my-1" placeholder="NIB" id="nibInput" style="display: none;">
                    <input type="text" name="pirt" class="form-control my-1" placeholder="PIRT" id="pirtInput" style="display: none;">
                    <input type="text" name="halal" class="form-control my-1" placeholder="Sertifikat Halal" id="halalInput" style="display: none;">
                    <input type="text" name="higenis" class="form-control my-1" placeholder="Sertifikat Laik Higieni" id="higenisInput" style="display: none;">
                    <input type="text" name="npwp" class="form-control my-1" placeholder="NPWP" id="npwpInput" style="display: none;">
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label for="">Komoditi Pangan Lokal Yang diolah</label>
                    <input type="text" name="komoditas" value="{{old('komoditas')}}" placeholder="Komoditi Pangan Lolak Yang diolah" class="form-control {{$errors->first('komoditas') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                    <div class="invalid-feedbeck"> {{$errors->first('komoditas')}}</div>
                  </div>
     
                  <div class="form-group mb-3">
                    <label for="">Jenis Produk Olahan</label>
                      <input type="text" name="produkolahan" value="{{old('produkolahan')}}" placeholder="Jenis Produk Olahan" class="form-control {{$errors->first('produkolahan') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                      <div class="invalid-feedbeck"> {{$errors->first('produkolahan')}}</div>
                    </div>
<div class="form-group mb-3">
	<label for="">File Pendukung</label>
      <input type="file" class="form-control {{$errors->first('file') ? "is-invalid" : ""}}" name="file" value="{{old('file')}}" >
  <div class="invalid-feedbeck"> {{$errors->first('file')}}</div>
</div>


<button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg> Simpan</button>
	<a href="{{route('sosialisasiumkm.index')}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
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
        // fungsi ini akan berjalan ketika akan menambahkan gambar dimana fungsi ini
        // akan membuat preview image sebelum kita simpan gambar tersebut.      
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Ketika tag input file denghan class image di klik akan menjalankan fungsi di atas
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
            // titik koordinat disini kita dapatkan dari tabel centrepoint tepatnya dari field location
            // yang sebelumnya sudah kita tambahkan jadi lokasi map yang akan muncul  sesuai dengan tabel
            // centrepoint
            center: [{{ $centrepoint->location }}],
            zoom: 13,
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
        // Begitu juga dengan curLocation titik koordinatnya dari tabel centrepoint
        // lalu kita masukkan curLocation tersebut ke dalam variabel marker untuk menampilkan marker
        // pada peta.
        var curLocation = [{{ $centrepoint->location }}];
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

function locateUser() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            map.setView([lat, lng], 13); // Mengatur posisi peta ke koordinat pengguna

            // Tambahkan marker untuk menunjukkan posisi pengguna
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup('You are here!').openPopup();

            // Mengisi nilai lokasi pada input field dengan latitude dan longitude
            var locationInput = document.querySelector("[name=location]");
            locationInput.value = lat + "," + lng;
        }, function (error) {
            console.log(error.message);
        });
    } else {
        console.log('Geolocation is not supported by this browser.');
    }
}

// Panggil fungsi locateUser ketika tombol "Curent Location" diklik
$("#currentLocationBtn").click(function () {
    locateUser();
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