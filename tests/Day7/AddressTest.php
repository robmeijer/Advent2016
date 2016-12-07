<?php

namespace Tests\Advent2016\Day7;

use Advent2016\Day7\Address;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class AddressTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanVerifyTLSAddress()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $address = new Address($filesystem);
        $address->verifyTLS('test1.txt');

        $this->assertEquals(2, count($address->getAddresses()));
    }

    public function testItCanVerifySSLAddress()
    {
        $adapter = new Local(__DIR__);
        $filesystem = new Filesystem($adapter);

        $address = new Address($filesystem);
        $address->verifySSL('test2.txt');

        $this->assertEquals(5, count($address->getAddresses()));
    }
}
