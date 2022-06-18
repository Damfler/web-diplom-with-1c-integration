<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\TradeOffer;
use App\Models\TypeOffer;
use App\Models\Slider;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sale()
    {
        $arOffers = [];
        $trade_offers = TradeOffer::where('percent', '!=', '0')->get();
        foreach ($trade_offers as $offer) {
            if (empty($arOffers[$offer->article]))
                $offer['price_sale'] = ceil($offer['price'] - (($offer['price'] * $offer['percent']) / 100));
            $arOffers[] = $offer;
        }

        return $arOffers;
    }

    public function new()
    {
        $trade_offers = TradeOffer::orderBy('id', 'DESC')->limit(6)->get();
        return $trade_offers;
    }
}
