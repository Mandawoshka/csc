<?php

if (!defined('BOOTSTRAP')) {die('Access denied');}

function fn_sec_sku_addon_get_products( $params, &$fields, $sortings, $condition, $join, $sorting, $group_by, $lang_code, $having)
{

    $fields['sec_sku'] = 'products.second_product_code';

}

function fn_sec_sku_addon_additional_fields_in_search( $params, $fields, $sortings, $condition, $join, $sorting, $group_by, &$tmp, &$piece, $having, $lang_code)
{

    $tmp .= db_quote(' OR products.second_product_code LIKE ?l', '%' . $piece . '%');

}