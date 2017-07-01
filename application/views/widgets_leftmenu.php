<ul class="nav">
	<? foreach($cat_list as $row):?>
		<? if(Request::initial()->param('url') == $row->url)
			$active = '-cur';
		elseif(!is_null($item_id) && $item_id == $row->id)
			$active = '-cur';
		else
			$active = '';?>
		<? if($row->url != 'rann-razv'):?>
			<li>
				<a class="<?= $row->css.$active?>" href="/shop/<?= $row->url?>" title="<?= $row->title?>"></a>
			</li>
		<? endif?>
	<? endforeach?>
</ul>

