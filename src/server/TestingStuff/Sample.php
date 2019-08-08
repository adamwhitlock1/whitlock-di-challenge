<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/7/19
 * Time: 7:23 PM
 */

namespace App\TestingStuff;


class Sample
{
    public function total(array $items = [])
    {
        return array_sum($items);
    }
}