<?php

namespace Tests\SDK\Auth;

use PHPUnit\Framework\TestCase;
use Fluffici\SDK\Auth\TemporaryCredentials;

class TemporaryCredentialsTest extends TestCase
{
    private TemporaryCredentials $tempCredentials;
    private string $grant_type;
    private mixed $result;

    protected function setUp(): void 
    {
        parent::setUp();
        
        $this->grant_type = "bearer";
        $this->result = "resultString";
        $this->tempCredentials = new TemporaryCredentials($this->result, $this->grant_type);
    }

    /**
     * Testing the getResult method of TemporaryCredentials class.
     */
    public function testGetResult(): void
    {
        $this->assertEquals(
            $this->result,
            $this->tempCredentials->getResult(),
            "Expected and actual result from method getResult do not match"
        );
    }
}
