<?php

namespace Tests\SDK\Auth;

use Fluffici\SDK\Auth\TemporaryCredentials;
use PHPUnit\Framework\TestCase;

class TemporaryCredentials2Test extends TestCase
{
    private TemporaryCredentials $temporaryCredentials;

    public function setUp(): void
    {
        $this->temporaryCredentials = new TemporaryCredentials('result', 'grant_type');
    }

    /**
     * @test
     */
    public function it_returns_correct_grant_type(): void
    {
        $this->assertSame('grant_type', $this->temporaryCredentials->getGrantType());
    }
}
