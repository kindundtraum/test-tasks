<?php

namespace Solution;

class ExternalServiceAdapter implements ClientInterface
{

    protected $host;

    protected $login;

    protected $password;

    public function __construct(string $host, string $login, string $password)
    {
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @param $parameterList
     * @return string
     */
    public function sendRequest($parameterList): string
    {
        return "{$this->host}:{$this->login} " . json_encode($parameterList);
    }
}
