<?php

use App\Http\Controllers\auth\SignInController;
use App\Http\Controllers\auth\SignUpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ResellerController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'de', 'es', 'fr', 'pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');

// ======================================================================
Route::domain(env('APP_DOMAIN', "kelirskin.test"))->group(function () {
    Route::redirect('/', '/signin');

    Route::get('/signin', [SignInController::class, 'index'])->middleware('guest')->name('signin');
    Route::post('/signin', [SignInController::class, 'login']);
    Route::post('/signout', [SignInController::class, 'logout']);

    Route::controller(SignUpController::class)
        ->group(function () {
            Route::get("/signup", 'index')->name("signup");
            Route::post("/signup", 'signUp');
        });
});

Route::domain('{subdomain}.' . env('APP_DOMAIN', "kelirskin.test"))->group(function () {
    Route::get('/', function () {
        return redirect()->route('signin');
    });
});

Route::domain('{subdomain}.' . env('APP_DOMAIN', "kelirskin.test"))->group(function () {
    Route::controller(SignInController::class)->group(function () {
        Route::get("/signin", 'index')->middleware('guest');
        Route::post('/signin', 'login');
        Route::post('/signout', 'logout');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)
        ->middleware('IsAdmin')
        ->group(function () {
            Route::get('/dashboard', 'index')->name('index');
            Route::get('/resellerLocation', 'showIndexLocationReseller')->name('location');
        });

    Route::controller(ResellerController::class)->middleware('IsReseller')->group(function () {
        Route::get('/dashboard-reseller', 'index')->name('index-reseller');
    });

    Route::controller(ResellerController::class)->middleware('IsAdmin')->group(function () {
       Route::get('/daftar-reseller', 'show')->name('daftar-reseller');
       Route::get('/pengajuan-reseller', 'showPengajuan')->name('pengajuan-reseller');
       Route::put('/update-status/{reseller}', 'updateStatus');
       Route::get('/update-data/{reseller}', 'showResellerId');
       Route::put('/update-data/{reseller}', 'update');
    });

    Route::controller(ProductController::class)->middleware('IsAdmin')->group(function () {
        Route::get('/daftar-produk', 'index')->name('daftar-produk');
        Route::get('/tambah-produk', 'showTambahProduk')->name('tambah-produk');
        Route::post('/tambah-produk', 'store')->name('tambah-produk');
        Route::get('/update-data-produk/{product}', 'showProdukId');
        Route::put('/update-data-produk/{product}', 'update');
        Route::delete('/delete-produk/{id}', 'destroy');
    });

    Route::controller(OrderController::class)->middleware('IsAdmin')->group(function () {
        Route::get('/daftar-order', 'index')->name('daftar-order');
    });

    Route::controller(ProductController::class)->middleware('IsReseller')->group(function () {
        Route::get('/produk', 'show')->name('produk');
        Route::get('/produk/{id}', 'showDetail')->name('produk-page');
    });

    Route::controller(CartController::class)->middleware('IsReseller')->group(function () {
        Route::get('/keranjang', 'index')->name('keranjang');
        Route::get('/checkout', 'showPesanan')->name('checkout-produk');
        Route::get('/payment', 'showPayment')->name('payment');
        Route::post('/post-cart', 'store');
        Route::put('/update-quantity/{id}', 'updateQuantity');
        Route::delete('/delete-cart/{id}', 'destroy');
    });
    
    Route::controller(OrderController::class)->middleware('IsReseller')->group(function () {
        Route::post('/payment', 'store');
    });

    Route::controller(OrderController::class)->middleware('AdminOrReseller')->group(function () {
        Route::get('/detail-pesanan/{id}', 'showDetail')->name('detail-pesanan');
        Route::get('/detail-pesanan', 'showTabeldetail')->name('detail-pesanann');
    });
});

// ======================================================================

Route::get('layout-{light}', function ($light) {
    session()->put('layout', $light);
    session()->get('layout');
    if ($light == 'vertical-layout') {
        return redirect()->route('pages-vertical-layout');
    }
    return redirect()->route('index');
    return 1;
});
Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

