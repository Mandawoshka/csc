<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Проверьте, что контроллер вызван с режимом trade_in
if ($mode == 'trade_in') {
    // Получите параметры из запроса
    $old_product_id = isset($_REQUEST['old_product_id']) ? $_REQUEST['old_product_id'] : 0;
    $new_product_id = isset($_REQUEST['new_product_id']) ? $_REQUEST['new_product_id'] : 0;

    // Проверьте, что оба параметра заданы и являются числами
    if (is_numeric($old_product_id) && is_numeric($new_product_id)) {
    // Вызовите функцию fn_trade_in_calculate_trade_in_price для расчета стоимости обмена
    $trade_in_price = fn_trade_in_calculate_trade_in_price($old_product_id, $new_product_id);

    // Проверьте, что функция вернула корректный результат
    if ($trade_in_price !== false) {
    // Установите переменную trade_in_price в реестре для передачи в шаблон
    Tygh::$app['view']->assign('trade_in_price', $trade_in_price);
    } else {
    // Установите сообщение об ошибке в реестре для передачи в шаблон
    Tygh::$app['view']->assign('error_message', 'Невозможно выполнить обмен между выбранными товарами');
    }
    } else {
    // Установите сообщение об ошибке в реестре для передачи в шаблон
    Tygh::$app['view']->assign('error_message', 'Некорректные параметры запроса');
    }

    // Установите имя шаблона для отображения результата
    Tygh::$app['view']->display('addons/trade_in/views/index/trade_in.tpl');

    // Завершите выполнение скрипта
    exit;
}