<h1>Корзина</h1>
<? if(!empty($cart)):?>
	<table class="cartlist">
		<tr>
			<th>Название</th>
			<th>Цена</th>
			<th>Количество</th>
			<th></th>
		</tr>
		<? $sum = 0;?>
		<? foreach($cart as $k => $v):?>
			<? $item = ORM::factory('Good', $k);?>
			<? if($item->status == 1):?>
				<? $sum += (($item->price) / 100) * $v;?>
				<tr itemid="<?= $item->id?>">
					<td><a href="/shop/<?= $item->id?>"><?= $item->title?></a></td>
					<td><?= $item->price / 100?> руб.</td>
					<td><a class="cartminus icon-minus icon-white"></a> <span class="quantity"><?= $v?></span> <a class="cartplus icon-plus icon-white"></a></td>
					<td><a class="removefromcart icon-trash icon-white"></a></td>
				</tr>
			<? endif?>
		<? endforeach?>
		<tr class="last">
			<td colspan="4" align="right">
				Товаров на сумму: <span class="cartsum"><?= $sum?></span>
			</td>
		</tr>
		<tr class="last">
			<td colspan="4" align="right">
				<a class="cartorder btn btn-primary" href="/cart/order">Оформить заказ</a>
			</td>
		</tr>
	</table>
	<script type="text/javascript">
		$('a.removefromcart').click(function() {
			var itemid = $(this).parents('tr').attr('itemid');
			$.post('/ajax/removefromcart/' + itemid, function(result) {
				if (result !== '0')
				{
					$('tr[itemid="' + itemid + '"]').remove();
					$('.cartsum').html(result);
				}
			});
		});

		$('a.cartminus').click(function() {
			var q = $(this).next('.quantity');
			var itemid = $(this).parents('tr').attr('itemid');
			if (q.text() > 1)
			{
				$.post('/ajax/quantity', {id: itemid, method: 0, sum: $('.cartsum').text()}, function(result) {
					q.text(parseInt(q.text()) - 1);
					$('.cartsum').html(result);
				});
			}
		});

		$('a.cartplus').click(function() {
			var q = $(this).prev('.quantity');
			var itemid = $(this).parents('tr').attr('itemid');
			$.post('/ajax/quantity', {id: itemid, method: 1, sum: $('.cartsum').text()}, function(result) {
				q.text(parseInt(q.text()) + 1);
				$('.cartsum').html(result);
			});
		});

	</script>
<? else:?>
	<div class="txtdescr">Для оформления заказа сначала нужно добавить товары в корзину</div>
<?endif?>