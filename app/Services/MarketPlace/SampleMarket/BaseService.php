<?php

namespace App\Services\MarketPlace\SampleMarket;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaseService
{
    protected $client;
    protected $authParams;

    public function __construct()
    {
        $this->baseUrl = config('services.sample_market.url');
        $this->client = Http::acceptJson()->baseUrl($this->baseUrl);
        $this->authParams = config('services.sample_market.api_key');
    }

    protected function get(string $uri, array $params = [])
    {
        Log::info("Get request: ". $uri. ", Params: " . \GuzzleHttp\json_encode($params));

        $response = $this->client->get($uri,
            [
                "api_key" => $this->authParams,
            ] + $params);

        $respBody = $response->getBody()->getContents();

        $status = $response->getStatusCode();

        Log::info("Get Response: " . $uri .
            ", Params: " . \GuzzleHttp\json_encode($params) .
            ", Status: " . $status .
            ", Response: " . $respBody);

        if ($status===200) {
            return json_decode($respBody, true);
        }

        sleep(3);
        return false;
    }

    protected function post(string $uri, array $params = [])
    {
        Log::info("Post request: ". $uri. ", Params: " . \GuzzleHttp\json_encode($params));

        $response = $this->client->post($uri,
            [
                "api_key" => $this->authParams,
            ] + $params);

        $respBody = $response->getBody()->getContents();

        Log::info("Post Response: " . $uri .
            ", Params: " . \GuzzleHttp\json_encode($params) .
            ", Status: " . $response->getStatusCode() .
            ", Response: " . $respBody);

        if ($response->getStatusCode()===200) {
            return json_decode($respBody, true);
        }

        sleep(3);
        return false;
    }
}
