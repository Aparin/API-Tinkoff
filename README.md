https://tinkoff.github.io/investAPI/swagger-ui/#/MarketDataService/MarketDataService_GetLastPrices

t.rSypVevyeKpV8SnwHnREU6bUy-4WO0z40acUrPFUIvdQSdRTY2TLGht4PbkLq7O366MPyiRDgusx7QoG5QlGmA
t.TMPE6pmL5xyXApA73H37Dql70Jg6eiQ2gAUlhsrXRqMwRYbtHX-qKgZs5ajAPkrkU3QEdi3BgDQmlDEujM3Eeg //sandbox

**GetLastPrices** Метод запроса последних цен по инструментам.
Тело запроса — GetLastPricesRequest
Тело ответа — GetLastPricesResponse

**GetLastPricesResponse** Список последних цен.
Field last_prices
Type LastPrice Массив объектов
Description Массив последних цен.

curl -X 'POST' \
 'https://invest-public-api.tinkoff.ru/rest/tinkoff.public.invest.api.contract.v1.MarketDataService/GetLastPrices' \
 -H 'accept: application/json' \
 -H 'Authorization: Bearer t.TMPE6pmL5xyXApA73H37Dql70Jg6eiQ2gAUlhsrXRqMwRYbtHX-qKgZs5ajAPkrkU3QEdi3BgDQmlDEujM3Eeg' \
 -H 'Content-Type: application/json' \
 -d '{
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
}'

Запрос в крон
curl 'znanion.ru/files/dengi/invest/tinkoff_last_prices.php' --output '/home/m/miruspeha/znanion.ru/public_html/files/dengi/invest/tinkoff_last_prices.json' --retry 1

curl 'znanion.ru/files/dengi/invest/tinkoff_last_prices.sh' --output '/home/m/miruspeha/znanion.ru/public_html/files/dengi/invest/tinkoff_last_prices.json' --retry 1

**Response body**

{
"lastPrices": [
{
"figi": "BBG0047315Y7",
"price": {
"units": "237",
"nano": 440000000
},
"time": "2022-01-27T08:57:18.388408Z"
},
{
"figi": "BBG004S681W1",
"price": {
"units": "281",
"nano": 450000000
},
"time": "2022-01-27T08:57:19.415596Z"
}
]
}
