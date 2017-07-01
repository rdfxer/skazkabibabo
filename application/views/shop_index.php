<?

function in_cart($id)
{
	$cart = Cookie::get('cart', false);
	if($cart)
	{
		$cart = unserialize($cart);
		return in_array($id, $cart);
	}
	else
		return false;
}
?>

<h1><?= $header?></h1>
<div class="txtdescr"><?= $description?></div>
<? if($count > 0):?>
	<ul>
		<? $i = 0;?>
		<? foreach($list as $row):?>
			<? $i++;?>
			<li class="span4 item">
				<div class="thumbnail">
					<? $imgsrc = (is_null($row->img_main)) ? '/static/img/noimg.png' : '/static/upload/goods/'.$row->id.'/s/'.$row->img_main;?>
					<a href="/shop/<?= $row->id?>"><img src="<?= $imgsrc?>" ></a>
					<div class="caption">
						<h2><a href="/shop/<?= $row->id?>"><?= $row->title?></a></h2>
						<p class="intro"><?= $row->intro?></p>
						<p class="price">
							<? $price = explode('.', number_format($row->price / 100, 2, '.', ''));?>
							<?= $price[0]?> руб. <?= ($price[1] != '00') ? $price[1].' коп.' : ''?><br />
							<a class="btn <?= (in_cart($row->id)) ? 'added' : ''?> mini to_cart" itemid="<?= $row->id?>">
								<?= (!in_cart($row->id)) ? 'В корзину' : 'Добавлено'?>
							</a>
						
						</p>
						<div class="alert alert-succ" style="display: none" id="cart_success_<?= $row->id?>">Успешно добавлено в корзину</div>
						<a class="bonus-mam" href="/bonus"></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</li>
			<? if(($i % 3) == 0):?>
				<div class="clearfix"></div>
			<? endif?>
		<? endforeach;?>
	</ul>
	<script type="text/javascript">
		$('a.to_cart').click(function() {
			var itemid = $(this).attr('itemid');
			if (!$(this).hasClass('added'))
			{
				$.ajax({
					type: "POST",
					url: "/ajax/addtocart",
					data: {id: itemid}
				}).done(function(r) {
					if (r == '1')
					{
				/*		$('#cart_success_' + itemid).show(300).delay(5000).hide(300);*/
						$('a.to_cart[itemid="' + itemid + '"]').addClass('added');
						$('a.to_cart[itemid="' + itemid + '"]').text('Добавлено');
						$('#cartwidget').load('/widgets/cart');
					}
				});
			}
		});
	</script>
<? else:?>
	<div>В данной категории товаров нет</div>
<? endif;?>
<? if($cat->video != '0'):?>
	<h4>Видео о категории товаров - <?= $header?></h4>
	<iframe width="560" height="315" src="http://www.youtube.com/embed/<?= $cat->video?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<br />
	<p><a href="/video">Перейти на страницу с видео</a></p>
<? endif?>