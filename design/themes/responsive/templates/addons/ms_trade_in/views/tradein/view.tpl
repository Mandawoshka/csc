<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" async></script>
<div id="ecl_tradein_container">
	<section class="ecl-tradein__box" >
		<ol class="ecl-tradein__list">
			<li class="ecl-tradein__item">
				<p class="ecl-tradein__title">{__("old_device")}</p>
				<p class="ecl-tradein__description">
	        		{__("select_product_from_list")}
	  			</p>
	  			
				<style>
					.diagnosticList{
						width: 95%;
						margin-bottom: 16px;
					}
					.diagnosticList .checked p{
						background-color: #6b98b6;
					}
					.diagnosticList p{
						background-color: #454b53;
						font-size: 18px;
						color: #fff;
						width: 28px;
						height: 28px;
						display: flex;
						align-items: center;
						justify-content: center;
						border-radius: 50%;
					}
					.diagnosticItem{
						display: flex;
						align-items: center;
						justify-content: center;
						flex-direction: column;
					}
					@media(max-width:991px){
						.diagnosticItem {
							display: flex;
							align-items: center;
							justify-content: left;
							flex-direction: row;
							column-gap: 5px;
						}
						.diagnosticList{
							flex-direction: column;
							row-gap: 15px;
						}
						
					}
				</style>
				<div class="diagnosticList d-flex justify-content-between">
					<div class="diagnosticItem checked">
						<p>A</p>
						<span>{__("perfect_diagnostic_condition")}</span>
					</div>
					<div class="diagnosticItem">
						<p>B</p>
						<span>{__("average_diagnostic_condition")}</span>
					</div>
					<div class="diagnosticItem">
						<p>C</p>
						<span>{__("bad_diagnostic_condition")}</span>
					</div>
				</div>
				
				<span style="margin-bottom: 16px;color: #939393;">{__("note_diagnostic_condition")}</span>
	  			{* <button class="ecl-tradein__add">
	        		Добавить
	      		</button> *}
	      		{if $product_first}
		      		{$btn_first_title = $product_first}
	      		{else}
	      			{$btn_first_title = __("add")}
	      		{/if}
	      		 {include file="common/popupbox.tpl"
	                href="tradein.request"
	                link_text=$btn_first_title
	                text=__("add")
	                id="tradein_popup_add_first"
	                link_meta="ecl-tradein__add "
	                content=""
	                link_text_meta="ecl-tradein__btn-text"
	                dialog_additional_attrs=["data-ca-dialog-purpose" => "ecl_tradein"]
	        	}
	      	</li>
	      	<li class="ecl-tradein__item">
	      		<p class="ecl-tradein__title">{__("new_device")}</p>
	      		<p class="ecl-tradein__description">
	        		{__("select_product_from_list_b")}
	  			</p>
	  		{* 	<button class="ecl-tradein__add">
	        		Добавить
	        	</button> *}
	        	{if $product_second}
		      		{$btn_second_title = $product_second}
	      		{else}
	      			{$btn_second_title = __("add")}
	      		{/if}
	        	{include file="common/popupbox.tpl"
	                href="tradein.request"
	                link_text=$btn_second_title
	                text=__("add")
	                id="tradein_popup_add_second"
	                link_meta="ecl-tradein__add cm-dialog-destroy-on-close"
	                link_text_meta="ecl-tradein__btn-text"
	                content=""
	                dialog_additional_attrs=["data-ca-dialog-purpose" => "ecl_tradein"]
	            }
	        </li>
	        <li class="ecl-tradein__item">
	        	<p class="ecl-tradein__title">
	        		{__("discount")} 
	        	
	        	</p>
        			{if isset($discount_price)}
	        			{if $discount_price.total >= 0}
	        			<div class="ecl-tradein-steps__economy">
	        				<p class="ecl-tradein-steps__economy-item">
	        					<span class="ecl-tradein-steps__economy-title">{__("you_can_save_tradein")}</span>
	        					<span class="ecl-tradein-steps__economy-price">
		        					{include file="common/price.tpl" value=$discount_price.economy}
		        				</span>
	        				</p>
	        				<p class="ecl-tradein-steps__economy-item">
		        				<span class="ecl-tradein-steps__economy-title">{__("grand_total_tradein")}</span>
		        				<span class="ecl-tradein-steps__economy-price">
		        					{include file="common/price.tpl" value=$discount_price.total}
		        				</span>
		        			</p>
	        			</div>
	        			{else}
	        				<p class="ecl-tradein__description">
	        					{__("we_will_contact_to_send_you_price")}
			      			</p>
	        			{/if}
	        		{else}
	        			<p class="ecl-tradein__description">
			        		{__("select_product_from_list_c")}
			      		</p>
	        		{/if}
	      		{if isset($product_first) && isset($product_second)}
		      		{include file="common/popupbox.tpl"
		                href="tradein.request"
		                link_text=__("make_a_request")
		                text=__("make_a_request")
		                id="tradein_popup_confirm"
		                link_meta="ecl-tradein__add cm-dialog-destroy-on-close"
		                content=""
		                dialog_additional_attrs=["data-ca-product-id" => $product.product_id, "data-ca-dialog-purpose" => "tradein"]
		            }
	      		{else}
		      		<button disabled="disabled" class="ecl-tradein__order">
		        		Оформить заявку
		      		</button>
	      		{/if}
	      		

	      		
	      	</li>
	      </ol>
	  </section>
  <!--ecl_tradein_container--></div>