<h1>Работает</h1>	
	
	<?php if(isset($username)):?>
		Привет <?=$username;?><br>
		<a href="<?=base_url();?>login/logout">Выход</a>
	<?php else:?>
		<a href="<?=base_url();?>login">Вход</a>	
	<?php endif;?>
	