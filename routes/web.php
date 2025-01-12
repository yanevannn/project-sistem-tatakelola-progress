<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\DokumenUkmController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DokumenEventController;
use App\Http\Controllers\PrestasiAnggotaController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'login'])->name('login');
    Route::get('/' ,function() {
        return redirect('login');
    });
    Route::post('/login', [SesiController::class, 'doLogin'])->name('doLogin');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[SesiController::class,'dashboard'])->name('dashboard');
    Route::get('/dashboard/profile',[SesiController::class,'dashboardProfile'])->name('dashboard.profile');
    Route::put('/dashboard/profile/resetpassword',[SesiController::class,'resetPassword'])->name('resetPassword');
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::middleware('auth', 'role:pengurus-inti')->group(function () {
    //User (PENGURUS UKM)
    Route::get("/user", [UserController::class, 'index'])->name('user.index');
    Route::get("/user/create", [UserController::class, 'create'])->name('user.create');
    Route::post("/user/store", [UserController::class, 'store'])->name('user.store');
    Route::get("/user/edit/{id}", [UserController::class, 'edit'])->name('user.edit');
    Route::put("/user/{id}", [UserController::class, 'update'])->name('user.update');

    //Surat Masuk
    Route::get("/suratmasuk", [SuratMasukController::class, 'index'])->name('suratmasuk.index');
    Route::get("/suratmasuk/create", [SuratMasukController::class, 'create'])->name('suratmasuk.create');
    Route::post('/suratmasuk/store', [SuratMasukController::class, 'store'])->name('suratmasuk.store');
    Route::get('/suratmasuk/edit/{id}', [SuratMasukController::class, 'edit'])->name('suratmasuk.edit');
    Route::put('/suratmasuk/{id}', [SuratMasukController::class, 'update'])->name('suratmasuk.update');

    // Surat Keluar
    Route::get("/suratkeluar", [SuratKeluarController::class, 'index'])->name('suratkeluar.index');
    Route::get("/suratkeluar/create", [SuratKeluarController::class, 'create'])->name('suratkeluar.create');
    Route::post('/suratkeluar/store', [SuratKeluarController::class, 'store'])->name('suratkeluar.store');
    Route::get('/suratkeluar/edit/{id}', [SuratKeluarController::class, 'edit'])->name('suratkeluar.edit');
    Route::put('/suratkeluar/{id}', [SuratKeluarController::class, 'update'])->name('suratkeluar.update');

    // Periode
    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode.index');
    Route::post('/periode', [PeriodeController::class, 'store'])->name('periode.store');
    Route::get('/periode/edit/{id_periode}', [PeriodeController::class, 'edit'])->name('periode.edit');
    Route::put('/periode/{id_periode}', [PeriodeController::class, 'update'])->name('periode.update');
    Route::delete('/periode/delete{id_periode}', [PeriodeController::class, 'destroy'])->name('periode.destroy');



    // Keuangan
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('/keuangan/create', [KeuanganController::class, 'create'])->name('keuangan.create');
    Route::post('/keuangan/store', [KeuanganController::class, 'store'])->name('keuangan.store');
    Route::get('/keuangan/edit/{id}', [KeuanganController::class, 'edit'])->name('keuangan.edit');
    Route::put('/keuangan/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');


    // Dokumen UKM
    Route::get('/dokumen_ukm', [DokumenUkmController::class, 'index'])->name('dokumen_ukm.index');
    Route::get('/dokumen_ukm/view', [DokumenUkmController::class, 'view'])->name('dokumen_ukm.view');
    Route::get('/dokumen_ukm/create', [DokumenUkmController::class, 'create'])->name('dokumen_ukm.create');
    Route::post('/dokumen_ukm/store', [DokumenUkmController::class, 'store'])->name('dokumen_ukm.store');
    Route::get('/dokumen_ukm/edit/{id}', [DokumenUkmController::class, 'edit'])->name('dokumen_ukm.edit');
    Route::put('/dokumen_ukm/{id}', [DokumenUkmController::class, 'update'])->name('dokumen_ukm.update');


    // DOkumen Event
    Route::get('/dokumen_event', [DokumenEventController::class, 'index'])->name('dokumen_event.index');
    Route::get('/dokumen_event/create', [DokumenEventController::class, 'create'])->name('dokumen_event.create');
    Route::post('/dokumen_event/store', [DokumenEventController::class, 'store'])->name('dokumen_event.store');
    Route::get('/dokumen_event/edit/{id}', [DokumenEventController::class, 'edit'])->name('dokumen_event.edit');
    Route::put('/dokumen_event/{id}', [DokumenEventController::class, 'update'])->name('dokumen_event.update');
    Route::delete('/dokumen_event{id}', [DokumenEventController::class, 'destroy'])->name('dokumen_event.destroy');

    Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');

});


Route::middleware('auth')->group(function () {
    // Inventaris
    Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::post('/inventaris/store', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/inventaris/edit/{id}', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::put('/inventaris/{id}', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::delete('/inventaris/delete{id}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');

    // Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    // Prestasi Anggota
    Route::get('/prestasianggota', [PrestasiAnggotaController::class, 'index'])->name('prestasi_anggota.index');
    Route::get('/prestasi-anggota/search', [PrestasiAnggotaController::class, 'searchAnggota'])->name('prestasi_anggota.search');
    Route::get('/prestasianggota/create', [PrestasiAnggotaController::class, 'create'])->name('prestasi_anggota.create');
    Route::post('/prestasianggota/store', [PrestasiAnggotaController::class, 'store'])->name('prestasi_anggota.store');
    Route::get('/prestasianggota/edit{id}', [PrestasiAnggotaController::class, 'edit'])->name('prestasi_anggota.edit');
    Route::put('/prestasianggota/{id}', [PrestasiAnggotaController::class, 'update'])->name('prestasi_anggota.update');
    Route::delete('/prestasianggota{id}', [PrestasiAnggotaController::class, 'delete'])->name('prestasi_anggota.delete');
});
