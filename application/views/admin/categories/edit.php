<h1>Редактирование товара</h1>
<!--Ошибки выводи тута-->
<div class="error">
	<?=validation_errors();?>
</div>

<?=form_open('admin/categories/edit/' . $info['id']); ?>

	<label>Название категории :</label>
	<input type="text" name="title" value="<?=$info['title'];?>">
	<input type="submit" name="save" value="Сохранить">

<?=form_close(); ?>