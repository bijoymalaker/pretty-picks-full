<?php

use Illuminate\Support\Facades\Route;

// Only catch-all for SPA frontend
Route::get('/{any}', fn () => view(view: 'app'))->where('any', '.*');
