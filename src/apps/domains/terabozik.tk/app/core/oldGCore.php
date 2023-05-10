<?php

//## Core class
class GCore {
    public $curPage = array(
        'name'  => 'MAIN'
    );
    public $tagCFG = array();
    public $attrCFG = array();

    public function __construct($act = 1, $name = null)
    {
        // Включение вывода ошибок PHP
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // $curTime = time(); // Текущее время

        /* // Todo:
        * getCFG
        * getPageName
        * getUserCFG + getPageCFG
        * getPreload
        * getPage (HTML + CSS)
        * getAfterload (admin-info)
        */
        $this->getConfig();
        //
        $this->getPageHTML();
    }

    protected function getConfig()
    {
        //% Get TAG CONFIG
        $this->tagCFG = $this->csvToArray(
            $csvPath = $this->getFilePath('db', 'tagCFG.csv'),
            $hasHeader = 1, $uniqueHeader = '@Name'
        );
        // $this->printArray($this->tagCFG, 'tagCFG_csv');
        //% Get ATTR CONFIG
        $this->attrCFG = $this->csvToArray(
            $csvPath = $this->getFilePath('db', 'attrCFG.csv'),
            $hasHeader = 1, $uniqueHeader = '@Name'
        );
        // $this->printArray($this->attrCFG, 'attrCFG_csv');
        //%
    }
    protected function getFilePath($type = '', $filename = '')
    {
        switch ($type) {
            case 'db':
                $path = $_SERVER['DOCUMENT_ROOT'] . '/source/db/' . $filename;
                break;
            case 'javascript':
            case 'php':
            case 'style':
            case 'img':
            case 'video':
            default:
                $path = $filename;
                break;
        }
        return $path;
    }

    protected function getPageHTML()
    {
        //! Почитать про HTML директивы
        echo ''
        . '<!DOCTYPE html>'
        . '<html lang="ru">'
            . '<head>'
                . '<title>' . '</title>'
                . '<meta charset="UTF-8">'
                . '<meta name="viewport" content="width=device-width, initial-scale=1">'
                . '<link href="css/style.css" rel="stylesheet">'
                . '<meta name="robots" content="noindex, nofollow">'
            . '</head>'
            . '<body>'
            . ''
            . '</body>'
        . '</html>';

        echo '<!DOCTYPE html>';
        echo '<html lang="ru">'
        //& head
        // . getHEAD();
        //& body
        // . getBODY();
        . '</html>';
    }


    protected function getElem($tag = 'div', $conts = '', $act = 1,
        // & & & ATTRIBUTES HERE
        $id = '', $class = '',
        // & & &
    )
    {
        $out = '';
        if ($act) {
            $out .= '<' . $tag;

            $attr = $this->getAttr();
            if ($attr != '') $out .= ' ' . $attr;

            if ($this->tagCFG[$tag]['@HasPair']) {
                $out .= '>' . $conts . '</' . $tag . '>';
            } else {
                $out .= ' />';
            }
        }
        return $out;
    }

    public function getAttr($act = 1, $type = '', $value = '')
    {
        $out = '';
        if ($act) {
            // бывают атрибуты без value
        }
        return $out;
    }

    public function csvToArray($csvPath = '', $hasHeader = 0, $uniqueHeader = '') // Перевести содержимое CSV файла в массив
    {
        $csvData = file_get_contents($csvPath);
        $lines = explode(PHP_EOL, $csvData);
        $array = array();
        if ($hasHeader) {
            $headers = array();
            $uniqueHeaderIndex = 0;
            $hcnt = 0;
            foreach ($lines as $line) {
                $lineFields = str_getcsv($line);
                foreach ($lineFields as $key => $value) {
                    if ($hcnt == 0) {
                        $headers[] = $value;
                        if ($value == $uniqueHeader) $uniqueHeaderIndex = $key;
                    } else {
                        $array[$lineFields[$uniqueHeaderIndex]]['temp_id'] = $hcnt; // id для отображения порядка
                        $array[$lineFields[$uniqueHeaderIndex]][$headers[$key]] = $value;
                    }
                }
                $hcnt++;
            }
        } else {
            foreach ($lines as $line) {
                $array[] = str_getcsv($line);
            }
        }
        // $this->printArray($array, 'csvToArray_output');
        return $array;
    }

    public function getArrayAsPHP($array, $var = 'array', $_level = null) // Вывести массив в виде PHP кода
    {
        $out = $margin ='';
        $nr  = "\n";
        $tab = "\t";
        if (is_null($_level)) {
            $out .= '$' . $var . ' = ';
            if (!empty($array)) {
                $out .= $this->getArrayAsPHP($array, $var, 0);
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
                        $out .= $this->getArrayAsPHP($row, $var, $_level);
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
    public function printArray($array, $var = 'array', $_level = null, $act = 1) // Вывод массива красиво
    {
        if ($act) {
            echo $this->getElem('pre', $this->getArrayAsPHP($array, $var, $_level));
            // echo '<pre>';
            // echo $this->getArrayAsPHP($array, $var, $_level);
            // print_r($array);
            // echo '</pre>';
        }
    }
}

?>
