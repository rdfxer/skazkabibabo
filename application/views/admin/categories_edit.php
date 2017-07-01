<h3>Редактирование категории</h3>
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
				<label for="video" class="control-label">Видео</label>
				<div class="controls">
					<select name="video" class="span12">
						<option value="0">не выбрано</option>
						<? foreach($videos as $vrow):?>
							<? $video_selected = ($item->video == $vrow->video) ? ' selected="selected"' : '';?>
							<option value="<?= $vrow->video?>"><?= $vrow->title?></option>
						<? endforeach?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Сортировка</label>
				<div class="controls">
					<?  foreach($goods as $grow):?>					
					<label class="checkbox">
						<input type="text" name="sort[<?=$grow->id?>]" value="<?=$grow->sort?>" class="span2"/>
						<a href="/admin/index/edit/<?=$grow->id?>" <?if($grow->status!=1):?>style="color:#999"<?endif?>><?=(!empty($grow->title))?$grow->title:'без названия'?></a>
					</label> 
					<?endforeach?>
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