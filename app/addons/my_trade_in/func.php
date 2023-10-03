<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Функция для проверки, является ли товар подходящим для trade-in
function fn_my_trade_in_is_product_eligible($product_id)
{
// Получаем настройки модуля
$settings = Registry::get('addons.my_trade_in');

// Если модуль выключен, то возвращаем false
// if ($settings['trade_in_enabled'] != 'Y') {
// return false;
// }

// Получаем информацию о товаре
$product = fn_get_product_data($product_id, $_SESSION['auth']);

// Если товар не найден, то возвращаем false
if (empty($product)) {
return false;
}

// Если указаны категории товаров, доступные для trade-in, то проверяем, принадлежит ли товар к одной из них
if (!empty($settings['trade_in_category_ids'])) {
$category_ids = explode(',', $settings['trade_in_category_ids']);
if (!in_array($product['main_category'], $category_ids)) {
return false;
}
}

// Здесь вы можете добавить другие условия для проверки товара, например, по бренду, состоянию и т.д.

// Если все проверки пройдены, то возвращаем true
return true;
}

// Функция для расчета стоимости старого товара в зависимости от его характеристик
function fn_my_trade_in_calculate_old_product_price($product_id, $features)
{
// Получаем настройки модуля
$settings = Registry::get('addons.my_trade_in');

// Получаем информацию о товаре
$product = fn_get_product_data($product_id, $_SESSION['auth']);

// Если товар не найден, то возвращаем 0
if (empty($product)) {
return 0;
}

// Получаем формулу расчета стоимости старого товара из настроек модуля
$formula = $settings['trade_in_formula'];

// Заменяем переменную price на цену товара
$formula = str_replace('price', $product['price'], $formula);

// Заменяем переменные feature_1, feature_2 и т.д. на значения характеристик товара
foreach ($features as $feature_id => $feature_value) {
$formula = str_replace('feature_' . $feature_id, $feature_value, $formula);
}

// Вычисляем значение формулы с помощью функции eval
$price = 0;
eval('$price = ' . $formula . ';');

// Округляем результат до двух знаков после запятой
$price = round($price, 2);

// Возвращаем результат
return $price;
}

// Функция для добавления старого товара в корзину как часть оплаты за новый товар
function fn_my_trade_in_add_old_product_to_cart(&$cart, &$product_id, &$amount)
{
// Проверяем, есть ли в сессии информация о выбранном старом товаре
if (!empty($_SESSION['my_trade_in']['old_product_id'])) {
// Получаем идентификатор и характеристики старого товара из сессии
$old_product_id = $_SESSION['my_trade_in']['old_product_id'];
$old_product_features = $_SESSION['my_trade_in']['old_product_features'];

// Рассчитываем стоимость старого товара с помощью нашей функции
$old_product_price = fn_my_trade_in_calculate_old_product_price($old_product_id, $old_product_features);

// Добавляем старый товар в корзину как отрицательную сумму (скидку)
$cart['products'][$old_product_id] = array(
'product_id' => $old_product_id,
'amount' => 1,
'price' => -$old_product_price,
'original_price' => -$old_product_price,
'stored_price' => 'Y',
'extra' => array(
'my_trade_in' => 'Y',
'parent' => $product_id
)
);

// Обновляем сумму корзины
$cart['subtotal'] -= $old_product_price;
$cart['total'] -= $old_product_price;

// Удаляем информацию о выбранном старом товаре из сессии
unset($_SESSION['my_trade_in']);
}
}

// Функция для отображения информации о trade-in на страницах магазина
function fn_my_trade_in_get_product_data_post(&$product_data, $auth, $preview)
{
// Проверяем, является ли товар подходящим для trade-in с помощью нашей функции
if (fn_my_trade_in_is_product_eligible($product_data['product_id'])) {
// Добавляем в массив товара флаг, что он доступен для trade-in
$product_data['my_trade_in_available'] = true;
}
}