<?php

namespace Fluffici\SDK\Auth;

class TemporaryCredentials
{
    private string $grant_type;
    private mixed $result;

    public function __construct(string $result, string $grant_type)
    {
        $this->grant_type = $grant_type;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grant_type;
    }

    /**
     * @return string
     */
    public function getResult(): mixed
    {
        return $this->result;
    }
}
