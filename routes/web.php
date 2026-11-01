<?php

use App\Http\Controllers\maincontroller;
use App\Http\Controllers\register_Login;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware("guest")->group(function(){
    Route::get("/register",[register_Login::class,'register']);
    Route::get("/login",[register_Login::class,'login'])->name('login');
    });

Route::middleware("auth")->group(function(){
    Route::get("/index",[register_Login::class,'index'])->name("home");
    Route::get("/create_folder",[maincontroller::class,'folder_page'])->name("create_folder");
    Route::get("/my_folder",[maincontroller::class,'my_folder'])->name("folders");
    Route::get("/download_folder/{id}",[maincontroller::class,'download'])->name('folder_download');
});

Route::post("/create_folder",[maincontroller::class,'folder_page_submit']);
Route::post("/register",[register_Login::class,'register_submit']);
Route::post("/login",[register_Login::class,'login_submit']);
Route::post("/logout",[register_Login::class,'logout']);