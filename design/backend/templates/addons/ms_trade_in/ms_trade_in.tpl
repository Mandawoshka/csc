{**
    @title Настройки модуля MS Trade-In
    @description Настройки модуля MS Trade-In
    @group MS Trade-In
    @type settings
    @code ms_trade_in
    @version 1.0
    @author Morningstar
    @copyright Copyright (c) Morningstar
    @license MIT License
*}

{include file="common/usergroup_picker.tpl" usergroups=$usergroups}

{include file="common/selectbox.tpl" options=$categories name="settings[buy_category_id]" selected=$buy_category_id}

{include file="common/selectbox.tpl" options=$categories name="settings[exchange_category_id]" selected=$exchange_category_id}