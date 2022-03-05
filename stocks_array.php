<?php

//$j = @file_get_contents('https://znanion.ru/files/dengi/invest/tinkoff_last_prices.json');
$j = @file_get_contents('tinkoff_last_prices.json'); // string
$decode = (array)json_decode($j); //array
$stocks_data = $decode["lastPrices"];

function get_price($arr, $figi)
{
    foreach ($arr as $key => $value) {
        $current_ticker = $value->{'figi'};
        if ($figi == $current_ticker) {
            $rub = empty($value->{'price'}->{'units'}) ? "0" : ($value->{'price'}->{'units'});
            $kop = empty($value->{'price'}->{'nano'}) ? "00" : ($value->{'price'}->{'nano'});
            $price = number_format(($rub . "." . $kop), 2, '.', ',');
            return $price;
        }
    }
}
//echo get_price($arr, "BBG004730RP0");
class Share
{
    public $figi, $title, $last_price, $dividend_amount, $currency, $description, $dividend_yield;
    function __construct($figi, $title, $last_price, $dividend_amount, $currency, $description)
    {
        $this->figi = $figi;
        $this->title = $title;
        $this->last_price = $last_price;
        $this->dividend_amount = $dividend_amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->dividend_yield = round($this->dividend_amount / $this->last_price * 100, 2);
    }
}

/*************** Данные акций **********************/
$stocks = [];

function create_stock($stocks_data, $arg)
{
    list($figi, $title, $dividend_amount, $currency, $description) = $arg;
    $last_price = get_price($stocks_data, $figi);
    $some_stock = new Share($figi, $title, $last_price, $dividend_amount, $currency, $description);
    return ($some_stock);
}
include './stocks_info/sberp.php';
array_push($stocks, create_stock($stocks_data, $sberp));
include './stocks_info/gazprom.php';
array_push($stocks, create_stock($stocks_data, $gazprom));

/*************** Данные акций Конец ****************/

/*************** Сортировка массива объектов ****************/

function bubble_sort($arr)
{
    $size = count($arr) - 1;
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size - $i; $j++) {
            $k = $j + 1;
            if ($arr[$k] < $arr[$j]) {
                // Swap elements at indices: $j, $k
                list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
            }
        }
    }
    return $arr;
}

$sorted_stocks = bubble_sort($stocks);
/*************** Конец сортировки            ****************/
