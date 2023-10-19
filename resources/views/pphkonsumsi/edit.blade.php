@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Edit Data</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
	<form action="{{route('pphkonsumsi.update',[$pphkonsumsi->id])}}" method="POST">
	@csrf
	@method('PUT')
          <div class="table-responsive">
<table class="table">
  <tr>
      <th class="bg-light" width="200">Kelompok Bahan Pangan</th>
      <td colspan="3"> <div class="col-6">
			<select name="id_bahanpangan" class="form-control {{$errors->first('id_bahanpangan') ? "is-invalid" : ""}}" >
				@foreach($bahanpangan as $p)
				<option @if($pphkonsumsi->id_bahanpangan == $p->id) selected @endif value="{{$p->id}}">{{$p->bahanpangan}}</option>
				@endforeach
	    		</select>
          <div class="invalid-feedbeck"> {{$errors->first('id_bahanpangan')}}</div>
</td>
  </tr>

  <tr>
    <th class="bg-light">KKAL/Kapita</th>
<td colspan="3"><div class="input-group col-6">
                <input type="text" name="kkal" value="{{$pphkonsumsi->kkal}}" placeholder="kkal/kapita" class="form-control {{$errors->first('kkal') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                </div>
       <div class="invalid-feedbeck"> {{$errors->first('kkal')}}</div>
</td>
</tr>

<tr>
  <th class="bg-light">%</th>
<td colspan="3"><div class="input-group col-6">
              <input type="text" name="persen" value="{{$pphkonsumsi->persen}}" placeholder="%" class="form-control {{$errors->first('persen') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              </div>
     <div class="invalid-feedbeck"> {{$errors->first('persen')}}</div>
</td>
</tr>

<tr>
  <th class="bg-light">% AKE</th>
<td colspan="3"><div class="input-group col-6">
              <input type="text" name="ake" value="{{$pphkonsumsi->ake}}" placeholder="% Ake" class="form-control {{$errors->first('ake') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              </div>
     <div class="invalid-feedbeck"> {{$errors->first('ake')}}</div>
</td>
</tr>
  

  <tr>
    <th class="bg-light">Bobot</th>
<td colspan="3"><div class="input-group col-6">
                <input type="text" name="bobot" value="{{$pphkonsumsi->bobot}}" class="form-control {{$errors->first('bobot') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                                  </div>
       <div class="invalid-feedbeck"> {{$errors->first('bobot')}}</div>
</td>
</tr>

 <tr>
      <th class="bg-light">Skor Aktual</th>
  <td colspan="3"><div class="input-group col-6">
              		<input type="text" name="skoraktual" value="{{$pphkonsumsi->skoraktual}}" class="form-control {{$errors->first('skoraktual') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              		              		</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('skoraktual')}}</div>
</td>
  </tr>
<tr>
      <th class="bg-light">Skor Ake</th>
  <td colspan="3"><div class="input-group col-6">
              		<input type="text" name="skorake" value="{{$pphkonsumsi->skorake}}" class="form-control {{$errors->first('skorake') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              		              		</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('skorake')}}</div>
</td>
  </tr>

 <tr>
      <th class="bg-light">Skor PPH</th>
  <td colspan="3"><div class="input-group col-6">
              		<input type="text" name="skorpph" value="{{$pphkonsumsi->skorpph}}" class="form-control {{$errors->first('skorpph') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              		              		</div>
	   		<div class="invalid-feedbeck"> {{$errors->first('skorpph')}}</div>
</td>
  </tr>
 <tr>
      <th class="bg-light">Skor Maks</th>
  <td colspan="3"><div class="input-group col-6">
              		<input type="text" name="skormaks" value="{{$pphkonsumsi->skormaks}}" class="form-control {{$errors->first('skormaks') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
              		 </div>
	   		<div class="invalid-feedbeck"> {{$errors->first('skormaks')}}</div>
</td>
  </tr>

<tr>
 <th class="bg-light">tahun</th>
  <td>  <div class="col-6">
	<select name="tahun" class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" >
		@foreach($tahun as $k)
			<option @if($pphkonsumsi->tahun == $k->tahun) selected @endif value="{{$k->tahun}}">{{$k->tahun}}</option>
		@endforeach
	    </select>
            <div class="invalid-feedbeck"> {{$errors->first('tahun')}}</div>
	</div>

  </td>
  </tr>
</table>
</div>
<button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg> Simpan</button>
	<a href="{{route('pphkonsumsi.index')}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
</svg> Kembali</a>
</form>

        </div>
      </div>
  

  </div>
</div>
@endsection