<h1><?=$title;?></h1>	
	
	<?php if(isset($username)):?>
		Привет <?=$username;?><br>
		<a href="<?=base_url();?>login/logout">Выход</a>
	<?php else:?>
		<a href="<?=base_url();?>login">Вход</a>	
	<?php endif;?>
	
	
		<?php foreach($goods as $item):?>
			<p>
				<b><?=$item['brand'];?></b>
				<?=$item['title'];?><br>
				Цена: <?=$item['price'];?>
			</p>
		<?php endforeach;?>
		<a href="<?=base_url();?>categories">Назад</a>