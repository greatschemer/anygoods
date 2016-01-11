<h1>Регистрация пользователя</h1>
<!--Ошибки выводим тута-->
<div class="error">
	<?=validation_errors();?>
	<?php if(isset($error)){echo $error;} ?>
</div>

<?=form_open('login/registration'); ?>

	<label>Имя :</label>
	<input type="text" name="firstname" value="<?=set_value('firstname')?>"><br>
	<label>Фамилия :</label>
	<input type="text" name="lastname" value="<?=set_value('lastname')?>"><br>
	<label>Дата рождения :</label>
	<input type="text" name="bdate" value="<?=set_value('bdate')?>"><br>
	<label>E-mail :</label>
	<input type="text" name="email" value="<?=set_value('email')?>"><br>
	<label>Пароль :</label>
	<input type="password" name="pass1"><br>
	<label>Пароль еще раз :</label>
	<input type="password" name="pass2"><br>
	<input type="submit" name="reg" value="Зарегистрироваться">

<?=form_close(); ?>