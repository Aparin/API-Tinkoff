<style>
    .card_stock {
        border: 1px dotted grey;
        margin: 5px 2px;
        padding: 5px;
    }
</style>

<?php
function create_card($obj)
{
    echo ("
    <section class='card_stock'>
        <h2>$obj->title</h2>
        $obj->description
    </section>
    ");
}

class Stock
{
    public $title, $description;
}

$sber = new Stock;
$sber->title = "Сбербанк ап";
$sber->description = "Префы";
create_card($sber);

?>