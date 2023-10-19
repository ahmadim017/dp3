@extends('layouts.sbadmin')

@section('content')
<div class="col-md-12">
  <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-secondary">Tambah Data Kecukupan Gizi</h6>
      </a>
  
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">

          <form action="{{route('pphkecukupangizi.store')}}" method="POST">
            @csrf
                <div class="row">
                <div class="col-12">
             
              <div class="table-responsive">
                    <table class="table"> 
                   <thead> 
                        <tr class="">
                          <th scope="col">No</th>
                          <th scope="col">Kelompok Bahan Pangan</th>
                          <th scope="col">kkal/kapita</th>
                          <th scope="col">gram/kapita</th>
                          <th scope="col">Tahun</th>
                        </tr>
                    </thead>
                    @foreach($bahanpanganpph as $b)
                    <tr> 
                      <td>
                       {{$loop->iteration}}
                      </td> 
                      <td>
                        <div class="input-group">
                          <label for="">{{$b->bahanpangan}}</label>
                        </div>
                          <input name="pphkecukupangizi[{{$loop->index}}][id_bahanpangan]" value="{{$b->id}}" type="hidden">
                          <input name="pphkecukupangizi[{{$loop->index}}][id_tahun]" value="{{$pphkonsumsitahun->id}}" type="hidden">
                      </td> 
                      <td>
                              <div class="input-group">
                                <input type="text" name="pphkecukupangizi[{{$loop->index}}][kkal]" value="{{old('kkal')}}" placeholder="kkal/kapita" class="form-control {{$errors->first('kkal') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                              </div>
                              <div class="invalid-feedbeck"> {{$errors->first('pphkecukupangizi.' . $loop->index . '.kkal')}}</div>
                            </td> 
                            <td>
                              <div class="input-group">
                                <input type="text" name="pphkecukupangizi[{{$loop->index}}][gram]" value="{{old('gram')}}" placeholder="gram/kapita" class="form-control {{$errors->first('gram') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                              </div>
                              <div class="invalid-feedbeck"> {{$errors->first('pphkecukupangizi.' . $loop->index . '.gram')}}</div>
                            </td> 
                            <td>
                              <div class="input-group">
                                <input type="text" name="pphkecukupangizi[{{$loop->index}}][tahun]" value="{{$pphkonsumsitahun->tahun}}" class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" aria-describedby="basic-addon2">
                              </div>
                               <div class="invalid-feedbeck">  {{$errors->first('pphkecukupangizi.' . $loop->index . '.tahun')}}</div>
                            </td> 

                                    </tr>
                      @endforeach
                    </table>
              </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg> Simpan</button>
                <a href="{{route('pphkonsumsitahun.show',[$pphkonsumsitahun->id])}}" class="btn btn-secondary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                  <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                  <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                </svg> Kembali</a>
                    </form>


	
        </div>
      </div>
  

  </div>
</div>
@endsection