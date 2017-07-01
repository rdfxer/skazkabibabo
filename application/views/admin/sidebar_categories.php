<style>
	.list {list-style: none}
</style>

	<? foreach($list as $row):?>
		<li class="list">
			<a href="/admin/categories/edit/<?= $row->id?>"><?= $row->title?></a>
		</li>
	<? endforeach;?>
		<li><hr></li>
	<? foreach($agelist as $row):?>
		<li class="list">
			<a href="/admin/categories/editage/<?= $row->id?>"><?= $row->title?></a>
		</li>
	<? endforeach;?>