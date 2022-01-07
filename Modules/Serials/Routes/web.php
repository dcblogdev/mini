<?php

use Modules\Serials\Http\Controllers\SerialsController;

Route::middleware(['web','auth'])->prefix('app/serials')->group(function() {
    Route::get('/', [SerialsController::class,'index'])->name('app.serials.index');
    Route::get('create', [SerialsController::class,'create'])->name('app.serials.create');
    Route::post('store', [SerialsController::class,'store'])->name('app.serials.store');
    Route::get('edit/{id}', [SerialsController::class,'edit'])->name('app.serials.edit');
    Route::patch('edit/{id}', [SerialsController::class,'update'])->name('app.serials.update');
    Route::delete('{id}', [SerialsController::class,'destroy'])->name('app.serials.delete');
});
