<?php

use Illuminate\Support\Facades\Route;
use Projects\WellmedSatuSehat\Controllers\API\Menu\MenuController;

Route::get('/menu',[MenuController::class,'index'])->name('menu.index');