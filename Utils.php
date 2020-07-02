<?php

use Psr\Http\Message\StreamInterface;

/**
 * Created by PhpStorm.
 * User: Adam Yu
 * Date: 2020/7/2
 * Time: 15:05
 */
class Utils
{
    /**
     * 发送http请求
     * @param string $url
     * @param $data_string
     * @return mixed|StreamInterface
     */
    public static function httpRequest($url, $data_string)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'X-AjaxPro-Method:ShowList',
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data_string)]
        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $data = curl_exec($ch);
        curl_close($ch);

        //var_dump(curl_error($ch));die;

        return $data;
    }

    /**
     * @return string 生成唯一订单号
     */
    public static function createOrderSn()
    {
        return date('Ymd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(1000, 9999));
    }
}
