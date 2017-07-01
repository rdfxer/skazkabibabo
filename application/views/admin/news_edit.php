<style>
	.tab-pane li {list-style: none}
</style>
<h3>Редактирование новости</h3>
<form method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="row">
		<div class="span12">
			<div class="control-group">
				<label for="title" class="control-label">Заголовок</label>
				<div class="controls">
					<input type="text" name="title" value="<?= $item->title?>" class="span12"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="text" class="control-label">Текст</label>
				<div class="controls">
					<textarea name="text" class="span12" id="descr">
						<?= $item->text?>
					</textarea>
				</div>
			</div>	
			<script type="text/javascript">
				CKEDITOR.replace('descr');
			</script>
			<div class="control-group">
				<div class="controls">
					<label for="status"  class="checkbox">
						<? $status = ($item->status == '1') ? ' checked="checked"' : '';?>
						<input type="checkbox" name="status" value="1" <?= $status?>/> Активно
					</label>
				</div>
			</div>	
			<div class="control-group">
				<div class="controls">
					<input type="submit" name="submit" value="Сохранить" class="btn btn-success"/>
				</div>
			</div>
		</div>
	</div>
</form>