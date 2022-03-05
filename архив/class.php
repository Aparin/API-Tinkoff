<?php

class Share
{
    public $figi, $ticker, $name, $last_price, $dividend_size, $percentage_dividend_yield;
    public function last_price()
    {
        echo "last price is " . $this->last_price . "руб";
    }
}

$sber = new Share;
$sber->last_price = 245;
$sber->last_price();
