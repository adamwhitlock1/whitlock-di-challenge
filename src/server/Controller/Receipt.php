<?php


namespace App\Controller;

use \BadMethodCallException;

class Receipt
{

    public function total(array $items, $coupon){
        if ($coupon > 1.00){
            throw new BadMethodCallException('Coupon must be 1.00 or less');
        }
        $sum = array_sum($items);
        if (!is_null($coupon)){
           return $sum - ($sum * $coupon);
        }
        return $sum;
    }

    public function tax($inputAmount, $inputTax){
        return $inputTax * $inputAmount;
    }

    public function postTaxTotal($items, $tax, $coupon){
        $subtotal = $this->total($items, $coupon);
        return $subtotal + $this->tax($subtotal, $tax);
    }

    public function currencyAmt($input){
        return round($input, 2);
    }
}