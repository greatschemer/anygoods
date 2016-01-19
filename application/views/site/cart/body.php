
	<div>
		<?php if (!$this->cart->contents()) { ?>
			<p>В корзине нет товаров</p>
		<?php } else { ?>
			<?php echo form_open('Cart/updateCart'); ?>
			<table class="cart-items">
				<thead>
				<tr>
					<th></th>
					<th>Наименование</th>
					<th>Бренд</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Сумма</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($this->cart->contents() as $items) { ?>
					<?php echo form_hidden('rowid[]', $items['rowid']); ?>
					<tr>
						<td>
							<?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
						</td>
						<td>
							<a href="<?=base_url();?>cart/clearCart/<?=$items['id']?>">Удалить</a>
						</td>
						<td><?php echo $items['title']; ?></td>
						<td><?php echo $items['brand']; ?></td>
						<td><?php echo $items['price']; ?></td>
						<td><?php echo $items['count']; ?></td>
						<td><?php echo $items['sum']; ?></td>
					</tr>
				<?php } ?>
					<tr>
						<td</td>
						<td></td>
						<td><strong>Итого</strong></td>
						<td><?php echo $this->cart->format_number($this->cart->total()); ?></td>
					</tr>
				</tbody>
			</table>
			<?php } ?>
	</div>
	<div>
		<?php print form_open('Cart/updateCart'); ?>
		<p><?php echo form_submit('', 'Обновить корзину');?></p>
		<?php print form_close(); ?>
		<?php print form_open('Cart/clearCart'); ?>
		<p><?php echo form_submit('', 'Очистить корзину');?></p>
		<?php echo form_close();  ?>
		<?php if(isset($username)):?>
		<a href="#">Оформить</a>
		<?php else:?>
			Авторизуйтесь чтобы оформить заказ
		<?php endif;?>
	</div>
	