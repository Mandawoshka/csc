{if $runtime.controller == 'addons' && $runtime.mode == 'manage' && !$smarty.capture.ecl_icon}
    <script type="text/javascript" class="cm-ajax-force">
    (function(_, $) {
        $(document).ready(function(){
            $('[id^="addon_ecl_"] .bg-icon').css('background-image', 'url(https://ecom-labs.com/images/ecl_logo.png)').css('background-size', 'cover');
            $('[id^="addon_ecl_"] .bg-icon i').css('display', 'none');
            $('[id^="addon_ecl_"] .addons-addon-icon__image').css('background-image', 'url(https://ecom-labs.com/images/ecl_addon_icon.png)').css('background-size', '50px 50px').css('background-repeat', 'no-repeat').css('background-position', 'center').css('font-size', '0');
        });
    }(Tygh, Tygh.$));
    </script>
    {capture name="ecl_icon"}Y{/capture}
    {elseif $runtime.controller == 'addons' && $runtime.mode == 'update' && !$smarty.capture.ecl_icon}
    <script type="text/javascript" class="cm-ajax-force">
    (function(_, $) {
        $(document).ready(function(){
            if ($('div[id^="content_groupecl_"]').length) {
                $('.addons-addon-icon__image').css('background-image', 'url(https://ecom-labs.com/images/ecl_addon_icon.png)').css('background-size', '50px 50px').css('background-repeat', 'no-repeat').css('background-position', 'center').css('font-size', '0');
            }
        });
    }(Tygh, Tygh.$));
    </script>
    {capture name="ecl_icon"}Y{/capture}
    {/if}
    
    {if $runtime.controller == 'addons' && $runtime.mode == 'manage'}
    <script type="text/javascript" class="cm-ajax-force">
    (function(_, $) {
        $(document).ready(function(){
            if (typeof(ecl_applied) == 'undefined') {
            $('[id^="addon_ecl_"] .exicon-box-blue').css('background-image', 'url(https://ecom-labs.com/images/ecl_logo.png)').css('background-position', '0px').css('width', '31px').css('height', '33px').css('margin-top', '0px');
            var ecl_applied = true;
            }
        });
    }(Tygh, Tygh.$));
    </script>
    {/if}
    
    {if $runtime.controller == 'addons' && $runtime.mode == 'manage'}
    <script type="text/javascript" class="cm-ajax-force">
    (function(_, $) {
        $(document).ready(function(){
            if (typeof(ecl_applied) == 'undefined') {
            $('[id^="addon_ecl_"] .exicon-box-blue').css('background-image', 'url(https://ecom-labs.com/images/ecl_logo.png)').css('background-position', '0px').css('width', '31px').css('height', '33px').css('margin-top', '0px');
            var ecl_applied = true;
            }
        });
    }(Tygh, Tygh.$));
    </script>
    {/if}
    