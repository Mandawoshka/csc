{$id = "tradein_popup_add_first"}

<div class="hidden" title="{__("add")}" id="content_tradein_popup_add_first">

    <form name="tradein_form" id="form_{$id}" action="{""|fn_url}" method="post" class="cm-ajax cm-processing-personal-data" data-ca-processing-personal-data-without-click="true">
        <div id="ecl-tradein_select_category_div">
            
        <div class="ty-control-group">
            <label class="ty-control-label" for="ecl-tradein_select_category_first">{__("select_product_type")}</label>
            <div class="ty-controls">
                <select class="select2-single" id="ecl-tradein_select_category_first" name="selected_category_first" style="width: 100%;margin-top: 10px;" onchange="fn_ecl_tradein_choose_category(1)">
                    {if isset($selected_category_first)}
                        <option selected='selected' value="{$selected_category_first}">{$selected_category_first|fn_get_category_name}</option>
                    {/if}
                    <option value="">{__("type")}</option>
                    {foreach from=$categories_first item=category key=category_id}
                        <option value="{$category_id}">{$category.category}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-label">{__("select_product_brand")}</label>
            <div class="ty-controls">
                <select class="select2-single" name="selected_subcategory_first" id="ecl-tradein_select_subcategory_first" style="width: 100%;margin-top: 10px;" {if empty($subcategories_first)}disabled="disabled"{/if} onchange="fn_ecl_tradein_choose_category(2)">
                    {if !empty($selected_subcategory_first)}
                        <option selected='selected'>{$selected_subcategory_first|fn_get_category_name}</option>
                    {/if}
                    <option value="">{__("brand")}</option>
                    {foreach from=$subcategories_first item=category key=category_id}
                        <option value="{$category_id}">{$category.category}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="ty-control-group">
            <label class="ty-control-label">{__("select_product_from_list")}</label>
            <div class="ty-controls">
                <select class="select2-single" name="selected_product" style="width: 100%;margin-top: 10px;" {if empty($products_first)}disabled="disabled"{/if}>
                    <option value="">{__("product")}</option>
                        {foreach from=$products_first item=product key=product_id}
                            <option value="{$product.product_id}">{$product.product}</option>
                        {/foreach}
                </select>
            </div>
        </div>
        <!--ecl-tradein_select_category_div--></div>

        <div class="ecl-tradein__button_block">
            <input type="hidden" name="step" value="1">
            <input type="hidden" name="result_ids" value="ecl_tradein_container">
            {* {include file="buttons/button.tpl" but_name="dispatch[tradein.request]" but_text=__("save") but_role="submit" but_meta="ecl-tradein__send cm-form-dialog-closer"} *}
            <button class="ecl-tradein__send cm-form-dialog-closer ty-btn" type="submit" onclick="$('html').removeClass('dialog-is-open')" name="dispatch[tradein.request]"><span><bdi>{__("save")}</bdi></span></button>
        </div>
    </form>
    <script type="text/javascript">
    function fn_ecl_tradein_choose_category(step) {
        var category_id = $("#ecl-tradein_select_category_first").val();
        var subcategory_id = $("#ecl-tradein_select_subcategory_first").val();
        $.ceAjax('request', fn_url("tradein.request"), {
            data: {
                category_id,
                subcategory_id,
                step,
                result_ids: 'ecl-tradein_select_category_div',
            },
            callback:    function fn_init_select2() {
                $('select').select2({
                    width: "100%",
                    allowClear: false
                }) 
    }

        });
    }

    $(document).ready(function() {
          $('select').select2({
    width: "100%",
    allowClear: false
  })
    });

    $(document).ajaxStop(function() {
        $('select').select2({
    width: "100%",
    allowClear: false
  })
    }); 
</script>

<!--content_tradein_popup_add_first--></div>
<div class="hidden" title="{__("add")}" id="content_tradein_popup_add_second">
    <form name="tradein_form_b" id="form_tradein_popup_add_second" action="{""|fn_url}" method="post" class="cm-ajax cm-processing-personal-data" data-ca-processing-personal-data-without-click="true">

        <div id="ecl-tradein_select_category_div">
            
        <div class="ty-control-group">
            <label class="ty-control-label" for="ecl-tradein_select_category_second">{__("select_product_type")}</label>
            <div class="ty-controls">
                <select class="select2-single" id="ecl-tradein_select_category_second" name="selected_category_second" style="width: 100%;margin-top: 10px;" onchange="fn_ecl_tradein_choose_category_sec(1)">
                    {if isset($selected_category_second)}
                        <option selected='selected' value="{$selected_category_second}">{$selected_category_second|fn_get_category_name}</option>
                    {/if}
                    <option value="">{__("type")}</option>
                    {foreach from=$categories_second item=category key=category_id}
                        <option value="{$category_id}">{$category.category}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-label">{__("select_product_brand")}</label>
            <div class="ty-controls">
                <select class="select2-single" name="selected_subcategory_second" id="ecl-tradein_select_subcategory_second" style="width: 100%;margin-top: 10px;" {if empty($subcategories_second)}disabled="disabled"{/if} onchange="fn_ecl_tradein_choose_category_sec(2)">
                    {if !empty($selected_subcategory_second)}
                        <option selected='selected'>{$selected_subcategory_second|fn_get_category_name}</option>
                    {/if}
                    <option value="">{__("brand")}</option>
                    {foreach from=$subcategories_second item=category key=category_id}
                        <option value="{$category_id}">{$category.category}</option>
                    {/foreach}
                </select>
            </div>
        </div>

         <div class="ty-control-group">
            <label class="ty-control-label" style="margin-bottom: 10px" for="selected_product_second">{__("select_product_from_list_b")}</label>
            <div class="ty-controls">
                <select class="select2-single" name="selected_product_second" id="selected_product_second" style="width: 100%; margin-top: 10px;" {if empty($products_second)}disabled="disabled"{/if}>
                    <option value="">{__("product")}</option>
                    {foreach from=$products_second item=product key=product_id}
                        <option value="{$product.product_id}">{$product.product}</option>
                    {/foreach}
                       
                </select>
            </div>
        </div>
        <!--ecl-tradein_select_category_div--></div>
        <div class="ecl-tradein__button_block">
            <input type="hidden" name="step" value="2">
            <input type="hidden" name="result_ids" value="ecl_tradein_container">
            {* {include file="buttons/button.tpl" but_name="dispatch[tradein.request]" but_text=__("save") but_role="submit" but_meta="ecl-tradein__send cm-form-dialog-closer"} *}
            <button class="ecl-tradein__send cm-form-dialog-closer ty-btn" type="submit" onclick="$('html').removeClass('dialog-is-open')" name="dispatch[tradein.request]"><span><bdi>{__("save")}</bdi></span></button>
        </div>
    </form>
     <script type="text/javascript">
    function fn_ecl_tradein_choose_category_sec(stepsec) {
        var category_id = $("#ecl-tradein_select_category_second").val();
        var subcategory_id = $("#ecl-tradein_select_subcategory_second").val();
        $.ceAjax('request', fn_url("tradein.request"), {
            data: {
                category_id,
                subcategory_id,
                stepsec,
                result_ids: 'ecl-tradein_select_category_div,content_tradein_popup_add_second',
            },
            callback:    function fn_init_select2() {
              $('select').select2({
    width: "100%",
    allowClear: false
  }) 
    }

        });
    }

    $(document).ready(function() {
          $('select').select2({
    width: "100%",
    allowClear: false
  })
    });
        $(document).ajaxStop(function() {
        $('select').select2({
    width: "100%",
    allowClear: false
  })
    }); 
</script>
<!--content_tradein_popup_add_second--></div>
<div class="hidden" title="{__("make_a_request")}" id="content_tradein_popup_confirm">
    <form name="call_requests_form{if !$product}_main{/if}" id="form_{$id}" action="{""|fn_url}" method="post" class="cm-ajax{if !$product} cm-ajax-full-render{/if} cm-processing-personal-data" data-ca-processing-personal-data-without-click="true" {if $product} data-ca-product-form="product_form_{$obj_prefix}{$product.product_id}"{/if}>
    <input type="hidden" name="result_ids" value="ecl_tradein_container" />
    <div class="ty-control-group">
        <label class="ty-control-group__title" for="call_data_{$id}_name">{__("your_name")}</label>
        <input id="call_data_ecl_tradein_name" size="50" class="ty-input-text-full" type="text" name="call_data[name]" value="{$call_data.name}" />
    </div>
    <div class="ty-control-group">
        <label for="call_data_ecl_tradein_phone" class="ty-control-group__title cm-mask-phone-label cm-required">{__("phone")}</label>
        <input id="call_data_ecl_tradein_phone" class="ty-input-text-full cm-mask-phone ty-inputmask-bdi" size="50" type="text" name="call_data[phone]" value="{$call_data.phone}" data-enable-custom-mask="true" />
    </div>
    <div class="buttons-container">
            <input type="hidden" name="step" value="3">
        {* {include file="buttons/button.tpl" but_name="dispatch[tradein.request]" but_text=__("submit") but_role="submit" but_meta="ecl-tradein__send cm-form-dialog-closer"} *}
        <button class="ecl-tradein__send cm-form-dialog-closer ty-btn" type="submit" onclick="$('html').removeClass('dialog-is-open')" name="dispatch[tradein.request]"><span><bdi>{__("submit")}</bdi></span></button>
    </div>

</form>
<!--content_tradein_popup_confirm--></div>

