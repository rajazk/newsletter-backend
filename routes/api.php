<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => '', 'namespace' => 'Api'], function () {

    Route::post('newsletter-signup', 'NewsletterController@signup');

    /* -------------------------------- Fallback -------------------------------- */
    Route::any('{segment}', function () {
        return response()->json([
            'error' => 'Invalid url.'
        ]);
    })->where('segment', '.*');
});

Route::get('unauthorized', function () {
    return response()->json([
        'error' => 'Unauthorized.'
    ], 401);
})->name('unauthorized');
