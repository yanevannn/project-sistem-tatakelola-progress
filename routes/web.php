<?php

use App\Http\Controllers\DataPengurusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SuratMasukController;

Route::get("/pengurus" , [DataPengurusController::class, 'index'])->name('pengurus.index');





Route::get('/keuangan', [KeuanganController::class, 'index']);
Route::get('/keuangan/create', [KeuanganController::class, 'create'])->name('keuangan.create');
Route::get('/keuangan/edit', [KeuanganController::class, 'edit2'])->name('keuangan.edit');

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});

Route::get('/home', function(){
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[PengurusController::class, 'index']);
    // Route::get('/dashboard/pengurusinti',[PengurusController::class, 'pengurusInti'])->middleware('userAccess:PengurusInti');
    // Route::get('/dashboard/pengurus',[PengurusController::class, 'pengurus'])->middleware('userAccess:Pengurus');
    
    Route::get('/logout',[SesiController::class, 'logout']);

    Route::get("/suratmasuk" , [SuratMasukController::class, 'index'])->name('suratmasuk.index');
    Route::get("/suratmasuk/create" , [SuratMasukController::class, 'create'])->name('suratmasuk.create');
    Route::post('/suratmasuk/store', [SuratMasukController::class, 'store'])->name('suratmasuk.store');
    
    Route::get('/periode',[PeriodeController::class, 'index'])->name('periode.index');
    Route::post('/periode', [PeriodeController::class, 'store'])->name('periode.store');
    Route::get('/periode/edit/{id_periode}', [PeriodeController::class, 'edit'])->name('periode.edit');
    Route::put('/periode/{id_periode}', [PeriodeController::class, 'update'])->name('periode.update');
    Route::delete('/periode/delete{id_periode}', [PeriodeController::class, 'destroy'])->name('periode.destroy');
    
    Route::get('/inventaris',[InventarisController::class, 'index'])->name('inventaris.index');                      //view data inventaris
    Route::get('/inventaris/create',[InventarisController::class, 'create'])->name('inventaris.create');             //view tambah data baru
    Route::post('/inventaris/store',[InventarisController::class, 'store'])->name('inventaris.store');               //proses tambah data baru
    Route::get('/inventaris/edit/{id}', [InventarisController::class, 'edit'])->name('inventaris.edit');                //view edit data
    Route::put('/inventaris/{id}', [InventarisController::class, 'update'])->name('inventaris.update');                 //proses simpan data yg diedit
    Route::delete('/inventaris/delete{id}',[InventarisController::class, 'destroy'])->name('inventaris.destroy');    //hapus data
});


