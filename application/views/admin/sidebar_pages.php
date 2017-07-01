<style>
	.list {list-style: none}
</style>
<? foreach($list as $row):?>
	<li class="list">
		<a href="/admin/pages/edit/<?= $row->id?>"><?= $row->title?></a>
	</li>
<? endforeach;?>
