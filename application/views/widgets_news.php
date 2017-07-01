
	<div class="row afish"><a href="/news"></a></div>


<? foreach($news_list as $row):?>
	<ul class="news">
		<br /><li>
			<div><small><em><?= date('d m Y', $row->date)?></em></small> | <strong><a href="/news#<?= $row->id?>"><?= $row->title?></a></strong></div>
			<p><?= UTF8::substr($row->text, 0, 200)?>...<a href="/news#<?= $row->id?>">Читать дальше >></a></p>
		</li> 
	</ul>
<?
endforeach?>