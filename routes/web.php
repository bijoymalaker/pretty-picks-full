<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', fn () => view(view: 'app'))->where('any', '.*');
