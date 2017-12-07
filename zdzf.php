<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/12/7
 * Time: 17:39
 *
 *  最短字符串
序号：#80 难度：非常难  时间限制：1000ms  内存限制：10M
描述

有一个字符串S，是由字符串T变换而来的。变换规则如下：
字符串S起始为空字符串，每次取T任意大小的前缀连接到S的末尾，形成新的S。
比如T=abcad，S起始为空
第一步：取T的前缀abcad加到S末尾，S=abcad
第二步：取T的前缀abc加到S末尾，S=abcadabc
第三步：取T的前缀abcad加到S末尾，S=abcadabcabcad

现在告诉你字符串S，请你给出可以变换成S的长度最小的字符串T
输入

输入一个非空字符串S，字符串S的长度L<100000,只包含小写字母
例如abcadabcabcad
输出

一个字符串T
输入样例

abcadabcabcad

abcababcd

aaaaaa
输出样例

abcad

abcd

a
 *
 * 基本思路
 * abcad
 * abcadabcabcad
 * abcad abcab[d] 错误，所以重新从头开始，仅提前了a一个
 * abcad abc abcad
 *
 * abcabd
 * ab abcabd abcababcabd
 * ab abcabd abcaba[d] 错误，所以重新从头开始，注意这个地方是提前了ab两个
 * ab abcabd abc ab abcabd
 */

function solution($line) {
    $k = $line[0];//第一个字符
    $f = $line[0];//源字符
    $line = trim($line, $f);//清除首尾重复的第一个字符
    if(empty($line)) {
        return $f;//aaaaaaaaaa 直接返回a
    }

    $t  = '';
    $j  = 0;//源字符串位置
    $tk = '';
    $jl = 1;//源字符串长度
    $l  = strlen($line);
    $tj = 0;

    for($i=0; $i<$l; $i++) {
        $d = $line[$i];
        $flag = true;

        while(true) {
            $s = $f[$j];
            if($s != $d) {
                if($j!=$jl && $flag && ($d==$k || (!empty($line[$i-1]) && $line[$i-1] == $tk))) {//顺序不能继续，重新从最近的开始字母算起
                    if($d==$k) {
                        $j = 0;
                    } else {
                        $flag = false;
                        $j = $tj;
                    }
                    $tj = 0;
                    $tk = '';
                    continue;
                }

                $f = $f . $t . $d;//注意$t是中间的值，需要保留
                $t = '';
                $j = 0;
                $jl = strlen($f);
                $tj = 0;
                $tk = '';
            } else {
                $t = $t . $d;

                if($tj) {
                    if($f[$tj] == $d) {
                        $tj ++;
                        $tk = $d;
                    } else {
                        $tj = 0;
                        $tk = '';
                    }
                }
                if($d == $k) {
                    $tj = 1;//记录从头开始的位置
                    $tk = $d;//记录从头循环的字母
                }
                //echo "tk=".$tk."\n";
                $j++;
                if ($j == $jl) {
                    $t = '';//注意清空，因为之前的都是可循环到的，不需要
                    $j = 0;
                    $tj = 0;
                    $tk = '';
                }
            }
            break;
        }
    }

    return $f;
}

$line = 'ababcdabcabcdadaabcabcd';//abcdad
//$line = 'ababcdabcabcdabeabcdabaaabcabcd';//abcdabe
//$line = 'abcadabcabcad';
//$line = 'abcababcd';
$line = 'aaaaaaaaaaaaaaaa';
//$line = 'afibmhqaacxapiwttscdbfobtgtzdnuhgrafibmhqaacxapiwttscdbfobtgtzdnuhgrierafibmhqaacxapiwttscdbfobtgtzdnuhgrierhdaafibmhafibmhqaacxapiwttscdbfobtgtzdafibmhqaacxapiwafafibmhqaacxapiwttsafibmhqaacxapiwttscdbfobtgtzafiafibmhqaacxapiwttsafibmhafibmhqaacxapafibafibmhqaacxapiwttsc';
//期望输出: "gcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagivefm"
//$line = 'gcdlbxtvcqsv,12,gcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagi,50,gcdlbxtvcqsvyqti,66,gcdlbxtvcqs,77,gcgcdlbgcdlbxtvcgcdlbxtvgcdlbxtvcqsvyqtigcqgcdlbxtvcgcdlbxtvcqsvyqtigcqaxyxgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkgcdlbxtvcqsgcdlbxtvcqsvyqtigcqaxyxlwwhgcdgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkgcdlbxtvcqsvyqtigcqaxgcdlbxtvcqsvyqtigcqaxygcdlbxtvcqsvyqtigcqaxyxlwwgcdlbxtvcqsvyqtigggcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagcdlbxtvcqgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagivefmgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkgcdlbxtvcqsvyqtigcqaxyxgcdlbxtvcqsvyqtigcqaxyxlgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagivefmgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagcdlbxtvcqsvyqtigcqaxyxlwwhwhgcdlbxtvcqsvyqtigcdlbxtvcqsvygcdlbxtvcqsvyqtgcdlbxtvgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkf';
$line = 'gcdlbxtvcqsvgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagigcdlbxtvcqsvyqtigcdlbxtvcqsgcgcdlbgcdlbxtvcgcdlbxtvgcdlbxtvcqsvyqtigcqgcdlbxtvcgcdlbxtvcqsvyqtigcqaxyxgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkgcdlbxtvcqsgcdlbxtvcqsvyqtigcqaxyxlwwhgcdgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkgcdlbxtvcqsvyqtigcqaxgcdlbxtvcqsvyqtigcqaxygcdlbxtvcqsvyqtigcqaxyxlwwgcdlbxtvcqsvyqtigggcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagcdlbxtvcqgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagivefmgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkgcdlbxtvcqsvyqtigcqaxyxgcdlbxtvcqsvyqtigcqaxyxlgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagivefmgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizagcdlbxtvcqsvyqtigcqaxyxlwwhwhgcdlbxtvcqsvyqtigcdlbxtvcqsvygcdlbxtvcqsvyqtgcdlbxtvgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkfizgcdlbxtvcqsvyqtigcqaxyxlwwhwhpqkf';
//$line = 'abeabeaabeabfagabeababeabfabeabfagaaababeabeabfagabeamabeabfabeabfaabeab';
//$line = 'ameamgamhameameaameamgameamgam';
echo solution($line);


/**
 * 心路
 * 关于字符串的题目，我还是比较钝的，没有数字那么敏感，这个题目从开始到解决差不多一个礼拜的时间，让我头疼至极，不容易 [终于等到你，还好没有放弃]
 * 主要的问题是源字符串同一个字符会多次出现比如abcdad，怎么判断a是开始的还是中间的，想得太多
 *
 * 间隔好几天后，突然想为什么不简单的考虑问题，还是老套路简单的正常人的思维，找到他，然后程序实现他
 * 正常简单的人的思维，从开始去分析看到第二次重复的就尝试往后，如果往后有问题就从头开始，总之真的很难描述我的思路。。。。。。
 * 之所以最后能够解决，完全是偶然进入了正确的地方，多了几次偶然，强制通过验证修复了bug，得以解决
 *
 * 还是老套路，不要把问题想得太难，假设是一个人怎么解决问题，找到这个思路，然后程序实现
 */