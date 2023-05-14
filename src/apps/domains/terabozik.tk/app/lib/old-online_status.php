<?php

// Статус онлайна
function online_status($ez_data) {
    // Запись разницы текущего времени и последней активности в секундах
    if ($ez_data['last_activity'] > 0) {
        $diff_act_sec = (time() - $ez_data['last_activity']);
    } else {
        $diff_act_sec = (time() - $ez_data['regdate']);
    }
    // Перевод даты последнего онлайна + склонения
    $diff_ye = floor($diff_act_sec / (60*60*24*365));//кол-во полных лет
    $diff_da = floor($diff_act_sec / (60*60*24) - ($diff_ye*365));//кол-во дней без лет
    $diff_ho = floor($diff_act_sec / (60*60) - ($diff_da*24) - ($diff_ye*365*24));//кол-во часов без дней и лет
    $diff_mi = floor($diff_act_sec / (60) - ($diff_ho*60) - ($diff_da*24*60) - ($diff_ye*365*24*60));//кол-во минут без часов, дней и лет
    $diff_se = floor($diff_act_sec / (1) - ($diff_mi*60) - ($diff_ho*60*60) - ($diff_da*60*60*24) - ($diff_ye*60*60*24*365));//кол-во секунд без ...
    $diff_new = $diff_se + $diff_mi*60 + $diff_ho*60*60 + $diff_da*60*60*24 + $diff_ye*60*60*24*365;
    $diff_new = "";
    if ($diff_ye == 1) {
        $diff_new = "более года назад";
    } elseif ($diff_ye == 2) {
        $diff_new = "больше 2-х лет назад";
    } elseif ($diff_ye > 2) {
        $diff_new = "давно...";
    } else {
        if ($diff_da > 0) {
            $diff_new .= $diff_da." дней ";
        }
        if ($diff_da < 7) {
            if ($diff_ho > 0) {
                $diff_new .= $diff_ho." часов ";
            }
            if ($diff_ho < 1) {
                if ($diff_mi > 0) {
                    $diff_new .= $diff_mi." минут ";
                }
                if ($diff_mi < 1) {
                    if ($diff_se > 0) {
                        $diff_new .= $diff_se." секунд ";
                    }
                }
            }
        }
        $diff_new .= "назад!";
    }
    // Запись строки статуса онлайна
    if ($diff_act_sec > (60 * 10)) { // онлайн 10 минут
        return('Заходил '.$diff_new);
    } else {
        return('В сети');
    }
}

?>