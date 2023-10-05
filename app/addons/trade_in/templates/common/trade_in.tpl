{strip}
    <!-- Проверьте, что есть настройка trade_in для текущего товара -->
    {if $product_options.S|fn_check_is_active_trade_in_option}
        <!-- Добавьте текст с предложением обмена -->
        <p>Вы можете обменять этот товар на другой и получить скидку.</p>
        <!-- Добавьте ссылку на страницу с функцией обмена -->
        <a href="{""|fn_url:'index.trade_in?new_product_id=`$product.product_id`'}"
            class="ty-btn ty-btn__secondary">Обменять</a>
    {/if}
{/strip}