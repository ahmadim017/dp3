<table class="table">
    <thead>
        <tr><th colspan="10" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="10" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="10" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
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