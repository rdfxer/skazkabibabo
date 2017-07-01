<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Интернет-магазин раннего развития - Страница не найдена</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<?
		$styles = array(
				'static/bootstrap.css' => 'screen',
				'static/style.css' => 'screen',
		);
		$scripts = array(
				'static/js/jquery.js',
				'static/js/bootstrap.js',
				'static/js/main.js',
		);
		$cart = Request::factory('/widgets/cart')->execute();
		foreach($styles as $file => $type)
		{
			echo HTML::style($file), "\n";
		}
		?>
		<?
		foreach($scripts as $file)
		{
			echo HTML::script($file), "\n";
		}
		?>
	</head>
	<body>
		<div class="container">
			<div class="container-inner">
				<div class="row title-bar">
					<div class="span6 logo"><a href="/"></a></div>
					<div class="span3 phone">8 910 409 74 39</div>
					<span id="cartwidget"><?= $cart?></span>
				</div>
				<div class="topmenu">
					<a href="/" class="main"></a>
					<a href="/oplata" class="pay"></a>
					<a href="/sadikam" class="sad"></a>
					<a href="/bonus" class="bonus"></a>
					<a href="/contacts" class="contact"></a>
				</div>

				<div class="row blinds-bc brd-red">
					<div class="span3 leftmenu">
						<ul class="nav">
							<li>
								<a class="nabor" href="/shop/nabori_dlya_razvitya_rechi" title="Наборы для развития речи"></a>
							</li>
							<li>
								<a class="teatr-pal" href="/shop/palchikovy_teatr_kukly" title="Пальчиковый театр и куклы"></a>
							</li>
							<li>
								<a class="kukl" href="/shop/kukly_na_ruku" title="Куклы на руку"></a>
							</li>
							<li>
								<a class="karnav" href="/shop/karnavalnye_kostumy" title="Карнавальные костюмы"></a>
							</li>
							<li>
								<a class="teatr-nas" href="/shop/teatri_nastolnie" title="Театры настольные"></a>
							</li>
							<li>
								<a class="igr-podush" href="/shop/igrushki_podushki" title="Игрушки-подушки"></a>
							</li>
							<li>
								<a class="noch" href="/shop/nochniki" title="Ночники"></a>
							</li>
							<li>
								<a class="proch" href="/shop/prochee" title="Прочее"></a>
							</li>
						</ul>

					</div>
					<div class="span6 content">
						<div class="row">
							<h2>Страница не найдена</h2>
							<p>Извините, такой страницы не существует - вы можете выбрать товарную категорию в меню, или перейти на <a href="/">главную страницу</a> сайта</p>
						</div>
					</div>
					<div class="span3 rightmenu">
						<ul class="nav">
							<li>
								<a class="rann-razv" href="/shop/rann-razv"></a>
							</li>
							<li>
								<a class="sam" href="/sdelay-sam"></a>
							</li>
							<li>
								<a class="vid" href="/video"></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="footer">
					<div class="span12">
						<p style="padding-right: 30px">© rdfx@rdfx.dj</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
