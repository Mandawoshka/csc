{include file="common/subheader.tpl" title=__("trade_in") target="#acc_addon_ms_trade_in"}
<div id="acc_addon_ms_trade_in" class="collapsed in">
    <div class="control-group">
        <label class="control-label" for="elm_category_use_for_trade_in">{__("use_for_trade_in")}:</label>
        <div class="controls">
        <input type="hidden" value="N" name="category_data[use_tradein]"/>
        <input type="checkbox" class="cm-toggle-checkbox" value="Y" name="category_data[use_tradein]" id="elm_category_use_for_trade_in"{if $category_data.use_tradein == "Y"} checked="checked"{/if} />
        </div>
    </div>
</div>