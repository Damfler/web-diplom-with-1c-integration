<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\TradeOffer;
use App\Models\TypeOffer;
use App\Models\Stock;

class UpdateForApiController extends Controller
{
    public $group = 'https://1c.xn-----6kcbivs1aohfys0g.xn--p1ai/group/all.json';
    public $storage = 'https://1c.xn-----6kcbivs1aohfys0g.xn--p1ai/storage/all.json';
    public $item = 'https://1c.xn-----6kcbivs1aohfys0g.xn--p1ai/item/all.json';

    public function ourStorage()
    {
        $allType = [];
        $stockId = [];

        $type = TypeOffer::get();
        foreach ($type as $res) {
            $allType[$res['name']] = $res['id'];
        }

        $arStorage = Http::get($this->storage);
        $resStorage = json_decode($arStorage->body(), true);
        foreach ($resStorage as $res) {
            foreach ($allType as $name => $id) {
                if (empty(Stock::where('outer_id', $res['IDСклада'])->where('type_id', $id)->first())) {
                    Stock::insert([
                        'type_id' => $id,
                        'outer_id' => $res['IDСклада'],
                        'name' => $res['Склад'],
                        'description' => 'Склад 1С',
                        'percent' => 1,
                    ]);
                }
            }
        }

        $stock = Stock::get();
        foreach ($stock as $res) {
            $stockId[$res['name']][$res['type_id']] = $res['id'];
        }

        $arResult = Http::get($this->item);
        $response = json_decode($arResult->body(), true);

        foreach ($response as $res) {
            foreach ($res['Остаток'] as $resCount) {
                $typeTmpId = $allType[$res['Родитель']];
                $stockTmpId = $stockId[$resCount['Склад']][$typeTmpId];
                if (empty(TradeOffer::where('name', $res['Товар'])->where('stock_id', $stockTmpId)->where('supplier_article', $res['IDТовара'])->first())) {
                    TradeOffer::insert([
                        'name' => $res['Товар'],
                        'supplier_article' => $res['IDТовара'],
                        'price' => $res['СредняяСебестоимость'],
                        'retail' => $res['РозничнаяЦена'],
                        'count' => $resCount['Остаток'],
                        'type_id' => $typeTmpId,
                        'stock_id' => $stockTmpId,
                        'article' => substr(md5($res['IDТовара'] . $res['Товар']), 0, 10),
                    ]);
                }
            }
        }
    }
}
