<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?= $title?> <?= ORM::factory('Common', 1)->body?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?= ORM::factory('Common', 2)->body?>">
		<meta name="author" content="<?= ORM::factory('Common', 3)->body?>">
		<link rel="icon" href="/favicon.gif" />
		<?
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
					<div class="span3 phone"><?= Request::factory('/widgets/phone')->execute()?></div>
					<span id="cartwidget"><?= $cart?></span>
				</div>
				<div class="topmenu">
					<a href="/" class="main"></a>
					<a href="/oplata" class="pay<?= (substr_count(Request::initial()->uri(), 'oplata')) ? '-cur' : ''?>"></a>
					<a href="/sadikam" class="sad<?= (substr_count(Request::initial()->uri(), 'sadikam')) ? '-cur' : ''?>"></a>
					<a href="/bonus" class="bonus<?= (substr_count(Request::initial()->uri(), 'bonus')) ? '-cur' : ''?>"></a>
					<a href="/contacts" class="contact<?= (substr_count(Request::initial()->uri(), 'contacts')) ? '-cur' : ''?>"></a>
				</div>
				<div class="row blinds-bc brd-red">
					<div class="span3 leftmenu">
						<?= $leftmenu?>
					</div>
					<div class="span6 content">
						<div class="row etap-rech-btn"><a href="/rech"></a></div>
						<div class="row agemenu">
							<?= $agemenu?>
						</div>
						<div class="row">
							<?= $content?>
						</div>
					</div>
					<div class="span3 rightmenu">
						<?= $rightmenu?>
					</div>
				</div>
				<? if($action == 'index/index'):?>
					<div class="row brd-red bcg-sir">
						<?= Request::factory('/widgets/news')->execute()?>
					</div>
					<div class="row brd-red bcg-sir">
						<?= Request::factory('/widgets/indextext')->execute()?>
					</div>
					<div class="row goods-alike brd-red video-slider">
						<?= Request::factory('/widgets/video')->execute()?>
					</div>
				<? endif?>

				<div class="footer">
					<div class="span12">
						<p class="copyright"></p>
					</div>
				</div>
				<!-- Yandex.Metrika counter -->
				<script type="text/javascript">
					(function(d, w, c) {
						(w[c] = w[c] || []).push(function() {
							try {
								w.yaCounter21777157 = new Ya.Metrika({id: 21777157,
									webvisor: true,
									clickmap: true,
									trackLinks: true,
									accurateTrackBounce: true});
							} catch (e) {
							}
						});

						var n = d.getElementsByTagName("script")[0],
						s = d.createElement("script"),
						f = function() {
							n.parentNode.insertBefore(s, n);
						};
						s.type = "text/javascript";
						s.async = true;
						s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

						if (w.opera == "[object Opera]") {
							d.addEventListener("DOMContentLoaded", f, false);
						} else {
							f();
						}
					})(document, window, "yandex_metrika_callbacks");
				</script>
				<noscript><div><img src="//mc.yandex.ru/watch/21777157" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
				<!-- /Yandex.Metrika counter -->
			</div>
		</div>
	</body>
</html>