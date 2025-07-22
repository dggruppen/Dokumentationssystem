<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// Lägg till fler rutter här för dokument, backup, statistik etc.
