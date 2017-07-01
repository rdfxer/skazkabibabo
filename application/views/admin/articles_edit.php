<h3>Редактирование статьи</h3>
<form method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="row">
		<div class="span12">
			<div class="control-group">
				<label for="category" class="control-label">Раздел</label>
				<div class="controls">
					<select name="cat_id" class="span12">
						<? foreach($cat as $c_row):?>
							<? $cat_sel = ($item->cat_id == $c_row->id) ? ' selected=selected' : '';?>
							<option value="<?= $c_row->id?>"<?= $cat_sel?>><?= $c_row->title?></option>
						<? endforeach?>
					</select>
				</div>
			</div>		
			<div class="control-group">
				<label for="title" class="control-label">Название</label>
				<div class="controls">
					<input type="text" name="title" class="span12" value="<?=$item->title?>"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="intro" class="control-label">Краткое oписание</label>
				<div class="controls">
					<textarea name="intro" class="span12" id="intro"><?=$item->intro?></textarea>
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
				<label for="seo_title" class="control-label">SEO title</label>
				<div class="controls">
					<input type="text" name="seo_title" class="span12" value="<?=$item->seo_title?>"/>
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
				<label for="image" class="control-label">Превью статьи</label>
				<div class="controls">
					<input name="image" type="file" />
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label for="seo_title"  class="checkbox">
						<? $status = ($item->status == '1') ? ' checked="checked"' : '';?>
						<input type="checkbox" name="status" value="1" <?=$status?>/> Активно
					</label>
				</div>
			</div>	
			<div class="control-group">
				<div class="controls">
					<img src="/static/upload/articles/<?=$item->id?>.jpg">
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