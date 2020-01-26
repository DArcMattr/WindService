<?php

namespace App\Http\Controllers;

use App\Http\Resources\Wind;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;

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

        try {
            $weatherInfo = $this->client->request('GET', '/data/2.5/weather', [
                'query' => [
                    'zip' => "{$zipCode},us",
                    'APPID' => static::API_ID,
                ] ,
            ]);
            $body = json_decode($weatherInfo->getBody()->getContents(), true);

            $out = [
                'speed' => $body['wind']['speed'],
                'direction' => $body['wind']['deg'],
            ];
        } catch (ClientException $ex) {
            $out = [
                'request' =>  Psr7\str($e->getRequest()),
                'response' => Psr7\str($e->getResponse()),
            ];
            $response->withStatus($e->getStatusCode());
        }

        return $response->json($out);
    }
}
