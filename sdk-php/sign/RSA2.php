<?php

class RSA2
{

    /**
     * 获取私钥
     */
    public static function getStrPrivateKey($privateKeyStr)
    {
        $privateKey = chunk_split($privateKeyStr, 64, "\n");
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n$privateKey-----END RSA PRIVATE KEY-----\n";
        return $privateKey;
    }

    /**
     * 获取公钥
     */
    public static function getStrPublicKey($publicKeyStr)
    {
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($publicKeyStr, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
        //$publicKey = "-----BEGIN  PUBLIC KEY-----\n$publicKey-----END  PUBLIC KEY-----\n";
        return $publicKey;
    }

    /**
     * 私钥签名
     * @param mixed $privateKey 私钥
     * @param mixed $signData   签名数据
     * @return string sign
     */
    public static function sign($privateKey, $signData)
    {
        if (!is_string($signData)) {
            return null;
        }
        /* echo "<br>$$$$$$$$$$$$$$$$$$$<br>\$signData:<br>"; */
        /* var_dump($signData); */
        /* echo "<br>\$sign End<br>$$$$$$$$$$$$$$$$<br>"; */
/*  */
/*  */
        /* echo "RSA2::getStrPrivateKey(\$privateKey)<br>"; */
            /* $re = RSA2::getStrPrivateKey($privateKey); */
            /* var_dump($re); */
        /* echo "<br>RSA END<br>"; */
        $res = openssl_sign(
            $signData,
            $sign,
            RSA2::getStrPrivateKey($privateKey),
            OPENSSL_ALGO_SHA256
        );
        echo "openssl_sign:<br>";
        var_dump($res);
        echo "<br>###############################<br>";
        echo "\$sign<br>";
        var_dump($sign);
        echo "<br>###############################<br>";
        echo "判断私钥是否可用<br>";
        $pi_key =  openssl_pkey_get_private($privateKey);
        var_dump($pi_key);
        echo "<br>###############################<br>";
        echo "<br>显示生成私钥###############################<pre>";
        echo RSA2::getStrPrivateKey($privateKey);
        echo "<br>###############################<br>";
        return openssl_sign(
            $signData,
            $sign,
            RSA2::getStrPrivateKey($privateKey),
            OPENSSL_ALGO_SHA256
        ) ? base64_encode($sign) : null;
    }

    /**
     *公钥验证签名
     */
    public static function verify($publicKey, $signData, $sign)
    {
        if (!is_string($signData)) {
            return false;
        }
        return (bool) openssl_verify(
            $signData,
            base64_decode($sign),
            RSA2::getStrPublicKey($publicKey),
            OPENSSL_ALGO_SHA256
        );
    }

}
