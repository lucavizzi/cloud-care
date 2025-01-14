<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/breweries/{page?}/{per_page?}', function (Request $request) {
    $meta=session('breweries_meta');
    if(empty($meta)){
        $meta=json_decode(file_get_contents('https://api.openbrewerydb.org/v1/breweries/meta'));// once per session
        session(['breweries_meta' => $meta]);
    }
    $page=$request->page? $request->page : 1;
    $per_page=$request->per_page? $request->per_page : 50;
    $pages=ceil($meta->total/$per_page);
    $breweries=json_decode(file_get_contents("https://api.openbrewerydb.org/v1/breweries?per_page=$per_page&page=$page"));
    return ['breweries'=>$breweries,'per_page'=>$per_page,'page'=>$page,'pages'=>$pages];
})->middleware('auth:sanctum');
