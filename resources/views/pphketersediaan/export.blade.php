<table class="table">
    <thead>
        <tr><th colspan="8" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="8" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="8" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
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