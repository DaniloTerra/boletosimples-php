<?php

use BoletoSimples\Util;

class UtilTest extends PHPUnit_Framework_TestCase
{
    public function testPluralize()
    {
        $this->assertEquals(Util::pluralize('bank_billet'), 'bank_billets');
        $this->assertEquals(Util::pluralize('BankBillet'), 'BankBillets');
        $this->assertEquals(Util::pluralize('bankbillet'), 'bankbillets');
    }

    public function testUnderscorize()
    {
        $this->assertEquals(Util::underscorize('BankBillet'), 'bank_billet');
        $this->assertEquals(Util::underscorize('Bank Billet'), 'bank_billet');
        $this->assertEquals(Util::underscorize('Bank-Billet'), 'bank_billet');
        $this->assertEquals(Util::underscorize('Bank.Billet'), 'bank_billet');
    }
}