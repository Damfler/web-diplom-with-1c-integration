<?php

use App\Models\TradeOffer;
use App\Models\TypeOffer;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Slider;

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');

//dashboard routes
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'admin.'], function () {
    //single action controllers
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/tyre', [HomeController::class, 'index_tyre'])->name('home.tyre');
    Route::get('/moto', [HomeController::class, 'index_moto'])->name('home.moto');
    Route::get('/disk', [HomeController::class, 'index_disk'])->name('home.disk');
    Route::get('/akb', [HomeController::class, 'index_akb'])->name('home.akb');

    Route::post('/search', [HomeController::class, 'search'])->name('search');

    //link that return view, to get compoment from there
    Route::view('/buttons', 'admin.buttons')->name('buttons');
    Route::view('/cards', 'admin.cards')->name('cards');
    Route::view('/charts', 'admin.charts')->name('charts');
    Route::view('/forms', 'admin.forms')->name('forms');
    Route::view('/modals', 'admin.modals')->name('modals');
    Route::view('/tables', 'admin.tables')->name('tables');

    Route::group(['prefix' => 'pages', 'as' => 'page.'], function () {
        Route::view('/404-page', 'admin.pages.404')->name('404');
        Route::view('/blank-page', 'admin.pages.blank')->name('blank');
        Route::view('/create-account-page', 'admin.pages.create-account')->name('create-account');
        Route::view('/forgot-password-page', 'admin.pages.forgot-password')->name('forgot-password');
        Route::view('/login-page', 'admin.pages.login')->name('login');
    });

    Route::get('/item/add', [HomeController::class, 'items'])->name('item.add');
    Route::post('/item/add', [HomeController::class, 'items_add'])->name('item.add.post');
    Route::get('/item/edit/{id}', [HomeController::class, 'items_edit'])->name('item.edit');
    Route::get('/item/delete/{id}', function ($id) {
        TradeOffer::where('id', $id)->delete();
        return redirect(route('admin.item.add'))->withErrors('Товар успешно удален!', 'message');
    })->name('item.delete');
    Route::post('/item/edit/complete', [HomeController::class, 'items_edit_complete'])->name('item.edit.complete');

    Route::get('/type', [HomeController::class, 'type'])->name('type.add');
    Route::post('/type/add', [HomeController::class, 'type_add'])->name('type.add.post');
    Route::get('/type/delete/{id}', function ($id) {
        TypeOffer::where('id', $id)->delete();
        return redirect(route('admin.type.add'))->withErrors('Тип успешно удален!', 'message');
    })->name('type.delete');

    Route::get('/brands', [HomeController::class, 'brands'])->name('brands.add');
    Route::post('/brands/add', [HomeController::class, 'brand_add'])->name('brands.add.post');
    Route::get('/brands/delete/{id}', function ($id) {
        Brand::where('id', $id)->delete();
        return redirect(route('admin.brands.add'))->withErrors('Бренд успешно удален!', 'message');
    })->name('brands.delete');

    Route::get('/slider', [HomeController::class, 'slider'])->name('slider.add');
    Route::post('/slider/add', [HomeController::class, 'slider_add'])->name('slider.add.post');
    Route::get('/slider/delete/{id}', function ($id) {
        Slider::where('id', $id)->delete();
        return redirect(route('admin.slider.add'))->withErrors('Слайд успешно удален!', 'message');
    })->name('slider.delete');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/debug.php';
