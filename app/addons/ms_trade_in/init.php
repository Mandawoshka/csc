<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

fn_register_hooks(
	'get_categories'
);

fn_register_addon(
	'ms_trade_in',
	'backend'
);