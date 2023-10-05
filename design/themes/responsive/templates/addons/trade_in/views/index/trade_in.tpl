{strip}
    <!-- Проверьте, что есть стоимость обмена -->
    {if $trade_in_price}
        <!-- Добавьте текст с стоимостью обмена -->
        <p>Стоимость обмена: {$trade_in_price|format_price}</p>
    {/if}
    <!-- Проверьте, что есть сообщение об ошибке -->
    {if $error_message}
        <!-- Добавьте текст с сообщением об ошибке -->
        <p class="ty-error-text">{$error_message}</p>
    {/if}
{/strip}