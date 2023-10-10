<?php
class OpenApiConfig
{
    private $requestUri;

    private $allinpayPublicKey;

    private $privateKey;

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param mixed $requestUri
     * @return self
     */
    public function setRequestUri($requestUri): self
    {
        $this->requestUri = $requestUri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllinpayPublicKey()
    {
        return $this->allinpayPublicKey;
    }

    /**
     * @param mixed $allinpayPublicKey
     * @return self
     */
    public function setAllinpayPublicKey($allinpayPublicKey): self
    {
        $this->allinpayPublicKey = $allinpayPublicKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @param mixed $privateKey
     * @return self
     */
    public function setPrivateKey($privateKey): self
    {
        $this->privateKey = $privateKey;
        return $this;
    }
}
