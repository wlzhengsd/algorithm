<?php
/**
 * 
 * 
需要多少个立方数？
 
描述

给出一个数字 N（0<N<1000000），将 N 写成立方数和的形式，求出需要的最少的立方数个数。

举例：
假设 N=17，可得 1+8+8 = 17，最少需要 3 个立方数，则输出 3
假设 N= 28，可得 1+1+1+1+8+8+8 = 28，需要 7 个立方数，又得 1+27=28，需要 2 个立方数，所以最少立方数为 2，则输出 2
输入

一个正整数 N（0<N<1000000）
输出

需要的最少的立方数个数（整型）
输入样例

1

17

28

输出样例

1

3

2

2017-4-10
*/

/**
 * @param  $line 为单行测试数据
 * @return 处理后的结果
 */
function solution($line) {
    // 在此处理单行数据

    // 返回处理后的结果

    $num = $line;
    //$max = floor($this->croot4($num));   
    $max = floor(pow($num, 1/3)+0.00000001); //获取立方根  比较诡异的用法，为什么要加0.000000001，开发的时候发现有时候会发现返回的是整数，floor之后就会小一位，故加入0.000001保证最接近的整数
    //echo $max;exit;
    if($max*$max*$max == $num) {
        return 1;
    }

    $j = 0;//楼层循环数
    $m_l = 0;
    $mmm = array();

    //第一层楼
    if(!isset($mmm[$max])) {
        $mmm[$max] = $max*$max*$max;
    }
    $t = 1 + $num - $mmm[$max];

    $i = 2;//楼层
    while(true) {
        for($mi=1;$mi<=$i;$mi++) {//楼层数字初始化
            $m[$mi] = 2;
        }

        $itt = 0;
        for($mi=1;$mi<$i;$mi++) {//初始值重置
            if($mi > 1) {
                $itt = $i - $mi;
                $m[$itt] = $m[$itt] + 1;
            }
            while(true) {
                $temp_j = 0;
                for($mz=1;$mz<$i;$mz++) {
                    if($itt>0 && $mz>$itt) {
                        $m[$mz] = $m[$itt];
                    }
                    if(!isset($mmm[$m[$mz]])) {
                        $mmm[$m[$mz]] = $m[$mz]*$m[$mz]*$m[$mz];
                    }
                    $temp_j = $temp_j + $mmm[$m[$mz]];
                }


                $temp_j_z = $num - $temp_j;
                if($temp_j_z > 0) {
                    //$temp_max1 = floor($this->croot4($temp_j_z));
                    $temp_max = floor(pow($temp_j_z, 1/3) + 0.0000001);
                    if(!isset($mmm[$temp_max])) {
                        $mmm[$temp_max] = $temp_max*$temp_max*$temp_max;
                    }
                    $temp_t = $i + $temp_j_z - $mmm[$temp_max];
                    if($temp_t < $t) {
                        $t = $temp_t;//此时的最小立方和数
                        if($t <= $i) {
                            break 3;   //提前中断，最关键的一步，之前调试总是超时1250毫秒，加入该行代码直接就是200毫秒，提升明显
                        }
                    }
                } else {
                    break;
                }


                for($jj=1;$jj<=$mi;$jj++) {
                    $itt = $i-$jj;
                    $m[$itt] = $m[$itt] + 1;
                    if($m[$itt] > $max || ($temp_max>0 && $m[$itt]>$temp_max)) {
                        $tl = true;
                        continue;
                    } else {
                        break;
                    }
                }
                if(($jj-$mi) == 1 && $tl) {
                    break;
                }
                $tl = false;
            }
        }

        //var_dump($m);exit;

        $i ++;//增加楼层
        if($t <= $i) {
            break;
        }
    }


    return $t;
}

/**
 * 测试用例
1 	1
17 	3
12 	5
28 	2
54 	2
7877 	5
32123 	4
55555 	4
84823 	4
331432 	4
848273 	5
999999 	4
*/

echo solution(55555); //4

/**
 * 本地调优代码
 * @param unknown $line
 */
function solution2($line) {
    $num = $line;
    //$max = floor($this->croot4($num));
    $max = floor(pow($num, 1/3) + 0.0000000001);
    //echo $max;exit;
    //if(pow($max,3) == $num) {
    //  echo 1;exit;
        // }
    
        $j = 0;//楼层循环数
        $m_l = 0;
        $mmm = array();
    
        //第一层楼
        if(!isset($mmm[$max])) {
            $mmm[$max] = pow($max, 3);
        }
        $t = 1 + $num - $mmm[$max];
        if($t == 1) {
            return 1;
        }
    
        $i = 2;//楼层
        $temp_max = $max;
        while(true) {
            for($mi=1;$mi<=$i;$mi++) {//楼层数字初始化
                $m[$mi] = 2;
            }
    
            $itt = 0;
            $jjt = 1;
            while(true) {
                $temp_j = 0;
                for($mz=1;$mz<$i;$mz++) {
                    if($itt>0 && $mz>$itt) {
                        $m[$mz] = $m[$itt];
                    }
                    if(!isset($mmm[$m[$mz]])) {
                        $mmm[$m[$mz]] = pow($m[$mz], 3);
                    }
                    $temp_j = $temp_j + $mmm[$m[$mz]];
                }
    
                $temp_j_z = $num - $temp_j;
                if($temp_j_z > 0) {
                    //$temp_max1 = floor($this->croot4($temp_j_z));
    
                    if($temp_j_z >= $mmm[$m[$i-1]]) { //new
                        if($temp_max) {
                            if(!isset($mmm[$temp_max+1])) {
                                $mmm[$temp_max+1] = pow($temp_max+1,3);
                            }
                            if($mmm[$temp_max]<$temp_j_z && $mmm[$temp_max+1]>$temp_j_z) {
                                $temp_max = $temp_max;
                            } else {
                                $temp_max = floor(pow($temp_j_z, 1/3) + 0.0000001);
                            }
                        } else {
                            $temp_max = floor(pow($temp_j_z, 1/3) + 0.0000001);
                        }
    
                        //if($mmm[$temp_max]>$temp_j_z){
                        //$temp_max = floor(pow($temp_j_z, 1/3) + 0.0000001);
                        //}
                        //if($temp_max != $temp_max1) {
                        //  echo $temp_j_z.":".$temp_max.":".$temp_max1."<br>";
                            //}
                            //echo $temp_max.",";
                            if(!isset($mmm[$temp_max])) {
                                $mmm[$temp_max] = pow($temp_max,3);
                            }
                            $temp_t = $i + $temp_j_z - $mmm[$temp_max];
                            if($temp_t < $t) {
                                $t = $temp_t;//此时的最小立方和数
                                if($t <= $i) {
                                    break 2;//关键优化代码
                                }
                            }
    
    
                        }
                    } else {
                        $jjt ++;
                        //$jj++;
                    }
    
    
                    for($jj=$jjt;$jj<$i;$jj++) {
                        $itt = $i-$jj;
                        $m[$itt] = $m[$itt] + 1;
                        if(($temp_max>0 && $m[$itt]>$temp_max) || $m[$itt] > $max) {
                            $tl = true;
                            continue;
                        } else {
                            break;
                        }
                    }
                    if($jj == $i && $tl) {
                        break;
                    }
                    $tl = false;
                }
    
                //var_dump($m);exit;
    
                $i ++;//增加楼层
                if($t <= $i) {
                    break;
                }
            }
    
    
            return $t;
}

/**
 * solution() oj系统的代码
 * solution2() 本地调试的代码，用来优化性能的，最后发现了关键优化代码line：102，就没有把本地的上传，相信2的性能更快
 */ 

