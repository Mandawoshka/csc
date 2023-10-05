<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Добавьте настройку trade_in в схему опций товаров
$schema['types']['S']['trade_in'] = array(
    'name' => TRADE_IN_OPTION_NAME,
    'variants_function' => 'fn_trade_in_get_trade_in_variants',
    'position' => 1000
);

// Функция для получения списка возможных значений для настройки trade_in
function fn_trade_in_get_trade_in_variants()
{
    // Создайте массив с двумя элементами: 'Y' и 'N'
    $variants = array(
        'Y' => array(
            'variant_name' => 'Да',
            'position' => 10
        ),
        'N' => array(
            'variant_name' => 'Нет',
            'position' => 20
        )
    );

    // Верните результат
    return $variants;
}

?>