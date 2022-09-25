<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

// frontend: hit backend every 1 sec
// backend: if file updated, dump new content
// if not dump same content or do nothing. which one? we will see

Route::get('/', function () {
    // get update time of file
    $updateTime = filemtime(Config::get('pick.file'));

    if ($updateTime !== Cache::get('pick_time')) {
        Cache::put('pick_time', filemtime(Config::get('pick.file')));

        // or else dump new stuff
        $data = file_get_contents(Config::get('pick.file'));

        dump($data);
        dump($data);

        return;
    }

    // if ther are the same don't do anyting
    return Inertia::render('Pick', [
        'noDump' => true,
    ]);
});

Route::post('webhook', function () {
    return view('welcome');
});
