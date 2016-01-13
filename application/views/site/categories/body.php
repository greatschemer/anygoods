	<h1><?=$title;?></h1>
	
	<ul>
		<?php foreach($categories as $item):?>
			<li><a href="<?=base_url();?>category/<?=$item['id']?>"><?=$item['title']?></a> ( <?=$item['total'];?> )</li>
		<?php endforeach;?>
	</ul>