<h1>Оформление заказа</h1>
<? if(!empty($cart)):?>
	<table class="cartlist">
		<tr>
			<th>Название</th>
			<th>Цена</th>
			<th>Количество</th>
		</tr>
		<? $sum = 0;?>
		<? foreach($cart as $k => $v):?>
			<? $item = ORM::factory('Good', $k);?>
			<? if($item->status == 1):?>
				<? $sum += (($item->price) / 100) * $v;?>
				<tr itemid="<?= $item->id?>">
					<td><a href="/shop/<?= $item->id?>"><?= $item->title?></a></td>
					<td><?= $item->price / 100?> руб.</td>
					<td><?= $v?></td>
				</tr>
			<? endif?>
		<? endforeach?>
		<tr class="last">
			<td colspan="4" align="right">
				Товаров на сумму: <span class="cartsum"><?= $sum?></span>
			</td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<h2>Контактные данные</h2>
	<form class="form-horizontal" method="post" id="orderform">
		<div class="control-group">
			<label for="fio" class="control-label">Имя *</label>
			<div class="controls">
				<input type="text" name="fio" class="span5" id="fio" value="<?= Arr::get(Request::initial()->post(), 'fio', '')?>"/>
			</div>
		</div>	
		<div class="control-group">
			<label for="phone" class="control-label">Телефон</label>
			<div class="controls">
				<input type="text" name="phone" class="span5" value="<?= Arr::get(Request::initial()->post(), 'phone', '')?>"/>
			</div>
		</div>	
		<div class="control-group">
			<label for="email" class="control-label">E-mail *</label>
			<div class="controls">
				<input type="text" name="email" class="span5" id="email" value="<?= Arr::get(Request::initial()->post(), 'email', '')?>"/>
			</div>
		</div>
		<div class="control-group">
			<label for="address" class="control-label">Адрес доставки</label>
			<div class="controls">
				<textarea name="address" class="span5"><?= Arr::get(Request::initial()->post(), 'address', '')?></textarea>
			</div>
		</div>	
		<div class="control-group">
			<label for="comment" class="control-label">Комментарий к заказу</label>
			<div class="controls">
				<textarea name="comment" class="span5"><?= Arr::get(Request::initial()->post(), 'comment', '')?></textarea>
			</div>
		</div>	
		<div class="control-group">
			<label for="captcha" class="control-label">Напишите буквы с картинки</label>
			<div class="controls">						
				<input type="text" name="captcha" class="span2"/>
				<?= $captcha?>
				<? if(!empty($captchaerror)):?><label><?= $captchaerror?></label><? endif?>
			</div>			
		</div>	
		<input type="hidden" name="sum" value="<?= $sum?>"/>
		<div class="control-group">
			<div class="controls">
				<input type="submit" name="submit" class="btn btn-large" value="Заказать" id="submit_button" />
			</div>
		</div>	
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#orderform').validate(
					{rules: {fio: {required: true}, email: {required: true, email: true}}});
		});
	</script>
<? else:?>
	<div class="txtdescr">Для оформления заказа сначала нужно добавить товары в корзину</div>
<?endif?>