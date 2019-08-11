<?php


namespace App\Controller;


class Receipt
{

    public function total(array $items, $coupon){

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
}