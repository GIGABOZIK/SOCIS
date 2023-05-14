<?php
// Функции для работы с JSON файлами и их контентом
// НЕ ЗАБЫТЬ ПРО РЕЗЕРВНЫЕ КОПИИ
//
function createJson($jsonPath, $task = 'empty') // Создать новый типовой json
{
    global $curTime;
    /* Правила содержания:
    $jsonCont = array(
        $key1 => $note1 = array(
            $field1 => $value,
            $field2 => $value,
            ...
        ),
        ...
    ) */
    $jsonCont = array( // Начальное состояние файла
        'cfg' => array( // Информация о файле
            'name' => 'Название',
            'description' => 'Описание',
            'comment' => 'Комментарий',
            'last-read-date' => $curTime, // Дата последнего прочтения (Через скрипты)
            'last-update-date' => $curTime, // Дата последнего обновления
            'amount' => 0, // Количество записей
        ),
    );
    if ($task == 'empty') {$jsonCont['cfg']['comment'] = 'Пусто';}
    if ($task == 'spreadsheet') {$jsonCont[0] = array('id');}
    $jsonPath = safe_file($jsonPath); // Создает файл безопасно (Без удаления существующего)
    writeJson($jsonPath, $jsonCont);
    return $jsonPath;
}
function writeJson($jsonPath, $jsonCont) // Запись файла json с нуля
{
    // readJson($jsonPath); // Проверка ошибок в функции чтения.. да-да.. это костыль, но влияет только на время загрузки
    global $curTime;
    $jsonCont['cfg']['last-read-date'] = $curTime;
    $jsonCont['cfg']['last-update-date'] = $curTime;
    return file_put_contents($jsonPath, json_encode($jsonCont, JSON_UNESCAPED_UNICODE));
}
function readJson($jsonPath) // Чтение файла json + декодирование
{
    $jsonCont = json_decode(file_get_contents($jsonPath), true);
    global $curTime;
    $jsonCont['cfg']['last-read-date'] = $curTime;
    switch (json_last_error()) {
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
    return $jsonCont;
}
//
function updateJson($jsonPath, $action = 'amount', $obj = '') // Некое обновление файла
{
    $jsonCont = readJson($jsonPath);
    switch ($action) {
        case 'name': // Обновить имя файла
            updateJsonCont($jsonCont, name: $obj); break;
        case 'description': // Обновить описание
            updateJsonCont($jsonCont, description: $obj); break;
        case 'comment': // Обновить комментарий
            updateJsonCont($jsonCont, comment: $obj); break;
        case 'amount': // Пересчитать количество записей (кроме 'cfg' и '0')
            updateJsonCont($jsonCont, amount: 1); break;
        case 'sortJson': // Сортировка, кроме внутренностей 'cfg'
            updateJsonCont($jsonCont, sortKeys: 1); // Сортировка уровня 0 (записей)
            updateJsonCont($jsonCont, sortFields: 1); // Сортировка уровня 1 (полей)
        break;
        case 'sortNotes': // Сортировка записей
            updateJsonCont($jsonCont, sortKeys: 1); break;
        case 'restoreFields': // Восстановление полей как указано в '0' (состав и порядок)
            updateJsonCont($jsonCont, restoreFields: 1); break;
        case 'newField': // Добавление нового поля
            updateJsonCont($jsonCont, newField: $obj); break;
        case 'newNote': // Добавление новой записи
            updateJsonCont($jsonCont, newNote: $obj); break;
        break;
        case 'delField': // Удаление поле из jsonCont
            updateJsonCont($jsonCont, delField: $obj); break;
        case 'delNote': // Удаление записи из jsonCont по ключу
            updateJsonCont($jsonCont, delNote: $obj); break;
        case 'renameFieldsInNotes': // Переименовать поля у всех записей в соответствии с '0'
            updateJsonCont($jsonCont, renameFields: 1); break;
    }
    writeJson($jsonPath, $jsonCont);
}
//
function updateJsonCont(&$jsonCont, $name = '', $description = '', $comment = '',
$delField = '', $newField = '', // Удалить/добавить поле в '0' и всем записям
$delNote = '', $newNote = '', // Удалить/добавить запись
$amount = '', // Пересчитать записи, кроме 'cfg' и '0'
$sortKeys = '', // Сортировать ключи/записи (ур.0)
$sortFields = '', // Сортировать поля записей (ур.1)
$restoreFields = '', // Восстановить поля из '0' в том же порядке
$renameFields = '' // Переименовать поля записей в соответствии с '0'
) // Обновить jsonCont
{
    if ($name != '')            $jsonCont['cfg']['name']        = $name;                // Заменить название
    if ($description != '')     $jsonCont['cfg']['description'] = $description;         // Заменить описание
    if ($comment != '')         $jsonCont['cfg']['comment']     = $comment;             // Заменить комментарий
    if ($delField != '')        delFieldFromCont($jsonCont, $delField);                 // Удалить поле
    if ($newField != '')        addFieldToCont($jsonCont, $newField);                   // Добавить поле
    if ($delNote != '')         delNoteFromCont($jsonCont, $delNote);                   // Удалить запись по $key
    if ($newNote != '')         addNoteToCont($jsonCont, $newNote);                     // Добавить запись
    if ($amount == 1)           $jsonCont['cfg']['amount']      = count($jsonCont) - 2; // Пересчитать записи
    if ($sortKeys == 1)         ksort($jsonCont);                                       // Отсортировать $key
    if ($sortFields == 1)       sortFields($jsonCont);                                  // Отсортировать $field
    if ($restoreFields == 1)    restoreFields($jsonCont);                               // Восстановить состав и порядок полей в записях
    if ($renameFields == 1)     renameFields($jsonCont);                                // Переименовать поля подряд в соответствии с '0'
}
// Поля
function delFieldFromCont(&$jsonCont, $delField) // Удалить поле
{
    foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0)
    {
        unset($jsonCont[$key][$delField]); // Удалить поле у записи
    }
    foreach ($jsonCont[0] as $keyField => $field) if ($field == $delField)
    {
        unset($jsonCont[0][$keyField]); // Удалить поле из списка '0'
        return 1;
    }
    return 0;
}
function addFieldToCont(&$jsonCont, $newField) // Добавить поле
{
    addFieldToList($jsonCont, $newField);
    foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0) // Перебор записей, кроме 'cfg' и '0'
    {
        addFieldToNote($jsonCont, $key, $newField);
    }
    return 0;
}
function addFieldToNote(&$jsonCont, $key, $newField) // Добавить поле записи
{
    if (key_exists($newField, $jsonCont[$key])) { // Если поле уже существует у данной записи
        // echo '<br>>Поле ' . $newField . ' уже есть у записи ' . $jsonCont[$key]['id'];
        return 0;
    } else {
        $jsonCont[$key][$newField] = ''; // Добавить поле с пустым значением
        return 1;
    }
}
function addFieldToList(&$jsonCont, $newField) // Добавить поле в список '0'
{
    if (!in_array($newField, $jsonCont[0])) { // Если поля нет в списке '0'
        $jsonCont[0][] = $newField; // Добавить поле в список '0'
    }
}
// Записи
function delNoteFromCont(&$jsonCont, $delNote) // Удалить запись
{
    if ($delNote != 'cfg' && $delNote != 0) {
        unset($jsonCont[$delNote]);
        return 1;
    }
    return 0;
}
function addNoteToCont(&$jsonCont, $newNote) // Добавить запись
{
    $searcher = findNoteInCont($jsonCont, $newNote); // Ищем id записи, совпадающей с новой
    if (!$searcher) { // Если эта запись не была найдена
        foreach ($newNote as $newField => $newValue) { // Добавить новые поля
            addFieldToCont($jsonCont, $newField);
        }
        $jsonCont[] = $newNote; // Добавляем запись
        $searcher = findNoteInCont($jsonCont, $newNote); // Снова ищем id уже добавленной записи
        $jsonCont[$searcher]['id'] = $searcher; // Записываем в поле записи ее id
        return $searcher; // Возвращаем id новой записи
    } else {
        // echo 'Запись уже существует';
        return 0;
    }
}
// Поиск и порядок
function findNoteInCont(&$jsonCont, $noteF, $param = array('id','name','Название','Имя')) // Поиск записи
{
    foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0) // Перебор записей, кроме 'cfg' и '0'
    {
        // /* Здесь часть, которая делает поиск по любым совпадениям, т.е. Возвращает id, если найдено хотя бы одно совпадение
        foreach($note as $field => $value) { // Перебор полей записи
            if (key_exists($field, $noteF)) { // Есть ли в искомой записи текущее поле
                if (in_array($field, $param)) // Настроить поиск на совпадения по заданным полям
                if ($value == $noteF[$field]) { // Если значение текущего поля текущей записи совпадает со значением одноименного поля искомой записи
                    // echo '<br>>Ура! Найдено! - id:' . $key; // Или $note['id'] (нет)
                    // return $note['id']; // Вернуть id записи / Или $key
                    return $key;
                }
            }
        }
        /**/
    }
    // echo '>' . out_array($noteF) . '<br>was not found :( in ' . $jsonPath;
    return 0;
}
function sortFields(&$jsonCont) // Отсортировать поля у записей (ключи $field)
{
    foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0) {
        ksort($jsonCont[$key]);
    }
}
function restoreFields(&$jsonCont) // Отсортировать поля в соответствии с '0'
{
    foreach ($jsonCont[0] as $keyField => $field) { // Восстанавливаем все поля из '0' для записей
        addFieldToCont($jsonCont, $field);
    }
    foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0) // Ставим все поля в порядке, как в '0'
    {
        $noteDump = $jsonCont[$key];
        // unset($jsonCont[$key]); // Удаление записи
        delNoteFromCont($jsonCont, $key); // Удаление записи
        foreach ($jsonCont[0] as $keyField => $fieldName) { // Восстановление записи с полями по порядку
            $jsonCont[$key][$fieldName] = $noteDump[$fieldName];
        }
    }
    ksort($jsonCont);
}
function renameFields(&$jsonCont) // Переименовать поля у всех записей в соответствии с '0'
{
    foreach ($jsonCont as $key => $note) if ($key != 'cfg' && $key != 0) // Перебор записей, кроме 'cfg' и '0'
    {
        foreach ($jsonCont[0] as $keyField => $fieldName) {
            $jsonCont[$key][$fieldName] = $note[$keyField];
            unset($jsonCont[$key][$keyField]);
        }
    }
}
//
// Прикладные функции для json
//
function getSpreadSheetFromGoogle($id = '', $gid = 0, $range = '') // Чтение листа google spreadsheets
{
    if ($id == '') return 0;
    $url = 'https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid;
    if ($range != '') $url .= '&range=' . $range; // Добавить диапазон, если введен
    // echo $url;
    // $csv = file_get_contents($url);
    // $csv = explode('\r\n', $csv);
    $csv = file($url);
    $array = array_map('str_getcsv', $csv);
    // $array['date'] = $curTime;
    return ($array);
} // https://snipp.ru/php/spreadsheets
//
function getSpreadSheetCont($jsonPath = '', $id = '', $gid = '', $range = '', $name = 'Таблица', $description = '', $renameFields = 1, $amount = 1) // Получение листа google spreadsheets
{
    global $curTime;
    //
    die(printArray(glob_tree_search(__DIR__, 'kinos.json')));
    $jsonCont = readJson($jsonPath); // Читаем файл
    // Пересоздать файл по истечении срока: (несколько вариантов)
    // if (1 == 0) // Никогда
    if ($jsonCont['cfg']['last-update-date'] + 86400 < $curTime) // Каждый день (или более)
    // if ($jsonCont['cfg']['last-update-date'] + 3600 < $curTime) // Каждый час (или более)
    // if ($jsonCont['cfg']['last-update-date'] + 300 < $curTime) // Каждые 5 минут (или более)
    // if ($jsonCont['cfg']['last-update-date'] + 60 < $curTime) // Каждую минуту (или более)
    // if ($jsonCont['cfg']['last-update-date'] + 5 < $curTime) // Каждые 5 секунд (или более)
    // if (1 == 1) // Каждый раз
    {
        unset($jsonCont); // Очистить полученные данные
        unlink($jsonPath); // Удалить файл
        $jsonPath = createJson($jsonPath, 'spreadsheet'); // Создать новый файл для таблицы
        $jsonCont = readJson($jsonPath); // Записываем начальные данные в массив
        $spreadSheet = getSpreadSheetFromGoogle(id: $id, gid: $gid, range: $range);
        $jsonCont[0] = $spreadSheet[0]; // Записать '0' как в таблице (настройка)
        foreach ($spreadSheet as $key => $newNote) if ($key != 0) { // Записываем остальные записи
            $jsonCont[] = $newNote;
            // addNoteToCont($jsonCont, $newNote);
        }
        updateJsonCont($jsonCont, // Освежаем инфу
            name: $name, // Название
            description: $description, // Описание
            renameFields: $renameFields, // Переименование полей в соответствии с '0'
            amount: $amount // Обновить счетчик (посчитать количество полезных записей)
        );
        writeJson($jsonPath, $jsonCont); // Записываем полученные данные в файл
    }
    //
    return $jsonCont;
}
//
?>