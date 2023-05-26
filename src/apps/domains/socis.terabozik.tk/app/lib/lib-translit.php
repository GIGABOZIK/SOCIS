<?php
//` Source:
//@ https://snipp.ru/php/translit

//> Транслит для текста
function translit($value) {
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
        //
		'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
		'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
		'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
		'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
		'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
		'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
		'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
	);
	$value = strtr($value, $converter);
	return $value;
}
//` echo translit('Яндекс, Гугл, Майл ру');
//` Результат:
//` Yandeks, Gugl, Mayl ru


//> Транслит для ЧПУ
//> Транслитерация для части URL (path), текст переводится в нижний регистр, пробелы и знаки препинания заменяются на «-».
function translit_sef($value) {
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
	);
	$value = mb_strtolower($value);
	$value = strtr($value, $converter);
	$value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');	
	return $value;
}
//` echo translit_sef('Яндекс, Гугл, Майл ру');
//` Результат:
//` yandeks-gugl-mayl-ru


//> Транслит для URL
//> В данную функцию можно передавать URL целиком, домен и GET параметры останутся без изменений.
function translit_path($value) {
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
	);
	$value = mb_strtolower($value);
	$value = strtr($value, $converter);
	$value = mb_ereg_replace('[^-0-9a-z\.]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');    
	return $value;
}
//
function traslit_url($url) {
	$url = parse_url(trim($url));
	if (!empty($url['host'])) {
		$res = '';
		if (!empty($url['scheme'])) {
			$res .= $url['scheme'] . '://';
		}
		if (!empty($url['host'])) {
			$res .= idn_to_ascii($url['host']);
		}
		if (!empty($url['port'])) {
			$res .= ':' . $url['port'];
		}
		if (!empty($url['path'])) {
			$path = explode('/', $url['path']);
			foreach ($path as $i => $row) {
				if (preg_match('/[а-яё]/iu', $row)) {
					$path[$i] = translit_path($row);
				}
			}
			$res .= implode('/', $path);
		}
		if (!empty($url['query'])) {
			$res .= '?' . $url['query'];
		}
		if (!empty($url['fragment'])) {
			$res .= '#' . $url['fragment'];
		}
		
		return $res;
	} else {
		return translit_path($url);
	}
}
//` echo traslit_url('https://example.com/category/статья о транслите.html?page=1');
//` Результат:
//` https://example.com/category/statya-o-translite.html?page=1


//> Транслит для имен файлов
function translit_file($filename) {
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
        //
		'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
		'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
		'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
		'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
		'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
		'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
		'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
	);
	$new = '';
	$file = pathinfo(trim($filename));
	if (!empty($file['dirname']) && @$file['dirname'] != '.') {
		$new .= rtrim($file['dirname'], '/') . '/';
	}
	if (!empty($file['filename'])) {
		$file['filename'] = str_replace(array(' ', ','), '-', $file['filename']);
		$file['filename'] = strtr($file['filename'], $converter);
		$file['filename'] = mb_ereg_replace('[-]+', '-', $file['filename']);
		$file['filename'] = trim($file['filename'], '-');					
		$new .= $file['filename'];
	}
	if (!empty($file['extension'])) {
		$new .= '.' . $file['extension'];
	}
	return $new;
}
//` echo translit_file('/upload/Пример файла.jpg');
//` Результат:
//` /upload/Primer-fayla.jpg




?>
