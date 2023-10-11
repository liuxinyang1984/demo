<?php

/**
 * 公共的请求方法
 * Summary of OpenApiReq
 */
class OpenApiReq
{

    private $version;

    private $accessId;

    private $method;

    private $format;

    private $charSet;

    private $signType;

    private $signData;

    private $timestamp;

    private $authToken = "";

    private $bizContent;

    private $arrayModel = array();

    /***
     * +---------------------------
     *  构造函数 -  因为加密的时候,参数无值也参与加密
     * +---------------------------
     */
    public function __construct()
    {
        $this->arrayModel["version"] = "";
        $this->arrayModel["accessId"] = "";
        $this->arrayModel["method"] = "";
        $this->arrayModel["format"] = "";
        $this->arrayModel["charSet"] = "";
        $this->arrayModel["signType"] = "";
        $this->arrayModel["signData"] = "";
        $this->arrayModel["timestamp"] = "";
        $this->arrayModel["authToken"] = "";
        $this->arrayModel["bizContent"] = "";
        /* $this->arrayModel["bizCode"] = "P004500"; */
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return self
     */
    public function setVersion($version): self
    {
        $this->arrayModel["version"] = $version;
        $this->version = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccessId()
    {
        return $this->accessId;
    }

    /**
     * @param mixed $accessId
     * @return self
     */
    public function setAccessId($accessId): self
    {
        $this->arrayModel["accessId"] = $accessId;
        $this->accessId = $accessId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return self
     */
    public function setMethod($method): self
    {
        $this->arrayModel["method"] = $method;
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     * @return self
     */
    public function setFormat($format): self
    {
        $this->arrayModel["format"] = $format;
        $this->format = $format;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharSet()
    {
        return $this->charSet;
    }

    /**
     * @param mixed $charset
     * @return self
     */
    public function setCharSet($charSet): self
    {
        $this->arrayModel["charSet"] = $charSet;
        $this->charSet = $charSet;
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
        $this->arrayModel["signType"] = $signType;
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
        $this->arrayModel["signData"] = $signData;
        $this->signData = $signData;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     * @return self
     */
    public function setTimestamp($timestamp): self
    {
        $this->arrayModel["timestamp"] = $timestamp;
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param mixed $authToken
     * @return self
     */
    public function setAuthToken($authToken): self
    {
        $this->arrayModel["authToken"] = $authToken;
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBizContent()
    {
        return $this->bizContent;
    }

    /**
     * @param mixed $bizContent
     * @return self
     */
    public function setBizContent($bizContent): self
    {
        $this->arrayModel["bizContent"] = $bizContent;
        $this->bizContent = $bizContent;
        return $this;
    }

    /***
     *
     */
    public function getArrayModel()
    {
        return $this->arrayModel;
    }

}
