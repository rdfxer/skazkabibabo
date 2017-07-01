<div class="item-page">
	<p>
		<?
		$imgmain = '/static/img/noimg.png';
		if(!empty($item->img_main))
			$imgmain = '/static/upload/goods/'.$item->id.'/s/'.$item->img_main;
		else
		{
			if(!empty($images))
				$imgmain = '/static/upload/goods/'.$item->id.'/s/'.$images[0];
		}
		if(!file_exists(DOCROOT.$imgmain))
			$imgmain = '/static/img/noimg.png';
		?>
		<a data-lightbox="img-main"  href="<?= str_replace($item->id.'/s', $item->id, $imgmain)?>">
			<img src="<?= $imgmain?>"  class="img-main"/>
		</a>
	</p>

	<h1><?= $item->title?></h1>
	<p class="intro"><?= $item->intro?></p>
	<br />
	<p class="price">
		<? $price = explode('.', number_format($item->price / 100, 2, '.', ''));?>
		<?= $price[0]?> руб. <?= ($price[1] != '00') ? $price[1].' коп.' : ''?><br />
		<a class="btn <?= ($in_cart) ? 'added' : ''?> " href="#" id="to_cart"><?= (!$in_cart) ? 'В корзину' : 'Добавлено'?></a>
	<div class="alert alert-succ" style="display: none" id="cart_success">Успешно добавлено в корзину</div>
</p>
<script type="text/javascript">
			$('#to_cart').click(function() {
				if (!$(this).hasClass('added'))
				{
					$.ajax({
						type: "POST",
						url: "/ajax/addtocart",
						data: {id: "<?= $item->id?>"}
					}).done(function(r) {
						if (r == '1')
						{
							$('#cart_success').show(300).delay(5000).hide(300);
							$('#to_cart').addClass('added');
							$('#to_cart').text('Добавлено');
							$('#cartwidget').load('/widgets/cart');
						}
					});
				}
			});
</script>
<a class="bonus-mam" href="/bonus"></a>
<div class="clearfix"></div>
<? if(!empty($images)):?>
	<div id="carousel_container">
		<div id="left_scroll"><img src="/static/img/scrollleft.png" /></div>
		<div id="carousel_inner">
			<ul id="carousel_ul">
				<? foreach($images as $img):?>
					<li class="h100">
						<img alt="<?= $item->title?>" src="/static/upload/goods/<?= $item->id?>/ss/<?= $img?>" class="chng-img">
					</li>
				<? endforeach;?>
			</ul>
		</div>
		<div id="right_scroll"><img src="/static/img/scrollright.png" /></div>
	</div>
<? endif?>

<br />
<div class="descr-full clearfix">
	<?= $item->description?>
</div>
<br />
<hr />
<? if(!empty($alike)):?>
	<h4>С этим товаром покупают:</h4>
	<div id="carousel_container2">
		<div id="left_scroll2"><img src="/static/img/scrollleft.png" /></div>
		<div id="carousel_inner2">
			<ul id="carousel_ul2">
				<? foreach($alike as $alrow):?>
					<li>
						<div class="intro"><a href="/shop/<?= $alrow->id?>"><?= $alrow->title?></a></div>
						<a href="/shop/<?= $alrow->id?>"><img alt="<?= $alrow->title?>" src="<?= $alike_imgs[$alrow->id]?>"></a>
					</li>
				<? endforeach;?>
			</ul>
		</div>
		<div id="right_scroll2"><img src="/static/img/scrollright.png" /></div>
	</div>
<? endif?>
</div>
<script type="text/javascript">
	function rightScroll()
	{
		var item_width = $('#carousel_ul li').outerWidth() + 10;
		var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;
		$('#carousel_ul:not(:animated)').animate({'left': left_indent}, 500, function() {
			$('#carousel_ul li:last').after($('#carousel_ul li:first'));
			$('#carousel_ul').css({'left': '0px'});
		});
	}

	function rightScroll2()
	{
		var item_width = $('#carousel_ul2 li').outerWidth() + 10;
		var left_indent = parseInt($('#carousel_ul2').css('left')) - item_width;
		$('#carousel_ul2:not(:animated)').animate({'left': left_indent}, 500, function() {
			$('#carousel_ul2 li:last').after($('#carousel_ul2 li:first'));
			$('#carousel_ul2').css({'left': '0px'});
		});
	}

	/* .window.setInterval(function(){
	 rightScroll();
	 }, 5000); */


	$(document).ready(function() {
		$('#carousel_ul li:first').before($('#carousel_ul li:last'));
		$('#right_scroll').click(function() {
			rightScroll();
		});

		$('#left_scroll').click(function() {
			var item_width = $('#carousel_ul li').outerWidth() + 10;
			var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;
			$('#carousel_ul:not(:animated)').animate({'left': left_indent}, 500, function() {
				$('#carousel_ul li:first').before($('#carousel_ul li:last'));
				$('#carousel_ul').css({'left': '0px'});
			});
		});

		$('#carousel_ul2 li:first').before($('#carousel_ul2 li:last'));
		$('#right_scroll2').click(function() {
			rightScroll2();
		});

		$('#left_scroll2').click(function() {
			var item_width = $('#carousel_ul2 li').outerWidth() + 10;
			var left_indent = parseInt($('#carousel_ul2').css('left')) + item_width;
			$('#carousel_ul2:not(:animated)').animate({'left': left_indent}, 500, function() {
				$('#carousel_ul2 li:first').before($('#carousel_ul2 li:last'));
				$('#carousel_ul2').css({'left': '0px'});
			});
		});

		var imgsrc;
		$(".chng-img").click(function() {
			imgsrc = $(this).attr('src');
			$(".img-main").attr('src', imgsrc.replace('<?= $item->id?>/ss', '<?= $item->id?>/s'));
			$(".img-main").parent('a').attr('href', imgsrc.replace('<?= $item->id?>/ss', '<?= $item->id?>/'));
		});
	});
</script>
<script type="text/javascript">
	hs.graphicsDir = '/static/js/highslide/graphics/';
	hs.allowMultipleInstances = false;
	hs.showCredits = false;
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
	if (hs.addSlideshow)
		hs.addSlideshow({
			interval: 5000,
			repeat: false,
			useControls: true,
			fixedControls: 'fit',
			overlayOptions: {
				opacity: .6,
				position: 'bottom center',
				hideOnMouseOut: true
			}
		});
</script>


