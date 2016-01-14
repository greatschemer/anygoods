<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$title;?></title>
</head>
<body>
<div>
	<div class="success">
	<?php 
		if($this->session->flashdata('success')){
			echo $this->session->flashdata('success');
		}
	?>
	</div>
	<?php if(isset($username)):?>
		Привет <?=$username;?><br>
		<a href="<?=base_url();?>login/logout">Выход</a>
	<?php elseif($this->uri->uri_string() !== 'login/registration' && $this->uri->uri_string() !== 'login/authentication'):?>
		
		<?=form_open('login/authentication'); ?>

		<label>Email :</label>
		<input type="text" name="email" value="<?=set_value('email');?>">
		<label>Пароль :</label>
		<input type="password" name="password">
		<input type="submit" value="Вход"><br />
		<a href="<?=base_url();?>login/registration">Зарегистрироваться</a>

		<?=form_close(); ?>	
	<?php endif;?>
</div>
<div>
	<?php if($this->uri->uri_string() !== 'cart'):?>
		<a href="<?=base_url();?>cart">Корзина</a>
	<?php else:?>
		<a href="<?=base_url();?>">Продолжить покупки</a>
	<?php endif;?>
</div>
<?php if($this->uri->uri_string() !== 'search'):?>
<div>
	<a href="<?=base_url();?>search">Поиск</a>
</div>
<?php endif;?>