<?php

include_once "./config.php";
include_once "./client/OpenApiClient.php";
include_once "./model/OpenApiConfig.php";
include_once "./model/OpenApiReq.php";
include_once "./model/PaymentContent.php";
include_once "./model/OpenApiResp.php";

header("Content-Type:text/html;charset=utf-8");
/**
 * 配置文件
 */
$openApiConfig = new OpenApiConfig();
//请求的地址
$openApiConfig->setRequestUri("http://test.sdtlpay.com/openapi/v1");
//$openApiConfig->setRequestUri("http://localhost:8000/openapi/v1");
//通联山东公钥
$openApiConfig->setAllinpayPublicKey(Config::$allinpayPublicKey);
//私钥
$openApiConfig->setPrivateKey(Config::$privateKey);

/***
 * 公共请求报文参数
 */
$openApiReq = new OpenApiReq();
$openApiReq->setAccessId("20230412aKTLds2v");
$openApiReq->setMethod("allinpay.shandong.payment");
$openApiReq->setSignType("RSA2");
$openApiReq->setFormat("json");
$openApiReq->setCharSet("UTF-8");
$openApiReq->setTimestamp(date("Ymd His"));
$openApiReq->setVersion("V1");

//业务参数
$paymentContent = new PaymentContent();
$paymentContent->setMerCd("800490010000553"); // 商户号
$paymentContent->setStoreCd("1030186308"); // 门店号
$paymentContent->setAppId("wx317765448aa3f8d5"); // appId
$paymentContent->setOpenId("wx317765448aa3f8d5");
$paymentContent->setOrderNo(date("YmdHis")); // 订单号
$paymentContent->setPayType("TX4599"); // 支付类型//收银宝、当面付类交易
$paymentContent->setRandomStr("100"); // 商户自定义串
$paymentContent->setTxnOrderFlag("00"); // 交易标记
$paymentContent->setSumAmt("0.01");
$paymentContent->setAmount("2");
$paymentContent->setOffestAmt("0.01");
$paymentContent->setRemark("备注摘要");
$paymentContent->setNotifyUrl("www.localhost.com"); // 异步通知 当有的时候 会发送异步通知 也可不填写
$paymentContent->setPageNotifyUrl("01");
$paymentContent->setValidTime("370102198308270022");

$openApiReq->setBizContent($paymentContent->getBizContent());


echo "<pre>\$paymentContent>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
var_dump($paymentContent);
echo "\$paymentContent END>>>>>>>>>>>>>>>>>>>>>>>>>>>>";

/**
 * sdk 客户端
 */
$openApiClient = new OpenApiClient();
$openApiResp = $openApiClient::execute($openApiConfig, $openApiReq);
/* echo "<pre>"; */
/* print_r($openApiReq); */
/* echo "<hr>"; */
if ($openApiResp->isSuccess()) {
    echo "成功";
    print_r("响应结果:<pre>");
    print_r($openApiResp->getArrayModel()) . "</br>";
} else {
    print_r("响应结果:<pre>");
    print_r($openApiResp->getArrayModel()) . "</br>";
}
