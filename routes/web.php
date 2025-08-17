<?php

use Livewire\Volt\Volt;
use App\Models\Document;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');


Volt::route('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

  
    Volt::route('documents', 'documents.index')->name('documents.index');
    Volt::route('documents/create', 'documents.create')->name('documents.create');
    
  
    Volt::route('users', 'users.index')->name('users.index');
    Volt::route('users/create', 'users.create')->name('users.create');
    
    
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle-block');
    Route::patch('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    
    
    Route::get('documents/{document}/view', function ($document) {
        $document = Document::findOrFail($document);
        return view('documents.view', compact('document'));
    })->name('documents.view');
    

    Route::get('documents/export/csv', [DocumentController::class, 'exportCsv'])->name('documents.export.csv');
    Route::get('documents/export/pdf', [DocumentController::class, 'exportPdf'])->name('documents.export.pdf');
});

require __DIR__.'/auth.php';
