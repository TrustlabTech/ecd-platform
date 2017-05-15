<?php

namespace App\Integrations\TIM;

use App\Integrations\TIM\Request;

class API
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function availableCalls()
    {
        return $this->request->send('GET', '/available_calls');
    }

    public function availableModules()
    {
        return $this->request->send('GET', '/available_modules');
    }

    public function idCheck(array $formParams)
    {
        return $this->request->send('POST', '/id_check', $formParams);
    }
}
