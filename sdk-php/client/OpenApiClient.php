<?php

include_once "./util/Util.php";
include_once "./sign/RSA2.php";
include_once "./model/OpenApiResp.php";

/**
 * OpenApi客户端
 */
class OpenApiClient
{

    /**
     * 客户端执行
     * @param mixed $openApiConfig
     * @param mixed $openApiReq
     * @return   返回array
     */
    public static function execute($openApiConfig, $openApiReq)
    {
        //待签名串
        $signData = Util::array2UrlQuery($openApiReq->getArrayModel());
        /* echo "<br>待签名串-开始>>>>>>>>>>>>>>>><br>"; */
        /* echo "\$OpenApiReq->getArrayModel():<br>"; */
        /* var_dump($signData); */
        /* echo "<br>待签名串-结束>>>>>>>>>>>>>>>><br>"; */


        //签名
        /* echo "<br>签名开始>>>>>>>>>>>>>>>><br>"; */
        /* echo "OpenApiClient->execute->RSA2::sing<br>"; */
        /* echo "\$openApiConfig->getPrivateKey():".$openApiConfig->getPrivateKey()."<br>"; */
        /* echo "\$singData:<br>"; */
        /* var_dump($signData); */
        /* echo "<br>>>>>>>>>>>>>>>>><br>"; */
        $signData = RSA2::sign($openApiConfig->getPrivateKey(), $signData);

        /* echo "<br>签名结束后>>>>>>>>>>>>>>>><br>"; */
        /* echo "\$singData:<br>"; */
        /* var_dump($signData); */
        /* echo "<br>签名结束后 打印结束>>>>>>>>>>>>>>>><br>"; */






        /* echo "<br>\$openApiReq->setSignData() 开始>>>>>>>>>>>>>>><br>"; */
        /* echo "OpenApiClient->execute->RSA2::sing<br>"; */
        /* echo "\$openApiConfig->getPrivateKey():".$openApiConfig->getPrivateKey()."<br>"; */
        /* echo "\$singData:<br>"; */
        /* var_dump($signData); */
        /* echo "<br>\$openApiReq->setSignData() 结束>>>>>>>>>>>>>>><br>"; */
        $openApiReq->setSignData($signData);





        $data = json_encode($openApiReq->getArrayModel(), JSON_PRETTY_PRINT);
        //打印
        print_r("请求参数:<pre>");
        print_r($data);
        print_r("</pre>");
        //print("==>签名串:" . "</br>" . $signData . "</br>");
        $resp = Util::curl_post($openApiConfig->getRequestUri(), $data);
        //$resp = str_replace("&", "&amp", $resp);
        //验证签名
        $resp_array = json_decode($resp, true);
        /* echo "验证签名"; */
        //平台签名
        $sign = $resp_array["signData"];
        /* echo "<hr>"; */
        /* print_r($sign); */
        /* echo "<hr>"; */
        //待签名串
        $signData = Util::array2UrlQuery($resp_array);
        /* echo "待签名串"; */
        /* var_dump($signData); */
        /* echo "<hr>"; */
        $falg = RSA2::verify($openApiConfig->getAllinpayPublicKey(), $signData, $sign);
        if ($falg) {
            print_r("<pre>");
            print_r("==================>");
            print_r(" 签名结果验证成功");
            print_r("==================>");
            print_r("</pre>");
            //do  other
        } else {
            print_r("<pre>");
            print_r("==================>");
            print_r(" 签名结果验证失败");
            print_r("==================>");
            print_r("</pre>");
        }
        $openApiResp = new OpenApiResp();
        return $openApiResp->initResp($resp_array);
    }

}
