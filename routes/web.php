<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZonaIntegrasi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SampulController;
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\SubMapelController;
use App\Http\Controllers\JenisMapelController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\KepemimpinanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontEndController::class, 'index']);
Route::get('/profil', [FrontEndController::class, 'profil']);
Route::get('/guru-staff', [FrontEndController::class, 'guru_staff']);
Route::get('/kurikulum', [FrontEndController::class, 'kurikulum']);
Route::get('/sarana', [FrontEndController::class, 'sarana']);
Route::get('/siswa', [FrontEndController::class, 'siswa']);
Route::get('/prestasi', [FrontEndController::class, 'prestasi']);
Route::get('/ppdb', [FrontEndController::class, 'ppdb']);
Route::get('/news', [FrontEndController::class, 'news']);
Route::get('/zona-integritas', [FrontEndController::class, 'zona_integrasi']);
Route::get('/humas', [FrontEndController::class, 'humas']);
Route::get('/layanan', [FrontEndController::class, 'layanan']);
Route::get('/news/{post:slug}', [FrontEndController::class, 'news_detail']);
Route::get('/zona-integritas/{post:slug}', [FrontEndController::class, 'integrasi_detail']);

Route::post('/comment-news/{post:slug}', [CommentController::class, 'comment']);
Route::get('/render-comment/{id}', [CommentController::class, 'render_news']);

// AUTH
Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/gallery', [FrontEndController::class, 'gallery']);


Route::group(['middleware' => 'auth'], function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register-create', [AuthController::class, 'create']);
    Route::get('/dataTablesUser', [AuthController::class, 'dataTables']);
    Route::get('/editUser/{id}', [AuthController::class, 'edit_user'])->middleware('auth');
    Route::post('/updateUser', [AuthController::class, 'update_user'])->middleware('auth');
    Route::post('/deleteUser/{uuid}', [AuthController::class, 'delete_user'])->middleware('auth');

    Route::get('/admin/home', [HomeController::class, 'index']);
    Route::get('/render-home', [HomeController::class, 'render_home']);
    Route::post('/update-home', [HomeController::class, 'update_home']);
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/admin/profil', [ProfilController::class, 'index']);
    Route::get('/render-profil', [ProfilController::class, 'render_profil']);
    Route::post('/update-profil', [ProfilController::class, 'update_profil']);
    Route::post('/update-tujuan', [ProfilController::class, 'update_tujuan']);

    Route::get('/admin/sambutan', [SambutanController::class, 'index']);
    Route::get('/render-sambutan', [SambutanController::class, 'render_sambutan']);
    Route::post('/update-sambutan', [SambutanController::class, 'update_sambutan']);

    Route::get('/admin/information', [InformationController::class, 'index']);
    Route::get('/render-form-informasi', [InformationController::class, 'render_informasi']);
    Route::get('/dataTablesInformation', [InformationController::class, 'dataTables']);
    Route::post('/update-informasi', [InformationController::class, 'update']);

    Route::get('/admin/sarana', [SaranaController::class, 'index']);
    Route::get('/dataTablesSarana', [SaranaController::class, 'dataTables']);
    Route::get('/dataTablesFasilitas', [SaranaController::class, 'dataTablesFasilitas']);
    Route::get('/render-form-sarana', [SaranaController::class, 'render_sarana']);
    Route::post('/update-sarana', [SaranaController::class, 'update']);
    Route::post('/add-fasilitas', [SaranaController::class, 'add_fasilitas']);
    Route::delete('/delete-fasilitas/{fasilitas:uuid}', [SaranaController::class, 'delete_fasilitas']);
    Route::put('/update-fasilitas/{fasilitas:uuid}', [SaranaController::class, 'update_fasilitas']);
    Route::get('/render-photo-fasilitas/{fasilitas:uuid}', [SaranaController::class, 'render_photo_fasilitas']);
    Route::post('/store-photo/{fasilitas:uuid}', [SaranaController::class, 'store_photo']);
    Route::delete('/destroy-photo-fasilitas/{fasilitas:uuid}', [SaranaController::class, 'destroy_photo']);

    Route::resource('/admin/komponen', KomponenController::class);
    Route::get('/dataTablesKomponen', [KomponenController::class, 'dataTables']);

    Route::resource('/admin/kepemimpinan', KepemimpinanController::class);
    Route::get('/dataTablesKepemimpinan', [KepemimpinanController::class, 'dataTables']);

    Route::get('/admin/lokasi', [LokasiController::class, 'index']);
    Route::get('/render-lokasi', [LokasiController::class, 'render_lokasi']);
    Route::post('/update-lokasi', [LokasiController::class, 'update']);

    Route::get('/admin/gallery', [GalleryController::class, 'index']);
    Route::get('/render-gallery', [GalleryController::class, 'render_gallery']);
    Route::post('/store-photo-gallery', [GalleryController::class, 'store']);
    Route::delete('/destroy-gallery/{gallery:uuid}', [GalleryController::class, 'destroy']);

    Route::resource('/admin/pegawai', PegawaiController::class);
    Route::get('/dataTablesGuru', [PegawaiController::class, 'dataTablesGuru']);
    Route::get('/dataTablesStaff', [PegawaiController::class, 'dataTablesStaff']);

    //TAHUN AJARAN
    Route::resource('/tahun_ajaran', TahunAjaranController::class);
    Route::get('/changeTahunAjaran', [TahunAjaranController::class, 'tahun_aktif']);
    Route::get('/refreshTahunAjaran', [TahunAjaranController::class, 'refresh_tahun_aktif']);
    Route::get('/datatablesTahunAjaran', [TahunAjaranController::class, 'dataTables']);

    Route::resource('/admin/siswa', SiswaController::class);
    Route::get('/dataTablesSiswa', [SiswaController::class, 'dataTables']);

    Route::resource('/admin/prestasi', PrestasiController::class);
    Route::get('/dataTablesPrestasi', [PrestasiController::class, 'dataTables']);



    Route::resource('/admin/ppdb', PPDBController::class);
    Route::delete('/delete-ppdb/{uuid}', [PPDBController::class, 'destroy2']);
    Route::get('/admin/ppdb/edit/{uuid}', [PPDBController::class, 'edit']);
    Route::put('/admin/ppdb/update/{uuid}', [PPDBController::class, 'update']);
    Route::get('/dataTablesPPDBPrestasi', [PPDBController::class, 'dataTablesPrestasi']);
    Route::get('/dataTablesPPDBRegular', [PPDBController::class, 'dataTablesRegular']);
    Route::get('/render-link-ppdb', [PPDBController::class, 'render_view_link']);
    Route::post('/update-ppdb', [PPDBController::class, 'update_ppdb']);
    Route::post('/update-ulang', [PPDBController::class, 'update_ulang']);

    Route::resource('/admin/sampul', SampulController::class);
    Route::post('/store-home', [SampulController::class, 'store_home']);
    Route::post('/store-profil', [SampulController::class, 'store_profil']);
    Route::post('/store-guru', [SampulController::class, 'store_guru']);
    Route::post('/store-kurikulum', [SampulController::class, 'store_kurikulum']);
    Route::post('/store-siswa', [SampulController::class, 'store_siswa']);
    Route::post('/store-prestasi', [SampulController::class, 'store_prestasi']);
    Route::post('/store-ppdb', [SampulController::class, 'store_ppdb']);
    Route::post('/store-berita', [SampulController::class, 'store_berita']);
    Route::post('/store-sarana', [SampulController::class, 'store_sarana']);
    Route::post('/store-humas', [SampulController::class, 'store_humas']);
    Route::post('/store-layanan', [SampulController::class, 'store_layanan']);
    Route::post('/store-gallery', [SampulController::class, 'store_gallery']);
    Route::post('/store-integrity', [SampulController::class, 'store_integrity']);
    Route::post('/update-sampul-link', [SampulController::class, 'store_link']);
    Route::post('/update-sampul-link-bawah', [SampulController::class, 'store_link_bawah']);
    Route::get('/render-sampul', [SampulController::class, 'render_sampul']);

    Route::resource('/admin/jenis-mapel', JenisMapelController::class);
    Route::get('/dataTablesJenisMapel', [JenisMapelController::class, 'dataTables']);

    Route::resource('/admin/mapel', MapelController::class);
    Route::get('/dataTablesMapel', [MapelController::class, 'dataTables']);

    Route::resource('/admin/sub-mapel', SubMapelController::class);
    Route::get('/dataTablesSubMapel', [SubMapelController::class, 'dataTables']);

    Route::resource('/admin/category-news', CategoryController::class);
    Route::get('/admin/get-data-news/{category:uuid}', [CategoryController::class, 'edit']);
    Route::put('/update-category-news/{category:uuid}', [CategoryController::class, 'update']);
    Route::delete('/delete-category-news/{category:uuid}', [CategoryController::class, 'destroy']);
    Route::get('/dataTablesCategories', [CategoryController::class, 'dataTables']);


    Route::resource('/admin/news', PostController::class);
    Route::get('/edit-news/{post:slug}', [PostController::class, 'edit']);
    Route::get('/show-news/{post:slug}', [PostController::class, 'show']);
    Route::put('/update-news/{post:slug}', [PostController::class, 'update']);
    Route::delete('/delete-news/{post:slug}', [PostController::class, 'destroy']);
    Route::get('/cekSlug', [PostController::class, 'cekSlug']);
    Route::resource('/admin/sosmed', SosmedController::class);
    Route::get('/dataTablesSosmed', [SosmedController::class, 'dataTables']);
    Route::get('/render-form-sosmed', [SosmedController::class, 'render_sosmed']);

    Route::resource('/admin/zona-integrasi', ZonaIntegrasi::class);

    Route::resource('/admin/generate-color', ColorController::class);
    Route::get('/render-view-home', [ColorController::class, 'render_view']);
});
