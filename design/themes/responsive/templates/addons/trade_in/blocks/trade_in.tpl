{strip}
    <!-- Проверьте, что есть список товаров для обмена -->
    {if $trade_in_products}
        <!-- Создайте форму для отправки запроса на обмен -->
        <form action="{""|fn_url}" method="post" name="trade_in_form" class="cm-ajax">
            <!-- Добавьте скрытое поле с идентификатором текущего товара -->
            <input type="hidden" name="new_product_id" value="{$product.product_id}" />
            <!-- Добавьте скрытое поле с режимом trade_in -->
            <input type="hidden" name="dispatch[index.trade_in]" value="" />
            <!-- Добавьте заголовок блока -->
            <h3>Обменять этот товар на другой</h3>
            <!-- Добавьте выпадающий список с товарами для обмена -->
            <select name="old_product_id" id="old_product_id"
                onchange="Tygh.$.ceAjax('request', fn_url('index.trade_in'), {result_ids: 'trade_in_price'});">
                <!-- Добавьте пустой элемент списка -->
                <option value="">Выберите товар</option>
                <!-- Переберите массив с товарами для обмена -->
                {foreach from=$trade_in_products item=trade_in_product}
                    <!-- Добавьте элемент списка с названием и ценой товара -->
                    <option value="{$trade_in_product.product_id}">{$trade_in_product.product} -
                        {$trade_in_product.price|format_price}</option>
                {/foreach}
            </select>
            <!-- Добавьте блок для отображения стоимости обмена -->
            <div id="trade_in_price">
                <!-- Проверьте, что есть стоимость обмена -->
                {if $trade_in_price}
                    <!-- Добавьте текст с стоимостью обмена -->
                    <p>Стоимость обмена: {$trade_in_price|format_price}</p>
                    <!-- Добавьте кнопку для добавления товаров в корзину -->
                    <button type="submit" class="ty-btn__primary">Добавить в корзину</button>
                {/if}
                <!-- Проверьте, что есть сообщение об ошибке -->
                {if $error_message}
                    <!-- Добавьте текст с сообщением об ошибке -->
                    <p class="ty-error-text">{$error_message}</p>
                {/if}
            </div>
        </form>
    {/if}
{/strip}