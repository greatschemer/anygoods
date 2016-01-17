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
<?php endif;?>