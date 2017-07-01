<h3>Редактирование возрастной категории</h3>
<form method="post" class="form-horizontal" >
	<div class="row">
		<div class="span12">	
			<div class="control-group">
				<label for="title" class="control-label">Название</label>
				<div class="controls">
					<input type="text" name="title" class="span12" value="<?=$item->title?>"/>
				</div>
			</div>		
			<div class="control-group">
				<label for="description" class="control-label">Описание</label>
				<div class="controls">
					<textarea name="description" class="span12" id="descr"><?=$item->description?></textarea>
				</div>
			</div>	
			<script type="text/javascript">
				CKEDITOR.replace('descr');
			</script>
			<div class="control-group">
				<div class="controls">
					<input type="submit" name="submit" value="Сохранить" class="btn btn-success"/>
				</div>
			</div>
		</div>
	</div>
</form>