<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Панель управления</title>
		<?
		foreach($styles as $file => $type) echo HTML::style($file), "\n";
		?>
		<?
		foreach($scripts as $file) echo HTML::script($file), "\n";
		?> 
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}

			@media (max-width: 980px) {
				/* Enable use of floated navbar text */
				.navbar-text.pull-right {
					float: none;
					padding-left: 5px;
					padding-right: 5px;
				}
			}

			.nav > li > a.active {color: #fff;}
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">Панель управления</a>
					<div class="nav-collapse collapse">
						<p class="navbar-text pull-right">
							<a href="/logout" class="navbar-link">Выход</a>
						</p>
						<ul class="nav">
							<? foreach($topmenu as $top_k => $top_v):?>
								<? $top_active = ($top_k == '/'.strtolower(Request::initial()->controller())) ? ' class="active"' : '';?>
								<li><a href="/admin<?= $top_k?>"<?= $top_active?>><?= $top_v?></a></li>
							<? endforeach?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row-fluid">
				<div class="span3">
					<div class="well sidebar-nav">
						<ul class="nav nav-list accordion" id="sidebar">
							<?= $sidebar?>
						</ul>
					</div><!--/.well -->
				</div><!--/span-->
				<div class="span9">
					<?= $content?>
				</div><!--/span-->
			</div><!--/row-->

			<hr>

			<footer>
				<p>&copy; Company 2013</p>
			</footer>

		</div><!--/.fluid-container-->

	</body>
</html>