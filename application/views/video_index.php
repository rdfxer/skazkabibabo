<h1>Видео</h1>
<? foreach($list as $row):?>
	<div class="row artic-list">
		<h2><a href="/video/<?= $row->id?>"><?= $row->title?></a></h2>
		<p>
			<a href="/video/<?= $row->id?>">
				<img class="lft" src="/static/upload/video/<?= $row->id?>.jpg" >
			</a>
			<?= $row->description?>
		</p>
	</div>
	<hr />
<?endforeach?>