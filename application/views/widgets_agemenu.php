<?
$r = Request::initial();
$url = $r->param('url');
$agehref = ($r->controller() != 'Index') ? '/shop/'.$url.'/age/' : '/shop/age/';?>
<? foreach($age_list as $k => $v):?>		
	<? $active = ($r->param('age') == $k) ? '-cur' : '';?>
	<div class="dropdown span4">
		<a class="dropdown-toggle age<?= $k?><?=$active?>" id="dLabel" role="button" href="<?=$agehref.$k?>">
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li class="etap-rech"><a href="/etap-rech">Этапы речевого развития</a></li>
				<? foreach($v as $ck => $cv):?>		
				<li>
					<a href="/shop/<?= $ck?>/age/<?= $k?>">
						<?= $cv?>
					</a>
				</li>
			<? endforeach?>
		</ul>
	</div>
<? endforeach;?>