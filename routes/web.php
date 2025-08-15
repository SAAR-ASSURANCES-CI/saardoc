<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

// Route du tableau de bord
Volt::route('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Routes pour les documents (Livewire)
    Volt::route('documents', 'documents.index')->name('documents.index');
    Volt::route('documents/create', 'documents.create')->name('documents.create');
    
    // Routes pour les utilisateurs (Livewire)
    Volt::route('users', 'users.index')->name('users.index');
    Volt::route('users/create', 'users.create')->name('users.create');
    
    // Routes pour la gestion des utilisateurs (Controller)
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle-block');
    Route::patch('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    
    // Routes pour la consultation des documents
    Route::get('documents/{document}/view', function ($document) {
        $document = \App\Models\Document::findOrFail($document);
        return view('documents.view', compact('document'));
    })->name('documents.view');
});

require __DIR__.'/auth.php';
