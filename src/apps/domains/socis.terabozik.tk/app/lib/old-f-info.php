<?php


function get_ip() // Функция для определения IP-адреса клиента
{
	$value = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$value = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$value = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
		$value = $_SERVER['REMOTE_ADDR'];
	}
	return $value;
} // https://snipp.ru/php/ip-address
//
function get_ip_list() // Получить все полученные адреса клиента через запятую
{
	$list = array();
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$list = array_merge($list, $ip);
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$list = array_merge($list, $ip);
	} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
		$list[] = $_SERVER['REMOTE_ADDR'];
	}
	$list = array_unique($list);
	return implode(',', $list);
} // https://snipp.ru/php/ip-address

?>
