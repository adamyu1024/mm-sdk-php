<?php
/**
 * Created by PhpStorm.
 * User: Adam Yu
 * Date: 2020/7/2
 * Time: 15:11
 */

use Signature\Signature;

include_once('vendor/jeferwang/signature/src/Signature.php');
include_once('Config.php');
include_once('Utils.php');

class Clients
{
    // 获取系统支持的币种信息
    public function supportCoins()
    {
        $s = new Signature(CLIENTCONFIG['app_id'], CLIENTCONFIG['api_key'], []);
        $r = $s->generate();
        $url = CLIENTCONFIG['gateway_address'] . '/v1/coin-type';
//var_dump($url);die;
        $data = array(
            'appid' => CLIENTCONFIG['app_id'],
            'nonce' => $r['nonce'],
            'signature' => $r['signature'],
            'timestamp' => $r['timestamp']
        );

        $data_string = json_encode($data);

        return Utils::httpRequest($url, $data_string);
    }

    // 生成地址
    public function createAddress()
    {
        $s = new Signature(CLIENTCONFIG['app_id'], CLIENTCONFIG['api_key'], []);
        $r = $s->generate();
        $url = CLIENTCONFIG['gateway_address'] . '/v1/wallet-address';

        $data = array(
            'appid' => CLIENTCONFIG['app_id'],
            'nonce' => $r['nonce'],
            'signature' => $r['signature'],
            'timestamp' => $r['timestamp']
        );

        $data_string = json_encode($data);

        return Utils::httpRequest($url, $data_string);
    }

    // 发送提币申请
    public function withdraw()
    {
        $params = [
            'from_a' => '0x559ca304a04fc7185c60fa4a7b2a090a70992615',
            'to_a' => '0x77920A6F61891b7228EBd9e6559130505c473b46',
            'value' => 0.01,
            'coin_type' => '1',
            'order_sn' => Utils::createOrderSn()
        ];
        $s = new Signature(CLIENTCONFIG['app_id'], CLIENTCONFIG['api_key'], $params);
        $r = $s->generate();
        $url = CLIENTCONFIG['gateway_address'] . '/v1/withdraw';

        $data = array(
            'appid' => CLIENTCONFIG['app_id'],
            'nonce' => $r['nonce'],
            'signature' => $r['signature'],
            'timestamp' => $r['timestamp'],
            'from_a' => '0x559ca304a04fc7185c60fa4a7b2a090a70992615',
            'to_a' => '0x77920A6F61891b7228EBd9e6559130505c473b46',
            'value' => 0.01,
            'coin_type' => '1',
            'order_sn' => Utils::createOrderSn()
        );

        $data_string = json_encode($data);

        return Utils::httpRequest($url, $data_string);
    }
}