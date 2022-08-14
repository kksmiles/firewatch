<?php

use KkSmiles\Firewatch\Controller\FirewatchErrorController;

Route::prefix('firewatch')->group(function() {
    Route::get('errors', [FirewatchErrorController::class, 'index']);
    Route::post('errors/solved', [FirewatchErrorController::class, 'solved']);
});
