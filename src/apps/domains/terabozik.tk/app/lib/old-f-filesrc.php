<?php
// Функции для обработки файлов
/*
Функционал:
) safe_file
) glob_tree_search
) 
*/
//
function safe_file($filename) // Безопасное сохранение файла
{
    /*Чтобы не затереть существующий файл на сервере можно применить данную функцию.
    В функцию передаётся путь и имя файла, если на сервере уже существует такой файл,
    функция к концу файла приписывает префикс. Также если директория не существует,
    пытается её создать.*/
	$dir = dirname($filename);
	if (!is_dir($dir)) {
		mkdir($dir, 0777, true);
	}
	$info = pathinfo($filename);
	$name = $dir . '/' . $info['filename']; 
	$prefix = '';
	$ext = (empty($info['extension'])) ? '' : '.' . $info['extension'];
	if (is_file($name . $ext)) {
		$i = 1;
		$prefix = '_' . $i;
		while (is_file($name . $prefix . $ext)) {
			$prefix = '_' . ++$i;
		}
	}
	return $name . $prefix . $ext;
    /*
    // Если в директории есть файл log.txt, файл будет сохранен с названием log_1.txt
    file_put_contents(safe_file(__DIR__ . '/log.txt'), $text);
    */
} // https://snipp.ru/php/file-names
//
function glob_tree_search($path, $pattern, $_base_path = null) // Поиск по имени/расширению
{
	if (is_null($_base_path)) {
		$_base_path = '';
	} else {
		$_base_path .= basename($path) . '/';
	}
	$out = array();
	foreach(glob($path . '/' . $pattern, GLOB_BRACE) as $file) {
		$out[] = $_base_path . basename($file);
	}
	foreach(glob($path . '/*', GLOB_ONLYDIR) as $file) {
		$out = array_merge($out, glob_tree_search($file, $pattern, $_base_path));
	}
	return $out;
    /*
    $path = __DIR__ . '/tmp';
    $files = glob_tree_search($path, '*.{jpg,png}');
    print_r($files);
    */
} // https://snipp.ru/php/search-files
//
?>