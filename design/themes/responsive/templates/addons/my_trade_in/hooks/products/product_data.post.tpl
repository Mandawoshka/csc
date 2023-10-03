{[** @var cart array **](https://www.bing.com/search?form=SKPBOT&q=%20%40var%20cart%20array%20)}
{[** @var product array **](https://www.bing.com/search?form=SKPBOT&q=%20%40var%20product%20array%20)}

{if $product.extra.my_trade_in == "Y"}
<div class="ty-product-block__trade-in-info">
<span class="ty-product-block__trade-in-label">{__("my_trade_in.old_product_price")}</span>
<span class="ty-product-block__trade-in-value">{$product.price|format_price}</span>
</div>
{/if}