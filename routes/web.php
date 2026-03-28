<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LoginForm;
use App\Livewire\TodoList;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn () => redirect()->route('todos'))->middleware('auth');

Route::get('/login', LoginForm::class)
    ->name('login')
    ->middleware('guest');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');

Route::get('/todos', TodoList::class)
    ->name('todos')
    ->middleware('auth');