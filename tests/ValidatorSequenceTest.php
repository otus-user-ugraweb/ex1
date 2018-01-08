<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ValidatorSequenceTest extends TestCase
{

    public function testCanBeCreatedFromValidSequence()
    {
        $sequence = "(()()(
        ()
        (()(
        (
        ))";
        $this->assertInstanceOf(
            ValidatorSequence::class,
            $object = new ValidatorSequence($sequence)
        );
    }

    public function testSuccessSequence()
    {
        $sequence = "(())(()())";
        $this->assertEquals(
            true,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testFailureSequence()
    {
        $sequence = "(())(((()()()))";
        $this->assertEquals(
            false,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testSuccessSequence1()
    {
        $sequence = "((()()
        ()(
        ))
        ) ";
        $this->assertEquals(
            true,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testFailureSequence1()
    {
        $sequence = "((()()
        ()(
        )))
        )";
        $this->assertEquals(
            false,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testSuccessSequence2()
    {
        $sequence = "((()(
        )()(
        )))(
        ()(
        ))";
        $this->assertEquals(
            true,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testFailureSequence2()
    {
        $sequence = "((()(
        )()(
        )))(
        ()((
        ))";
        $this->assertEquals(
            false,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testSuccessSequence3()
    {
        $sequence = "(()
        (())
        )((
        (()))())";
        $this->assertEquals(
            true,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testFailureSequence3()
    {
        $sequence = "((()
        (())
        )((
        (()))())";
        $this->assertEquals(
            false,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testSuccessSequence4()
    {
        $sequence = "(())(()())()()()()()()()()()()";
        $this->assertEquals(
            true,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testFailureSequence4()
    {
        $sequence = "(())(()())()()()()()()()()()())";
        $this->assertEquals(
            false,
            $bool = (new ValidatorSequence($sequence))->checkSequence()
        );
    }

    public function testCannotBeCreatedFromValidSequence()
    {
        $sequence = "(()()(a))";
        $this->expectException(InvalidArgumentException::class);
        new ValidatorSequence($sequence);
    }

    public function testCannotBeCreatedFromValidSequence1()
    {
        $sequence = "(()()
        (a)1)";
        $this->expectException(InvalidArgumentException::class);
        new ValidatorSequence($sequence);
    }

    public function testCannotBeCreatedFromValidSequence2()
    {
        $sequence = "(()(
        )(
        a))";
        $this->expectException(InvalidArgumentException::class);
        new ValidatorSequence($sequence);
    }

    public function testCannotBeCreatedFromValidSequence3()
    {
        $sequence = "(()(
        ()()a
        )2())";
        $this->expectException(InvalidArgumentException::class);
        new ValidatorSequence($sequence);
    }

    public function testCannotBeCreatedFromValidSequence4()
    {
        $sequence = "(()(12)())";
        $this->expectException(InvalidArgumentException::class);
        new ValidatorSequence($sequence);
    }

}