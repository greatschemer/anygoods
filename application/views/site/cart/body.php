	<h1><?=$title;?></h1>	
	<div>
		Вывод товара в корзине
	</div>
	<div>
		<a href="#">Обновить</a>
		<a href="#">Очистить</a>
	</div>
	<div>
		<?php if(isset($username)):?>
		<a href="#">Оформить</a>
		<?php else:?>
			Авторизуйтесь чтобы оформить заказ
		<?php endif;?>
	</div>
	