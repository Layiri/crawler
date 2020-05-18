<?php

namespace tests;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use src\crawler\SiteAddress;

final class SiteAddressTest extends TestCase
{

    public function testCanBeCreatedFromValidSiteAddress(): void
    {
        $this->assertInstanceOf(
            SiteAddress::class,
            SiteAddress::fromString('facebook.com')
        );
    }

    public function testCannotBeCreatedFromInvalidSiteAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

        SiteAddress::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'www.facebook.cd',
            SiteAddress::fromString('www.facebook.com')
        );
    }

}