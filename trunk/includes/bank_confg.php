<?php
//############################## 银行日志设定开始 #############################
//  0  存款
//  1  取款
//  2  转出
//  3  转入
//  4  兑换
//  5  获取利息
//  货币说明
//   1铜币
//   2银币
//	 3金币
//############################## 银行日志设定结束 #############################
//############################## 银行利率设定开始 #############################
define('INTEREST_RATE',0.01);       //银行利率
define('DAY_BASE',1);               //记息单位（天）
define('COIN_BASE',1);              //记息货币

//############################## 银行利率设定结束 #############################
define('VIREMENT',0.5);

$bank_log_action = array('存款','取款','转出','转入','兑换','获取利息');

?>