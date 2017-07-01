<h3>Добавление статьи</h3>
<form method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="row">
		<div class="span12">
			<div class="control-group">
				<label for="category" class="control-label">Раздел</label>
				<div class="controls">
					<select name="cat_id" class="span12">
						<? foreach($cat as $c_row):?>
							<option value="<?= $c_row->id?>"><?= $c_row->title?></option>
						<? endforeach?>
					</select>
				</div>
			</div>		
			<div class="control-group">
				<label for="title" class="control-label">Название</label>
				<div class="controls">
					<input type="text" name="title" class="span12"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="intro" class="control-label">Краткое писание</label>
				<div class="controls">
					<textarea name="intro" class="span12" id="intro"></textarea>
				</div>
			</div>		
			<div class="control-group">
				<label for="description" class="control-label">Описание</label>
				<div class="controls">
					<textarea name="description" class="span12" id="descr"></textarea>
				</div>
			</div>	
			<script type="text/javascript">
				CKEDITOR.replace('descr');
			</script>
			<div class="control-group">
				<label for="seo_title" class="control-label">SEO title</label>
				<div class="controls">
					<input type="text" name="seo_title" class="span12"/>
				</div>
			</div>
			<div class="control-group">
				<label for="seo_descr" class="control-label">description</label>
				<div class="controls">
					<input type="text" name="seo_descr" class="span12"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="seo_keywords" class="control-label">keywords</label>
				<div class="controls">
					<input type="text" name="seo_keywords" class="span12"/>
				</div>
			</div>		
			<div class="control-group">
				<label for="image" class="control-label">Превью статьи</label>
				<div class="controls">
					<input name="image" type="file" />
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label for="seo_title"  class="checkbox">
						<input type="checkbox" name="status" checked="checked" value="1"/> Активно
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