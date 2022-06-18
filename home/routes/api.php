<?php

use App\Models\TradeOffer;
use App\Models\TypeOffer;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Товары
Route::get('/items', function () {
    return TradeOffer::get();
});
Route::get('/items/limit/{number}', function ($number) {
    return TradeOffer::limit($number)->get();
});
Route::get('/items/brand/{brand_id}', function ($brand_id) {
    return TradeOffer::where('brand_id', $brand_id)->get();
});
Route::get('/items/type/{id}', function ($id) {
    return TradeOffer::where('type_id', $id)->get();
});
Route::get('/items/type/{id}/brand/{brand_id}', function ($id, $brand_id) {
    return TradeOffer::where('type_id', $id)->where('brand_id', $brand_id)->get();
});
Route::get('/items/type/{id}/stock/{stock_id}', function ($id, $stock_id) {
    return TradeOffer::where('type_id', $id)->where('stock_id', $stock_id)->get();
});
Route::get('/items/type/{id}/stock/{stock_id}/brand/{brand_id}', function ($id, $stock_id, $brand_id) {
    return TradeOffer::where('type_id', $id)->where('stock_id', $stock_id)->where('brand_id', $brand_id)->get();
});
Route::get('/items/article/{article}', function ($article) {
    return TradeOffer::where('article', $article)->get();
});
Route::get('/items/sale', [ApiController::class, 'sale']);
Route::get('/items/new', [ApiController::class, 'new']);

// Типы товаров
Route::get('/type', function () {
    return TypeOffer::all();
});

// Склад
Route::get('/stocks', function () {
    return Stock::all();
});
Route::get('/stocks/id/{id}', function ($id) {
    return Stock::where('id', $id)->all();
});
Route::get('/stocks/name/{name}', function ($name) {
    return Stock::where('name', $name)->all();
});

// Слайдер
Route::get('/slider', function () {
    return Slider::limit(4)->get();
});

// бренды
Route::get('/brands', function () {
    $arrName = [];
    $arrFinish = [];
    $name = TypeOffer::all();
    foreach($name as $tmp)
        $arrName[$tmp->id] = $tmp->name;
        
    $brand = Brand::get();
    foreach($brand as $tmp){
        $tmp['type_name'] = $arrName[$tmp->type_id];
        $arrFinish[] = $tmp;}
    
    return $arrFinish;
});
Route::get('/brands/limit/{number}', function ($number) {
    $arrName = [];
    $arrFinish = [];
    $name = TypeOffer::all();
    foreach($name as $tmp)
        $arrName[$tmp->id] = $tmp->name;
        
    $brand = Brand::limit($number)->get();
    foreach($brand as $tmp){
        $tmp['type_name'] = $arrName[$tmp->type_id];
        $arrFinish[] = $tmp;}
        
    return $arrFinish;
});
Route::get('/brands/type/{id}', function ($id) {
    $arrName = [];
    $arrFinish = [];
    $name = TypeOffer::all();
    foreach($name as $tmp)
        $arrName[$tmp->id] = $tmp->name;
        
    $brand = Brand::where('type_id', $id)->get();
    foreach($brand as $tmp){
        $tmp['type_name'] = $arrName[$tmp->type_id];
        $arrFinish[] = $tmp;}
        
    return $arrFinish;
});
