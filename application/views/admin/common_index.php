<h3>Настройки сайта</h3>
<form method="post" class="form-horizontal" >
	<div class="row">
		<div class="span12">	
			<div class="control-group">
				<label for="title" class="control-label">Название сайта</label>
				<div class="controls">
					<input type="text" name="global_title" class="span12" value="<?= $global_title['body']?>"/>
				</div>
			</div>
			<div class="control-group">
				<label for="seo_descr" class="control-label">description главной страницы</label>
				<div class="controls">
					<textarea name="index_description" class="span12"><?=$index_description['body']?></textarea>
				</div>
			</div>	
			<div class="control-group">
				<label for="seo_keywords" class="control-label">keywords главной страницы</label>
				<div class="controls">
					<textarea name="index_keywords" class="span12"><?=$index_keywords['body']?></textarea>
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