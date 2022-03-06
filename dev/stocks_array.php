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
            $price = $rub . "." . $kop;
            $time = $value->{'time'};
            return [$price, $time];
        }
    }
}

class Share
{
    public $figi, $title, $last_price, $time, $dividend_amount, $currency, $description, $dividend_yield;
    function __construct($figi, $title, $last_price, $time, $dividend_amount, $currency, $description)
    {
        $this->figi = $figi;
        $this->title = $title;
        $this->time = $time;
        $this->last_price = $last_price;
        $this->dividend_amount = $dividend_amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->dividend_yield = number_format(round($this->dividend_amount / $this->last_price * 100, 1), 1);
    }
}

/*************** Данные акций **********************/
$stocks = [];

function create_stock($stocks_data, $arg)
{
    list($figi, $title, $dividend_amount, $currency, $description) = $arg;
    list($last_price, $full_time) = get_price($stocks_data, $figi);
    $time = substr($full_time, 8, 2) . '.' . // день
        substr($full_time, 5, 2) . '.' . // месяц
        substr($full_time, 0, 4) . // год
        ' ' .
        substr($full_time, 11, 2) . ':' . // час (гринвич)
        substr($full_time, 14, 2); // минута
    $some_stock = new Share($figi, $title, $last_price, $time, $dividend_amount, $currency, $description);
    return ($some_stock);
}
include './stocks_info/sberp.php';
array_push($stocks, create_stock($stocks_data, $sberp));
include './stocks_info/gazprom.php';
array_push($stocks, create_stock($stocks_data, $gazprom));
include './stocks_info/mts.php';
array_push($stocks, create_stock($stocks_data, $mts));
include './stocks_info/nlmk.php';
array_push($stocks, create_stock($stocks_data, $nlmk));
include './stocks_info/lukoil.php';
array_push($stocks, create_stock($stocks_data, $lukoil));


/*************** Данные акций Конец ****************/

/*************** Сортировка массива объектов ****************/

function bubble_sort($arr)
{
    $size = count($arr) - 1;
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size - $i; $j++) {
            $k = $j + 1;
            if ($arr[$k]->dividend_yield > $arr[$j]->dividend_yield) {
                // Swap elements at indices: $j, $k
                list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
            }
        }
    }
    return $arr;
}

$sorted_stocks = bubble_sort($stocks);
/*************** Конец сортировки            ****************/
