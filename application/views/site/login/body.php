<h1>Вход на сайт</h1>

<!--Ошибки выводи тута-->
<div class="error">
	<?=validation_errors();?>
</div>

<?=form_open('login/authentication'); ?>

	<label>Email :</label>
	<input type="text" name="email" value="<?=set_value('email');?>">
	<label>Пароль :</label>
	<input type="password" name="password">
	<input type="submit" value="Вход"><br />
	<a href="<?=base_url();?>login/registration">Зарегистрироваться</a>

<?=form_close(); ?>