<?php

$picAmt = rand(4, 16);
// $picAmt = rand(0, 0);

// $rtextAmt = rand(2, 8);
$rtextAmt = $picAmt;
// $rtextAmt = rand(2, 2);

function find_all_files($dir) {
    $root = scandir($dir);
    foreach($root as $value) {
        if($value === '.' || $value === '..') {continue;}
        if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
        foreach(find_all_files("$dir/$value") as $value) {
            $result[]=$value;
        }
    }
    if (isset($result)) return $result;
}

function randomBg_URL() {
    // $gifs = find_all_files('./gifs_orig');
    $gifs = find_all_files('./gifs_pressed');
    if (isset($gifs)) return $gifs[rand(0, count($gifs)-1)];
}

function getRandStr($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') // Генерирует случайную строку
{
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
} // https://www.php.net/manual/ru/function.mt-rand.php

//! ДОБАВИТЬ ВОЗМОЖНОСТЬ МЕНЯТЬ ФОРМАТ ЦВЕТА
function getRandColor() // Генерирует случайный цвет по Hex
{
    // return '#' . getRandStr(6, '0123456789ABCDEF'); // Обычный цвет #B9CD0F
    return '#' . getRandStr(8, '0123456789ABCDEF'); // С прозрачностью #B9CD0FAB
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>psycho-meow · terabozik</title>

    <style>
        html, body {
            margin: 0px;
            /* overflow: hidden; */
        }
        .body-wrap {
            /* border: 2px solid #1da1f2; */
            /* position: absolute; */
            position: fixed;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            /* height: 100%; */
            /* color: transparent; */
        }

        .back-anim {
            /* animation: bg-anim-simple 44s ease infinite alternate; */
            background-size: 300% 300%;
            background-image: linear-gradient(
                    -45deg,
                    <?php echo getRandColor(); ?> 0%,
                    <?php echo getRandColor(); ?> 25%,
                    <?php echo getRandColor(); ?> 51%,
                    <?php echo getRandColor(); ?> 100%
            );
            animation: bg-anim-gradient <?php echo rand(30, 60); ?>s ease infinite alternate;
        }

        @keyframes bg-anim-simple {
            0%   { background: <?php echo getRandColor(); ?>; }
            20%  { background: <?php echo getRandColor(); ?>; }
            40%  { background: <?php echo getRandColor(); ?>; }
            60%  { background: <?php echo getRandColor(); ?>; }
            80%  { background: <?php echo getRandColor(); ?>; }
            100% { background: <?php echo getRandColor(); ?>; }
        }
        @keyframes bg-anim-gradient { 
            0%   { background-position: 0% 50%;   }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%;   }
        }

        .txta {
            opacity: 1.0;
            position: absolute;
            /* position: relative; */
            /* position: fixed; */
            font-size: xx-large;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;
            white-space: nowrap;
            text-shadow: 0 0 13px <?php echo getRandColor(); ?>;
            color: <?php echo getRandColor(); ?>;
            transition: all 1s;
            transform: scale(1.7);
        }
        .txtn {
            opacity: 0.0;
            display: block;
            position: absolute;
            font-size: xx-large;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            white-space: nowrap;
            text-shadow: 1 1 13px <?php echo getRandColor(); ?>;
            color: <?php echo getRandColor(); ?>
        }
        <?php for ($i = 0; $i < $rtextAmt; $i++) {
            echo '
            .txt_'.$i.' {
                left:    '.rand(15, 75).'vw;
                top:     '.rand(35, 85).'vh;
                animation:
                    gen_anim_txt_'.$i.' '.rand(15, 60).'s
                    infinite ease-in-out alternate '.rand(0, 10).'s
            }';
        }
        for ($i = 0; $i < $rtextAmt; $i++) {
            echo '
            @keyframes gen_anim_txt_'.$i.' {
                25% {
                    opacity: 0.8; transform: scale('.rand(1, 2).') rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw;
                    text-shadow: 0 0 30px '.getRandColor().'; color: '.getRandColor().'}
                50% {
                    opacity: 0.1; transform: scale('.rand(1, 2).') rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw;
                    text-shadow: 0 0 30px '.getRandColor().'; color: '.getRandColor().'}
                75% {
                    opacity: 1.0; transform: scale('.rand(1, 2).') rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw;
                    text-shadow: 0 0 30px '.getRandColor().'; color: '.getRandColor().'}
                to  {
                    opacity: 0.1; transform: scale('.rand(1, 2).') rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw;
                    text-shadow: 0 0 30px '.getRandColor().'; color: '.getRandColor().'}
            }';
        } ?>
        <?php
        for ($j = 0; $j < $rtextAmt; $j++) {
            echo '
            @keyframes gen_anim_txt_jumper_'.$j.' {';
                for ($i = 0; $i < rand(10, 40); $i++) {
                    echo '
                    '.rand(1, 100).'% {
                        opacity: 0.'.rand(0, 100).';
                        transform:
                            scale('.rand(-2, 2).'.'.rand(0, 9).', '.rand(-2, 2).'.'.rand(0, 9).')
                            rotate('.rand(-400, 400).'deg);
                        top: '.rand(-10, 110).'vh; left: '.rand(-10, 110).'vw;
                        text-shadow: 0 0 30px '.getRandColor().'; color: '.getRandColor().';
                    }';
                }
            echo '
            }';
        }
        ?>

        .picn {
            position: absolute;
            /* object-fit: cover; */
            /* object-position: bottom; */
            /* object-position: center; */
            transition: all 1s;
        }
        .picn:hover {
            transform: scale(1.7);
        }
        <?php for ($i = 0; $i < $picAmt; $i++) {
            echo '
            .pic_'.$i.' {
                height: '.rand(4, 34).   'vh;
                left:   '.rand(-14, 104).'vw;
                top:    '.rand(-14, 104).'vh;
                animation:
                    gen_anim_pic_'.rand(0, $picAmt-1).' '.rand(60, 100).'s
                    infinite ease-in-out alternate '.rand(0, 10).'s;
                opacity: 0.02;
            }';
        }
        for ($i = 0; $i < $picAmt; $i++) {
            echo '
            @keyframes gen_anim_pic_'.$i.' {
                25% {opacity: 0.8; transform: rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw; }
                50% {opacity: 0.1; transform: rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw; }
                75% {opacity: 0.9; transform: rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw; }
                to  {opacity: 0.2; transform: rotate('.rand(-400, 400).'deg); top: '.rand(-14, 104).'vh; left: '.rand(-14, 104).'vw; }
            }';
        } ?>
        <?php
        for ($j = 0; $j < $picAmt; $j++) {
            echo '
            @keyframes gen_anim_pic_jumper_'.$j.' {';
                for ($i = 0; $i < rand(10, 40); $i++) {
                    echo '
                    '.rand(1, 100).'% {
                        opacity: 0.'.rand(0, 100).';
                        transform:
                            scale('.rand(-2, 2).'.'.rand(0, 9).', '.rand(-2, 2).'.'.rand(0, 9).')
                            rotate('.rand(-400, 400).'deg);
                        top: '.rand(-10, 110).'vh; left: '.rand(-10, 110).'vw;
                    }';
                }
            echo '
            }';
        }
        ?>
    </style>
</head>
<!-- <body class="back-anim"> -->
<body>
    <div class="body-wrap back-anim">
        <div class="txta txt_0">С 8 мартой щтоле</div>
        <div class="txta txt_1">Поздравлямба щтоле</div>
        <?php
        // for ($i = 2; $i < $rtextAmt; $i++) {
        //     echo '<div class="txtn txt_'.$i.'">'.getRandStr(rand(3, 33), 'UuVvWwAaOoEeUuVvWwAaOoEeXx_^^:)))0').'</div>';
        // }
        // for ($i = 0; $i < $picAmt; $i++) {
        //     echo '
        //     <img
        //         src="'.randomBg_URL().'"
        //         class="picn pic_'.$i.'"
        //     >';
        // }
        for ($i = 0; $i < $picAmt; $i++) {
            echo '
            <img style="
                height: '.rand(4, 54).   'vh;
                left:   '.rand(-14, 104).'vw;
                top:    '.rand(-14, 104).'vh;
                animation:
                    gen_anim_pic_jumper_'.$i.' '.rand(60, 100).'s
                    infinite ease-in-out alternate '.rand(0, 10).'s;
                opacity: 0.02;
            "
                src="'.randomBg_URL().'"
                class="picn"
            >';
        }
        for ($i = 0; $i < $rtextAmt; $i++) {
            echo '<div style="
                left:    '.rand(15, 75).'vw;
                top:     '.rand(35, 85).'vh;
                animation:
                    gen_anim_txt_jumper_'.$i.' '.rand(15, 60).'s
                    infinite ease-in-out alternate '.rand(0, 10).'s
            "
                class="txtn"
            >'.getRandStr(rand(3, 33), 'UuVvWwAaOoEeUuVvWwAaOoEeXx_^^:)))0').'</div>';
        }
        ?>
    </div>
<!-- . -->
</body>
</html>