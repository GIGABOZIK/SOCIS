<?php
// Включение вывода ошибок PHP на экран
ini_set('display_errors', 1);
// Активация отчета об ошибках всех типов
error_reporting(E_ALL);

// функция для дебага
function debug($str) {
    printArray($str, "arr");
    exit;
}

//& kek
function redirect($url) {
    header('location: ' . $url);
    exit;
}


function getArrayAsPHP($array, $var = 'array', $_level = null) // Вывести массив в виде PHP кода
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

function printArray($array, $var = 'array', $_level = null, $act = 1) // Вывод массива красиво
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

?>
