<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AmalTkAbaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSKController;
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\MenuAisyiyahController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardKajianController;
use App\Http\Controllers\DashboardSejarahController;
use App\Http\Controllers\MenuAngkatanMudaController;
use App\Http\Controllers\MenuMuhammadiyahController;
use App\Http\Controllers\AmalMasjidAlAmienController;
use App\Http\Controllers\DashboardStrukturController;
use App\Http\Controllers\AmalMasjidAlHikmahController;
use App\Http\Controllers\AmalMasjidAlIkhsanController;
use App\Http\Controllers\DashboardCategoriesController;
use App\Http\Controllers\DashboardInventarisController;
use App\Http\Controllers\DashboardMusyawarahController;
use App\Http\Controllers\AmalMasjidAlKhasanahController;
use App\Http\Controllers\AmalMasjidBaiturohmanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\AmalMasjidSafinatullahController;
use App\Http\Controllers\DashboardBiodataPimpinanController;
use App\Http\Controllers\DashboardPelaksanaanProgramController;

Route::get('/welcome', function () {
    return Inertia::render('welcome');
});
Route::get('/home', [PostController::class, 'cekHome']);

//Login Controller
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login')
    ->middleware('guest');//middleware digunakan untuk hanya user guest yang bisa akses
    Route::Post('/login', 'authenticate');

    Route::post('/logout', 'logout');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::controller(RegisterController::class)->group(function (){
    
    Route::get('/register', 'index')
    ->middleware('guest');
    Route::post('/register','store')->name('register');
});

Route::get('/contact-us', function () {
    return Inertia::render('contact');
});


Route::get('/', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::get('/categories/{category:slug}', [PostController::class, 'postByCategory']);
Route::get('authors/{author:username}', [PostController::class, 'postByAuthor']);
Route::get('/search', [PostController::class, 'search']);


// Lingkup
Route::get('/view/muhammadiyah',[MenuMuhammadiyahController::class, 'index']);
Route::get('/musyawarah/muhammadiyah',[MenuMuhammadiyahController::class, 'showMusyawarah']);
Route::get('/musyawarah/muhammadiyah/{slug}',[MenuMuhammadiyahController::class, 'detailMusyawarah']);
Route::get('/struktur/muhammadiyah',[MenuMuhammadiyahController::class, 'showStruktur']);
Route::get('/sk/muhammadiyah/{slug}',[MenuMuhammadiyahController::class, 'showSK']);
Route::get('/kajian/muhammadiyah/{slug}',[MenuMuhammadiyahController::class, 'showKajian']);
Route::get('/pelaksana/muhammadiyah/{slug}',[MenuMuhammadiyahController::class, 'showPelaksana']);
Route::get('/inventaris/muhammadiyah',[MenuMuhammadiyahController::class, 'showInventaris']);
Route::get('/inventaris/muhammadiyah/{slug}',[MenuMuhammadiyahController::class, 'detailInventaris']);

Route::get('/view/aisyiyah',[MenuAisyiyahController::class, 'index']);
Route::get('/musyawarah/aisyiyah',[MenuAisyiyahController::class, 'showMusyawarah']);
Route::get('/musyawarah/aisyiyah/{slug}',[MenuAisyiyahController::class, 'detailMusyawarah']);
Route::get('/struktur/aisyiyah',[MenuAisyiyahController::class, 'showStruktur']);
Route::get('/sk/aisyiyah/{slug}',[MenuAisyiyahController::class, 'showSK']);
Route::get('/kajian/aisyiyah/{slug}',[MenuAisyiyahController::class, 'showKajian']);
Route::get('/pelaksana/aisyiyah/{slug}',[MenuAisyiyahController::class, 'showPelaksana']);
Route::get('/inventaris/aisyiyah',[MenuAisyiyahController::class, 'showInventaris']);
Route::get('/inventaris/aisyiyah/{slug}',[MenuAisyiyahController::class, 'detailInventaris']);

Route::get('/view/angkatanMuda',[MenuAngkatanMudaController::class, 'index']);
Route::get('/musyawarah/angkatanMuda',[MenuAngkatanMudaController::class, 'showMusyawarah']);
Route::get('/musyawarah/angkatanMuda/{slug}',[MenuAngkatanMudaController::class, 'detailMusyawarah']);
Route::get('/pemudaMuhammadiyah/angkatanMuda',[MenuAngkatanMudaController::class, 'showPemuda']);
Route::get('/nasyiatulAisyiyah/angkatanMuda',[MenuAngkatanMudaController::class, 'showPemuda']);
Route::get('/syiar/angkatanMuda',[MenuAngkatanMudaController::class, 'showSyiar']);
Route::get('/syiar/angkatanMuda/{slug}',[MenuAngkatanMudaController::class, 'detailSyiar']);
Route::get('/baksos/angkatanMuda',[MenuAngkatanMudaController::class, 'showBaksos']);
Route::get('/baksos/angkatanMuda/{slug}',[MenuAngkatanMudaController::class, 'detailBaksos']);

Route::get('/kabar', [PostController::class, 'postByKabar']);

Route::get('kategori/kajian',[KajianController::class, 'index']);
Route::get('kajian/{kajian:slug}', [KajianController::class, 'show']);
Route::get('authors/kajian/{author:username}', [KajianController::class, 'postByAuthor']);
Route::get('speaker/kajian/{kajian:speaker}', [KajianController::class, 'postBySpeaker']);
Route::get('/kategori/{slug}', [KajianController::class, 'postByCategory']);
// Route::get('/kajian/search', [KajianController::class, 'search']);

Route::get('{sejarah:slug}', [SejarahController::class, 'show']);

// Amal Usaha
// Route::get('/amal/tkAba',[AmalTkAbaController::class, 'index']);
Route::get('/amal/tkAba',[AmalTkAbaController::class, 'sejarah']);
Route::get('/sejarah/tkAba',[AmalTkAbaController::class, 'sejarah']);
Route::get('/prestasi/tkAba',[AmalTkAbaController::class, 'prestasi']);
Route::get('/prestasi/tkAba/{slug}',[AmalTkAbaController::class, 'detailPrestasi']);

// Route::get('/amal/masjidAlAmien',[AmalMasjidAlAmienController::class, 'index']);
Route::get('/amal/masjidAlAmien',[AmalMasjidAlAmienController::class, 'showSejarah']);
Route::get('/sejarah/masjidAlAmien',[AmalMasjidAlAmienController::class, 'showSejarah']);
Route::get('/sk/masjidAlAmien',[AmalMasjidAlAmienController::class, 'showSK']);
Route::get('/struktur/masjidAlAmien',[AmalMasjidAlAmienController::class, 'showStruktur']);
Route::get('/kajian/masjidAlAmien/{slug}',[AmalMasjidAlAmienController::class, 'showKajian']);

Route::get('/amal/masjidSafinatullah',[AmalMasjidSafinatullahController::class, 'index']);
Route::get('/sejarah/masjidSafinatullah',[AmalMasjidSafinatullahController::class, 'showSejarah']);
Route::get('/sk/masjidSafinatullah',[AmalMasjidSafinatullahController::class, 'showSK']);
Route::get('/struktur/masjidSafinatullah',[AmalMasjidSafinatullahController::class, 'showStruktur']);
Route::get('/kajian/masjidSafinatullah/{slug}',[AmalMasjidSafinatullahController::class, 'showKajian']);

// Route::get('/amal/masjidBaiturohman',[AmalMasjidBaiturohmanController::class, 'index']);
Route::get('/amal/masjidBaiturohman',[AmalMasjidBaiturohmanController::class, 'showSejarah']);
Route::get('/sejarah/masjidBaiturohman',[AmalMasjidBaiturohmanController::class, 'showSejarah']);
Route::get('/sk/masjidBaiturohman',[AmalMasjidBaiturohmanController::class, 'showSK']);
Route::get('/struktur/masjidBaiturohman',[AmalMasjidBaiturohmanController::class, 'showStruktur']);
Route::get('/kajian/masjidBaiturohman/{slug}',[AmalMasjidBaiturohmanController::class, 'showKajian']);

// Route::get('/amal/masjidAlIkhsan',[AmalMasjidAlIkhsanController::class, 'index']);
Route::get('/amal/masjidAlIkhsan',[AmalMasjidAlIkhsanController::class, 'showSejarah']);
Route::get('/sejarah/masjidAlIkhsan',[AmalMasjidAlIkhsanController::class, 'showSejarah']);
Route::get('/sk/masjidAlIkhsan',[AmalMasjidAlIkhsanController::class, 'showSK']);
Route::get('/struktur/masjidAlIkhsan',[AmalMasjidAlIkhsanController::class, 'showStruktur']);
Route::get('/kajian/masjidAlIkhsan/{slug}',[AmalMasjidAlIkhsanController::class, 'showKajian']);


// Route::get('/amal/masjidAlKhasanah',[AmalMasjidAlKhasanahController::class, 'index']);
Route::get('/amal/musholaAlKhasanah',[AmalMasjidAlKhasanahController::class, 'showSejarah']);
Route::get('/sejarah/musholaAlKhasanah',[AmalMasjidAlKhasanahController::class, 'showSejarah']);
Route::get('/sk/musholaAlKhasanah',[AmalMasjidAlKhasanahController::class, 'showSK']);
Route::get('/struktur/musholaAlKhasanah',[AmalMasjidAlKhasanahController::class, 'showStruktur']);
Route::get('/kajian/musholaAlKhasanah/{slug}',[AmalMasjidAlKhasanahController::class, 'showKajian']);

// Route::get('/amal/masjidAlHikmah',[AmalMasjidAlHikmahController::class, 'index']);
Route::get('/amal/musholaAlHikmah',[AmalMasjidAlHikmahController::class, 'showSejarah']);
Route::get('/sejarah/musholaAlHikmah',[AmalMasjidAlHikmahController::class, 'showSejarah']);
Route::get('/sk/musholaAlHikmah',[AmalMasjidAlHikmahController::class, 'showSK']);
Route::get('/struktur/musholaAlHikmah',[AmalMasjidAlHikmahController::class, 'showStruktur']);
Route::get('/kajian/musholaAlHikmah/{slug}',[AmalMasjidAlHikmahController::class, 'showKajian']);


Route::get('/dashboard/home',[DashboardController::class, 'index'])
->middleware('auth');
Route::get('/download/{filename}', [DashboardController::class, 'download'])->name('download');
Route::get('/download-image/{filename}', [DashboardController::class, 'downloadImage'])->name('downloadImage')
->where('filename', '.*'); // agar mendukung file dengan spasi dll;


// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });


// Route manual untuk checkSlug
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
// Route resource untuk dashboard posts
Route::resource('/dashboard/posts', DashboardPostController::class);
// Route::post('/dashboard/posts/{slug}', [DashboardPostController::class, 'update']);
// Route::put('/dashboard/posts/{post:slug}', [DashboardPostController::class, 'update']);

Route::get('/dashboard/categories/checkSlug', [DashboardCategoriesController::class,'checkSlug']);
Route::resource('/dashboard/categories', DashboardCategoriesController::class);
// Route::get('/dashboard/categories/checkSlug', [DashboardCategoriesController::class,'checkSlug'])
// ->middleware('auth');
// Route::resource('/dashboard/categories', DashboardCategoriesController::class)
// ->middleware('auth');

Route::get('/dashboard/user/checkSlug', [DashboardUserController::class,'checkSlug']);
Route::resource('/dashboard/user', DashboardUserController::class);
Route::get('/dashboard/exportUsers', [DashboardUserController::class, 'export'])->name('users.export');

Route::post('/request-role', [RoleRequestController::class, 'store'])->name('requestRole')
->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/role-requests', [RoleRequestController::class, 'index']);
    Route::patch('/admin/role-requests/{roleRequest}', [RoleRequestController::class, 'update'])->name('admin.updateRequest');
});

// Route::middleware(['auth', 'admin:admin'])->group(function () {
//     Route::get('/admin/role-requests', [RoleRequestController::class, 'index'])->name('admin.roleRequests');
// });

Route::get('/dashboard/sejarah/checkSlug', [DashboardSejarahController::class,'checkSlug']);
Route::resource('/dashboard/sejarah', DashboardSejarahController::class);
// Untuk spoof method PUT dari form.submit("post")
Route::post('/dashboard/sejarah/{sejarah}', [DashboardSejarahController::class, 'update']);

Route::get('/dashboard/kajian/checkSlug', [DashboardKajianController::class,'checkSlug']);
Route::resource('/dashboard/kajian', DashboardKajianController::class);

Route::get('/dashboard/sk/checkSlug', [DashboardSKController::class,'checkSlug']);
Route::resource('/dashboard/sk', DashboardSKController::class);

Route::get('/dashboard/struktur/checkSlug', [DashboardStrukturController::class,'checkSlug']);
Route::resource('/dashboard/struktur', DashboardStrukturController::class);
// Untuk spoof method PUT dari form.submit("post")
Route::post('/dashboard/struktur/{struktur}', [DashboardStrukturController::class, 'update']);

Route::get('/dashboard/biodataPimpinan/checkSlug', [DashboardBiodataPimpinanController::class,'checkSlug']);
Route::resource('/dashboard/biodataPimpinan', DashboardBiodataPimpinanController::class);

Route::get('/dashboard/inventaris/checkSlug', [DashboardInventarisController::class,'checkSlug']);
Route::resource('/dashboard/inventaris', DashboardInventarisController::class);
Route::get('/dashboard/inventaris/{slug}/edit', [DashboardInventarisController::class, 'edit']);
// Untuk spoof method PUT dari form.submit("post")
Route::post('/dashboard/inventaris/{slug}', [DashboardInventarisController::class, 'update']);

Route::get('/dashboard/pelaksanaanProgram/checkSlug', [DashboardPelaksanaanProgramController::class,'checkSlug']);
Route::resource('/dashboard/pelaksanaanProgram', DashboardPelaksanaanProgramController::class);
// Untuk spoof method PUT dari form.submit("post")
Route::post('/dashboard/pelaksanaanProgram/{pelaksanaanProgram}', [DashboardPelaksanaanProgramController::class, 'update']);

Route::get('/dashboard/musyawarah/checkSlug', [DashboardMusyawarahController::class,'checkSlug']);
Route::resource('/dashboard/musyawarah', DashboardMusyawarahController::class);
// Untuk spoof method PUT dari form.submit("post")
Route::post('/dashboard/musyawarah/{musyawarah}', [DashboardMusyawarahController::class, 'update']);