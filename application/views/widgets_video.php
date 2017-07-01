<hr /><? foreach($video_list as $row):?>
	<div class="span4 item">
		<a href="/video/<?= $row->id?>"><?= UTF8::substr($row->title,0,20).' ...'?>
	<img src="/static/upload/video/<?=$row->id?>.jpg" /></a>
	</div>
<?endforeach?>

