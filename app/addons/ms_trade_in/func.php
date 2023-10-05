<?php


use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }


function fn_ecl_tradein_get_categories($params, $join, &$condition, $fields, $group_by, $sortings, $lang_code)
{
	if (isset($params['use_tradein'])){
        $condition .= db_quote(' AND ?:categories.use_tradein = ?s', 'Y');
        $condition .= db_quote(' AND ?:categories.status IN (?a) ', array("A","H"));
	}
}

function fn_ecl_tradein_get_tradein_categories()
{
	$categories = db_get_hash_array("SELECT c.category_id, d.category FROM ?:categories as c LEFT JOIN ?:category_descriptions as d ON c.category_id = d.category_id AND d.lang_code = ?s WHERE c.status IN (?a) AND c.use_tradein = ?s", 'category_id', CART_LANGUAGE, array("A","H"), "Y");
	return $categories;
}

function fn_ecl_tradein_get_dicsount_tradein_price($product_id_first, $product_id_second){
	if (isset($product_id_first) && isset($product_id_second)){
		$price_first = fn_get_product_price($product_id_first, 1, $_SESSION['auth']);
		$price_second = fn_get_product_price($product_id_second, 1, $_SESSION['auth']);
		return ['total' => fn_convert_price($price_second - $price_first), 'economy' => $price_first] ;
	}
}

function fn_ecl_tradein_get_tradein_subcategories($category_id)
{
	$categories = db_get_hash_array("SELECT c.category_id, d.category FROM ?:categories as c LEFT JOIN ?:category_descriptions as d ON c.category_id = d.category_id AND d.lang_code = ?s WHERE c.status IN (?a) AND c.parent_id = ?i", 'category_id', CART_LANGUAGE, array("A","H"), $category_id);
	fn_print_r($categories);
	return $categories;	
}