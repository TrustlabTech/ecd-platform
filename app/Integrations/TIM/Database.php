<?php

namespace App\Integrations\TIM;

use App\Models\TIMHistory;

class Database
{
    public function logRequest($childId, $idNumber, $rawResponse, $action)
    {
        TIMHistory::create([
            'child_id' => $childId,
            'id_number' => $idNumber,
            'raw_response' => $rawResponse,
            'action' => $action
        ]);
    }
}
