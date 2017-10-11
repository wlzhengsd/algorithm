算法
=======
### Migraine_headache.php
	组长偏头痛
	http://blog.sina.com.cn/s/blog_6e51c0630102wqp2.html
	
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

### min_cube_total.php
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
	
	解题历程
	大约用了6个小时时间提交oj验证，发现测试用例有问题，用例修复后发现超时，用了大量时间优化不佳，最后就一行代码搞定，代码中有说明
	开始想求最大立方根，然后循环下去，感觉逻辑不可靠，放弃，看其他同学的提交证明是对的
	其实最终的方法就是枚举加技巧
	
	max最接近的立方根
	1楼
	1	2	3	max
	2楼
	2			3			。。。	max
	2-max		3-max		。。。	max
	3楼
	2			3			4			。。。		max
	2			3			4			。。。		max
	2-max		3-max		4-max		。。。		max
	类推
	计算出的立方数小于或者等于楼层循环跳出，该立方数即为所求
	详细心路可见<<小米工作日记本2>>
	
### 最小生成树
	村村通计划
		
	描述

	乡政府设立了一项村村通计划，准备修建一个公路网，以覆盖乡里所有村落。不要求每个村落都直接连通，只要有路到达即可（例如A->B,B->C,那么 A->C也连通）。但是因为财政压力过大，要求尽量节省开支。
	经过调研和评估，政府已经评估出了每两个村之间修筑一条路所需要的成本，请问实现村村通计划，所需要的最低成本是多少？
	输入
	
	第一个数字n表示村庄的个数，村庄编号为1~n
	之后有n*(n-1)/2组元素，每组有a,b,c三个数字,a,b是村庄编号，c是两个村庄之间修路的成本。
	
	例如3;1,2,3;1,3,4;2,3,5
	表示一共3个村庄，1,2之间修路需要花费3，2,3之间修路需要花费5，1,3之间修路需要花费4。
	输出
	
	一个整数，表示最少需要花费的成本。
	输入样例
	
	3;1,2,3;1,3,4;2,3,5
	输出样例
	
	7
	
	wiki
	http://blog.sina.com.cn/s/blog_6e51c0630102wvyp.html
	
### rucksack.php
	动态规划.0-1背包问题
	http://www.cnblogs.com/fengty90/p/3768845.html
	
	问题描述：
	给定n种物品和一背包。物品i的重量是wi，其价值为vi，背包的容量为C。问应如何选择装入背包的物品，使得装入背包中物品的总价值最大?
	
	对于一种物品，要么装入背包，要么不装。所以对于一种物品的装入状态可以取0和1.我们设物品i的装入状态为xi,xi∈ (0,1)，此问题称为0-11背包问题。
	
	数据：物品个数n=5,物品重量w[n]={0，2，2，6，5，4},物品价值V[n]={0，6，3，5，4，6},
	（第0位，置为0，不参与计算，只是便于与后面的下标进行统一，无特别用处，也可不这么处理。）总重量c=10。背包的最大容量为10，那么在设置数组m大小时，可以设行列值为6和11，那么，对于m(i,j)就表示可选物品为i…n背包容量为j(总重量)时背包中所放物品的最大价值。
	
### island.php
	数数有几个岛
	
	问题描述：
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
	
	心路历程
	开始的时候想到了一个方法,还卓有成效,过了几个样例但是多次多次测试总是有样例不能过,后来想是不是原型方法有问题,后来采用了Two方法，一次编程一次过样例，一次提交oj通过
	
	评价
	解决该问题，思维基本是最基础的逻辑，就像从沙中找黄金，简单就是一个个来，然后利用了计算机的快速处理，找到黄金，没有太多算法含量
	
	
	人生亦如此，放弃边缘痛苦难耐，说坚持谈何容易，不总是见彩虹；一个人就是一个世界，吃苦瓜的时候，不要想着瓜的苦，而是无所谓反正不死人，苦亦成甜
	找对方法很重要，遇到明白人更重要
	
### continuity_num.php
	描述
    
    给出一个字符串S，判断S是否为连乘字符串。
    连乘字符串定义为：
    字符串拆分成若干数字，后面的数字（从第三个数字开始）为前面2个数字的乘积。
    例如：
    122，可以拆成{1|2|2}，有12=2
    1122242，可以拆成{11|22|242}，有1122=242
    1224832256，可以拆成{1|2|2|4|8|32|256}，有12=2，22=4，24=8，48=32，8*32=256。
    
    若是连乘字符串，则输出true，否则输出false。(PS:不考虑乘以0)
    输入
    
    一个正整数字符串
    输出
    
    字符串true或者false，表示是否可以拆成连乘数字。
    输入样例
    
    122
    
    113
    
    1122242
    输出样例
    
    true
    
    false
    
    true
    
    
    没有太多心得体会，是做得最快的一个题目，一气呵成，没有bug
    主要运用了常规的解题思想，用纸笔推算的顺序、多次尝试
    妙的事用程序准确的反映了解题思路，最后用了折半退出的问题点，提高了性能（如果推演到数字字符串的一半，还是不能连乘，即退出，因为后面的位数小于前面的永不可能相等
    
### hdfz.php
    描述
    
    海盗分赃
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
    
    心得：没有太多好的方法，还是采用常规逻辑思想，一个个尝试枚举所有可能找到正确的
    
### zsjh.php
    描述
    
    最少交换次数
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
    
    心得：也没有太多体会，基本就是一个冒泡排序，大的跟小的交换位置完成
    
### chb.php
    擦黑板
    
    描述
    
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
    
    解题分析
    xyz
    816
     81
      8
    x + y + z + 10*y + 10*x + 100x = 905
    111*x + 11*y + z = 905
    要求求最小的，所以从后往前，每一个循环拿到所求数的一位数（8 1 6）
   
### hszfc.php
    还是字符串
    描述
    
    有一个无限长的字符串，只包含数字 1 和 2 ，按照一定的规则变化后，字符串不会发生任何变化。规则如下：
    将字符串按1与2进行拆解，计算相邻的1与2的数量，组成的新字符串。
    
    下面是这个字符串的前19位：
    1221121221221121122......
    按1与2拆解，可得：
    (1) (22) (11) (2) (1) (22) (1) (22) (11) (2) (11) (22) ......
    计算相邻的1与2的数量，组成的新字符串：
    1 2 2 1 1 2 1 2 2 1 2 2 ......
    恰好等于原字符串。字符串不变。
    输入
    
    输入正整数 Ｎ，表示这个无限长字符串的前N位子串的长度
    例如Ｎ＝6，前6位子串为 122112
    输出
    
    正整数 M，表示前N位子串中1的个数
    输入样例
    
    4
    
    5
    
    6
    输出样例
    
    2
    
    3
    
    3
    
    心得
    样例给出的字符串就是目标字符串，后面的字符串由前面的字符串限制产生，找到规律依此得出结果
    
### jyyd.php
    节约用电
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
    
    没有太多心得，从头开始发现是1按开关，相应位置变化，继续发现是1按开关，相应位置变化，一直到最后，不可能出现-1的情况
    
    