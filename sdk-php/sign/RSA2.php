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
        echo "<pre>################################<br>";
        echo "PublicKey:<br>";
        echo RSA2::getStrPublicKey($publicKey);
        return (bool) openssl_verify(
            $signData,
            base64_decode($sign),
            RSA2::getStrPublicKey($publicKey),
            OPENSSL_ALGO_SHA256
        );
    }

}
