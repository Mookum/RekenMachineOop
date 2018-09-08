<?php

class RekenMachine
{

    public function __construct()
    {

        $this->currentValue = $_SESSION['currentValue'];
        $this->id = $_SESSION['aantal'];


    }

    public $id; // de id

    public $firstNumber; // eerste nummer

    public $bewerking; // de bewerking

    public $delimiter;

    public $lastNumber; // laatste nummer

    public $currentValue; // uitkomst

    public $action;

    public $voter = array(
        1 => '+',
        2 => '-',
        3 => 'x',
        4 => '/'
    );

    public function getCalcMultiply() {
        $result = $this->firstNumber * $this->lastNumber;
        return $result;
    }

    public function getCalcSubstract() {
        $result = $this->firstNumber - $this->lastNumber;
        return $result;
    }

    public function getCalcAddingUp() {
        $result = $this->firstNumber + $this->lastNumber;
        return $result;
    }

    public function getCalcParts() {
        $result = $this->firstNumber / $this->lastNumber;
        return $result;
    }

    public function setCurrentValue($voter) {
        switch ($voter) {
            case 1:
                $this->currentValue = $this->getCalcAddingUp();
                $this->delimiter = '+';
                break;
            case 2:
                $this->currentValue = $this->getCalcSubstract();
                $this->delimiter = '-';
                break;
            case 3:
                $this->currentValue = $this->getCalcMultiply();
                $this->delimiter = 'x';
                break;
            case 4:
                $this->currentValue = $this->getCalcParts();
                $this->delimiter = ':';
                break;
        }

        return $this->currentValue;
    }

    public function setAction() {
       $this->action = $this->firstNumber . ' ' . $this->delimiter  . ' ' . $this->lastNumber . ' = ' . $this->currentValue;

       return $this->action;
    }




}