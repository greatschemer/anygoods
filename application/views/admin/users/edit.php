<h1>Редактирование пользователя</h1>
<!--Ошибки выводи тута-->
<div class="error">
	<?=validation_errors();?>
</div>
<?=form_open('admin/users/edit/' .$info['id']); ?>

	<label>Фамилия :</label>
	<input type="text" name="firstname" value="<?=$info['firstname'];?>"><br>
	<label>Имя :</label>
	<input type="text" name="lastname" value="<?=$info['lastname'];?>"><br>
	<label>День рождения :</label>
	<input type="text" name="bdate" value="<?=$info['bdate'];?>"><br>
	<label>Email :</label>
	<input type="text" name="email" value="<?=$info['email'];?>"><br>
	<label>Пароль :</label>
	<label>Тип пользователя:</label>
	<select name="active">
		<?php 
			switch($info['active']){
				case '1':
					echo '<option value="1" selected>Пользователь</option>
					<option value="2">Администратор</option>';
					break;
				case '2':
					echo '<option value="1">Пользователь</option>
					<option value="2" selected>Администратор</option>';
					break;
			}
		?>
	</select><br>

	<input type="submit" name="save" value="Сохранить">

<?=form_close(); ?>