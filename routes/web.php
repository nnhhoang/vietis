<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentRoomController;
use App\Http\Controllers\MonthlyRentController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Nhóm các route yêu cầu xác thực
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('apartments', ApartmentController::class);

    Route::prefix('apartments/{apartment}/rooms')->group(function () {
        Route::get('/', [ApartmentRoomController::class, 'index'])->name('rooms.index');
        Route::get('/create', [ApartmentRoomController::class, 'create'])->name('rooms.create');
        Route::post('/', [ApartmentRoomController::class, 'store'])->name('rooms.store');
        Route::get('/{room}/edit', [ApartmentRoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/{room}', [ApartmentRoomController::class, 'update'])->name('rooms.update');
        Route::delete('/{room}', [ApartmentRoomController::class, 'destroy'])->name('rooms.destroy');
    });

    Route::prefix('rooms/{room}/rents')->group(function () {
        Route::get('/', [MonthlyRentController::class, 'index'])->name('rents.index');
        Route::get('/create', [MonthlyRentController::class, 'create'])->name('rents.create');
        Route::post('/', [MonthlyRentController::class, 'store'])->name('rents.store');
        Route::get('/{rent}/edit', [MonthlyRentController::class, 'edit'])->name('rents.edit');
        Route::put('/{rent}', [MonthlyRentController::class, 'update'])->name('rents.update');
        Route::delete('/{rent}', [MonthlyRentController::class, 'destroy'])->name('rents.destroy');
    });

    Route::get('unpaid-rooms', [MonthlyRentController::class, 'unpaidRooms'])->name('rents.unpaid');

    Route::get('logs', [LogController::class, 'index'])->name('logs.index');
});

require __DIR__.'/auth.php';
