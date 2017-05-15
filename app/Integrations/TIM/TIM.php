<?php

namespace App\Integrations\TIM;

use App\Integrations\TIM\Request;
use App\Integrations\TIM\API;
use App\Integrations\TIM\Database;

class TIM
{
    public $api;
    public $database;

    public function __construct()
    {
        $this->api = new API(new Request());
        $this->database = new Database();
    }

    public function availableCalls()
    {
        $response = $this->api->availableCalls();

        return json_decode($response->getBody());
    }

    public function availableModules()
    {
        $response = $this->api->availableModules();

        return json_decode($response->getBody());
    }

    public function idCheck(string $country, string $identityNumber, $childId, string $action)
    {
        $formParams = [
            'country' => $country,
            'identity_number' => $identityNumber
        ];

        $response = $this->api->idCheck($formParams);

        if ($response === null) {
            return false;
        }

        $this->database->logRequest($childId, $identityNumber, $response->getBody(), $action);

        return json_decode($response->getBody());
    }
}
