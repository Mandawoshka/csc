<?php

if (!defined('BOOTSTRAP')) {
    die('Access denied');
}

use Tygh\Http;
use Tygh\Registry;




$my_city = fn_get_session_data('my_city');

if (empty($my_city)) {

    $ip = '128.124.208.5';

    $url = 'http://ipwho.is/';

    $param = [
        'ip' => $ip,
    ];

    $result = Http::get($url, $param);

    $my_city = json_decode($result, true);

    fn_set_session_data('my_city', $my_city);
    // fn_print_r(1);

}
if (!empty($my_city['city'])){
    Registry::get('view')->assign('my_city', $my_city);
}