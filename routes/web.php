<?php

use App\Http\Controllers\bahanpanganController;
use App\Http\Controllers\bahanpanganpphController;
use App\Http\Controllers\beritaController;
use App\Http\Controllers\cadanganpanganController;
use App\Http\Controllers\centerpointController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\datakomoditasController;
use App\Http\Controllers\fsvaController;
use App\Http\Controllers\fsvatahunController;
use App\Http\Controllers\jenissampelController;
use App\Http\Controllers\keamananpanganController;
use App\Http\Controllers\kecamatanController;
use App\Http\Controllers\kelurahanController;
use App\Http\Controllers\komoditasController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\nbmController;
use App\Http\Controllers\nbmtahunController;
use App\Http\Controllers\neracapanganController;
use App\Http\Controllers\panelhargaController;
use App\Http\Controllers\pelepasanController;
use App\Http\Controllers\penyaluranController;
use App\Http\Controllers\pphketersediaanController;
use App\Http\Controllers\pphketersediaantahunController;
use App\Http\Controllers\pphkecukupangiziController;
use App\Http\Controllers\pphkonsumsiController;
use App\Http\Controllers\pphkonsumsitahunController;
use App\Http\Controllers\prognosaController;
use App\Http\Controllers\skpgbulanController;
use App\Http\Controllers\skpgController;
use App\Http\Controllers\sosialisasiController;
use App\Http\Controllers\sosialisasiumkmController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\tahunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\usulanController;
use App\Http\Controllers\keamananpanganmasyarakatController;
use App\Http\Controllers\jenispsatController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth.login');});

//route::get('/', [App\Http\Controllers\welcomeController::class, 'index'])->name('portal');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

route::resource('usulan', usulanController::class)->except(['index', 'show'])
->middleware('operator');

route::get('/dashboard/pangan',[App\Http\Controllers\neracapanganController::class,'dash'])->name('neracapangan.dashboard');

    route::get('/dashboard/neracabahanmakan',[App\Http\Controllers\nbmController::class,'dash'])->name('nbm.dashboard');

    route::get('/dashboard/pphkonsumsi',[App\Http\Controllers\pphkonsumsiController::class,'dash'])->name('pphkonsumsi.dashboard');

    route::get('/dashboard/cadanganpangan',[App\Http\Controllers\cadanganpanganController::class,'dash'])->name('cadanganpangan.dashboard');

    route::get('/dashboard/skpg',[App\Http\Controllers\skpgController::class,'dash'])->name('skpg.dashboard');

    route::get('/dashboard/fsva',[App\Http\Controllers\fsvaController::class,'dash'])->name('fsva.dashboard');

    route::get('/dashboard/prognosa',[App\Http\Controllers\prognosaController::class,'dashboard'])->name('prognosa.dashboard');

    route::get('/dashboard/usulan',[App\Http\Controllers\usulanController::class,'dashboard'])->name('usulan.dashboard');

    route::get('/dashboard/panelharga',[App\Http\Controllers\panelhargaController::class,'dashboard'])->name('panelharga.dashboard');

    route::get('/dashboard/panelharga/{id_komoditas}',[App\Http\Controllers\panelhargaController::class,'detail'])->name('panelharga.detail');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/getData', [App\Http\Controllers\ApiController::class, 'getData'])->name('dataharga.get');

    Route::get('/getDataFromAPI', [App\Http\Controllers\datakomoditasController::class, 'getDataFromAPI'])->name('datakomoditas.get');

    Route::get('/getDatapanelharga', [App\Http\Controllers\panelhargaController::class, 'getDataFromAPI'])->name('datapanelharga.get');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    route::get('/portal', [App\Http\Controllers\welcomeController::class, 'index'])->name('portal');

    route::get('/usulan/laporan', [App\Http\Controllers\usulanController::class, 'laporan'])->name('usulan.laporan');

    route::get('/neracapangan/laporan', [App\Http\Controllers\neracapanganController::class, 'laporan'])->name('neracapangan.laporan');
    //route resource

    Route::resource('datakomoditas', datakomoditasController::class);

    Route::resource('panelharga',panelhargaController::class);

    Route::resource('user', userController::class);

    Route::resource('menu', menuController::class);

    route::resource('berita', beritaController::class);

    Route::resource('komoditas', komoditasController::class);

    Route::resource('tahun', tahunController::class);

    Route::resource('bahanpangan', bahanpanganController::class);

    route::resource('neracapangan', neracapanganController::class);

    route::resource('nbm', nbmController::class);
    
    route::resource('pphketersediaan', pphketersediaanController::class);

    route::resource('pphkonsumsi', pphkonsumsiController::class);

    route::resource('cadanganpangan', cadanganpanganController::class);

    route::resource('penyaluran', penyaluranController::class);

    route::resource('pelepasan', pelepasanController::class);

    Route::resource('centre-point',centerpointController::class);

    route::resource('space', SpaceController::class);

    route::resource('skpg', skpgController::class);

    route::resource('prognosa', prognosaController::class);

    route::resource('keamananpangan', keamananpanganController::class);
	
    route::resource('keamananpanganmasyarakat', keamananpanganmasyarakatController::class);

    route::resource('jenissampel', jenissampelController::class);

    route::resource('jenispsat', jenispsatController::class);

    route::resource('kecamatan', kecamatanController::class);

    route::resource('kelurahan', kelurahanController::class);

    route::resource('sosialisasipsat', sosialisasiController::class);

    route::resource('sosialisasiumkm', sosialisasiumkmController::class);

    route::resource('fsva', fsvaController::class);

    route::resource('fsvatahun', fsvatahunController::class);

    route::resource('nbmtahun', nbmtahunController::class);

    route::resource('bahanpanganpph', bahanpanganpphController::class);

    route::resource('pphketersediaantahun', pphketersediaantahunController::class);

    route::resource('pphkonsumsitahun', pphkonsumsitahunController::class);

    route::resource('skpgbulan', skpgbulanController::class);

    route::resource('pphkecukupangizi', pphkecukupangiziController::class);
    
    route::resource('usulan', usulanController::class)->only(['index', 'show','proses'])
    ->middleware('admin');

    //-----------------------//

    Route::put('usulan/{id}/proses', [\App\Http\Controllers\usulanController::class, 'proses'])->name('usulan.proses');
	
    Route::put('usulan/{id}/reject', [\App\Http\Controllers\usulanController::class, 'reject'])->name('usulan.reject');


    //----impor csv/excel-------//

    Route::post('penyaluran/import/{id}',[\App\Http\Controllers\penyaluranController::class, 'import'])->name('penyaluran.import');

    Route::post('pelepasan/import/{id}',[\App\Http\Controllers\pelepasanController::class, 'import'])->name('pelepasan.import');

    Route::post('fsva/import/{id}',[\App\Http\Controllers\fsvaController::class, 'import'])->name('fsva.import');

    //-----------export excel-------//

    route::get('export/jenissampel',[jenissampelController::class, 'export_excel'])->name('jenissampel.export');

    route::get('export/penyaluran',[penyaluranController::class, 'export_excel'])->name('penyaluran.export');

    route::get('export/usulan',[usulanController::class, 'export_excel'])->name('usulan.export');

    Route::post('export/neracapangan', [neracapanganController::class, 'export_excel'])->name('neracapangan.export');

    Route::post('export/nbm', [nbmController::class, 'export_excel'])->name('nbm.export');

    Route::post('export/pphketersediaan', [pphketersediaanController::class, 'export_excel'])->name('pphketersediaan.export');

    Route::post('export/pphkonsumsi', [pphkonsumsiController::class, 'export_excel'])->name('pphkonsumsi.export');

    Route::post('export/cadanganpangan', [cadanganpanganController::class, 'export_excel'])->name('cadanganpangan.export');

    Route::post('export/sosialisasiumkm', [sosialisasiumkmController::class, 'export_excel'])->name('sosialisasiumkm.export');

    Route::post('export/sosialisasipsat', [sosialisasiController::class, 'export_excel'])->name('sosialisasipsat.export');

    Route::get('export/prognosa', [prognosaController::class, 'export_excel'])->name('prognosa.export');

    Route::post('export/skpg', [skpgController::class, 'export_excel'])->name('skpg.export');

    //--------------------------------------------------------//

    //---map---//

    Route::get('/centrepoint/data',[DataController::class,'centrepoint'])->name('centre-point.data');

    Route::get('/spaces/data',[DataController::class,'spaces'])->name('data-space');

    Route::get('/map',[App\Http\Controllers\MapController::class,'index'])->name('map.index');
    
    Route::get('/map/keamananpangan',[App\Http\Controllers\keamananpanganController::class,'map'])->name('mapkeamananpangan.index');

    Route::get('/map/{slug}',[App\Http\Controllers\MapController::class,'show'])->name('map.show');

    //------------------------------------------------//

    //--download--//

    route::get('/spaces/{id}/download',[SpaceController::class,'download'])->name('spaces.download');

    route::get('/cadanganpangan/{id}/download',[\App\Http\Controllers\cadanganpanganController::class,'download'])->name('cadanganpangan.download');

    route::get('/sosialisasi/{id}/download',[\App\Http\Controllers\sosialisasiController::class,'download'])->name('sosialisasipsat.download');

    route::get('/sosialisasiumkm/{id}/download',[\App\Http\Controllers\sosialisasiumkmController::class,'download'])->name('sosialisasiumkm.download');

    route::get('/keamananpangan/{id}/download',[\App\Http\Controllers\keamananpanganController::class,'download'])->name('keamananpangan.download');

    route::get('/usulan/{id}/download',[\App\Http\Controllers\usulanController::class,'download'])->name('usulan.download');

    route::get('/nbmtahun/{id}/download',[\App\Http\Controllers\nbmtahunController::class,'download'])->name('nbmtahun.download');

    route::get('/pphkonsumsitahun/{id}/download',[\App\Http\Controllers\pphkonsumsitahunController::class,'download'])->name('pphkonsumsitahun.download');

    route::get('/pphketersediaantahun/{id}/download',[\App\Http\Controllers\pphketersediaantahunController::class,'download'])->name('pphketersediaantahun.download');

    //----dashboard---//

    

    //--------------------//


    route::get('/cadanganpangan/{id}/daftarpenyaluran',[\App\Http\Controllers\cadanganpanganController::class, 'daftarpenyaluran'])->name('daftarpenyaluran.create');

    route::get('/cadanganpangan/{id}/daftarpelepasan',[\App\Http\Controllers\cadanganpanganController::class, 'daftarpelepasan'])->name('daftarpelepasan.create');

    route::get('/keamananpangan/{id}/jenissampel',[\App\Http\Controllers\keamananpanganController::class, 'jenissampel'])->name('daftarsampel.create');

    route::get('/nbmtahun/{id}/jenispangan',[\App\Http\Controllers\nbmtahunController::class, 'jenispangan'])->name('jenispangan.create');

    route::get('/sosialisasi/{id}/jenispsat',[\App\Http\Controllers\sosialisasiController::class, 'jenispsat'])->name('jenispsat.create');

    route::get('/pphketersdiaantahun/{id}/ketersediaan',[\App\Http\Controllers\pphketersediaantahunController::class, 'ketersediaan'])->name('ketersediaan.create');

    route::get('/pphkonsumsitahun/{id}/konsumsi',[\App\Http\Controllers\pphkonsumsitahunController::class, 'konsumsi'])->name('konsumsi.create');

    route::get('/pphkonsumsitahun/{id}/kecukupangizi',[\App\Http\Controllers\pphkonsumsitahunController::class, 'kecukupangizi'])->name('kecukupangizi.create');

    route::get('/skpgbulan/{id}/skpg',[\App\Http\Controllers\skpgbulanController::class, 'skpg'])->name('skpgtable.create');
	
    route::get('/fsvatahun/{id}/fsva',[\App\Http\Controllers\fsvatahunController::class, 'fsva'])->name('fsva.create');

  
    //-----cetak----//

    Route::get('/keamananpangan/{id}/cetak_pdf',[\App\Http\Controllers\keamananpanganController::class, 'cetak_pdf'])->name('keamananpangan.cetak');

    Route::get('/sosialisasi/{id}/cetak_pdf',[\App\Http\Controllers\sosialisasiController::class, 'cetak_pdf'])->name('sosialisasipsat.cetak');

    Route::get('/cetak_pdf', [jenissampelController::class, 'cetak_pdf'])->name('jenissampel.cetak');

    Route::get('/daftarpenyaluran/cetak', [penyaluranController::class, 'cetak_pdf'])->name('daftarpenyaluran.cetak');

    Route::get('/daftarusulan/cetak', [usulanController::class, 'cetak_pdf'])->name('usulan.cetak');


    //----ganti pasword---//

    Route::get('/password',[\App\Http\Controllers\passwordController::class, 'password'])->name('user.password');

    Route::patch('password',[\App\Http\Controllers\passwordController::class, 'gantipassword'])->name('user.gantipassword');
});