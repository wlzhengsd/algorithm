<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/11
 * Time: 20:59
 *  节约用电
序号：#66 难度：困难  时间限制：1000ms  内存限制：10M
描述

为了节约用电，星际争霸里的神族（Protoss）每天需要在战斗结束后关闭神族水晶（Pylon）的电源。
神族的电源开关是由一个巨大的网络与水晶连接的，每个水晶对应一个开关，其中第 i 个开关会同时改变第 i 个水晶，第 2 * i 个水晶以及第 3 * i 个水晶... 的状态（水晶和开关的编号都从 1 开始）。
现在给出所有 n 个水晶的初始状态，问最少需要多少次开关操作才能使所有水晶 变为关闭状态。

神族水晶长这样
输入

一个字符串，包含 N 个字符（1<= N <=1000）。其中第 i 个字符为 1 表示为初始状态为 开，0 表示为初始状态为 关。
输出

一个整数，表示操作开关使所有水晶变为 关闭状态 最少需要的操作次数。
如果不可能关掉所有开关，输出 -1。
输入样例

111111

101010101

11101110111011011110
输出样例

1

2

4
 */
function solution($line) {
    $w = strlen($line);
    $n = 0;

    $t = [];
    for($i=0;$i<$w;$i++) {
        $t_i = $i + 1;
        if(empty($t)) {
            $f = 1;
        } else {
            $f = 1;
            foreach($t as $j) {
                if($t_i % $j == 0) {
                    if($f == 1) {
                        $f = 0;
                    } else {
                        $f = 1;
                    }
                }
            }
        }

        if($f == 1) {
            if($line[$i] == 1) {
                $t[] = $t_i;
            }
        } else {
            if($line[$i] == 0) {
                $t[] = $t_i;
            }
        }
    }
    return count($t);
}

$line = '11101110111011011110';
echo solution($line);


/*
 * 没有太多心得，从头开始发现是1按开关，相应位置变化，继续发现是1按开关，相应位置变化，一直到最后，不可能出现-1的情况
 */