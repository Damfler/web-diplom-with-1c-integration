<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\TradeOffer;
use App\Models\TypeOffer;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $arTypes = [];

        $brands = Brand::count();
        $stocks = Stock::count();
        $trade_offers = TradeOffer::count();
        $trade_offers_item = TradeOffer::paginate(10);
        $slider = Slider::count();

        $types = TypeOffer::get();
        foreach ($types as $type)
            $arTypes[$type->id] = $type->name;

        return view('admin.index', [
            'brands' => $brands,
            'stocks' => $stocks,
            'trade_offers' => $trade_offers,
            'trade_offers_item' => $trade_offers_item,
            'slider' => $slider,
            'arTypes' => $arTypes,
        ]);
    }

    public function index_tyre()
    {
        $arTypes = [];

        $trade_offers_item = TradeOffer::where('type_id', 1)->paginate(10);
        $types = TypeOffer::get();
        foreach ($types as $type)
            $arTypes[$type->id] = $type->name;

        return view('admin.page_item.tyre', [
            'trade_offers_item' => $trade_offers_item,
            'arTypes' => $arTypes,
        ]);
    }
    public function index_moto()
    {
        $arTypes = [];

        $trade_offers_item = TradeOffer::where('type_id', 4)->paginate(10);
        $types = TypeOffer::get();
        foreach ($types as $type)
            $arTypes[$type->id] = $type->name;

        return view('admin.page_item.tyre', [
            'trade_offers_item' => $trade_offers_item,
            'arTypes' => $arTypes,
        ]);
    }
    public function index_disk()
    {
        $arTypes = [];

        $trade_offers_item = TradeOffer::where('type_id', 2)->paginate(10);
        $types = TypeOffer::get();
        foreach ($types as $type)
            $arTypes[$type->id] = $type->name;

        return view('admin.page_item.tyre', [
            'trade_offers_item' => $trade_offers_item,
            'arTypes' => $arTypes,
        ]);
    }
    public function index_akb()
    {
        $arTypes = [];

        $trade_offers_item = TradeOffer::where('type_id', 3)->paginate(10);
        $types = TypeOffer::get();
        foreach ($types as $type)
            $arTypes[$type->id] = $type->name;

        return view('admin.page_item.tyre', [
            'trade_offers_item' => $trade_offers_item,
            'arTypes' => $arTypes,
        ]);
    }

    public function items()
    {
        $types = TypeOffer::get();
        $brands = Brand::get();
        $stocks = Stock::get();

        return view('admin.items_add', [
            'types' => $types,
            'brands' => $brands,
            'stocks' => $stocks,
        ]);
    }

    public function items_add(Request $request)
    {
        $image_name = "items_" . md5($request->input('name')) . "." . $request->file("photo")->extension();
        $request->file("photo")->move(public_path("images/items/"), $image_name);
        $path = "images/items/" . $image_name;

        TradeOffer::insert([
            'name' => $request->input('name'),
            'stock_id' => $request->input('stock_id'),
            'type_id' => $request->input('type_id'),
            'brand_id' => $request->input('brand_id'),
            'article' => $request->input('article'),
            'price' => $request->input('price'),
            'retail' => $request->input('retail'),
            'count' => $request->input('count'),
            'photo' => $path,
        ]);

        return redirect(route('admin.item.add'))->withErrors('Товар "' . $request->input('name') . '" успешно добавлен!', 'message');
    }

    public function type()
    {
        $types = TypeOffer::get();

        return view('admin.type_add', [
            'types' => $types,
        ]);
    }

    public function type_add(Request $request)
    {
        TypeOffer::insert([
            'name' => $request->input('name'),
        ]);

        return redirect(route('admin.type.add'))->withErrors('Тип "' . $request->input('name') . '" успешно добавлен!', 'message');
    }

    public function brands()
    {
        $arTypes = [];

        $brands = Brand::get();
        $types = TypeOffer::get();
        foreach ($types as $type)
            $arTypes[$type->id] = $type->name;

        return view('admin.brands', [
            'brands' => $brands,
            'types' => $types,
            'arTypes' => $arTypes,
        ]);
    }

    public function brand_add(Request $request)
    {
        $image_name = "brands_" . $request->input('name') . "." . $request->file("photo")->extension();
        $request->file("photo")->move(public_path("images/brands/"), $image_name);
        $path = "images/brands/" . $image_name;

        Brand::insert([
            'name' => $request->input('name'),
            'type_id' => $request->input('type_id'),
            'photo' => $path,
        ]);

        return redirect(route('admin.brands.add'))->withErrors('Бренд "' . $request->input('name') . '" успешно добавлен!', 'message');
    }

    public function slider()
    {
        $slider = Slider::get();

        return view('admin.slider', [
            'slider' => $slider
        ]);
    }

    public function slider_add(Request $request)
    {
        $image_name = "slide_" . $request->input('title') . "." . $request->file("photo")->extension();
        $request->file("photo")->move(public_path("images/slider/"), $image_name);
        $path = "images/slider/" . $image_name;

        Slider::insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'photo' => $path,
        ]);

        return redirect(route('admin.slider.add'))->withErrors('Слайд "' . $request->input('title') . '" успешно добавлен!', 'message');
    }

    public function items_edit($id)
    {
        $trade_offer = TradeOffer::where('id', $id)->first();
        $brands = Brand::where('type_id', $trade_offer->type_id)->get();

        return view('admin.form.edit_offers', [
            'brands' => $brands,
            'trade_offer' => $trade_offer,
        ]);
    }

    public function items_edit_complete(Request $request)
    {
        $image_name = "items_" . md5($request->input('name')) . "." . $request->file("photo")->extension();
        $request->file("photo")->move(public_path("images/items/"), $image_name);
        $path = "images/items/" . $image_name;

        TradeOffer::where('article', $request->input('article'))->update([
            'brand_id' => $request->input('brand_id'),
            'photo' => $path,
        ]);

        return redirect(route('admin.home'))->withErrors('Товар "' . $request->input('name') . '" успешно изменен!', 'message');
    }

    public function search(Request $request)
    {
        $trade_offers = TradeOffer::where('article', 'LIKE', $request->input('query'))->get();

        return $trade_offers;
    }
}
