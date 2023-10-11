<?php

/**
 * 统一下单支付请求
 */
class PaymentContent
{
    private $merCd;

    private $storeCd;

    private $appId;

    private $openId;

    private $orderNo;

    private $payType;

    private $randomStr;

    private $txnOrderFlag;

    private $sumAmt;

    private $amount;

    private $offestAmt;

    private $splitAcctContent;

    private $pointContent;

    private $CouponContent;

    private $remark;

    private $notifyUrl;

    private $pageNotifyUrl;

    private $validTime;
    
    private $productCd;

    /***
     * 业务参数
     */
    private $arrayModel = array();

    private $bizContent = null;

    /**
     * @return mixed
     */
    public function getMerCd()
    {
        return $this->merCd;
    }

    /**
     * @param mixed $merCd
     * @return self
     */
    public function setMerCd($merCd): self
    {
        $this->arrayModel["merCd"] = $merCd;
        $this->merCd = $merCd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductCd()
    {
        return $this->productCd;
    }

    /**
     * @param mixed $storeCd
     * @return self
     */
    public function setProductCd($productCd): self
    {
        $this->arrayModel["productCd"] = $productCd;
        $this->productCd = $productCd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoreCd()
    {
        return $this->storeCd;
    }

    /**
     * @param mixed $storeCd
     * @return self
     */
    public function setStoreCd($storeCd): self
    {
        $this->arrayModel["storeCd"] = $storeCd;
        $this->storeCd = $storeCd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     * @return self
     */
    public function setAppId($appId): self
    {

        $this->arrayModel["appId"] = $appId;
        $this->appId = $appId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOpenId()
    {
        return $this->openId;
    }

    /**
     * @param mixed $openId
     * @return self
     */
    public function setOpenId($openId): self
    {
        $this->arrayModel["openId"] = $openId;
        $this->openId = $openId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * @param mixed $orderNo
     * @return self
     */
    public function setOrderNo($orderNo): self
    {
        $this->arrayModel["orderNo"] = $orderNo;
        $this->orderNo = $orderNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayType()
    {
        return $this->payType;
    }

    /**
     * @param mixed $payType
     * @return self
     */
    public function setPayType($payType): self
    {
        $this->arrayModel["payType"] = $payType;

        $this->payType = $payType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRandomStr()
    {
        return $this->randomStr;
    }

    /**
     * @param mixed $randomStr
     * @return self
     */
    public function setRandomStr($randomStr): self
    {
        $this->arrayModel["randomStr"] = $randomStr;
        $this->randomStr = $randomStr;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTxnOrderFlag()
    {
        return $this->txnOrderFlag;
    }

    /**
     * @param mixed $txnOrderFlag
     * @return self
     */
    public function setTxnOrderFlag($txnOrderFlag): self
    {
        $this->arrayModel["txnOrderFlag"] = $txnOrderFlag;
        $this->txnOrderFlag = $txnOrderFlag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumAmt()
    {
        return $this->sumAmt;
    }

    /**
     * @param mixed $sumAmt
     * @return self
     */
    public function setSumAmt($sumAmt): self
    {
        $this->arrayModel["sumAmt"] = $sumAmt;
        $this->sumAmt = $sumAmt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return self
     */
    public function setAmount($amount): self
    {
        $this->arrayModel["amount"] = $amount;

        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffestAmt()
    {
        return $this->offestAmt;
    }

    /**
     * @param mixed $offestAmt
     * @return self
     */
    public function setOffestAmt($offestAmt): self
    {
        $this->arrayModel["offestAmt"] = $offestAmt;

        $this->offestAmt = $offestAmt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSplitAcctContent()
    {
        return $this->splitAcctContent;
    }

    /**
     * @param mixed $splitAcctContent
     * @return self
     */
    public function setSplitAcctContent($splitAcctContent): self
    {
        $this->arrayModel["splitAcctContent"] = $splitAcctContent;

        $this->splitAcctContent = $splitAcctContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPointContent()
    {
        return $this->pointContent;
    }

    /**
     * @param mixed $pointContent
     * @return self
     */
    public function setPointContent($pointContent): self
    {
        $this->arrayModel["pointContent"] = $pointContent;

        $this->pointContent = $pointContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCouponContent()
    {
        return $this->CouponContent;
    }

    /**
     * @param mixed $CouponContent
     * @return self
     */
    public function setCouponContent($CouponContent): self
    {

        $this->arrayModel["CouponContent"] = $CouponContent;

        $this->CouponContent = $CouponContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param mixed $remark
     * @return self
     */
    public function setRemark($remark): self
    {
        $this->arrayModel["remark"] = $remark;

        $this->remark = $remark;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param mixed $notifyUrl
     * @return self
     */
    public function setNotifyUrl($notifyUrl): self
    {
        $this->arrayModel["notifyUrl"] = $notifyUrl;

        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageNotifyUrl()
    {
        return $this->pageNotifyUrl;
    }

    /**
     * @param mixed $pageNotifyUrl
     * @return self
     */
    public function setPageNotifyUrl($pageNotifyUrl): self
    {
        $this->arrayModel["pageNotifyUrl"] = $pageNotifyUrl;

        $this->pageNotifyUrl = $pageNotifyUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidTime()
    {
        return $this->validTime;
    }

    /**
     * @param mixed $validTime
     * @return self
     */
    public function setValidTime($validTime): self
    {
        $this->arrayModel["validTime"] = $validTime;
        $this->validTime = $validTime;
        return $this;
    }

    public function getBizContent()
    {
        if (!empty($this->arrayModel)) {
            $this->bizContent = json_encode($this->arrayModel, JSON_UNESCAPED_UNICODE);
        }
        return $this->bizContent;
    }

}
