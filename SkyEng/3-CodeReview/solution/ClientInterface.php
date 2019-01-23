<?php

namespace Solution;

interface ClientInterface
{

    public function sendRequest($parameterList): string;
}
