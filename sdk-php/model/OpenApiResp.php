<?php

class OpenApiResp
{

    private $resCode;

    private $resMsg;

    private $bizCode;

    private $bizMsg;

    private $signType;

    private $signData;

    private $resContent;

    private $arrayModel = array();

    /**
     * @return mixed
     */
    public function getResCode()
    {
        return $this->resCode;
    }

    /**
     * @param mixed $resCode
     * @return self
     */
    public function setResCode($resCode): self
    {
        $this->resCode = $resCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResMsg()
    {
        return $this->resMsg;
    }

    /**
     * @param mixed $resMsg
     * @return self
     */
    public function setResMsg($resMsg): self
    {
        $this->resMsg = $resMsg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBizCode()
    {
        return $this->bizCode;
    }

    /**
     * @param mixed $bizCode
     * @return self
     */
    public function setBizCode($bizCode): self
    {
        $this->bizCode = $bizCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBizMsg()
    {
        return $this->bizMsg;
    }

    /**
     * @param mixed $bizMsg
     * @return self
     */
    public function setBizMsg($bizMsg): self
    {
        $this->bizMsg = $bizMsg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSignType()
    {
        return $this->signType;
    }

    /**
     * @param mixed $signType
     * @return self
     */
    public function setSignType($signType): self
    {
        $this->signType = $signType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSignData()
    {
        return $this->signData;
    }

    /**
     * @param mixed $signData
     * @return self
     */
    public function setSignData($signData): self
    {
        $this->signData = $signData;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResContent()
    {
        return $this->resContent;
    }

    /**
     * @param mixed $resContent
     * @return self
     */
    public function setResContent($resContent): self
    {
        $this->resContent = $resContent;
        return $this;
    }

    /***
     *
     */
    public function getArrayModel()
    {
        return $this->arrayModel;
    }

    /***
     *使用数组初始化对象
     */
    public function initResp($array)
    {
        $this->setBizCode($array["bizCode"]);
        $this->setBizMsg($array["bizMsg"]);
        $this->setResCode($array["resCode"]);
        $this->setResMsg($array["resMsg"]);
        $this->setSignType($array["signType"]);
        $this->setSignData($array["signData"]);
        $this->setResContent($array["resContent"]);
        $this->arrayModel = $array;
        return $this;
    }

    public function isSuccess()
    {
        if ($this->getResCode() == "SSSSSS") {
            return true;
        } else {
            return false;
        }

    }

}
