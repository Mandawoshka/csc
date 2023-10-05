<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Константа для определения имени настройки trade_in в таблице product_options
define('TRADE_IN_OPTION_NAME', 'Обмен');

// Хук для добавления флага trade_in в таблицу products при установке аддона
fn_register_hooks(
'install_trade_in',
// Хук для удаления флага trade_in из таблицы products при удалении аддона
'uninstall_trade_in',
// Хук для добавления настройки trade_in в таблицу product_options при создании или редактировании опции товара
'update_product_option_post',
// Хук для добавления поля trade_in в параметры поиска товаров
'get_products_pre',
// Хук для добавления условия по полю trade_in в запрос поиска товаров
'get_products',
// Хук для добавления стоимости обмена в данные корзины
'calculate_cart_items',
// Хук для добавления стоимости обмена в данные заказа
'place_order'
);

?>