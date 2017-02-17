<?php
/**
 * 
 * 
描述

临近年底，组长突然患上了偏头痛的毛病，因为他最近从产品经理那里收到了好多需求，需要按排组员尽快完成。
现在用一个数组来表示各个需求需要完成的时间，数组A包含n个元素，表示n个需求以及各个需求需要的时间。现在有个k个组员，因为需求有相关性，每个人只能完成连续一段编号的需求，比如A[1],A[2]由第一个人完成，但是不能A[1],A[3]由第一个人完成，求最少需要的时间完成所有需求。

举例：总共两位组员，三个需求，分别需要3,2,4个小时。第一位组员完成前两个需求，第二位组员完成第三个需求，需要5小时
输入

使用分号(;)分隔两组数据。
第一组为一个整数，表示组长手下一共有几位组员。
第二组为一个使用逗号(,)分隔的数组，表示每个需求消耗的工时。
输出

一个整数，表示完成所有需求所使用的最少时间。
输入样例

2;3,2,4

输出样例

5




 * @param  $line 为单行测试数据
 * @return 处理后的结果
 */

$gthree = array();
function solution($line) {
    // 在此处理单行数据
    $lines = explode(";", $line);

    $persons = $lines[0];//组员
    $times   = $lines[1];//工时
    $times   = explode(",", $times);

    if($persons == 1) {//一个人直接把时间加起来
        foreach($times as $time) {
            $t_time = $time + $t_time;
        }
        echo $t_time;
    } else if($persons == 2) {
        echo twoP($times);
    } else {
        echo threeP($persons, $times);
    }
    // 返回处理后的结果
    return ;
}

//两个人的时候  最优分配
function twoP($times) {
    global $gthree;
    $t_time = 0;
    foreach($times as $time) {
        $t_time = $time + $t_time;
    }

    //循环尝试  找到最优的
    $temp1 = 0;
    for($i=0; $i<count($times)-1; $i++) {
        $temp1 = $temp1 + $times[$i];
        $temp2 = $t_time - $temp1;

        if($i == 0) {
            $temp_1 = ($temp1 > $temp2)?$temp1:$temp2;
        } else {
            $temp_2 = ($temp1 > $temp2)?$temp1:$temp2;
            $temp_1 = ($temp_1 > $temp_2)?$temp_2:$temp_1;
        }
    }
    $gthree[md5('2#'.implode(',', $times))] = $temp_1;//保存 （2人 + times工时） 时的最优值，会重复出现
    return $temp_1;
}
//两个人以上的时候  最优分配
function threeP($pnum, $times) {
    global $gthree;
    if($pnum == 2) {
        //var_dump($times);
        if(isset($gthree[md5('2#'.implode(',', $times))])) {
            return $gthree[md5('2#'.implode(',', $times))];
        } else {
            return twoP($times);
        }
    }

    $t_time = 0;
    foreach($times as $time) {
        $t_time = $time + $t_time;
    }

    //循环取最优值
    $temp1 = 0;
    for($i=0; $i<count($times)-$pnum+1; $i++) {
        $temp1 = $temp1 + $times[$i];
        //$pnum = $pnum - 1;
        if(isset($gthree[md5($pnum.'#'.implode(',', $times))])) {
            $temp2 = $gthree[md5($pnum.'#'.implode(',', $times))];
        } else {
            $temp2 = threeP($pnum-1, array_slice($times, $i+1));
        }
        //$temp2 = threeP($pnum-1, array_slice($times, $i+1));
        //$temp2 = $t_time - $temp1;

        if($i == 0) {
            $temp_1 = ($temp1 > $temp2)?$temp1:$temp2;
        } else {
            $temp_2 = ($temp1 > $temp2)?$temp1:$temp2;
            $temp_1 = ($temp_1 > $temp_2)?$temp_2:$temp_1;
        }
    }
    $gthree[md5($pnum.'#'.implode(',', $times))] = $temp_1;//保存 （pnum人 + times工时） 时的最优值，会重复出现
    return $temp_1;
}

$line = "5;3,2,4,2,5,1,3,6,3,6,2,9,2,3,5,3,6,2,3";
solution($line); //17



/*
 * 解题思路
 * 先求出2人的最优分配方案，工时只能顺序分割，第一个和后面的分割求出最大工时、第一个第二个一组和后面的分割求出最大工时、依次类推到最后，取出各种分割方式中最大工时的最小值，就是最优分配方式
 * 求3个人的最优方案，第一个和后面的分割求出最大工时、第一个第二个一组和后面的分割求出最大工时、依次类推到最后，后面的就是2个人的最优工时，按照上面的方案可以求出，取出各种分割方式中最大工时的最小值，就是最优分配方式
 * 求4个人的最优方案，第一个和后面的分割求出最大工时、第一个第二个一组和后面的分割求出最大工时、依次类推到最后，后面的就是3个人的最优工时，按照上面的方案可以求出，取出各种分割方式中最大工时的最小值，就是最优分配方式
 * 依次类推即可找到n个人，m个工时 的最优方案
 * 
 * 第一次运行超时了，关键是的优化节点是，发现（n个人+m个工时）会出现重复，加入了$gthree全局变量保存n+m，从而减少重复的计算，结果非常好仅用64ms跑完测试用例
 * 
 * 
 * 其他
 * 最早考虑的方案是，从前往后依次两两相加，找到最小的那个合并，以此类推知道工时组合等于人员组合，结果失败了，分析后发现两两组合可能最优，但是放到三三组合不一定最优，所以失败
 * 
 * 
 * 
 */