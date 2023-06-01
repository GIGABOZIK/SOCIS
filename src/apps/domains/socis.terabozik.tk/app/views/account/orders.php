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
                'Статус'        => 'statusTitle',
                'Заказчик'  	=> 'userLogin',
                'Дата создания' => 'date_created',
                'Дедлайн'       => 'date_deadline',
                // 'Описание'      => 'description',
            ];
			if ($_SESSION['user']['role_name'] == 'admin') $theader['Описание'] = 'description';
            foreach ($theader as $key => $value) {
                if ($_SESSION['user']['role_name'] !='admin' && $key == 'Заказчик') continue;
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
                if ($_SESSION['user']['role_name'] !='admin' && $key == 'Заказчик') continue;
				if (in_array($value, ['date_deadline'])) 	$row[$value] = date("d-m-Y", strtotime($row[$value]));
				if (in_array($value, ['date_created'])) 	$row[$value] = date("d-m-Y H:i", strtotime($row[$value]));
				// if (in_array($value, ['statusTitle'])) 		$row[$value] = REPLACE;
				echo '<td>' . $row[$value] . '</td>';
            } ?>
		</tr>
		<?php endforeach; ?>    
	</tbody>
</table>