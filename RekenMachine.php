<?php

class RekenMachine
{

    public function __construct()
    {
        $this->currentValue = 0;
    }

    public $id; // de id

    public $firstNumber; // eerste nummer

    public $bewerking; // de bewerking

    public $lastNumber; // laatste nummer

    public $currentValue; // uitkomst

    public function calculate($first, $bewerking, $last) {
        switch ($bewerking) {
            case 1:
                $result = $first + $last;
                break;
            case 2:
                $result = $first - $last;
                break;
            case 3:
                $result = $first * $last;
                break;
            case 4:
                $result = $first / $last;
                break;
        }

        return $result;
    }

}