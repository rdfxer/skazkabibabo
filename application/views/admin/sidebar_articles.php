<style>
	.accordion-inner li {list-style: none}
</style>

<? $i = 0;?>
<? foreach($list as $k => $v):?>
	<? $i++;?>
	<li class="accordion-group">
		<div  class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#sidebar" href="#collapse<?= $i?>">
				<?= $k?>
			</a>
		</div>
		<div id="collapse<?= $i?>" class="accordion-body collapse">
			<ul class="accordion-inner">
				<? foreach($v as $kk => $vv):?>
					<li>
						<a href="/admin/articles/edit/<?= $kk?>" <? if($vv['status'] == '0') echo 'style="color:#aaa;"'?>><?= Arr::get($vv, 'title', 'Без названия')?></a>
					</li>
				<? endforeach;?>
			</ul>
		</div>
	</li>
<? endforeach;?>