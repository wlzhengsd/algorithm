<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/8/14
 * Time: 11:06
 */

$number = '';

function getNum($s, $e) {
    global $number;

    $f = '';
    for($i=$s;$i<=$e;$i++) {
        $f .= $number[$i];
    }

    return $f;
}

function solution($line) {
    global $number;

    $number = $line;
    $flag   = 'false';
    $l      = strlen($number);
    $w      = ceil($l/2);

    for($i=0;$i<$w;$i++) {

        for($j=($i+1);$j<$w;$j++) {
            $f = getNum(0, $i);
            $s = getNum($i+1, $j);

            $t_j = $j;
            while (true) {
                $t_f_s = $f * $s;
                //echo $f.'*'.$s.'='.$t_f_s."\n";
                $t_l = strlen($t_f_s);
                $t_e = $t_j + $t_l;
                if($t_e >= $l) {
                    break;
                }
                $t_f_s_s = getNum($t_j+1, $t_e);
                if($t_f_s_s == $t_f_s) {
                    if($t_e == $l-1) {
                        $flag = 'true';
                        break 3;
                    } else {
                        $f = $s;
                        $s = $t_f_s_s;
                        $t_j = $t_e;
                    }
                } else {
                    break;
                }
            }

        }
        //echo $i."\n";
        //break;
    }

    return $flag;
}

$line = '122';
$flag = solution($line);
echo $flag;

/**
 * 没有太多心得体会，是做得最快的一个题目，一气呵成，没有bug
 * 主要运用了常规的解题思想，用纸笔推算的顺序、多次尝试
 * 妙的事用程序准确的反映了解题思路，最后用了折半退出的问题点，提高了性能（如果推演到数字字符串的一半，还是不能连乘，即退出，因为后面的位数小于前面的永不可能相等）
 *
 */