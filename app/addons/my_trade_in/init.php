<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Регистрируем хук для добавления старого товара в корзину как часть оплаты за новый товар
fn_register_hooks(
'pre_add_to_cart',
'post_add_to_cart'
);

// Регистрируем хук для отображения информации о trade-in на карточке товара
fn_register_hooks(
'get_product_data_post'
);