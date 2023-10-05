<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Добавьте новую группу прав для вашего аддона
$schema['controllers']['index']['modes']['trade_in'] = array(
'permissions' => 'trade_in',
);

// Добавьте новое право для вашего аддона
$schema['permissions']['admin']['trade_in'] = array(
'title' => 'Обмен товаров',
'description' => 'Разрешает использовать функцию обмена товаров'
);

// Верните схему
return $schema;

?>