<?php

use Illuminate\Support\Facades\Route;
use Projects\WellmedSatuSehat\Controllers\API\Setting\{
    PaymentMethodController,
};

Route::group([
    'prefix' => '/finance',
    'as' => 'finance.'
],function(){
    Route::apiResource('/payment-method',PaymentMethodController::class)->parameters(['payment-method' => 'id']);
});
