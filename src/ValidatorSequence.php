<?php

class ValidatorSequence
{
    private $inputStr;

    public function __construct($inputStr)
    {
        $this->ensureIsValidSequence($inputStr);
        $this->inputStr = $inputStr;
    }

    public function checkSequence(): bool
    {
        $sequence = $this->formatterSequence();
        $depth = 0;
        $strLen = strlen($sequence);
        for ($i = 0; $i < $strLen; $i++) {
            if (($sequence[$i]) == "(") {
                $depth++;
            } else $depth--;
            if ($depth < 0) return false;
        }
        if ($depth == 0) {
            return true;
        } else return false;
    }

    private function formatterSequence(): string
    {
        $outputArray = "";
        preg_match_all("/[#(#|#)#]*/", $this->inputStr, $outputArray);
        $result = "";
        foreach ($outputArray[0] as $value) $result .= $value;
        return $result;
    }

    private function ensureIsValidSequence($subject): void
    {
        $outVal = preg_match_all("/^[#(#|#)#|#\s#]*$/", $subject);
        if ($outVal !== 1) {
            throw new InvalidArgumentException(sprintf(
                '"%s" is not a valid sequence',
                $subject
            ));
        }
    }

    public function getInputStr(): string
    {
        return $this->inputStr;
    }

    public function setInputStr($inputStr): void
    {
        $this->inputStr = $inputStr;
    }
}
