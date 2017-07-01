<a href="/cart">
	<div class="span3 cart<?=(!$empty)?'full':'';?>">
		<span>
			<? if($empty):?>
				Товары не выбраны
			<? else:?>
				Товаров на сумму <?=$sum?> руб.
			<? endif?>
		</span>
	</div>
</a>