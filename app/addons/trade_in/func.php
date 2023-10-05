<?php 
if (!defined('BOOTSTRAP')) { die('Access denied'); }

use Tygh\Registry;

// Функция для получения списка товаров, доступных для обмена
function fn_trade_in_get_trade_in_products($params){
    // Задайте параметры поиска товаров
    $params['status'] = 'A'; // Только активные товары
    $params['trade_in'] = 'Y'; // Только товары с флагом trade_in

    // Получите список товаров с помощью функции fn_get_products
    list($products, $search) = fn_get_products($params);

    // Верните результат
    return array($products, $search);
}



// Функция для расчета стоимости обмена
function fn_trade_in_calculate_trade_in_price($old_product_id, $new_product_id)
{
    // Получите данные о старом и новом товаре с помощью функции fn_get_product_data
    $old_product = fn_get_product_data($old_product_id);
    $new_product = fn_get_product_data($new_product_id);

    // Проверьте, что оба товара существуют и доступны для обмена
    if ($old_product && $new_product && $old_product['trade_in'] == 'Y' && $new_product['trade_in'] == 'Y') {
        // Рассчитайте стоимость обмена как разницу между ценами нового и старого товара
        $trade_in_price = $new_product['price'] - $old_product['price'];

        // Верните результат
        return $trade_in_price;
    } else {
        // Верните ошибку
        return false;
    }
}








?>