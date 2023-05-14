<?php
/*
Функции для обработки|генерации текста
*/
//
function numWord($value, $words, $show = true) { // Склонение слов после числительных
    /* Склонение существительных после числительных.
    string $value - Числовое значение
    array $words - Массив вариантов, например: array('товар', 'товара', 'товаров')
    bool $show - Включает значение $value в результирующею строку (по умолчанию включает) */
    $num = $value % 100;
	if ($num > 19)
		$num %= 10;
	$out = ($show) ? $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2:
		case 3:
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	return $out;
    /* Образец:
    for ($i = 0; $i < 500; $i++) {
        echo num_word($i, array('секунда', 'секунды', 'секунд')) . '<br>';
    }
    die('ok');
    */
} // https://snipp.ru/php/word-declination
//
// Заполнить текстом
function genText($type = 'lol', $param = 1, $act = 1)
{
    if ($act) {
        switch ($type) {
            case 'lol':
                $out = '';
                for ($i = 0; $i < $param; $i++)
                    $out .= ''
                        . '<br><br><br><br><br>O'
                        . '<br><br><br><br><br>L';
                return $out;
            break;
            case 'lorem':
                switch ($param) {
                    case 1: // 1 предложение
                        return 'Lorem'
                        . ' ipsum dolor sit amet, consectetur adipiscing elit.';
                    case 2: // 2 предложения
                        return genText('lorem', $param-1, 1)
                        . ' Ut consequat lectus tellus, vitae mattis sapien fringilla non.';
                    case 3: // 3 предложения
                        return genText('lorem', $param-1, 1)
                        . ' Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
                    case 7: // 7 предложений
                        return genText('lorem', $param-4, 1)
                        . ' Fusce ipsum massa, maximus non lobortis vel, ultricies ut arcu. Nam sit amet scelerisque nulla, vitae'
                        . ' gravida lectus. Vestibulum risus orci, vestibulum et sollicitudin ac, commodo nec enim. Vivamus consequat bibendum libero at ornare.';
                    case 13: // 1 абзац
                        return genText('lorem', $param-6, 1)
                        . ' Integer maximus urna vel mauris vulputate, eu pulvinar sapien dignissim. Aliquam erat volutpat. Nunc dignissim est eget sodales tempus.'
                        . ' Vestibulum vitae ante id nisi fermentum congue. Sed et tortor eu turpis elementum porta pellentesque eu quam. Pellentesque eleifend'
                        . ' dictum nibh, ut ultrices libero maximus congue.'; 
                    case 25: // 2 абзаца
                        return genText('lorem', $param-12, 1) . '<br>'
                        . 'Donec ullamcorper ligula at risus pellentesque, ut posuere quam vestibulum. Proin volutpat metus nisl, quis rutrum tellus pellentesque id.'
                        . ' In ac blandit orci. Aenean vehicula tempus nulla quis viverra. Quisque vel dui faucibus, condimentum dolor sed, malesuada ligula. Aenean'
                        . ' dolor ligula, viverra vitae massa molestie, eleifend facilisis risus. Donec bibendum enim elit. Aliquam dignissim erat et nisl sodales, sit amet'
                        . ' mattis lorem dictum. Ut efficitur, purus a tincidunt lobortis, odio ex ornare nisl, non auctor tellus orci id dui. Nunc lacinia orci ut arcu'
                        . ' vulputate sagittis. Morbi posuere at mauris eget tempus. Quisque ultrices vitae nisl sit amet efficitur.';
                    case 37: // 3 абзаца
                        return genText('lorem', $param-12, 1) . '<br>'
                        . 'Duis sagittis pharetra ultricies. In nec porttitor diam, sed condimentum nisl. In condimentum fermentum est sed rutrum. Duis ac ligula'
                        . ' lorem. Etiam consequat massa pharetra sapien varius accumsan. Morbi efficitur accumsan risus, vitae finibus felis faucibus ac. Praesent et'
                        . ' cursus dui. Fusce vel libero sem. Aliquam hendrerit a erat sit amet rutrum. Phasellus vestibulum leo ac faucibus rhoncus. Nullam eget'
                        . ' ligula eget velit iaculis elementum. Sed eget lectus sit amet purus placerat consectetur consectetur vitae magna.';
                    default: return 'oh no';
                }
            break;
        }
    }
}
//
// Генерация пароля на основе массива символов:
function genPassword($length = 6, $act = 1)
{
    if ($act) {
        $password = '';
        $arr = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );
        for ($i = 0; $i < $length; $i++)
            $password .= $arr[random_int(0, count($arr) - 1)];
        return $password;
    }
} // https://snipp.ru/php/gen-password
//
function genToken() {
	$token = md5(microtime() . 'salt' . time());
	return $token;
} // https://snipp.ru/php/gen-token
//
function switcher_ru($value) // Англо-русская замена
{
	$converter = array(
		'f' => 'а',	',' => 'б',	'd' => 'в',	'u' => 'г',	'l' => 'д',	't' => 'е',	'`' => 'ё',
		';' => 'ж',	'p' => 'з',	'b' => 'и',	'q' => 'й',	'r' => 'к',	'k' => 'л',	'v' => 'м',
		'y' => 'н',	'j' => 'о',	'g' => 'п',	'h' => 'р',	'c' => 'с',	'n' => 'т',	'e' => 'у',
		'a' => 'ф',	'[' => 'х',	'w' => 'ц',	'x' => 'ч',	'i' => 'ш',	'o' => 'щ',	'm' => 'ь',
		's' => 'ы',	']' => 'ъ',	"'" => "э",	'.' => 'ю',	'z' => 'я',					
        //
		'F' => 'А',	'<' => 'Б',	'D' => 'В',	'U' => 'Г',	'L' => 'Д',	'T' => 'Е',	'~' => 'Ё',
		':' => 'Ж',	'P' => 'З',	'B' => 'И',	'Q' => 'Й',	'R' => 'К',	'K' => 'Л',	'V' => 'М',
		'Y' => 'Н',	'J' => 'О',	'G' => 'П',	'H' => 'Р',	'C' => 'С',	'N' => 'Т',	'E' => 'У',
		'A' => 'Ф',	'{' => 'Х',	'W' => 'Ц',	'X' => 'Ч',	'I' => 'Ш',	'O' => 'Щ',	'M' => 'Ь',
		'S' => 'Ы',	'}' => 'Ъ',	'"' => 'Э',	'>' => 'Ю',	'Z' => 'Я',					
        //
		'@' => '"',	'#' => '№',	'$' => ';',	'^' => ':',	'&' => '?',	'/' => '.',	'?' => ',',
	);
	$value = strtr($value, $converter);
	return $value;
    /* Пример:
    echo switcher_ru('
        Hfcrkflrf rkfdbfnehs - cjukfitybt j cjjndtncndbb nbgjuhfabxtcrb[ cbvdjkjd 
        (,erd? wbah? pyfrjd ghtgbyfybz b/ l/) gbcvtyyjuj zpsrf rkfdbifv rkfdbfnehs/
    ');
    Результат:
    Раскладка клавиатуры - соглашение о соответствии типографических символов 
    (букв, цифр, знаков препинания и. д.) писменного языка клавишам клавиатуры.
    */
} // https://snipp.ru/php/punto-switcher
function switcher_en($value) // Русско-английская замена
{
	$converter = array(
		'а' => 'f',	'б' => ',',	'в' => 'd',	'г' => 'u',	'д' => 'l',	'е' => 't',	'ё' => '`',
		'ж' => ';',	'з' => 'p',	'и' => 'b',	'й' => 'q',	'к' => 'r',	'л' => 'k',	'м' => 'v',
		'н' => 'y',	'о' => 'j',	'п' => 'g',	'р' => 'h',	'с' => 'c',	'т' => 'n',	'у' => 'e',
		'ф' => 'a',	'х' => '[',	'ц' => 'w',	'ч' => 'x',	'ш' => 'i',	'щ' => 'o',	'ь' => 'm',
		'ы' => 's',	'ъ' => ']',	'э' => "'",	'ю' => '.',	'я' => 'z',
        //
		'А' => 'F',	'Б' => '<',	'В' => 'D',	'Г' => 'U',	'Д' => 'L',	'Е' => 'T',	'Ё' => '~',
		'Ж' => ':',	'З' => 'P',	'И' => 'B',	'Й' => 'Q',	'К' => 'R',	'Л' => 'K',	'М' => 'V',
		'Н' => 'Y',	'О' => 'J',	'П' => 'G',	'Р' => 'H',	'С' => 'C',	'Т' => 'N',	'У' => 'E',
		'Ф' => 'A',	'Х' => '{',	'Ц' => 'W',	'Ч' => 'X',	'Ш' => 'I',	'Щ' => 'O',	'Ь' => 'M',
		'Ы' => 'S',	'Ъ' => '}',	'Э' => '"',	'Ю' => '>',	'Я' => 'Z',
        //
		'"' => '@',	'№' => '#',	';' => '$',	':' => '^',	'?' => '&',	'.' => '/',	',' => '?',
	);
	$value = strtr($value, $converter);
	return $value;
    /* Пример:
    echo switcher_en('
        Ф лунищфкв дфнщге шы фтн ызусшашс ьусрфтшсфдб мшыгфдб щк агтсешщтфд фккфтпуьуте 
        ща еру луныб дупутвыб щк лун-ьуфтштп фыыщсшфешщты (куызусешмудн) ща ф сщьзгеукю
    ');
    Результат:
    A keyboard layout is any specific mechanical, visual, or functional arrangement 
    of the keys, legends, or key-meaning associations (respectively) of a computer.
    */
} // https://snipp.ru/php/punto-switcher
//
//
?>