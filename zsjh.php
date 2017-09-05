<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/9/5
 * Time: 15:16
 * 描述

给出一个无序数列，每次只能交换相邻两个元素，求将原数列变成递增数列的最少交换次数。
如：数列：2,3,1，交换3和1后变成：2,1,3；交换1和2之后变成：1,2,3。总共交换2次。
输入

逗号隔开的正整数数列
输出

正整数
输入样例

2,3,1
输出样例

2
 */
function solution($line) {
    // 在此处理单行数据

    // 返回处理后的结果

    $lines = explode(',', $line);
    $t     = 0;

    while (true) {
        $flag  = false;
        $temp  = 0;

        foreach ($lines as $k => $v) {
            if (empty($temp)) {
                $temp = $v;
            } else if ($temp > $v) {
                $flag = true;
                $lines[$k] = $temp;
                $lines[$k - 1] = $v;
                $t++;
            } else {
                $temp = $v;
            }
        }

        if(!$flag) {
            break;
        }
    }

    //var_dump($lines);

    return $t;
}

$line = '2,3,1';
echo solution($line);