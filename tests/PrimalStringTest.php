<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Tests;

use Ascetik\Primalvalues\Values\PrimalString;
use PHPUnit\Framework\TestCase;

class PrimalStringTest extends TestCase
{
    public function testPrimalStringContent()
    {
        $string = PrimalString::of('hello');
        $this->assertSame('hello', $string->value());
    }

    public function testStringComparisons()
    {
        $string = PrimalString::of('hello');
        $this->assertTrue($string->equals('hello'));
        $this->assertFalse($string->equals('bye'));
    }

    public function testStringConcatenation()
    {
        $string = PrimalString::of('h');
        $concat = $string
            ->concat('e')
            ->concat('l')
            ->concat('l')
            ->concat('o');
        $this->assertSame('hello', $concat->value());
    }

    public function testSimpleConcatWithAnotherPrimalString()
    {
        $hello = PrimalString::of('hello');
        $world = PrimalString::of(' world');
        $concat = $hello->concat($world);
        $this->assertSame('hello world', $concat->value());
    }

    public function testGetCharacterAtGivenPosition()
    {
        $hello = PrimalString::of('hello');
        $this->assertSame('e', $hello->charAt(1));
        $this->assertNull($hello->charAt(8));
    }

    public function testCheckIfValueContainsString()
    {
        $hello = PrimalString::of('hello');
        $this->assertTrue($hello->contains('llo'));
        $this->assertFalse($hello->contains('hi'));
    }

    public function testCheckIfValueContainsPrimalString()
    {
        $hello = PrimalString::of('hello');
        $expected = PrimalString::of('llo');
        $unexpected = PrimalString::of('hi');
        $this->assertTrue($hello->contains($expected));
        $this->assertFalse($hello->contains($unexpected));
    }

    public function testCheckForEqualityWithString()
    {
        $hello = PrimalString::of('hello');
        $this->assertTrue($hello->equals('hello'));
    }

    public function testCheckForEqualityWithPrimalString()
    {
        $hello = PrimalString::of('hello');
        $this->assertTrue($hello->equals($hello));
    }

    public function testIndexOfAStringChunk()
    {
        $hello = PrimalString::of('hello');
        $this->assertEquals(2, $hello->indexOf('ll'));
        $this->assertEquals(4, $hello->indexOf('o'));
        $this->assertEquals(-1, $hello->indexOf('any'));
    }

    public function testIndexOfAPrimalStringChunk()
    {
        $hello = PrimalString::of('hello');
        $this->assertEquals(0, $hello->indexOf(PrimalString::of('h')));
        $this->assertEquals(3, $hello->indexOf(PrimalString::of('lo')));
        $this->assertEquals(-1, $hello->indexOf(PrimalString::of('any')));
    }

    public function testLastIndexOf()
    {
        $hello = PrimalString::of('hello');
        $this->assertEquals(3, $hello->lastIndexOf(PrimalString::of('l')));
        $this->assertEquals(-1, $hello->lastIndexOf(PrimalString::of('any')));
    }

    public function testReplaceChunkWithAString()
    {
        $example = PrimalString::of('this is just a test');
        $replace = $example->replace('just', 'only');
        $this->assertSame('this is only a test', $replace->value());
    }

    public function testReplaceChunkWithAPrimalString()
    {
        $example = PrimalString::of('this is just a test');
        $replace = $example->replace(PrimalString::of('just a test'), PrimalString::of('a try'));
        $this->assertSame('this is a try', $replace->value());
    }

    public function testReplaceAllMatchingChunksWithOtherStringChunks()
    {
        $example = PrimalString::of('this is just a test for a test');
        $replace = $example->replaceAll('/test/', 'try');
        $this->assertSame('this is just a try for a try', $replace->value());
    }

    public function testTryToReplaceUnMatchingChunksWithOtherStringChunks()
    {
        $example = PrimalString::of('this is just a test for a test');
        $replace = $example->replaceAll('/experience/', 'try');
        $this->assertSame($example, $replace);
    }

    public function testTryToReplaceUnMatchingChunksWithAnOtherPrimalString()
    {
        $example = PrimalString::of('this is just a test for a test');
        $replace = $example->replaceAll('/experience/', PrimalString::of('try'));
        $this->assertSame($example, $replace);
    }

    public function testTryToReplaceMatchingChunksWithAnArray()
    {
        $example = PrimalString::of('this is just a try for a test');
        $replace = $example->replaceAll(['/just/','/a test/'], ['only','an experience']);
        $this->assertSame('this is only a try for an experience', $replace->value());
    }

    public function testTryToReplaceMatchingChunksWithAnArrayOfPrimalStrings()
    {
        $example = PrimalString::of('this is another try once again');
        $replace = $example->replaceAll(['/th/','/again/'], [PrimalString::of('z'),PrimalString::of('for all')]);
        $this->assertSame('zis is anozer try once for all', $replace->value());
    }

    public function testSplittingAPrimalStringWithRegex()
    {
        $example = PrimalString::of('there is another test that is pissing his own history');
        $split = $example->split('/is/');
        $this->assertCount(6, $split);
    }
}
