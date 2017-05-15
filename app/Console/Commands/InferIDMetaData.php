<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Staff;
use App\Models\Child;
use Carbon\Carbon;

class InferIDMetaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infer:id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Infer ID meta data such as gender, citizenship, date of birth to respective fields';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Inferring meta data for Children...\n";

        $children = Child::all();

        foreach ($children as $child) {
            if ($child->id_number !== null || trim($child->id_number) !== "") {
                if ($this->validate($child->id_number)) {

                    if ($child->citizenship !== 'ZA') {
                        $child->citizenship = 'ZA';
                    }

                    if($child->gender !== $this->inferGender($child->id_number)) {
                        $child->gender = $this->inferGender($child->id_number);
                    }

                    if ($child->date_of_birth !== $this->inferDateOfBirth($child->id_number)) {
                        $child->date_of_birth = $this->inferDateOfBirth($child->id_number);
                    }
                    $child->save();
                }
            }
        }
        echo "Inferring meta data for Children...Done\n";
        echo "Inferring meta data for Staff...\n";
        $staff = Staff::all();

        foreach ($staff as $person) {
            if ($person->za_id_number !== null || trim($person->za_id_number) !== "") {
                if ($this->validate($person->za_id_number)) {

                    if ($person->citizenship !== 'ZA') {
                        $person->citizenship = 'ZA';
                    }

                    if($person->gender !== $this->inferGender($person->za_id_number)) {
                        $person->gender = $this->inferGender($person->za_id_number);
                    }

                    if ($person->date_of_birth !== $this->inferDateOfBirth($person->za_id_number)) {
                        $person->date_of_birth = $this->inferDateOfBirth($person->za_id_number);
                    }
                    $person->save();
                }
            }
        }
        echo "Inferring meta data for Staff...Done\n";
    }

    private function convert ($value)
    {
        return str_split(strval($value));
    }

    private function validate ($idInput)
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

    private function inferGender($idNumber) {
        $genderValue = substr($idNumber, 6, 4);

        if (intval($genderValue) >= 5000) {
            return "male";
        } else {
            return "female";
        }

        return null;
    }

    private function inferDateOfBirth($idNumber) {
        $yearPart = substr($idNumber, 0, 2);
        $month = substr($idNumber, 2, 2);
        $day = substr($idNumber, 4, 2);

        $dateWithOldPrefix = '19' . $yearPart . $month . $day;
        $dateWithNewPrefix = '20' . $yearPart . $month . $day;

        $oldDate = Carbon::createFromDate('19' . $yearPart, $month, $day);
        $newDate = Carbon::createFromDate('20' . $yearPart, $month, $day);
        // $oldDate = Carbon::createFromFormat('Ymd', $dateWithOldPrefix);
        // $newDate = Carbon::createFromFormat('Ymd', $dateWithNewPrefix);
        $nowDate = Carbon::now();

        $nowDateYearPart = $nowDate->format('Y');

        if (intval($yearPart) <= intval(substr($nowDateYearPart, 2, 2))) {
            return $newDate->toDateString();
        } else {
            return $oldDate->toDateString();
        }
    }
}
