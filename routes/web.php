<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // get update time of file
    $updateTime = filemtime(Config::get('pick.file'));

    if ($updateTime !== Cache::get('pick_time')) {
        Cache::put('pick_time', filemtime(Config::get('pick.file')));

        $data = file_get_contents(Config::get('pick.file'));

        dump($data);

        return;
    }

    return Inertia::render('Pick', [
        'noDump' => true,
    ]);
});

Route::post('webhook', function () {
    file_put_contents(Config::get('pick.file'), Request::all());

    return Response::noContent();
});
