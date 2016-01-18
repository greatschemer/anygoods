<h1>Добавление пользователя</h1>
<!--Ошибки выводи тута-->
<div class="error">
	<?=validation_errors();?>
</div>
<?=form_open('admin/users/add'); ?>

	<label>Фамилия :</label>
	<input type="text" name="firstname" value="<?=set_value('firstname');?>"><br>
	<label>Имя :</label>
	<input type="text" name="lastname" value="<?=set_value('lastname');?>"><br>
	<label>День рождения :</label>
	<input type="text" name="bdate" value="<?=set_value('bdate');?>"><br>
	<label>Email :</label>
	<input type="text" name="email" value="<?=set_value('email');?>"><br>
	<label>Пароль :</label>
	<input type="password" name="pass1" value=""><br>
	<label>Пароль еще раз:</label>
	<input type="password" name="pass2" value=""><br>
	<label>Тип пользователя:</label>
	<select name="active">
		<option value="1">Пользователь</option>
		<option value="2">Администратор</option>
	</select><br>

	<input type="submit" name="add" value="Создать">

<?=form_close(); ?>