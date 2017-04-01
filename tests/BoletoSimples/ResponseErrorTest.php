<?php

use BoletoSimples\ResponseError;
use GuzzleHttp\Message\Response;

class ResponseErrorTest extends PHPUnit_Framework_TestCase
{
    private function getMockResponse()
    {
        $mock = $this->getMockBuilder('Response')
                     ->setMethods(['json'])
                     ->getMock();

        return $mock;
    }

    public function testWithoutError()
    {
        $response = $this->getMockResponse();

        $jsonMock = ['success' => 'success message goes here'];

        $response->expects($this->once())
                 ->method('json')
                 ->willReturn($jsonMock);

        $this->subject = new ResponseError($response);

        $this->assertEquals($response, $this->subject->response);
    }

    public function testWithError()
    {
        $this->setExpectedException('Exception', 'error message goes here');

        $response = $this->getMockResponse();

        $jsonMock = ['error' => 'error message goes here'];

        $response->expects($this->once())
                 ->method('json')
                 ->willReturn($jsonMock);

        $this->subject = new ResponseError($response);
    }
}