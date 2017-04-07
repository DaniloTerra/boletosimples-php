<?php

use BoletoSimples\LastRequest;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;


class LastRequestTest extends PHPUnit_Framework_TestCase
{
    public function testWithLink()
    {
        $request = $this->getMockBuilder('Request')
                        ->setMethods([])
                        ->getMock();

        $response = $this->getMockBuilder('Response')
                         ->setMethods(['getHeaders'])
                         ->getMock();

        $response->expects($this->any())
                 ->method('getHeaders')
                 ->willReturn([
                     'Total'                 => 'total',
                     'X-Ratelimit-Limit'     => 'x-ratelimit-limit',
                     'X-Ratelimit-Remaining' => 'x-ratelimit-remaining',
                     'Link'                  => '<http://foo.com>; rel="foo";'
                 ]);

        $subject = new LastRequest($request, $response);

        $this->assertEquals($request, $subject->request);
        $this->assertEquals($response, $subject->response);
        $this->assertEquals('total', $subject->total);
        $this->assertEquals('x-ratelimit-limit', $subject->ratelimit_limit);
        $this->assertEquals('x-ratelimit-remaining', $subject->ratelimit_remaining);
        $this->assertEquals(
            array('foo' => 'http://foo.com'),
            $subject->links
        );
    }

    public function testWithoutLink()
    {
        $request = $this->getMockBuilder('Request')
                        ->setMethods([])
                        ->getMock();

        $response = $this->getMockBuilder('Response')
                         ->setMethods(['getHeaders'])
                         ->getMock();

        $response->expects($this->any())
                 ->method('getHeaders')
                 ->willReturn([
                     'Total'                 => 'total',
                     'X-Ratelimit-Limit'     => 'x-ratelimit-limit',
                     'X-Ratelimit-Remaining' => 'x-ratelimit-remaining'
                 ]);

        $subject = new LastRequest($request, $response);

        $this->assertEquals($request, $subject->request);
        $this->assertEquals($response, $subject->response);
        $this->assertEquals('total', $subject->total);
        $this->assertEquals('x-ratelimit-limit', $subject->ratelimit_limit);
        $this->assertEquals('x-ratelimit-remaining', $subject->ratelimit_remaining);
        $this->assertEquals(array(), $subject->links);
    }
}