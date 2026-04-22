<?php

namespace Tests;

use App\Validators\NameValidator;
use PHPUnit\Framework\TestCase;

class NameValidatorTest extends TestCase
{
    public function testIsEmptyWithEmptyString(): void
    {
        $this->assertTrue(NameValidator::isEmpty(''));
    }

    public function testIsEmptyWithOnlyWhitespace(): void
    {
        $this->assertTrue(NameValidator::isEmpty('     '));
        $this->assertTrue(NameValidator::isEmpty("\t"));
        $this->assertTrue(NameValidator::isEmpty("\n"));
    }

    public function testIsEmptyWithValidName(): void
    {
        $this->assertFalse(NameValidator::isEmpty('João'));
    }

    public function testIsEmptyWithNameContainingWhitespace(): void
    {
        $this->assertFalse(NameValidator::isEmpty('  João Silva  '));
    }

    public function testValidateWithEmptyName(): void
    {
        $errors = NameValidator::validate('');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('obrigatório', $errors[0]);
    }

    public function testValidateWithOnlyWhitespace(): void
    {
        $errors = NameValidator::validate('     ');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('obrigatório', $errors[0]);
    }

    public function testValidateWithValidName(): void
    {
        $errors = NameValidator::validate('João');
        $this->assertEmpty($errors);
    }

    public function testValidateWithNameContainingWhitespace(): void
    {
        $errors = NameValidator::validate('  Maria Silva  ');
        $this->assertEmpty($errors);
    }
}
