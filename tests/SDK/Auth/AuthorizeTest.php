<?php

namespace Tests\SDK\Auth;

use Fluffici\SDK\AuthSDK;
use Fluffici\SDK\Auth\Authorize;
use PHPUnit\Framework\TestCase;

class AuthorizeTest extends TestCase
{
    private $authSDK;
    private $authorize;

    protected function setUp(): void
    {
        // Mock the AuthSDK class 
        $this->authSDK = $this->getMockBuilder(AuthSDK::class)
            ->disableOriginalConstructor()
            ->setMethods(['getClientId', 'getRedirectUri', 'getState', 'getScope'])
            ->getMock();

        $this->authorize = new Authorize($this->authSDK);
    }

    public function testGetAuthURL()
    {
        $clientId = 'testClientId';
        $redirectUri = 'https://example.com';
        $state = 'testState';
        $scope = 'testScope';

        $this->authSDK->expects($this->once())
            ->method('getClientId')
            ->will($this->returnValue($clientId));

        $this->authSDK->expects($this->once())
            ->method('getRedirectUri')
            ->will($this->returnValue($redirectUri));

        $this->authSDK->expects($this->once())
            ->method('getState')
            ->will($this->returnValue($state));

        $this->authSDK->expects($this->once())
            ->method('getScope')
            ->will($this->returnValue($scope));

        $expectedURL = "https://auth.fluffici.eu?clientId={$clientId}&redirectUri={$redirectUri}&state={$state}&scope={$scope}";

        $this->assertEquals($expectedURL, $this->authorize->getAuthURL());
    }
}
