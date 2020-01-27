<?php

namespace App\Http\Controllers;

use App\Wind;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WindInfo extends Controller
{
    /**
     * @var string
     */
    const REMOTE_API_ENDPOINT = 'http://api.openweathermap.org';

    /**
     * @var string
     */
    const API_ID = '17a6d89f789d43b7f6465df09f442e9d';

    /**
     * @var GuzzleHttp\Client
     */
    private Client $client;

    /**
     * @uses GuzzleHttp\Client
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => static::REMOTE_API_ENDPOINT,
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  string $zipCode
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $zipCode)
    {
        $response = response();

        $wind = Cache::remember("wind-{$zipCode}", 15, function () use ($zipCode, $response) {
            try {
                $weatherInfo = $this->client->request('GET', '/data/2.5/weather', [
                    'query' => [
                        'zip' => "{$zipCode},us",
                        'APPID' => static::API_ID,
                    ] ,
                ]);
                $body = json_decode($weatherInfo->getBody()->getContents(), true);

                $wind = new Wind();
                $wind->fill($body['wind']);
            } catch (ClientException $ex) {
                $wind = [
                    'request' =>  Psr7\str($e->getRequest()),
                    'response' => Psr7\str($e->getResponse()),
                    'statuscode' => Psr7\str($e->getStatusCode()),
                ];
            }
            return $wind;
        });

        return $response->json($wind);
    }
}
