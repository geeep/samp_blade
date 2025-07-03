<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/productcontroller.php';
require __DIR__.'/usercontroller.php';
