<?php 

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\EpaperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================
// ROUTE YANG BUTUH LOGIN
// ============================

Route::middleware('auth')->group(function () {

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============================
    // SUBSCRIPTION (SEMUA USER LOGIN BOLEH AKSES)
    // ============================
    Route::get('/subscriptions/plans', [SubscriptionController::class, 'index'])
        ->name('subscriptions.plans');

    // 👉 STEP 1: form pembayaran
    Route::get('/subscriptions/{plan}/payment', [SubscriptionController::class, 'paymentForm'])
        ->name('subscriptions.payment');

    // 👉 STEP 2: submit form + (sekarang) generate Snap token
    Route::post('/subscriptions/{plan}/subscribe', [SubscriptionController::class, 'subscribe'])
        ->name('subscriptions.subscribe');

    Route::get('/subscriptions/my', [SubscriptionController::class, 'mySubscription'])
        ->name('subscriptions.my');

    // 👉 HALAMAN SUKSES SETELAH POPUP MIDTRANS (BARU)
    Route::get('/subscriptions/success', [SubscriptionController::class, 'success'])
        ->name('subscriptions.success');

    // ============================
    // ADMIN: E-PAPER (CRUD)
    // ============================
    Route::get('/epapers/create', [EpaperController::class, 'create'])
        ->name('epapers.create');

    Route::post('/epapers', [EpaperController::class, 'store'])
        ->name('epapers.store');

    Route::get('/epapers/manage', [EpaperController::class, 'manage'])
        ->name('epapers.manage');

    Route::get('/epapers/{epaper}/edit', [EpaperController::class, 'edit'])
        ->name('epapers.edit');

    Route::put('/epapers/{epaper}', [EpaperController::class, 'update'])
        ->name('epapers.update');

    Route::delete('/epapers/{epaper}', [EpaperController::class, 'destroy'])
        ->name('epapers.destroy');

    // ============================
    // USER BERLANGGANAN: LIHAT & BACA E-PAPER
    // ============================
    Route::middleware('subscription.active')->group(function () {
        Route::get('/epapers', [EpaperController::class, 'index'])
            ->name('epapers.index');

        Route::get('/epapers/{epaper}', [EpaperController::class, 'show'])
            ->name('epapers.show');
    });
});

// ============================
// MIDTRANS NOTIFICATION (TANPA AUTH) – BARU
// ============================
Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification'])
    ->name('midtrans.notification');

require __DIR__.'/auth.php';
