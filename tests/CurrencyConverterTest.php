<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../models/CurrencyConverter.php';
require_once __DIR__ . '/../models/CurrencyWebservice.php';

class CurrencyConverterTest extends TestCase
{
    public function testConvertGBPtoEUR()
    {
        $ws = new CurrencyWebservice();
        $conv = new CurrencyConverter($ws);
        $this->assertEquals(11.5, $conv->convert('£10.00'));
    }

    public function testConvertUSDtoEUR()
    {
        $ws = new CurrencyWebservice();
        $conv = new CurrencyConverter($ws);
        $this->assertEquals(9.2, $conv->convert('$10.00'));
    }

    public function testConvertEURtoEUR()
    {
        $ws = new CurrencyWebservice();
        $conv = new CurrencyConverter($ws);
        $this->assertEquals(10.0, $conv->convert('€10.00'));
    }

    public function testInvalidValueReturnsZero()
    {
        $ws = new CurrencyWebservice();
        $conv = new CurrencyConverter($ws);
        $this->assertEquals(0.0, $conv->convert('abc'));
    }
}
