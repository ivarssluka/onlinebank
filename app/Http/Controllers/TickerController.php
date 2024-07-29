<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TickerController extends Controller
{
    public function index()
    {
        $response = Http::withOptions(['verify' => false])->get('https://api.coingecko.com/api/v3/coins/markets', [
            'vs_currency' => 'usd',
            'order' => 'market_cap_desc',
            'per_page' => 100,
            'page' => 1,
            'sparkline' => true,
        ]);

        if ($response->successful()) {
            $cryptos = $response->json();
            return view('crypto', [
                'cryptos' => $cryptos
            ]);
        } else {
            abort(500, 'Error: ' . $response->body());
        }
    }
}
