<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$title;?></title>
</head>
<body>
<?php if(isset($useradmin)):?>
	Привет <?=$useradmin;?><br>
	<a href="<?=base_url();?>admin/logout">Выход</a>
	
	<ul>
		<li><a href="<?=base_url();?>admin">Главная</a></li>
		<li><a href="<?=base_url();?>admin/users">Пользователи</a></li>
		<li><a href="<?=base_url();?>admin/categories">Категории</a></li>
		<li><a href="<?=base_url();?>admin/goods">Товары</a></li>
		<li><a href="<?=base_url();?>admin/orders">Заказы</a></li>
	</ul>

	<hr>
<?php endif;?>

