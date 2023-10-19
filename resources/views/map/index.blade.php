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

<div class="d-sm-flex align-items-center justify-content-between my-2 mb-4">
    <h3 class="text-gray-800">Dashboard Penganekaragaman Pangan (Sosialisasi dan UMKM)</h3>
    <div class="lg:text-right">
    <a href="{{route('space.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg> Penganekaragaman Pangan Sosialisasi</a>
<a href="{{route('sosialisasiumkm.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
  </svg> Penganekaragaman Pangan UMKM</a>
    </div>
</div>
    <div class="row">
        <form action="{{route('map.index')}}">
        <div class="d-flex justify-content-between">
        
        <div class="ml-2 text-left">
              <select name="ta" class="form-control {{$errors->first('minggu') ? "is-invalid" : ""}}" >
                <option value="">-pilih-</option>
                @foreach ($tahun as $t)
                <option @if($t->tahun == $ta) selected @endif value="{{$t->tahun}}">{{$t->tahun}}</option>
                @endforeach
            </select>
          </div>
        
          <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </div>
        </form>
        </div>  
<br>
    
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">Penganekaragaman Pangan Pelaku Usaha Mikro</h6>
                      </div>
                    <div class="card-body">
                        <div id="map2" style="height: 500px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">Pelaku Usaha Mikro Berdasarkan Kecamatan</h6>
                      </div>
                    <div class="card-body">
                    <div id="container" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">Kegiatan Sosialisasi Penganekaragaman Pangan</h6>
                      </div>
                    <div class="card-body">
                        <div id="map" style="height: 600px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

            
        <div class="row">
            
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">Daftar Kegiatan Sosialisasi Penganekaragaman Pangan</h6>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead class="bg-primary text-white">
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">Jumlash Peserta</th>
                                    <th scope="col">Tanggal Pelaksanaan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spaces as $u)
                                  <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{ route('map.show', $u->slug) }}">{{$u->name}}</a></a></td>
                                        <td>{{$u->jumlah}}</td>
                                        <td>{{$u->created_at}}</td>
                                
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                                </div>
                            
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">Daftar Kegiatan Sosialisasi Penganekaragaman Pangan UMKM</h6>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead class="bg-primary text-white">
                                  <tr>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Usaha</th>
                                        <th scope="col">No Hp/WA</th>
                                        <th scope="col">Alamat</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sosialisasiumkm as $u)
                                      <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="{{route('sosialisasiumkm.show',[$u->id])}}">{{$u->namausaha}}</a></td>
                                            <td>{{$u->nohp}}</td>
                                            <td>{{$u->alamat}}</td>
                                      </tr>
                                      @endforeach
                                </tbody>
                              </table>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        
@endsection

  
@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
    map.scrollWheelZoom.disable();
    // Menampilkan popup data ketika marker di klik 
    @foreach ($spaces as $item)
        L.marker([{{ $item->location }}])
            .bindPopup(
                "<div class='my-2'><strong>Nama Kegiatan:</strong> <br>{{ $item->name }}</div>" +
		"<div class='my-2'><strong>Tanggal Kegiatan:</strong> <br>{{ $item->created_at }}</div>" + 
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
		"<div class='my-2'><img class='img-fluid' width='200' src='{{ asset('uploads/imgCover/' . $item->image) }}'></div>" +
                "<div class='my-2'><strong>Nama Kegiatan:</strong> <br>{{ $item->name }}</div>" +
	        "<div class='my-2'><strong>Tanggal Kegiatan:</strong> <br>{{ $item->created_at }}</div>" + 
                "<a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Kegiatan</a></div>" +
                "<div class='my-2'></div>"
            ).addTo(map);
        @endforeach
    }
 
    L.control.fullscreen({
            position: 'topleft' // Atur posisi kontrol fullscreen (opsional)
    }).addTo(map);

    //map 2

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
	
    var map2 = L.map('map2', {
                   
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
               L.control.layers(baseLayers, overlays).addTo(map2);
               map2.scrollWheelZoom.disable();
               // Menampilkan popup data ketika marker di klik 
               @foreach ($sosialisasiumkm as $item)
                   L.marker([{{ $item->location }}])
                       .bindPopup(
                           "<div class='my-2'><strong>Nama UMKM:</strong> <br>{{ $item->namausaha }}</div>" + 
                           "<div><a href='{{ route('sosialisasiumkm.show', $item->id) }}' class='btn btn-outline-info btn-sm'>Detail UMKM</a></div>" +
                           "<div class='my-2'></div>"
                       ).addTo(map2);
               @endforeach
           
               var datas = [    
               @foreach ($sosialisasiumkm as $key => $value) 
                   {"loc":[{{$value->location }}], "title": '{!! $value->namausaha !!}'},
               @endforeach            
               ];
               // pada koding ini kita menambahkan control pencarian data        
               var markersLayer = new L.LayerGroup();
               map2.addLayer(markersLayer);
               var controlSearch = new L.Control.Search({
                   position:'topleft',
                   layer: markersLayer,
                   initial: false,
                   zoom: 17,
                   markerLocation: true
               })
           
           //menambahkan variabel controlsearch pada addControl
              map2.addControl( controlSearch );
               // looping variabel datas utuk menampilkan data space ketika melakukan pencarian data
               for(i in datas) {
                 
                   var title = datas[i].title,	
                       loc = datas[i].loc,		
                       marker = new L.Marker(new L.latLng(loc), {title: title} );
                   markersLayer.addLayer(marker);
                   // melakukan looping data untuk memunculkan popup dari space yang dipilih
                   @foreach ($sosialisasiumkm as $item)
                   L.marker([{{ $item->location }}]
                       )
                       .bindPopup(
                           "<div class='my-2'><strong>Nama UMKM:</strong> <br>{{ $item->namausaha }}</div>" +
			    "<div class='my-2'>Alamat: <br>{{ $item->alamat }}</div>" +
                           "<a href='{{ route('sosialisasiumkm.show', $item->id) }}' class='btn btn-outline-info btn-sm'>Detail UMKM</a></div>" +
                           "<div class='my-2'></div>"
                       ).addTo(map2);
                   @endforeach
               }
           
           
               L.control.fullscreen({
                       position: 'topleft' // Atur posisi kontrol fullscreen (opsional)
               }).addTo(map2);
		
</script>
<script>
    // Data retrieved from https://netmarketshare.com
    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y} UMKM</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} UMKM'
            }
        }
    },
    credits: {
    enabled: false
  },
    series: [{
        name: 'Kecamatan',
        colorByPoint: true,
        data: {!!json_encode($data)!!}
    }]
});
</script>
@endsection
    
