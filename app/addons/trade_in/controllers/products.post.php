<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Проверьте, что контроллер вызван с режимом view
if ($mode == 'view') {
    // Получите идентификатор товара из запроса
    $product_id = isset($_REQUEST['product_id']) ? $_REQUEST['product_id'] : 0;

    // Проверьте, что параметр задан и является числом
    if (is_numeric($product_id)) {
        // Вызовите функцию fn_trade_in_get_trade_in_products для получения списка товаров, доступных для обмена
        list($trade_in_products, $search) = fn_trade_in_get_trade_in_products(array('exclude_pid' => $product_id));

        // Проверьте, что функция вернула непустой список товаров
        if (!empty($trade_in_products)) {
            // Установите переменную trade_in_products в реестре для передачи в шаблон
            Tygh::$app['view']->assign('trade_in_products', $trade_in_products);
        }
    }
}