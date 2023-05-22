<?php
// Включение вывода ошибок PHP на экран
ini_set('display_errors', 1);
// Активация отчета об ошибках всех типов
error_reporting(E_ALL);

//` Функция для узкого дебага
function debug($str) {
    printArray($str, "arr");
    exit;
}

//` from class View
function redirect($url) {
    header('location: ' . $url);
    exit;
}

//` Вывести массив в виде PHP кода
function getArrayAsPHP($array, $var = 'array', $_level = null)
{
    $out = $margin ='';
    $nr  = "\n";
    $tab = "\t";
    if (is_null($_level)) {
        $out .= '$' . $var . ' = ';
        if (!empty($array)) {
            // $out .= $this->getArrayAsPHP($array, $var, 0);
            $out .= getArrayAsPHP($array, $var, 0);
        }
        $out .= ';';	
    } else {
        for ($n = 1; $n <= $_level; $n++) {
            $margin .= $tab;
        }
        $_level++;
        if (is_array($array)) {
            $i = 1;
            $count = count($array);
            $out .= 'array(' . $nr;
            foreach ($array as $key => $row) {
                $out .= $margin . $tab;
                if (is_numeric($key)) {
                    $out .= $key . ' => ';
                } else {
                    $out .= "'" . $key . "' => ";
                }
                if (is_array($row)) {
                    // $out .= $this->getArrayAsPHP($row, $var, $_level);
                    $out .= getArrayAsPHP($row, $var, $_level);
                } elseif (is_null($row)) {
                    $out .= 'null';
                } elseif (is_numeric($row)) {
                    $out .= $row;
                } else {
                    $out .= "'" . addslashes($row) . "'";
                }
                if ($count > $i) {
                    $out .= ',';
                }
                $out .= $nr;
                $i++;
            }
            $out .= $margin . ')';	
        } else {
            $out .= "'" .  addslashes($array) . "'";
        }
    }
    return $out;
} // https://snipp.ru/php/out-array-code

//` Вывод массива
function printArray($array, $var = 'array', $_level = null, $act = 1)
{
    if ($act) {
        // echo $this->getElem('pre', $this->getArrayAsPHP($array, $var, $_level));

        // echo '<pre>';
        // echo $this->getArrayAsPHP($array, $var, $_level);
        // print_r($array);
        // echo '</pre>';

        echo '<pre>';
        echo getArrayAsPHP($array, $var, $_level);
        // print_r($array);
        echo '</pre>';
    }
}

//` Время загрузки страницы
function printLoadTime($act = 1)
{
    if ($act) {
        echo '<br>>'
        . 'Время загрузки страницы: ' . (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) . ' sec';
    }
}

function getUrl($url = 'cur', $parts = 'full') // Работа с URL страницы
{
    $url = ($url == 'cur') ? (((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) : $url;
    $parse = parse_url($url);
    // die(print(out_array($parse, 'parse')));
    if ($parts == 'full') return $url; // Результат: https://example.com/category/page?sort=asc&page=2#sample
    elseif ($parts == 'scheme' // Результат: https
        ||  $parts == 'host' // Результат: example.com
        ||  $parts == 'path' // Результат: /category/page
        ||  $parts == 'query' // Результат: sort=asc&page=2
        ||  $parts == 'fragment' // Результат: sample
    ) return $parse[$parts];
    elseif ($parts == 'domain')         return getUrl($url, 'host'); // Результат: example.com
    elseif ($parts == 'protocol')       return getUrl($url, 'scheme')       . '://'; // Результат: https://
    elseif ($parts == 'query-string')   return '?' . getUrl($url, 'query'); // Результат: ?sort=asc&page=2
    elseif ($parts == 'untHost')        return getUrl($url, 'protocol')     . $parse['host']; // Результат: https://example.com
    elseif ($parts == 'untPath')        return getUrl($url, 'untHost')      . $parse['path']; // Результат: https://example.com/category/page
    elseif ($parts == 'untGet')         return getUrl($url, 'untPath')      . '/' . getUrl($url, 'query-string');  // Результат: /category/page?sort=asc&page=2
} // https://snipp.ru/php/parse-url
/*
Для преобразования строки с GET-параметрами в ассоциативный массив можно применить функцию parse_str()
parse_str('sort=asc&page=2&brand=rich', $get);
print_r($get);
Результат:
Array
(
    [sort] => asc
    [page] => 2
    [brand] => rich
)
*/
//
//
function getRandIntArray($min = 0, $max = 99, $cnt = 1) // Генерирует массив случайных целых чисел
{
    $array = array();
    while (count($array) < $cnt) {
        $newNum = mt_rand($min, $max);
        if (!in_array($newNum, $array)) {
            $array[] = $newNum;
        }
    }
    return $array;
}
//
function getRandStr($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') // Генерирует случайную строку
{
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
} // https://www.php.net/manual/ru/function.mt-rand.php
function getRandColor() // Генерирует случайный цвет по Hex
{
    return '#' . getRandStr(6, '0123456789ABCDEF'); // Обычный цвет #B9CD0F
    // return '#' . getRandStr(8, '0123456789ABCDEF'); // С прозрачностью #B9CD0FAB
}
//
function date_ru($timestamp, $show_time = false) // PHP-функция для вывода даты в привычном формате из метки unix timestamp.
{
	if (empty($timestamp)) {
		return '-';
	} else {
		$now   = explode(' ', date('Y n j H i'));
		$value = explode(' ', date('Y n j H i', $timestamp));
		if ($now[0] == $value[0] && $now[1] == $value[1] && $now[2] == $value[2]) {
			return 'Сегодня в ' . $value[3] . ':' . $value[4];
		} else {
			$month = array(
				'', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 
				'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
			);
			$out = $value[2] . ' ' . $month[$value[1]] . ' ' . $value[0];
			if ($show_time) {
				$out .= ' в ' . $value[3] . ':' . $value[4];
			}
			return $out;
		}
	}
    /* Если с даты прошел день, то выводится только время, далее дата с месяцем и годом.
    echo date_ru(time() - 60);       // Сегодня в 19:43
    echo date_ru(1549682408);        // 9 февраля 2019
    echo date_ru(1549682408, true);  // 9 февраля 2019 в 06:20
    echo date_ru(0);                 // -
    */
} // https://snipp.ru/php/blog-date
//
?>
