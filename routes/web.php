<?php

use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\SalesPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $totalPages = auth()->user()->salesPages()->count();
        $recentPages = auth()->user()->salesPages()->latest()->take(5)->get();
        return view('dashboard', compact('totalPages', 'recentPages'));
    })->name('dashboard');

    Route::get('/generate', [GeneratorController::class, 'create'])->name('generate.create');
    Route::post('/generate', [GeneratorController::class, 'generate'])->name('generate.store');

    Route::prefix('sales-pages')->name('sales-pages.')->group(function () {
        Route::get('/', [SalesPageController::class, 'index'])->name('history');
        Route::get('/{salesPage}/preview', [SalesPageController::class, 'preview'])->name('preview');
        Route::get('/{salesPage}/export', [SalesPageController::class, 'export'])->name('export');
        Route::delete('/{salesPage}', [SalesPageController::class, 'destroy'])->name('destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';