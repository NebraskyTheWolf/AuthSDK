<?php

namespace Tests\SDK\Auth;

use PHPUnit\Framework\TestCase;
use Fluffici\SDK\AuthSDK;
use Fluffici\SDK\Auth\Authorize;
use Fluffici\SDK\Auth\TemporaryCredentials;

class Authorize2Test extends TestCase
{
    private AuthSDK $client;
    private Authorize $authorize;

    protected function setUp(): void
    {
        $this->client = new AuthSDK();
        $this->authorize = new Authorize($this->client);
    }

    /**
     * Test Authorize::authorize method for valid authorization scenario.
     * User should be authorized and TemporaryCredentials instance should be returned.
     * @throws \Exception
     */
    public function testAuthorizeForValidAuthorization(): void
    {
        $temporaryCredentials = new TemporaryCredentials("Bearer token", "grant_type");

        $this->authorize->authorize("valid_auth_code");

        $this->assertInstanceOf(TemporaryCredentials::class, $temporaryCredentials);
    }

    /**
     * Test Authorize::authorize method for invalid authorization scenario.
     * Exception is expected to be thrown.
     * @throws \Exception
     */
    public function testAuthorizeForInvalidAuthorization(): void
    {
        $this->expectException(\Exception::class);

        $this->authorize->authorize("invalid_auth_code");
    }
}
