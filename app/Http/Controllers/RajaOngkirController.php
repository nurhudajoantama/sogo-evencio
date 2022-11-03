<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    public function getProvince(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province?id=' . $request->id, [
            'headers' => [
                'key' => config('apikey.raja_ongkir_api_key')
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['rajaongkir']['results'];
    }

    public function getCity(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city?id=' . $request->id . '&province=' . $request->province, [
            'headers' => [
                'key' => config('apikey.raja_ongkir_api_key')
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['rajaongkir']['results'];
    }

    public function getCost(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => config('apikey.raja_ongkir_api_key'),
                'content-type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'origin' => Setting::where('key', 'rajaongkir_origin')->first()->value,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['rajaongkir']['results'];
    }
}
