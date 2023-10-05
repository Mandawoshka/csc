<?php
/*****************************************************************************
*                                                                            *
*                   All rights reserved! eCom Labs LLC                       *
* http://www.ecom-labs.com/about-us/ecom-labs-modules-license-agreement.html *
*                                                                            *
*****************************************************************************/

if (!defined('BOOTSTRAP')) { die('Access denied'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($mode == 'request'){
		$params = $_REQUEST;
		if ($params['step'] == 1){
			$_SESSION['tradein']['first_product'] = $params['selected_product'];
			fn_redirect("tradein.view?step=".$params['step']);
		}
		if ($params['step'] == 2){
			$_SESSION['tradein']['second_product'] = $params['selected_product_second'];
			fn_redirect("tradein.view?step=".$params['step']);
		}
		if ($params['step'] == 3){
			$call_data = $_REQUEST['call_data'];	
			$call_data['notes'] = "Товар на обмен: " . fn_get_product_name($_SESSION['tradein']['first_product']) .". Желаемый товар: ". fn_get_product_name($_SESSION['tradein']['second_product']);
			if ($res = fn_do_call_request($call_data, $product_data, Tygh::$app['session']['cart'], Tygh::$app['session']['auth'])) {
                if (!empty($res['error'])) {
                    fn_set_notification('E', __('error'), $res['error']);
                } elseif (!empty($res['notice'])) {
                    fn_set_notification('N', __('notice'), $res['notice']);
                }
            }
		}
	}
}
if ($mode == 'view') {
	    if (isset($_SESSION['tradein']['first_product'])){
			$product = fn_get_product_name($_SESSION['tradein']['first_product']);
		    Tygh::$app['view']->assign('product_first', $product);
		}
	    
	    if (isset($_SESSION['tradein']['second_product'])){
			$product_second = fn_get_product_name($_SESSION['tradein']['second_product']);
		    Tygh::$app['view']->assign('product_second', $product_second);	
		}
	    if (!empty($_SESSION['tradein']['first_product']) && !empty($_SESSION['tradein']['second_product'])){
	    	$discount = fn_ecl_tradein_get_dicsount_tradein_price($_SESSION['tradein']['first_product'], $_SESSION['tradein']['second_product']);
	    	Tygh::$app['view']->assign('discount_price', $discount);	
	    }
}

if ($mode == "select_category"){
	

}

if ($mode == 'request'){
	$params = $_REQUEST;
	if (isset($params['step'])){
		$subcategories_first = [];
		if ($params['category_id']){
			$subcategories_first = fn_ecl_tradein_get_tradein_subcategories($params['category_id']);
		}
		Tygh::$app['view']->assign('subcategories_first', $subcategories_first);
		Tygh::$app['view']->assign('selected_category_first', $params['category_id']);
		if (!empty($params['subcategory_id'])){
			list($products_first, ) = fn_get_products(['cid'=> $params['subcategory_id'], 'area' => 'A', 'subcats' => "Y"]);
			Tygh::$app['view']->assign('selected_subcategory_first', $params['subcategory_id']);
			Tygh::$app['view']->assign('products_first', $products_first);
		}
	}

	if (isset($params['stepsec'])){
		$subcategories_second = [];
		if ($params['category_id']){
			$subcategories_second = fn_ecl_tradein_get_tradein_subcategories($params['category_id']);
		}
		Tygh::$app['view']->assign('subcategories_second', $subcategories_second);
		Tygh::$app['view']->assign('selected_category_second', $params['category_id']);
		if (!empty($params['subcategory_id'])){
			list($products_second, ) = fn_get_products(['cid'=> $params['subcategory_id'], 'area' => 'A', 'subcats' => "Y"]);
			Tygh::$app['view']->assign('selected_subcategory_second', $params['subcategory_id']);
			Tygh::$app['view']->assign('products_second', $products_second);
		}	
	}
	$categories_first = fn_ecl_tradein_get_tradein_subcategories(870);
	$categories_second = fn_ecl_tradein_get_tradein_categories();
    Tygh::$app['view']->assign('categories_first', $categories_first);
    Tygh::$app['view']->assign('categories_second', $categories_second);
}