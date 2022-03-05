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

/*

$sber = new Share(
    $title = "Сбербанк ап",
    $last_price = $price,
    $dividend_amount = 24,
    $currency = "руб",
    $description = "<p>Префы Сбера могут быть хорошей инвестицией на долгосрок</p>"
);
array_push($stocks, $sber);

$price = get_price($arr, "BBG004730RP0");
$gazprom = new Share(
    $title = "Газпром (тикер: GAZP)",
    $last_price = $price,
    $dividend_amount = 45.00,
    $currency = "руб",
    $description = "<p>«Газпром» ожидает рекордные дивиденды по итогам 2021 года, говорится в презентации компании. 
        За 9 мес. 2021 ожидается дивидендов 29,71 рубля на акцию (50% чистой прибыли по МФСО). 4 квартал ожидается рекордным по прибыли за всю историю компании.</p>
        <p>Дивиденды выплачивает 1 раз в год. Ожидаемый дивиденд за 2021 (отсечка в июле 2022) — не менее 45 руб. на акцию (заявление руководства).</p>
        <p>Купить акции Газпрома можно 
        <a class='attention' href='https://www.finam.ru/quote/moex-akcii/gazprom/?AgencyBackOfficeID=46&amp;agent=22d0a439-78b4-4932-a042-fdc54a8f0b0c&amp;utm_term=gazprom' target='_blank' rel='nofollow noopener'>
        здесь</a>
        "
);
array_push($stocks, $gazprom);
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
?>

<!--
    $data = json_encode(json_decode($j), JSON_PRETTY_PRINT);
    // echo '
    <pre>' . $data . '</pre>';

    /******************-
    [
    "figi" => "",
    "ticker" => "",
    "name" => "",
    "dividends" => "",
    ],
    "figi": [
    "BBG0047315Y7", // SBERP
    "BBG004S681W1", // MTSS
    "BBG000PR0PJ6", // NLMK
    "BBG004731032", // LKOH
    "BBG004730RP0", // GAZP
    "BBG004S689R0", // PHOR
    "BBG000QFH687", // TGKA
    "BBG004S681M2", // SNGSP
    "BBG000GQSVC2", // NKNCP
    "BBG004S68BR5" // NMTP
    ]
    */
    ?>
    -->