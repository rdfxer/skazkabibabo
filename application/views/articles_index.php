<h1><?=$cat->title?></h1>
<? foreach($list as $row):?>
	<div class="row artic-list">
		<h2><a href="/<?= $cat->url?>/<?= $row->id?>"><?= $row->title?></a></h2>
		<p>
			<?$img = (file_exists(DOCROOT.'static/upload/articles/'.$row->id.'.jpg')) ? 'static/upload/articles/'.$row->id.'.jpg' : '/static/img/noimg.png';?>
			<img class="lft" src="<?= $img?>" >
			<?= $row->intro?>
		</p>
		<p><a href="/<?= $cat->url?>/<?= $row->id?>">Читать далее >></a></p>
	</div>
	<hr />
<?endforeach?>
	<br />
	<div class="txtdescr intro">Cтатьи и материалы сайта защищены законом об авторских и смежных правах. При использовании и перепечатке материала активная ссылка на сайт <a href="http://skazkabibabo.ru/">skazkabibabo.ru</a> обязательна!</div>