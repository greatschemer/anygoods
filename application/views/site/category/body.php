<h1><?=$title;?></h1>	
	<?php foreach($goods as $item):?>
		<p>
			<b><?=$item['brand'];?></b><br>
			<a href="<?=base_url();?>good/<?=$item['id'];?>"><?=$item['title'];?></a><br>
			Цена: <?=$item['price'];?>
			Кол-во: <?=$item['count'];?>
		</p>
	<?php endforeach;?>
	<a href="<?=base_url();?>categories">Назад</a>