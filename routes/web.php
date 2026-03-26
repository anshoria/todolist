<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});
 