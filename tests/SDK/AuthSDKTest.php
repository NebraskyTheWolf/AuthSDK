<?php

namespace Tests\SDK\AuthSDK\Tests\SDK;

use PHPUnit\Framework\TestCase;
use Fluffici\SDK\AuthSDK;

class AuthSDKTest extends TestCase
{
    /**
     * This test method is used to test the behavior of the `build` method in 
     * the `AuthSDK` class, ensuring that it creates an `Authorize` object correctly 
     * and as expected.
     */
    public function testBuildReturnsAuthorizeInstance(): void
    {
        $authSDK = new AuthSDK();

        // Some sort of an initialization for $authSDK 
        // method calls with representative string values, depending each method's logic
        $authSDK->setGrantType('grant_type')
                ->setClientId('client_id')
                ->setClientSecret('client_secret')
                ->setRedirectUri('https://example.com/callback')
                ->setScope('scope')
                ->setState('state');

        $authorize = $authSDK->build();

        // Assert that returned object is an instance of \Fluffici\SDK\Auth\Authorize class
        $this->assertInstanceOf(\Fluffici\SDK\Auth\Authorize::class, $authorize);

        // TODO: Add more tests when behavior of build method or returned object is known
    }
}
