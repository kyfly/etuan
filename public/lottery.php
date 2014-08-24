<?php

function lotteryRand($prob= array(10, 90, 900))   //传入每个奖品的概率，用整数表示（默认的是例子，请删除）
{
    $probSum = 0; //概率总和
    for ($i = 0; $i < count($prob); $i++)  //累加计算总和
        $probSum += $prob[$i];
    $range = array($prob[0]);  //概率区间
    for ($i = 1; $i < count($prob); $i++)  //计算区间
        $range[$i] = $range[$i-1] + $prob[$i];
    $randVal = rand(1, $probSum);   //产生随机数（包含$probSum）
    $gift = 0;
    while ($randVal > $range[$gift]) //找到所在概率区间
        $gift++;
    return $gift;      //返回抽奖编号
}