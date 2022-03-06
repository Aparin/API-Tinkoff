<?php
/* Plugin Name: Дивидендные акции | Znanion.ru
 * Plugin URI:
 * Author: Апарин Александр
 * Author URI: https://efeto.ru
 * Description: Контакты. Email: engineer.aparin@gmail.com, Telegram: https://t.me/aaaparin
 * Version: 1.0
 */

if (!defined('ABSPATH')) {
      exit; // Exit if accessed directly
}


function dividend_stocks()
{ ?>
      <style>
            .card_stock {
                  border: 1px dotted grey;
                  margin: 5px 2px;
                  padding: 0px 10px;
                  background-color: #6699FF;
                  color: white;
                  font-family: Georgia, 'Times New Roman', Times, serif;
                  font-size: 18px;
                  box-shadow: inset 1px 1px 6px 0 #dcdcdc;
            }

            .attention {
                  background-color: yellow;
                  color: #0d6efd;
                  padding: 6px;
                  border-radius: 50%;
            }

            h3 {
                  color: white;
                  padding-top: 10px;
            }

            h2 {
                  color: #49423d;
            }

            ;
      </style>
      <h2>Российские дивидендные акции: ожидаемые дивиденды в 2022</h2>

<?php
      include 'stocks_array.php';
      /*************** Вывод карточек           ****************/

      function create_card($stock)
      {
            $title = $stock->title;
            $last_price = number_format($stock->last_price, 2, '.', ',');
            $time = $stock->time;
            $dividend_amount = $stock->dividend_amount;
            $currency = $stock->currency;
            $description = $stock->description;
            $dividend_yield = $stock->dividend_yield;
            echo ("
            <section class='card_stock'>
                <h3>$title</h3>
                <p><b>Ожидаемая дивидендная доходность</b>:  <span class='attention'><b>$dividend_yield%</b></span>.</p> 
                <p>Цена: $last_price $currency <i>(на $time GMT)</i>. Размер дивидендов: $dividend_amount $currency.</p>
                $description
            </section>
            ");
      }

      foreach ($sorted_stocks as $stock) {
            create_card($stock);
      }
      /*************** Конец вывода        ****************/
}

add_shortcode('dividend_stocks', 'dividend_stocks');

?>