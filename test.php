<?php
/**
 * Created by PhpStorm.
 * User: Adam Yu
 * Date: 2020/7/2
 * Time: 15:19
 */
include_once('Clients.php');

$client = new Clients();

// 获取系统支持的币种信息
//$res = $client->supportCoins();

// 生成地址
//$res = $client->createAddress();

//发送提币申请
$res = $client->withdraw();
var_dump($res);die;