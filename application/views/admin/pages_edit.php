<h3>Редактирование статической страницы</h3>
<form method="post" class="form-horizontal" >
	<div class="row">
		<div class="span12">	
			<div class="control-group">
				<label for="title" class="control-label">Название</label>
				<div class="controls">
					<input type="text" name="title" class="span12" value="<?= $item->title?>"/>
				</div>
			</div>		
			<div class="control-group">
				<label for="description" class="control-label">Текст</label>
				<div class="controls">
					<? if($item->url == 'phone'):?>
						<input name="description" class="span12" value="<?= $item->body?>"/>
					<? else:?>	
						<textarea name="description" class="span12" id="descr"><?= $item->body?></textarea>	
						<script type="text/javascript">
							CKEDITOR.replace('descr');
						</script>
					<? endif?>
				</div>
			</div>
			<div class="control-group">
				<label for="seo_title" class="control-label">SEO title</label>
				<div class="controls">
					<input type="text" name="seo_title" class="span12" value="<?= $item->seo_title?>"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="seo_descr" class="control-label">description</label>
				<div class="controls">
					<input type="text" name="seo_descr" value="<?=$item->seo_descr?>" class="span12"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="seo_keywords" class="control-label">keywords</label>
				<div class="controls">
					<input type="text" name="seo_keywords" value="<?=$item->seo_keywords?>" class="span12"/>
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