<?php

use BoletoSimples\Configuration;

class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    private function getCustomConfiguration()
    {
        return new Configuration([
            'environment' => 'production',
            'application_id' => 'application_id-teste',
            'application_secret' => 'application_secre-test',
            'access_token' => 'access_token-test'
        ]);        
    }

    public function testDefaultProperties()
    {
        $subject = new Configuration();

        $this->assertEquals('sandbox', $subject->environment);
        $this->assertNull($subject->application_id);
        $this->assertNull($subject->application_secret);
        $this->assertNull($subject->access_token);
    }

    public function testCustomProperties()
    {
        $subject = $this->getCustomConfiguration();

        $this->assertEquals(
            'production',
            $subject->environment
        );

        $this->assertEquals(
            'application_id-teste',
            $subject->application_id
        );

        $this->assertEquals(
            'application_secre-test',
            $subject->application_secret
        );

        $this->assertEquals(
            'access_token-test',
            $subject->access_token
        );
    }

    public function testUserAgent()
    {
        $subject = new Configuration();

        $this->assertEquals(
            "BoletoSimples PHP Client v".\BoletoSimples::VERSION." (contato@boletosimples.com.br)",
            $subject->userAgent()
        );
    }

    public function testHasAccessTokenWhenConfigurationIsCreatedDefault()
    {
        $subject = new Configuration();

        $this->assertFalse($subject->hasAccessToken());
    }

    public function testHasAccessTokenWhenConfigurationIsCreatedCustom()
    {
        $subject = $this->getCustomConfiguration();

        $this->assertTrue($subject->hasAccessToken());
    }

    public function testBaseUriWhenConfigurationIsCreatedDefault()
    {
        $subject = new Configuration();

        $this->assertEquals(
            'https://sandbox.boletosimples.com.br/api/v1/',
            $subject->baseUri()
        );
    }

    public function testBaseUriWhenConfigurationIsCreatedCustom()
    {
        $subject = $this->getCustomConfiguration();

        $this->assertEquals(
            'https://boletosimples.com.br/api/v1/',
            $subject->baseUri()
        );
    }
}