<br/>
	<? foreach($news as $row):?>
	<ul class="news">
		<br /><li style="margin-bottom: 5px">
		<div><small><em><?= date('d m Y', $row->date)?></em></small> | <strong><a name="<?=$row->id?>"></a><?= $row->title?></strong></div>
		<?= $row->text?>
		</li>
	</ul>
<?endforeach?>