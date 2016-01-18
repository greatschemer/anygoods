<h1>Добавление категории</h1>
<!--Ошибки выводи тута-->
<div class="error">
	<?=validation_errors();?>
</div>
<?=form_open('admin/categories/add'); ?>

	<label>Название категории :</label>
	<input type="text" name="title" value="<?=set_value('title');?>">
	<input type="submit" name="add" value="Создать">

<?=form_close(); ?>