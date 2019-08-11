<?php


namespace App\Controller;


class Receipt
{
public function tax($inputAmount, $inputTax){
    return $inputTax * $inputAmount;
}
}