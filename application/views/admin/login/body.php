<h1>Вход в админ панель</h1>

<!--Ошибки выводи тута-->
<div class="error">
	<?=validation_errors();?>
</div>

<?=form_open('admin/login/authentication'); ?>

	<label>Email :</label>
	<input type="text" name="email" value="<?=set_value('email');?>">
	<label>Пароль :</label>
	<input type="password" name="password">
	<input type="submit" value="Вход"><br />

<?=form_close(); ?>