<table class="table">
    <thead>
        <tr><th colspan="5" ><b>Pemerintah Kota Balikpapan</b></th></tr>
        <tr><th colspan="5" ><b>DINAS PANGAN, PERTANIAN DAN PERIKANAN</b></th></tr>
        <tr><th colspan="5" ><b>Jl. Marsma Iswahyudi, Gunung Bahagia, Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</b></th></tr>
        <tr><th></th></tr>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Jenis Bahan Makanan</th>
        <th scope="col">Kalori (kkal/hari)</th>
        <th scope="col">Protein (gram/hari)</th>
        <th scope="col">Lemak (gram/hari)</th>
      </tr>
    </thead>
          <tbody>
            @foreach ($nbm as $u)
            <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$u->bahanpanganid->bahanpangan}}</td>
                  <td>{{round($u->kalori,3)}}</td>
                  <td >{{round($u->protein,3)}}</td>
                  <td>{{round($u->lemak,3)}}</td>
                        
            </tr>
          
            @endforeach
          <tr class="bg-secondary text-white">
          <td colspan="2">Jumlah</td>
          <td>{{$nbm->sum('kalori')}}</td>
          <td >{{$nbm->sum('protein')}}</td>
          <td>{{$nbm->sum('lemak')}}</td>
          </tr>
          <tr class="bg-secondary text-white">
          <td colspan="2">Rata-rata AKG (WNPG)</td>
          <td>2400</td>
          <td >63</td>
          <td>57</td>
          </tr>
          <tr class="bg-secondary text-white">
          <td colspan="2">Persentase Ketersediaan AKG %</td>
          <td>{{round($nbm->sum('kalori') / 2400 * 100,2)}}</td>
          <td>{{round($nbm->sum('protein') /63 * 100,2)}}</td>
          <td>{{round($nbm->sum('protein') /57 * 100,2)}}</td>
          </tr>
      
          </tbody>
  </table>