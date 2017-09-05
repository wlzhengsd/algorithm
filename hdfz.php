<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/9/5
 * Time: 15:11
 * 描述

一箱失落多年的宝藏被两位海盗找到，宝箱里的一堆大小与重量各不相同的金块。
他们称出了每个金块的重量，但是如何如何平分这些金子却令他们十分头疼。
程序员们，你能告诉两位海盗，他们能否平分这箱宝藏么？

假设宝箱里有三块金子，重量分别为：1,2,3。则他们可以平分这些金子：1+2=3
又假设宝箱里有四块金子，重量分别为：1,2,6,4。则他们无法找到平分的方法
输入

一行由逗号分隔的无序正整数，表示每块金子的重量
输出

字符串true或false，表示海盗们能否平分这些金子
输入样例

1,2,3

1,2,6,4

1,6,8,3,5,9

10,5,8,6,20,13,7,11
输出样例

true

false

true

true

 */
function solution($line) {
    $ls = explode(',', $line);
    $c  = count($ls);//总数量
    if($c < 2) {
        return 'false';
    }

    $t = 0;//总价值
    $work = array();
    foreach($ls as $v) {
        $t = $v + $t;
    }

    if($t%2 == 0) {
        $p = $t/2;//平均值

        foreach($ls as $v) {
            if($v > $p) {
                return 'false';
            } else if($v == $p) {
                return 'true';
            }

            if(empty($work)) {
                if($v == $p) {
                    return 'true';
                } else {
                    $work[] = $v;
                    continue;
                }
            }

            foreach($work as $key=>$w) {
                $temp = $w+$v;
                if($temp == $p) {
                    return 'true';
                } else if($temp < $p) {
                    $work[] = $temp;
                }
            }
        }
    }

    return 'false';
}

$line = '1,2,6,4';
echo solution($line);