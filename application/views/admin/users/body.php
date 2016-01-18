<h1>Пользователи</h1>
<div>
	<a href="<?=base_url();?>admin/users/add">Создать пользователя</a>
	<hr>
	<div class="success">
	<?php 
		if($this->session->flashdata('success')){
			echo '<b>' . $this->session->flashdata('success') . '</b>';
		}
	?>
	</div>
</div>
<table>
	<tr>
		<td>Фамилия</td>
		<td>Имя</td>
		<td>День рождения</td>
		<td>Email</td>
		<td>Тип</td>
		<td>Дата регистрации</td>
		<td>Действия</td>
	</tr>
	<?php foreach($users as $item):?>
	<tr>
		<td><?=$item['firstname'];?></td>
		<td><?=$item['lastname'];?></td>
		<td><?=$item['bdate'];?></td>
		<td><?=$item['email'];?></td>
		<td>
			<?php
				switch($item['active']){
					case '1':
						echo 'Пользователь';
						break;
					case '2':
						echo 'Администратор';
						break;
				}
			?>
		</td>
		<td><?=$item['regdate'];?></td>
		<td>
			<a href="<?=base_url();?>admin/users/edit/<?=$item['id'];?>">Редактировать</a> / 
			<a href="<?=base_url();?>admin/users/delete/<?=$item['id'];?>">Удалить</a>
		</td>
	</tr>
	<?php endforeach;?>
</table>