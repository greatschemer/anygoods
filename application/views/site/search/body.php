<h1><?=$title;?></h1>	

<div>
	<?=form_open('search'); ?>

		<input type="text" name="search">
		<input type="submit" name="go" value="Найти">

	<?=form_close(); ?>
</div>

<?php if(isset($result)):?>
	<div class="result">
		<h2>Результат поиска:</h2>
		<?php foreach($result as $item): ?>
			<div>
				<a href="<?=base_url();?>good/<?=$item['id'];?>"><?=$item['title'];?></a><br>	
				Категория: <?=$item['ctitle'];?>
			</div>
			
		<?php endforeach;?>
	</div>
<?php endif;?>

<?php if(isset($error_serach)):?>
	<div>
		<b><?=$error_serach;?></b>
	</div>
<?php endif;?>