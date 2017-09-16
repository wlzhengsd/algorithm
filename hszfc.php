<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/9/16
 * Time: 18:23
 */
function solution($w) {

    if($w < 4) {
        return 1;//初始字符串定义为122
    }

    $c = 2;//字符串当前值
    $s = array(2);//待转换字符串
    $n = 1;//1的数量
    $p = 3;//字符串位数

    while(true) {
        $s_s = array_shift($s);//当前待转字符串

        if($s_s == 2) {
            if($c == 2) {
                $s[] = 1;
                $s[] = 1;
                $c   = 1;
                $n   = $n + 2;
            } else {
                $s[] = 2;
                $s[] = 2;
                $c   = 2;
            }
            $p = $p + 2;
        } else {
            if($c == 2) {
                $s[] = 1;
                $c   = 1;
                $n = $n + 1;
            } else {
                $s[] = 2;
                $c   = 2;
            }
            $p = $p + 1;
        }

        if($p == $w) {
            break;
        } else if($p > $w) {
            if($c == 1) {
                $n = $n - 1;
            }
            break;
        }
    }

    //var_dump($s);
    //echo $p;
    //echo $c;
    return $n;
}

$line = 19;
echo solution($line);