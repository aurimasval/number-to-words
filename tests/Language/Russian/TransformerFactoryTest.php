<?php

namespace Kwn\NumberToWords\Language\Russian;

use Kwn\NumberToWords\Model\Currency;
use Kwn\NumberToWords\Model\SubunitFormat;

class TransformerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TransformerFactory
     */
    private $transformerFactory;

    public function setUp()
    {
        $this->transformerFactory = new TransformerFactory();
    }

    public function testGetLanguageIdentifier()
    {
        $this->assertEquals(
            TransformerFactory::LANGUAGE_IDENTIFIER,
            $this->transformerFactory->getLanguageIdentifier()
        );
    }

    public function testCreateNumberTransformerBuildsCorrectClass()
    {
        $numberTransformer = $this->transformerFactory->createNumberTransformer();
        $this->assertInstanceOf(
            'Kwn\NumberToWords\Language\Russian\Transformer\NumberTransformer',
            $numberTransformer
        );
    }

    public function testCreateCurrencyTransformerBuildsCorrectClass()
    {
        $currencyTransformer = $this->transformerFactory->createCurrencyTransformer(
            new Currency('RUB'),
            new SubunitFormat(SubunitFormat::WORDS)
        );
        $this->assertInstanceOf(
            'Kwn\NumberToWords\Language\Russian\Transformer\CurrencyTransformer',
            $currencyTransformer
        );
    }

    /**
     * @expectedException \Kwn\NumberToWords\Exception\InvalidArgumentException
     */
    public function testThrowsExceptionWithUnknownCurrency()
    {
        $this->transformerFactory->createCurrencyTransformer(
            new Currency('UNK'),
            new SubunitFormat(SubunitFormat::WORDS)
        );
    }
}
