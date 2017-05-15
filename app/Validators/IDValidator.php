<?php

namespace App\Validators;

class IDValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->validateID($value);
    }

    public function externalValidate($idNumber)
    {
        return $this->validateID($idNumber);
    }

    private function validateID($idInput)
    {
        if (strlen($idInput) === 0 || $idInput === null) {
            return false;
        }

        $id = $this->convert($idInput);

        if (count($id) !== 13) {
            return false;
        }

        $a = 0;
        $_b = "";
        for ($j = 0; $j < 12; $j++) {
            if (($j % 2) === 0) {
                $a += intval($id[$j]);
            } else {
                $_b .= strval($id[$j]);
            }
        }
        $b = intval($_b) * 2;

        $bSum = 0;
        foreach ($this->convert($b) as $bValue) {
            $bSum += intval($bValue);
        }
        $c = $a + $bSum;

        $c_digits = $this->convert($c);
        $c_length = sizeof($c_digits);

        $d = 10 - $c_digits[$c_length - 1];

        $d_digits = $this->convert($d);
        $d_length = sizeof($d_digits);

        return intval($d_digits[$d_length - 1]) === intval($id[12]);
    }

    private function convert($value)
    {
        return str_split(strval($value));
    }
}
