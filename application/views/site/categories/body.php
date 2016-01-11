	<h1><?=$title;?></h1>	
	
	<?php if(isset($username)):?>
		Привет <?=$username;?><br>
		<a href="<?=base_url();?>login/logout">Выход</a>
	<?php else:?>
		<a href="<?=base_url();?>login">Вход</a>	
	<?php endif;?>
	
	<ul>
		<?php foreach($categories as $item):?>
			<li><a href="<?=base_url();?>category/<?=$item['id']?>"><?=$item['title']?></a> ( <?=$item['total'];?> )</li>
		<?php endforeach;?>
	</ul>