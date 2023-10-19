@extends('layouts.sbadmin')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard PPH Ketersediaan dan PPH Konsumsi</h1>
<div class="lg:text-right">
    <a href="{{route('pphketersediaantahun.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
 PPH Ketersediaan</a>
<a href="{{route('pphkonsumsitahun.index')}}" class="my-1 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>
 PPH Konsumsi</a>
</div>
</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <form action="{{route('pphkonsumsi.dashboard')}}">
  <div class="d-flex justify-content-between">
  <div class="ml-2 text-left">
        <select name="ta" class="form-control {{$errors->first('ta') ? "is-invalid" : ""}}" >
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


   <div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-secondary">Skor PPH Konsumsi</h6>
            </div>

            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                          <tr class="bg-primary text-white">
                            <th scope="col">No</th>
                            <th scope="col">Kelompok Bahan Pangan</th>
                            <th scope="col">KKAL/Kapita</th>
                            <th scope="col">%</th>
                            <th scope="col">% AKE</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Skor Aktual</th>
                            <th scope="col">Skor Ake</th>
                            <th scope="col">Skor PPH</th>
                            <th scope="col">Skor Maks</th>
                          </tr>
                        </thead>
                        @php
                        $skormaksValues = $pphkonsumsi->pluck('bahanpanganpphid.skormaks');
                        $totalSkormaks = $skormaksValues->sum();
                        @endphp
                        <tbody>
                        
                            @foreach ($pphkonsumsi as $p)
                          <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$p->bahanpanganpphid->bahanpangan}}</td>
                                <td>{{$p->kkal}}</td>
                                <td>{{$p->persen}}</td>
                                <td>{{$p->ake}}</td>
                                <td>{{$p->bahanpanganpphid->bobot}}</td>
                                <td>{{$p->skoraktual}}</td>
                                <td>{{$p->skorake}}</td>
                                <td class="bg-warning text-white">{{$p->skorpph}}</td>
                                <td>{{$p->bahanpanganpphid->skormaks}}</td>        
                          </tr>
                          @endforeach
                        <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{$pphkonsumsi->sum('kkal')}}</td>
                        <td>{{$pphkonsumsi->sum('persen')}}</td>
                        <td>{{$pphkonsumsi->sum('ake')}}</td>
                        <td></td>
                        <td>{{$pphkonsumsi->sum('skoraktual')}}</td>
                        <td>{{$pphkonsumsi->sum('skorake')}}</td>
                        <td class="bg-warning text-white">{{$pphkonsumsi->sum('skorpph')}}</td>
                        <td>{{$totalSkormaks}}</td>
                        </tr>
                        </tbody>
                      </table>
                    
            
                </div>
            </div>
        </div>
    </div>
   </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Skor PPH Ketersediaan</h6>
                </div>
    
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th scope="col">No</th>
                                <th scope="col">Kelompok Bahan Pangan</th>
                                <th scope="col">Energi (Kalori)</th>
                                <th scope="col">% AKE</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Skor Riil</th>
                                <th scope="col">Skor PPH</th>
                                <th scope="col">Skor Maks</th>
                              </tr>
                            </thead>
                            @php
                            $skormaksValues = $pphketersediaan->pluck('bahanpanganpphid.skormaks');
                            $totalSkormaks = $skormaksValues->sum();
                            @endphp
                            <tbody>
                                @foreach ($pphketersediaan as $u)
                              <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$u->bahanpanganpphid->bahanpangan}}</td>
                                    <td>
                                      {{$u->energi}}
                                    </td>
                                    <td>{{$u->ake}}</td>
                                    <td>{{$u->bahanpanganpphid->bobot}}</td>
                                    <td  class="bg-info text-white">{{$u->skorriil}}</td>
                                    <td class="bg-warning text-white">{{$u->skorpph}}</td>
                                    <td>{{$u->bahanpanganpphid->skormaks}}</td>     
                              </tr>
                              @endforeach
                            <tr>
                            <td colspan="2">Jumlah</td>
                            <td>{{$pphketersediaan->sum('energi')}}</td>
                            <td>{{$pphketersediaan->sum('ake')}}</td>
                            <td></td>
                            <td class="bg-info text-white">{{$pphketersediaan->sum('skorriil')}}</td>
                            <td class="bg-warning text-white">{{$pphketersediaan->sum('skorpph')}}</td>
                            <td>{{$totalSkormaks}}</td>
                            </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
