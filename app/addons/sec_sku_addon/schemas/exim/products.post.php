<?php

$count_empty_second_product_code = db_get_field("SELECT COUNT(*) FROM ?:products WHERE second_product_code = ''");

if ($count_empty_second_product_code == 0) {

    $schema['export_fields']['Product code'] = array(
        'db_field' => 'product_code',
    );
    $schema['export_fields']['Product code 2'] = array(
        'db_field' => 'second_product_code',
        'alt_key' => true,
        'required' => true,
        'alt_field' => 'product_id'
    );

} else {
    // Код, который будет выполнен, если хотя бы у одного товара поле second_product_code пустое
    $schema['export_fields']['Product code 2'] = array(
        'db_field' => 'second_product_code',
    );
}


return $schema;