<h3>Список заказов</h3>

<div class="accordion" id="orderstable">
	<? foreach($list as $row):?>
		<div class="accordion-group">
			<div class="accordion-heading accordion-toggle" data-toggle="collapse" data-parent="#orderstable" href="#orderinfo<?=$row->id?>" style="margin: 5px; display: inline">
				<div class="span4"><?= $row->fio?></div>
				<div class="span4"><?= $row->email?></div>
				<div class="span2"><?= date('d/m/Y', $row->ts)?></div>
				<div class="span2"><?= $row->stat->title?></div>
			</div>
			<div id="orderinfo<?=$row->id?>" class="accordion-body collapse in">
				<div class="accordion-inner">
					123
				</div>
			</div>
		</div>
	<? endforeach?>
</div>