<?php

namespace App\Integrations\TIM;

use Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Request
{
    private $client;
    private $endpoint = 'https://uat.api.thisisme.com';
    private $headers;

    public function __construct()
    {
        $this->headers = ['auth' => [ env('TIM_PASSWD'), ''] ];
        $this->client = new Client([
            'base_uri' => $this->endpoint,
            'timeout' => '60.0',
            'ssl_key' => env('TIM_CERT_LOCATION') . 'www.consent.global.key.pem',
            'verify' => env('TIM_CERT_LOCATION') . 'thisisme_ca_bundle.pem',
            'cert' => [ env('TIM_CERT_LOCATION') . 'www.consent.global.pem', env('TIM_CERT_PASSWD') ],
        ]);
    }

    /**
     * Returns Guzzle Response configured with TIM request options
     * @param  string $type Type of request eg: GET, POST
     * @param  string $url Url to be appended to base URI
     * @param  array $formParams form fields needed to be sent
     * @return GuzzleHttp\Psr7\Response
     */
    public function send(
        string $type = 'GET',
        string $url = '/',
        array $formParams = []
    ) {
        try {
            return $this->client->request($type, $url, [
                'headers' => $this->headers,
                'curl' => [
                    CURLOPT_SSL_VERIFYHOST => false
                ],
                'form_params' => $formParams
            ]);
        } catch (GuzzleException $ex) {
            Log::error($ex);
        }
    }
}
