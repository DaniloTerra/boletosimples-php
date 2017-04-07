<?php

use BoletoSimple\LastRequest;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;


class LastRequestTest extends PHPUnit_Framework_TestCase
{
    public function testSuccess()
    {
        $request = $this->getMockBuilder('Request')
                        ->setMethods([])
                        ->getMock();

        $response = $this->getMockBuilder('Response')
                         ->setMethods([])
                         ->getMock();

        $this->assertTrue(true);
    }
}