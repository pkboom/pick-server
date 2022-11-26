<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pick');
});

Route::get('dump', function () {
    $updateTime = filemtime(Config::get('pick.file'));

    if ($updateTime !== Cache::get('pick_time')) {
        Cache::put('pick_time', filemtime(Config::get('pick.file')));

        $data = file_get_contents(Config::get('pick.file'));

        collect(json_decode($data, true))->each(function ($dump) {
            if (is_array($dump)) {
                dump($dump);
            } else {
                $unserialized = @unserialize($dump);

                $unserialized ? dump($unserialized) : dump($dump);
            }
        });
    }
});

Route::post('webhook', function () {
    file_put_contents(Config::get('pick.file'), Request::all());

    return Response::noContent();
});
