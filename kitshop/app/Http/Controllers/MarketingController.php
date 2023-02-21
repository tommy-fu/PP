<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Services\ElasticService;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function buy(Request $request)
    {
        $kit = Kit::where('name', $request->name)->first();

        $data = [
            'name' => $kit->name,
            'price' => $kit->price,
            'on_sale' => $kit->price_with_discount ? 'true' : 'false',
            'url' => $kit->url,
        ];

        ElasticService::addToElastic($request->event, $data);
        return redirect()->to($kit->url . '?sid=' . session()->getiD() . '&et=purchase' . '&');
    }
    
    public function preview(Request $request)
    {
        $kit = Kit::where('name', $request->name)->first();

        $data = [
            'name' => $kit->name,
            'price' => $kit->price,
            'url' => '/pages/' . $request->name,
            'on_sale' => $kit->price_with_discount ? 'true' : 'false',
        ];

        ElasticService::addToElastic($request->event, $data);
        return redirect()->to('/pages/' . $request->name);
    }
}
