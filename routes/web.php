<?php

use App\Services\QrCodeService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
