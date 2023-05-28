<style>
    
</style>

<?php
/* Функция вывода ссылок */
function sort_link_th($title, $a, $b) {
	$sort = @$_GET['sort'];
	if ($sort == $a) {
		return '<a class="active" href="?sort=' . $b . '">' . $title . ' <i>▲</i></a>';
	} elseif ($sort == $b) {
		return '<a class="active" href="?sort=' . $a . '">' . $title . ' <i>▼</i></a>';  
	} else {
		return '<a href="?sort=' . $a . '">' . $title . '</a>';  
	}
}
?>

<table class="account orders">
	<thead>
		<tr>
            <?php
            $theader = [
                'ID'            => 'id',
                'Название'      => 'title',
                'Тип'           => 'typeTitle',
                // 'Описание'      => 'description',
                'Дата создания' => 'date_created',
                'Статус'        => 'statusTitle',
                'Пользователь'  => 'userLogin',
                'Дедлайн'       => 'date_deadline',
            ];
            foreach ($theader as $key => $value) {
                echo '<th>' . sort_link_th($key, $value . '_asc', $value . '_desc') . '</th>';
            }
            ?>
		</tr>
	</thead>
	<tbody>
        <!-- orderList - from db -->
		<?php foreach ($orderList as $row): ?>
		<tr>
            <?php foreach ($theader as $key => $value) {
                echo '<td>' . $row[$value] . '</td>';
            } ?>
			<!-- <td><?php echo $row['id']; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['date_created']; ?></td> -->
		</tr>
		<?php endforeach; ?>    
	</tbody>
</table>