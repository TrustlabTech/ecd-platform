<?php

namespace App\Integrations\TIM;

use App\Models\TIMChildHistory;
use App\Models\TIMStaffHistory;

class Database
{
    public function logRequest($personId, $idNumber, $rawResponse,$personType, $action)
    {
        if($personType == 'child'){
            TIMChildHistory::create([
                'child_id' => $personId,
                'id_number' => $idNumber,
                'raw_response' => $rawResponse,
                'action' => $action
            ]);
        } else if($personType == 'staff'){
            if($personId == null){
                $personId = '0';
            }
            TIMStaffHistory::create([
                'staff_id' => $personId,
                'id_number' => $idNumber,
                'raw_response' => $rawResponse,
                'action' => $action
            ]);
        }
    }
}
