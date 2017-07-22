<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/7/12
 * Time: 17:15
 *  数数有几个岛
序号：#55 难度：非常难  时间限制：1000ms  内存限制：10M
描述

有一个二维的网格地图，其中1代表陆地0代表水，并且该网格的四周全部由水包围。我们对岛屿的定义是四面环水，由相邻的陆地水平或垂直连接形成，现在需要统计岛屿的数量。

举例：
有一个二维地图如下：
11110
11010
11000
00000
其中的岛屿数量为1。

提示：是时候祭出 B/DFS（广/深度优先）来一发了！
输入

使用空格分隔二维地图的每一行，使用逗号分隔每一项。
输出

岛屿的数量。
输入样例

1,1,1,1,0 1,1,0,1,0 1,1,0,0,0 0,0,0,0,0

1,1,0,0,0 1,1,0,0,0 0,0,1,0,0 0,0,0,1,1
输出样例

1

3

 */


//构建矩阵
function init($line) {
    $i = 0;
    $row = [];
    $line = explode(' ', $line);

    foreach($line as $l) {
        $t = explode(',', $l);
        foreach($t as $k=>$v) {
            $row[$i][$k] = $v;
        }
        $i ++;
    }

    return $row;
}

function row($i, $k) {
    global $row;
    global $w;
    global $l;

    $k = $k + 1;
    if($k == $w) {

    }
    for($t_i=$k;$t_i<$w;$t_i++) {
        if($row[$i][$t_i] == 1) {

        }
    }
}

function row1($i, $s, $e) {
    global $row;

    $t_s = 0;
    $t_e = 0;

    if($s==$e && $s==0) {

    }

    $s = -1;
    $e = -1;
    for($t_l=0;$t_l<$l;$t_l++) {
        if($s==-1 && $e==-1) {
            foreach($row[$t_l] as $k=>$v) {
                if($v == 1) {
                    if(isset($t_r[$t_l.','.$k])) {
                        continue;
                    }
                    $flag = true;
                    if($s == -1) {
                        $s = $k;
                        $e = $k;
                    } else {
                        $e = $k;
                    }
                    $t_r[$t_l.','.$k] = [$t_l, $k];
                } else {
                    if($s!=-1) {
                        break;
                    }
                }
            }

        } else {
            $s = -1;
            $e = -1;

            for($t_s=$s;$t_s<=0;$t_s--) {
                if($row[$t_l][$t_s] == 1) {
                    if(isset($t_r[$t_l.','.$t_s])) {
                        break 2;
                    }
                    $s = $t_s;
                    $t_r[$t_l.','.$t_s] = [$t_l, $t_s];
                } else {
                    break;
                }
            }

            for($t_s=$s+1;$t_s<$w;$t_s++) {
                if($t_s<=$e) {
                    if($row[$t_l][$t_s] == 1) {
                        if(isset($t_r[$t_l.','.$t_s])) {
                            break 2;
                        }
                        $t_r[$t_l.','.$t_s] = [$t_l, $t_s];
                        if($s == -1) {
                            $s = $t_s;
                            $e = $t_s;
                        } else {
                            $e = $t_s;
                        }
                    }
                } else {
                    if($row[$t_l][$t_s] == 1) {
                        $e = $t_s;
                    } else {
                        break;
                    }
                }
            }

            if($flag && $s==-1 && $e==-1) {
                $q ++;
            }
        }
    }

}

function solution($line) {
    // 在此处理单行数据

    // 返回处理后的结果
    $row = init($line);
    $w   = count($row[0]);//宽度
    $l   = count($row) + 1;//长度
    //最后补偿一行
    for($m=0;$m<$w;$m++) {
        $row[$l-1][$m] = 0;
    }

    /*
    for($i = 0;$i<$w;$i++) {
        echo '     '.$i.'   ';
    }
    echo "\n";
    foreach($row as $k=>$t) {
        echo $k.'     '.implode('   ', $t)."\n";
    }*/
    //exit;

    $t_t_l = 0;
    $t_k = 0;
    $q = 0;
    while(true) {
        $s = -1;
        $e = -1;
        $flag = false;
        $d = false;
        $temp_t_r = [];

        for($t_l=$t_t_l;$t_l<$l;$t_l++) {


            if($s==-1 && $e==-1) {
                $temp_t_r = [];
                for($k=$t_k;$k<$w;$k++) {
                    $v = $row[$t_l][$k];
                    if($v == 1) {
                        if(isset($t_r[$t_l.','.$k])) {
                            $flag = false;
                            $s = -1;
                            $e = -1;
                            continue;
                        }

                        $flag = true;
                        $e = $k;
                        $t_k = $k+1;
                        if($s == -1) {
                            $s = $k;
                        }
                        $t_r[$t_l.','.$k] = [$t_l, $k];
                    } else {
                        if($s != -1) {
                            $t_t_l = $t_l;
                            break;
                        }
                    }
                }
                /*
                foreach($row[$t_l] as $k=>$v) {
                    if($v == 1) {
                        if(isset($t_r[$t_l.','.$k])) {
                            continue;
                        }
                        $flag = true;
                        $e = $k;
                        if($s == -1) {
                            $s = $k;
                        }
                        $t_r[$t_l.','.$k] = [$t_l, $k];
                    } else {
                        if($s != -1) {
                            break;
                        }
                    }
                }*/
            } else {
                //echo $t_l.'.'.$s.'.'.$e."\n";
                $ts = $s;
                $te = $e;

                $s = -1;
                $e = -1;

                /*
                for($t_s=$ts;$t_s>=0;$t_s--) {
                    if($row[$t_l][$t_s] == 1) {
                        if(isset($t_r[$t_l.','.$t_s])) {
                            $d = true;
                            break;
                        }
                        $s = $t_s;
                        if($e == -1) {
                            $e = $t_s;
                        }
                        $t_r[$t_l.','.$t_s] = [$t_l, $t_s];
                    } else {
                        break;
                    }
                }
                */
                if(empty($temp_t_r)) {
                    for ($i = $ts; $i <= $te; $i++) {
                        $temp_t_r[($t_l - 1) . ',' . $i] = 1;
                    }
                }
                if($row[$t_l][$te] == 1) {
                    if(isset($t_r[$t_l.','.$te])) {
                        $d = true;
                    }
                    $s = $te;
                    if ($e == -1) {
                        $e = $te;
                    }
                    $t_r[$t_l . ',' . $te] = [$t_l, $te];
                    $temp_t_r[$t_l . ',' . $te] = 1;
                }

                for($t_s=$te-1;$t_s>=0;$t_s--) {
                    if($row[$t_l][$t_s] == 1) {

                        if($t_s <=$ts) {
                            if(isset($t_r[$t_l.','.$t_s])) {
                                $d = true;
                            }


                                $s = $t_s;
                                if ($e == -1) {
                                    $e = $t_s;
                                }
                                $t_r[$t_l . ',' . $t_s] = [$t_l, $t_s];
                                $temp_t_r[$t_l . ',' . $t_s] = 1;
                        } else {
                            if(isset($temp_t_r[$t_l.','.($t_s+1)]) || isset($temp_t_r[($t_l-1).','.$t_s])) {
                                if(isset($t_r[$t_l.','.$t_s])) {
                                    $d = true;
                                }
                                $s = $t_s;
                                if ($e == -1) {
                                    $e = $t_s;
                                }
                                $t_r[$t_l . ',' . $t_s] = [$t_l, $t_s];
                                $temp_t_r[$t_l . ',' . $t_s] = 1;
                            } else if($t_s < $ts) {
                                break;
                            }
                        }

                    } else {
                        if($t_s <= $ts) {
                            break;
                        }

                    }
                }

                if($row[$t_l][$te] == 1) {
                    for ($t_s = $te + 1; $t_s < $w; $t_s++) {
                        if ($row[$t_l][$t_s] == 1) {
                            if (isset($t_r[$t_l . ',' . $t_s])) {
                                $d = true;
                                break;
                            }
                            if ($s == -1) {
                                $s = $t_s;
                                $e = $t_s;
                            } else {
                                $e = $t_s;
                            }
                            $t_r[$t_l . ',' . $t_s] = [$t_l, $t_s];
                            $temp_t_r[$t_l . ',' . $t_s] = 1;
                        } else {
                            break;
                        }
                    }
                }


/*
                if($ts == $te) {
                    if($row[$t_l][$ts] == 1) {
                        for($t_s=$te+1;$t_s<$w;$t_s++) {
                            if($row[$t_l][$t_s] == 1) {
                                if(isset($t_r[$t_l.','.$t_s])) {
                                    $d = true;
                                    break;
                                }
                                if($s == -1) {
                                    $s = $t_s;
                                    $e = $t_s;
                                } else {
                                    $e = $t_s;
                                }
                                $t_r[$t_l.','.$t_s] = [$t_l, $t_s];
                            } else {
                                break;
                            }
                        }
                    }
                } else {


                    for($t_s=($ts+1);$t_s<$te;$t_s++) {
                        if($row[$t_l][$t_s]==1) {
                            //左右上


                            if(isset($t_r[$t_l.','.($t_s-1)]) || isset($t_r[($t_l-1).','.$t_s]) || (($te-$t_s)==1 && $row[$t_l][$te]==1)) {
                                //$c = true;
                            //if(true) {
                                if($s == -1) {
                                    $s = $t_s;
                                    $e = $t_s;
                                } else {
                                    $e = $t_s;
                                }
                                $t_r[$t_l.','.$t_s] = [$t_l, $t_s];
                            }
                        }
                    }

                    for($t_s=$te;$t_s<$w;$t_s++) {
                        if($row[$t_l][$t_s] == 1) {
                            if(isset($t_r[$t_l.','.$t_s])) {
                                $d = true;
                                break ;
                            }
                            if($s == -1) {
                                $s = $t_s;
                                $e = $t_s;
                            } else {
                                $e = $t_s;
                            }
                            $t_r[$t_l.','.$t_s] = [$t_l, $t_s];
                        } else {
                            break;
                        }
                    }
                }
*/



            }

            if($flag && $s==-1 && $e==-1) {

                if($d) {

                    break;
                } else {
                    $q ++;
                    //echo $t_l.'.'.$s.'.'.$e.'.'.$q."\n";
                }
                $d = false;
                break;
            }

            $t_k = 0;
            //echo $t_l."\n";
        }

        if(empty($flag)) {
            break;
        }
    }

    return $q;
}


$row = [];
$w = 0;
$h = 0;
$quan = [];
$team = [];
$factory = [];

//判断上下左右是否为1
function quan($position) {
    global $row;
    global $quan;
    global $team;
    global $factory;

    $i = $position[0];
    $j = $position[1];

    //前面
    if(!empty($row[$i][$j-1])) {
        $qk = $i.','.($j-1);
        if(!isset($quan[$qk])) {
            if(!isset($factory[$qk])) {
                $team[$qk] = [$i, $j-1];
                $quan[$qk] = 1;
                $factory[$qk] = 1;
            }
        }
    }
    //后面
    if(!empty($row[$i][$j+1])) {
        $qk = $i.','.($j+1);
        if(!isset($quan[$qk])) {
            if(!isset($factory[$qk])) {
                $team[$qk] = [$i, $j+1];
                $quan[$qk] = 1;
                $factory[$qk] = 1;
            }
        }
    }
    //上面
    if(!empty($row[$i-1][$j])) {
        $qk = ($i-1).','.$j;
        if(!isset($quan[$qk])) {
            if(!isset($factory[$qk])) {
                $team[$qk] = [($i-1), $j];
                $quan[$qk] = 1;
                $factory[$qk] = 1;
            }
        }
    }
    //下面
    if(!empty($row[$i+1][$j])) {
        $qk = ($i+1).','.$j;
        if(!isset($quan[$qk])) {
            if(!isset($factory[$qk])) {
                $team[$qk] = [($i+1), $j];
                $quan[$qk] = 1;
                $factory[$qk] = 1;
            }
        }
    }
}

function solutionTwo($line)
{
    // 在此处理单行数据

    // 返回处理后的结果
    global $row;
    global $w;
    global $h;
    global $quan;
    global $team;
    global $factory;

    $team = [];
    $quan = [];
    $factory = [];

    $row = init($line);
    $w = count($row[0]);//宽度
    $h = count($row);//高度

    $q = 0;//岛

    for($i=0;$i<$h;$i++) {
        for($j=0;$j<$w;$j++) {
            if($row[$i][$j] == 1) {
                $quan = [];

                $qk = $i.','.$j;
                if(isset($factory[$qk])) {
                    continue;
                }
                $team[$qk] = [$i, $j];
                $quan[$qk] = 1;
                $factory[$qk] = 1;

                while($team) {
                    $teamp_team = $team;
                    foreach($teamp_team as $k=>$m) {
                        quan($m);
                        unset($team[$k]);
                    }
                }

                $q ++;
            }
        }
    }

    return $q;

}


$line = '1,0,1,0,0,1,0,0,0,0,0,0,0,1,0,1,1,0,0,0 1,1,0,1,1,0,0,0,0,0,0,1,0,1,0,0,1,0,0,0 1,0,0,0,0,0,1,0,1,0,1,0,0,1,1,0,0,0,1,1 1,1,0,1,0,1,0,1,1,0,1,1,1,1,0,0,0,1,0,0 0,1,0,1,0,1,0,1,0,0,0,0,0,1,0,0,1,1,1,0';//13
//$line = '1,0,0,0,0,1,0,1,0,0,0,0,1,1,1,0,1,0,0,0 1,0,1,0,0,1,1,1,1,1,1,1,1,0,1,1,0,1,0,0 0,0,0,0,0,0,1,1,0,1,1,1,0,0,0,0,0,0,1,1 0,1,0,0,0,0,1,1,0,0,0,0,1,0,1,1,1,0,0,0 1,1,1,0,0,0,0,0,0,1,0,0,0,1,0,1,0,0,1,1';//12
//$line = '0,0,1,1,0,0,1,1,0,0,1,1,0,1,1,1,1,0,0,0 0,0,0,1,1,0,1,0,0,0,0,1,1,0,0,0,1,0,1,1 0,0,0,1,0,1,0,1,1,1,1,0,1,0,1,0,0,1,0,1 1,1,1,1,1,1,0,1,0,1,1,0,0,0,0,1,0,0,0,0 1,0,0,0,1,1,1,1,0,0,0,0,1,0,0,0,0,1,0,1 0,0,0,0,1,0,1,0,1,0,0,0,0,1,1,0,1,0,0,1 0,1,1,1,0,1,0,0,1,0,1,1,0,0,0,0,0,0,0,1 1,0,0,0,0,0,0,0,1,1,1,0,0,1,0,0,0,0,1,1 1,0,0,1,0,1,0,1,0,0,0,1,0,0,0,0,0,0,0,0 1,0,0,0,0,1,1,1,0,0,0,1,1,0,0,0,0,0,1,0 1,0,0,1,0,0,1,0,0,0,0,0,0,0,0,1,1,0,0,1 0,0,1,1,0,0,0,1,1,1,0,1,0,1,1,1,0,0,0,0 1,1,1,0,0,0,0,0,1,1,0,1,0,0,1,1,0,0,1,1 1,0,0,1,1,0,0,1,1,0,1,0,1,1,1,0,1,0,0,0 0,1,0,0,1,0,0,0,0,1,0,0,1,1,1,0,0,0,1,1 0,1,0,1,1,1,0,0,0,0,1,0,0,1,0,1,0,1,1,0';//36
//$line = '1,0,0,1,1,1,0,0,1,1,0,0,0,0,0,0 0,0,1,0,1,0,0,1,0,1,0,0,0,0,1,1 0,0,0,1,0,0,0,1,0,1,1,1,1,0,1,0 0,0,1,1,1,0,1,0,0,0,0,0,0,1,1,1 0,1,0,0,0,1,1,0,1,0,1,0,0,1,1,1 1,0,0,0,0,1,0,1,0,1,0,0,0,0,1,0 1,0,1,1,0,0,0,0,1,1,1,0,1,1,0,0 1,0,1,0,0,1,0,0,1,0,1,1,1,0,0,0 0,0,0,0,0,1,0,1,0,1,1,0,0,0,0,0 0,0,0,1,0,1,0,0,0,0,0,0,1,0,0,0';//19
//$line = '1,1,0,0,0 1,1,0,0,0 0,0,1,0,0 0,0,0,1,1';
//$line = '1,1,1,1,0 1,1,0,1,0 1,1,0,0,0 0,0,0,0,0';
//$line = '0,0,0,1,0,0,1,1 0,0,1,1,0,0,0,1 0,0,1,1,0,1,1,0 0,0,0,1,1,1,1,0 0,0,0,1,0,0,1,1 1,1,1,1,0,0,0,1 0,0,0,0,1,1,0,0';//3
//$line = '1,1,1,1,0 1,1,0,1,0 1,1,0,0,0 0,0,0,0,0';
//$line = '0,0,0,0,0,0,1,1,0,1,0,0 1,1,0,1,0,0,1,0,0,1,1,0 1,0,0,0,0,1,0,1,0,1,0,1 0,0,1,0,0,0,0,0,1,0,0,1 1,1,1,0,0,0,0,1,1,1,1,0 1,0,1,0,0,0,0,1,0,1,0,0 0,0,1,0,1,1,0,0,1,1,0,1 0,0,1,0,1,0,0,0,1,0,1,0 0,0,0,1,0,1,0,1,0,1,0,0 1,1,1,1,1,0,0,0,1,0,1,0 0,1,0,1,0,0,1,0,1,1,0,0 0,1,0,0,0,0,1,0,0,0,0,0 0,0,0,1,1,0,1,1,0,0,0,0 1,1,0,1,0,0,0,0,0,1,1,1 1,0,0,1,0,0,0,0,0,0,0,0 1,0,0,1,1,0,1,0,1,1,0,1 0,1,1,0,0,1,1,0,1,1,0,0 0,1,1,0,1,1,1,1,0,1,0,0';//26
//$line = '0,0,0,0,0,1,0,0,1,0,1,0,0,0,0,1 1,1,1,1,1,1,1,1,1,0,0,1,0,1,0,0 1,1,0,0,0,0,1,1,1,0,1,0,1,0,0,1 0,1,0,0,0,1,0,0,1,0,0,1,1,0,1,1 0,0,1,1,0,1,1,1,0,0,0,1,0,0,0,1 0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,0 0,1,1,0,1,0,0,1,1,0,1,0,0,0,1,1 0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0 0,0,0,0,0,1,1,1,0,0,0,0,1,0,0,0 0,0,0,0,0,0,0,1,0,0,0,0,0,0,1,1 0,0,1,0,0,0,0,0,0,1,0,1,0,1,1,0 1,0,1,0,0,0,0,1,1,0,0,1,0,1,0,1 0,1,0,0,0,0,1,0,1,0,1,0,0,1,1,1 1,1,0,0,0,1,0,1,1,0,0,0,0,1,0,0 0,0,1,0,1,1,0,0,1,0,0,0,0,0,0,0 0,1,0,0,1,0,0,0,0,1,0,0,1,1,0,0 0,1,1,0,1,1,1,0,1,0,1,0,1,0,0,0 0,0,1,0,1,0,0,0,1,0,1,1,0,0,1,1';//33
//$line = '0,0,1,1,1,1,0,0,1,0,1,1,0,0 1,1,1,0,0,1,0,0,0,1,0,0,0,1 0,0,1,1,0,1,1,1,1,0,0,0,0,0 0,0,0,0,0,0,1,1,1,1,0,0,0,0 1,0,0,0,0,1,0,0,1,0,1,1,1,1 0,1,1,1,0,1,1,1,0,0,0,1,0,1 1,0,0,1,0,0,0,0,0,1,0,0,0,0 1,1,0,0,1,1,0,0,1,0,1,0,1,1 1,0,0,0,0,0,0,0,0,0,1,0,0,0 1,0,0,1,0,1,1,0,0,1,1,1,0,1 1,1,0,0,1,1,1,0,1,0,0,1,1,1';//18
//$line = '1,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,1,1,1,0 0,1,1,1,1,1,1,0,1,1,0,0,1,1,0,1,0,0,0,1 0,0,1,0,1,1,0,0,0,0,0,0,0,1,1,0,0,0,0,0 0,1,0,1,1,1,0,1,0,0,1,1,0,0,0,1,0,1,0,0 0,0,0,1,0,1,1,0,0,0,0,0,1,0,1,1,0,1,0,1 1,0,0,1,1,0,1,0,1,0,0,1,1,0,1,0,1,0,0,0 1,0,1,0,1,0,0,1,1,0,0,1,0,1,0,0,1,0,0,0 1,1,1,1,1,1,0,0,1,0,0,0,1,0,1,0,1,0,0,1 1,1,0,0,1,0,0,0,1,1,1,1,1,1,0,1,0,0,0,0 0,1,0,0,0,0,1,1,0,0,0,0,0,1,0,0,1,1,1,0 0,0,0,0,0,0,1,0,1,0,1,0,1,0,0,1,0,0,0,0 1,1,1,0,0,1,0,0,1,0,0,0,0,1,0,1,0,0,0,0 1,1,0,0,0,0,0,1,0,1,0,0,1,0,1,0,1,0,1,0 0,0,1,0,1,1,1,1,0,0,0,1,0,1,0,1,0,1,0,1 0,1,1,1,0,0,0,1,1,1,0,0,0,0,0,0,0,1,0,1 1,0,1,0,1,1,1,1,0,0,0,0,0,1,0,1,0,1,0,0 1,0,1,0,0,0,0,0,1,1,1,1,0,0,1,0,0,1,0,1';//47


/*
 * solution() 最早用这个方法，结果多个多个样例失败，后怀疑此方法有问题，亦换方法solutionTwo()解决
 */

echo solutionTwo($line);
//echo solution($line2);

