<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\DocumentList;
use App\Livewire\Public\DocumentVerify;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('admin.documents');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.documents');
    });

    Route::get('/admin/documents', DocumentList::class)->name('admin.documents');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

Route::get('/verify-scan/{uuid}', DocumentVerify::class)->name('public.verify');

