<?php
// Функции для работы с JSON файлами и их контентом
/*
Функционал:
) Все переменные:
    ) $jsonPath - Полный путь к файлу (от корня до .json)
    ) $jsonContName - Имя контента в файле
    ) $jsonContDescription - Описание контента в файле
    ) $jsonTask - Назначение файла
    ) $spreadsheetName - Имя гугл-таблицы
    ) $spreadsheetId - ID гугл-таблицы
    ) $spreadsheetGid - GID - ID листа гугл-таблицы
    ) $spreadsheetRange - Диапазон ячеек гугл-таблиц
    ) 
) Проверить наличие файла json
    ) file_exist($jsonPath)
) Создать json файл с первоначальными настройками
    ) $jsonPath = createNewJson($jsonPath, jsonContName, $jsonContDescription, $jsonTask, $jsonSpreadsheetName)
        ) $jsonName.json == safe_file($filename) \ safe_file($jsonPath)
) Сделать резервную копию файла
    ) ?
) Записать инфу в файл
    ) writeJson($jsonPath, $jsonCont)
        ) file_put_contents($jsonPath, json_encode($jsonCont, JSON_UNESCAPED_UNICODE))
        ) last-update
        // ) last-read
) Прочитать инфу из файла
    ) $jsonCont = readJson($jsonPath)
        ) json_decode(file_get_contents($jsonPath), true)
        ) last-read
) Обработать инфу файла
    ) $jsonCont = updJson($jsonPath, $action, $target)
    ) $jsonCont = updJsonCont($jsonCont, $target1, $target2, $target3...)
*/
// Главная функция
function getSpreadsheetCont($jsonPath = (__DIR__ . '/base/some-files/newJson.json'),
$spreadsheetName = 'noname') // Возвращает $jsonCont
{
    global $curTime;
    if (!file_exists($jsonPath)) { // Если не существует файла, то нужно создать
        $jsonPath = createNewJson($jsonPath);
    }
    $jsonCont = readJson($jsonPath);
    $updPeriod = 604800; // Каждую неделю (или более)
    // $updPeriod = 86400; // Каждый день (или более)
    // $updPeriod = 3600; // Каждый час (или более)
    // $updPeriod = 300; // Каждые 5 минут (или более)
    // $updPeriod = 60; // Каждую минуту (или более)
    // $updPeriod = 5; // Каждые 5 секунд (или более)
    // $updPeriod = 0; // Каждый раз
    //
    $fileIsGone = ($curTime >= ($jsonCont['cfg']['last-update'] + $updPeriod)) ? 1 : 0; // Нужно ли файл перезаписывать по сроку
    if ($fileIsGone) // Если истек срок обновления
    {
        unlink($jsonPath); // Удалить файл
        return getSpreadsheetCont($jsonPath, $spreadsheetName); // Рекурсивное пересоздание
    }
    $fileIsNew = ($jsonCont['cfg']['created'] == $curTime) ? 1 : 0; // Является ли файл новым
    if ($fileIsNew) {
        switch ($spreadsheetName) {
            case 'kinos':
                $spreadsheetId = '13BpGYbVpxDtM964H1HmUJ29TJ5pGmnryI3n0vq0hyRc';
                $spreadsheetGid = '1519642126';
                $spreadsheetRange = 'E2:I';
                $jsonContName = 'КиноТапки';
                $jsonContDescription = 'Список фильмов в одноименной гугл-таблице';
            break;
            case 'minds':
                $spreadsheetId = '15YaR_m7EiZQIsgM7ClHc9hGnBYxi_Xk9l_K77wU-e14';
                $spreadsheetGid = '0';
                $spreadsheetRange = 'B2:E';
                $jsonContName = 'Мысли перед сном';
                $jsonContDescription = 'Список мыслей перед сном в гугл-таблице';
            break;
            case 'games':
                $spreadsheetId = '1oKtt1W8K65qRCuLLTtD9icYOMPdEgKUWDGE_DxyXuXc';
                $spreadsheetGid = '0';
                $spreadsheetRange = 'B2:N';
                $jsonContName = 'Игры';
                $jsonContDescription = 'Список игр в гугл-таблице';
            break;
            default:
                die(outWarn('getSpreadsheetCont', 'Таблицы с таким позывным не существует', $spreadsheetName));
            break;
        }
        $spreadsheet = getSpreadsheetCsv(
            id: $spreadsheetId,
            gid: $spreadsheetGid,
            range: $spreadsheetRange
        ); // Получить массив из csv
        $jsonCont[0] = $spreadsheet[0]; // Записать '0' как в таблице (настройка списка полей)
        foreach ($spreadsheet as $newKey => $newNote) if ($newKey != 0) {
            $jsonCont[] = $newNote; // Записать каждую запись в jsonCont[$newKey]
        }
        updJsonCont($jsonCont, // Освежаем инфу
            name: $jsonContName,
            description: $jsonContDescription,
            renameFields: 1,
            countNotes: 1
        );
    }
    writeJson($jsonPath, $jsonCont);
    return $jsonCont;
}
// Далее идут вспомогательные функции
function getSpreadsheetCsv($id = '', $gid = '', $range = '') // Чтение гугл-таблицы в формате csv
{
    if ($id == '') return 0;
    $url = 'https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid;
    if ($range != '') { // Для диапазона ячеек
        $url .= '&range=' . $range; // Добавить к запросу диапазон
        $csv = file($url);
    } else { // Для всего листа (наверное)
        // echo $url;
        $csv = file_get_contents($url);
        $csv = explode('\r\n', $csv);
    }
    $array = array_map('str_getcsv', $csv);
    return $array;
} // https://snipp.ru/php/spreadsheets
//
function writeJson($jsonPath, $jsonCont) // Записать инфу в файл json с нуля
{
    return file_put_contents($jsonPath, json_encode($jsonCont, JSON_UNESCAPED_UNICODE));
}
function readJson($jsonPath) // Чтение файла json + декодирование
{
    $jsonCont = json_decode(file_get_contents($jsonPath), true);
    updJsonCont($jsonCont, lastRead: 1, lastUpdate: 0);
    switch (json_last_error())
    {
        case JSON_ERROR_NONE:
            return $jsonCont;
            echo 'Ошибок нет';
        break;
        case JSON_ERROR_DEPTH:
            echo 'Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo 'Некорректные разряды или несоответствие режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo 'Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            echo 'Синтаксическая ошибка, некорректный JSON';
        break;
        case JSON_ERROR_UTF8:
            echo 'Некорректные символы UTF-8, возможно неверно закодирован';
        break;
        default:
            echo 'Неизвестная ошибка';
        break;
    }
    return 0;
}
function createNewJson($jsonPath = __DIR__ . '/base/some-files/newJson.json',
) // Создать новый json файл
{
    global $curTime;
    /* Правила содержания:
    $jsonCont = array($key_N => $note_N)
        $note_N = array($field_N => $value_N)
    т.е.
    $jsonCont = array(
        $key1 => $note1 = array(
            $field1 => $value,
            $field2 => $value,
            ...
        ),
        ...
    ) */
    $jsonCont = array( // Универсальный конфиг файла
        'cfg' => array(
            'name' => '', // Название содержимого
            'description' => '', // Описание содержимого
            'created' => $curTime, // Дата создания
            'last-read' => $curTime, // Дата последнего чтения
            'last-update' => $curTime, // Дата последнего изменения
            'notes-amount' => 0, // Количество записей
        ),
        0 => array(), // Ключ для записи полей для записей
    );
    if (!file_exists($jsonPath)) { // В случае отсутствия файла
        $jsonPath = safe_file($jsonPath); // Создает файл безопасно (в принципе и необязательно)
        writeJson($jsonPath, $jsonCont);
    } else {
        die(outWarn('createNewJson', 'Файл уже существует:', $jsonPath));
    }
    return $jsonPath; // Вернуть полный путь к новому файлу
}
//
// Обновить $jsonCont
function updJsonCont(&$jsonCont, $name = '', $description = '',
$lastRead = 1, $lastUpdate = 1,
$newNote = '', // Добавить запись
$renameFields = '', // Переименовать поля у всех записей в соответствии с источником
$countNotes = '', // Пересчитать записи
)
{
    global $curTime;
    if ($name != '') $jsonCont['cfg']['name'] = $name;
    if ($description != '') $jsonCont['cfg']['description'] = $description;
    if ($lastRead == 1) $jsonCont['cfg']['last-read'] = $curTime;
    if ($lastUpdate == 1) $jsonCont['cfg']['last-update'] = $curTime;
    if ($newNote != '') $jsonCont[] = $newNote;
    if ($renameFields == 1) {
        foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0) // Перебор записей, кроме 'cfg' и '0'
        {
            foreach ($jsonCont[0] as $keyField => $fieldName) {
                $jsonCont[$key][$fieldName] = $note[$keyField];
                unset($jsonCont[$key][$keyField]);
            }
            // т.е. в каждой записи значение [keyField] заменяется на [fieldName]
            // т.е. численные наименования полей заменяются на те, которые в id'0'
        }
    }
    if ($countNotes == 1) $jsonCont['cfg']['notes-amount'] = (count($jsonCont) - 2); // Посчитать записи, кроме 'cfg' и '0'
    return 1;
}
//
//
?>