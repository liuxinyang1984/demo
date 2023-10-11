<?php

class Util
{
    /**
     * 组织需要加密的字符串
     * @param {Object} $transMap
     */
    public static function array2UrlQuery($transMap)
    {
        if (!$transMap) {
            return null;
        }
        unset($transMap["signType"]);
        unset($transMap["signData"]);

        //将要 参数 排序
        ksort($transMap);

        //重新组装参数
        $params = array();
        foreach ($transMap as $key => $value) {
            $params[] = $key . '=' . $value;
        }

        $data = implode('&', $params);
        return $data;
    }

    /**
     * http Post请求
     * @param {Object} $url
     * @param {Object} $data
     */
    public static function curl_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, ""); //必须解压缩防止乱码
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data),
            )
        );

        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}