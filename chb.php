<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/9/16
 * Time: 18:13
 * 擦黑板
 * 描述

Steph 无聊的时候会在黑板上写一个数。之后，每次擦出末尾的数字，直到写下来的数被全部擦除。
每次擦除前，Steph 会将当前在黑板上的数累加到计算器中。

举个例子，如果 Steph 最初写在黑板上的数是 816，那么每次擦除前黑板上的数是816，81，8。最终计算器中的结果是 816 + 81 + 8 = 905。

假设给出一个数 S (1 <= S <= 10^18)，Steph 想知道能否找到一个数 x，当写在 x 在黑板上后，执行擦除过程后计算器中得到的结果是 S。如果不能得到，输出 -1，如果能得到，输出最小的 x。
输入

一个正整数，表示S
输出

一个正整数或者-1，表示能找到的最小的x，或者找不到。
输入样例

905

10
输出样例

816

-1
 */
function solution($line)
{
    $line = "" . $line;
    $w = strlen($line);
    if ($w == 1) {
        return $line;
    }

    $num = [];
    for($i=0;$i<$w;$i++) {
        $num[$i] = 0;
    }
    $p   = 0;
    while($line > 0) {
        $temp = 0;
        $temp_p = 0;
        for ($i = 0; $i < $w; $i++) {
            $flag = false;
            for ($j = 9; $j >= 0; $j--) {
                $temp_j = str_pad($j, ($i + 1), $j) + $temp;

                if ($temp_j >= $line) {
                    $temp_p = $j;
                    $flag = true;
                } else {
                    $temp_p = $j + 1;
                    $temp = $temp_j;
                    break;
                }
            }

            if ($flag) {
                break;
            }

        }
        $num[$i] = $temp_p;

        //echo $num[$p].",";
        //echo $i.",";
        //var_dump($num);
        //echo str_pad($num[$p], ($i + 1), $num[$p])."\n";
        $line = $line - str_pad($temp_p, ($i + 1), $temp_p);
        $line = "" . $line;
        //echo $line."\n";
        $w = strlen($line);
        //echo $w."\n";
        //for($t_j=$w;$t_j<$i;$t_j++) {
        //  $p++;
        // $num[$p] = 0;
        //}


        //$p++;
    }
    //echo $i;

    if($line == 0) {
        //for($t_i=0;$t_i<$i;$t_i++) {
        //  $num[] = 0;
        //}
        $t_v = '';
        //var_dump($num);
        foreach($num as $v) {
            $t_v = $v.$t_v;
        }
        return intval($t_v);
    }
    return -1;
}
$line = 102; //
echo solution($line);

//1367758989  1230983094
//905   816
//10 -1