	<h1><?=$title;?></h1>	
	<div>
		<b>Бренд: </b><?=$info['brand'];?><br>
		<b>Цена: </b><?=$info['price'];?><br>
		<b>Кол-во: </b><?=$info['count'];?><br>
		<b>Категория: </b><?=$info['ctitle'];?>
	</div>
	
	<a href="<?=base_url();?>cart/add/<?=$info['id']?>">Купить</a>
	<div>
		<a href="<?=base_url();?>category/<?=$info['cid'];?>">Назад</a>
	</div>
	