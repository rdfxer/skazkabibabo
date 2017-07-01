<style>
	.list {list-style: none}
</style>
<? $i = 0;?>
<? foreach($list as $row):?>
	<? $i++;?>
	<li class="list">
		<a href="/admin/news/edit/<?= $row->id?>" <?if($row->status=='0')echo 'style="color:#aaa;"'?>><?= $row->title?></a>
	</li>
<? endforeach;?>
