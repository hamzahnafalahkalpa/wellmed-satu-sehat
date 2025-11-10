<?php

use Illuminate\Support\Facades\Route;
use Projects\WellmedSatuSehat\Controllers\API\Navigation\Notification\NotificationController;

Route::apiResource('notification',NotificationController::class)->parameters(['notification' => 'id']);