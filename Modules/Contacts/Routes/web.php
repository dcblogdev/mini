<?php

use Modules\Contacts\Http\Controllers\ContactsController;
use Modules\Contacts\Http\Livewire\Feedback;

Route::middleware(['web', 'auth'])->prefix('app/contacts')->group(function() {
    Route::get('/', [ContactsController::class, 'index'])->name('app.contacts.index');
    Route::get('create', [ContactsController::class, 'create'])->name('app.contacts.create');
    Route::post('create', [ContactsController::class, 'store'])->name('app.contacts.store');
    Route::get('edit/{id}', [ContactsController::class, 'edit'])->name('app.contacts.edit');
    Route::patch('edit/{id}', [ContactsController::class, 'update'])->name('app.contacts.update');
    Route::delete('delete/{id}', [ContactsController::class, 'destroy'])->name('app.contacts.delete');
    Route::get('feedback', Feedback::class)->name('app.contacts.feedback');
});
