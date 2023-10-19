@extends('layouts.sbadmin')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Panel Harga</h1>
    <a href="{{route('panelharga.index')}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg> Panel Harga</a>
</div>

<div class="row">
    <form action="{{route('panelharga.dashboard')}}">
    <div class="d-flex justify-content-between">
    <div class="mx-2 text-right">
             <select name="id_komoditas" class="form-control" >
        <option value="">-semua data-</option>
        @foreach ($datakomoditas as $b)
        <option @if($b->id == $id_komoditas) selected @endif value="{{$b->id}}">{{$b->komoditas}}</option>
        @endforeach
          </select>
      </div>
    
    <div class="text-left">
          <input type="date" name="tanggal" value="{{$tanggal}}" class="form-control">
      </div>
    
      <button type="submit" class="btn btn-secondary btn-sm ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg></button>
    </div>
    </form>
    </div><br>

<div class="row">
    @foreach ($panelharga as $item)
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('panelharga.detail', ['id_komoditas' => $item->id_komoditas]) }}">
        <div class="card bg-gray-500 text-white shadow d-flex flex-row-reverse">
            <img src="{{asset('storage/'. $item->datakomoditas->image)}}" width="150px" />
            <div class="card-img-overlay">
                <h5 class="card-title">{{ $item->datakomoditas->komoditas }}</h5>
                <p class="card-text">Rp. {{ $item->harga }}</p>
                @if ($hargaKemarin)
                    @php
                        $matchingHargaKemarin = $hargaKemarin->where('id_komoditas', $item->id_komoditas)->first();
                        if ($matchingHargaKemarin) {
                            $hargaKemarinValue = intval($matchingHargaKemarin->harga);
                            $hargaSekarangValue = intval($item->harga);
                            $perubahanHarga = $hargaSekarangValue - $hargaKemarinValue;
                            $percentageChange = ($perubahanHarga / $hargaKemarinValue) * 100;
                        } else {
                            $perubahanHarga = null;
                            $percentageChange = null;
                        }
                    @endphp
                    @if ($perubahanHarga === null)
                        <button class="btn btn-secondary btn-sm">Tidak Ada Data Kemarin</button>
                    @elseif ($perubahanHarga > 0)
                        <button class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                          </svg> ({{ number_format($percentageChange, 2) }}%) Rp. {{ $perubahanHarga }} </button>
                    @elseif ($perubahanHarga < 0)
                        <button class="btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                          </svg> ({{ number_format($percentageChange, 2) }}%) -Rp. {{ abs($perubahanHarga) }} </button>
                    @else
                        <button class="btn btn-primary btn-sm">0.0 % Rp. 0</button>
                    @endif
                @else
                    <button class="btn btn-secondary btn-sm">Tidak Ada Data Kemarin</button>
                @endif
            </div>
        </div>
    </a>
    </div>
@endforeach

    


   </div>

   
@endsection
