<h1>Категории</h1>
<div>
	<a href="<?=base_url();?>admin/categories/add">Создать категорию</a>
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
		<td>Название категории</td>
		<td>Действие</td>
	</tr>
	<?php foreach($categories as $item):?>
		<tr>
			<td><?=$item['title'];?></td>
			<td>
				<a href="<?=base_url();?>admin/categories/edit/<?=$item['id'];?>">Редактировать</a> 
				/<a href="<?=base_url();?>admin/categories/delete/<?=$item['id']?>">Удалить</a>
			</td>
		</tr>
	<?php endforeach;?>
</table>