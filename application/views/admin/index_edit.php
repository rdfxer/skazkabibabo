<style>
	.tab-pane li {list-style: none}
</style>
<h3>Редактирование товара</h3>
<form method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="row">
		<div class="span12">
			<div class="control-group">
				<label for="title" class="control-label">Название</label>
				<div class="controls">
					<input type="text" name="title" value="<?= $item->title?>" class="span12"/>
				</div>
			</div>	
			<div class="control-group">
				<label for="category" class="control-label">Товарная категория</label>
				<div class="controls">
					<select name="category" class="span12">
						<? foreach($cat as $c_row):?>
							<? $cat_sel = ($item->cat_id == $c_row->id) ? ' selected=selected' : '';?>
							<option value="<?= $c_row->id?>"<?= $cat_sel?>><?= $c_row->title?></option>
						<? endforeach?>
					</select>
				</div>
			</div>			
			<div class="control-group">
				<label for="intro" class="control-label">Краткое описание</label>
				<div class="controls">
					<input type="text" name="intro" value="<?= $item->intro?>" class="span12"/>
				</div>
			</div>
			<div class="control-group">
				<label for="description" class="control-label">Описание</label>
				<div class="controls">
					<textarea name="description" class="span12" id="descr">
						<?= $item->description?>
					</textarea>
				</div>
			</div>	
			<script type="text/javascript">
				CKEDITOR.replace('descr');
			</script>
			<div class="control-group">
				<label for="price_r" class="control-label">Цена</label>
				<div class="controls">
					<input type="text" name="price_r" value="<?= $price[0]?>" class="span2"/> руб. 
					<input type="text" name="price_k" value="<?= $price[1]?>" class="span1"/> коп. 
				</div>
			</div>	
			<div class="control-group">
				<div class="controls">
					<button type="button" data-toggle="modal" data-target="#alike" class="btn">Сопутствующие товары</button>
					<div id="alike" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Сопутствующие товары</h3>
						</div>
						<div class="modal-body">
							<div class="tabbable tabs-left">
								<ul class="nav nav-tabs">
									<? foreach($cat as $alike_tabs):?>
										<li>
											<a data-toggle="tab" href="#alike<?= $alike_tabs->id?>" data-toggle="tab">
												<?= $alike_tabs->title?>
											</a>
										</li>
									<? endforeach?>
								</ul>
								<div class="tab-content">
									<? foreach($cat as $alike_tabs_content):?>
										<div class="tab-pane" id="alike<?= $alike_tabs_content->id?>">
											<? foreach($alike_tabs_content->goods->find_all() as $alike_goods):?>
												<? $a_ch = (in_array($alike_goods->id, $alike)) ? ' checked="checked"' : '';?>
												<label class="checkbox">											
													<input type="checkbox" name="alike[]" value="<?= $alike_goods->id?>" <?= $a_ch?> />
													<?= $alike_goods->title?>
												</label>
											<? endforeach?>
										</div>
									<? endforeach?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="control-group">
				<label for="age" class="control-label">Возрастная категория</label>
				<div class="controls">
					<? foreach($ages as $agerow):?>
						<? $age_checked = ($item->has('ages', $agerow->id)) ? ' checked="checked"' : '';?>
						<label class="checkbox inline"> <?= $agerow->title?>
							<input type="checkbox" name="age[]" value="<?= $agerow->id?>" <?= $age_checked?>/>
						</label>
					<? endforeach?>
				</div>
			</div>	
			<div class="control-group">
				<label for="seo_title" class="control-label">SEO title</label>
				<div class="controls">
					<input type="text" name="seo_title" value="<?= $item->seo_title?>" class="span12"/>
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
					<label for="seo_title"  class="checkbox">
						<? $status = ($item->status == '1') ? ' checked="checked"' : '';?>
						<input type="checkbox" name="status" value="1" <?= $status?>/> Активно
					</label>
				</div>
			</div>		
			<div class="control-group">
				<label for="image" class="control-label">Изображения</label>
				<div class="controls">
					<input name="image[]" type="file" multiple/>
					<br/><br/>
					<table id="imgtable">
						<? $imgpath = '/static/upload/goods/'.$item->id.'/ss/'?>
						<? foreach($images as $imgrow):?>
							<? if(strlen($imgrow) > 3):?>
								<tr>
									<td>
										<img src="<?= $imgpath.$imgrow?>" height="75px" />
									</td>
									<td style="padding-left: 10px" >
										<? $main_sel = ($imgrow == $item->img_main) ? ' checked="checked"' : '';?>
										<label class="radio">
											<input type="radio" name="main_photo" value="<?= $imgrow?>" <?= $main_sel?> /> по умолчанию
										</label>
										<label class="checkbox">
											<input name="delimage[]" type="checkbox" value="<?= $imgrow?>" /> удалить
										</label>
									</td>
								</tr>
							<? endif?>
						<? endforeach?>
					</table>
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