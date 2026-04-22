<?php

namespace Tests;

use App\Validators\NameValidator;
use PHPUnit\Framework\TestCase;

class NameValidatorTest extends TestCase
{
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
    }

    public function testValidateWithValidName(): void
    {
        $errors = NameValidator::validate('João');
        $this->assertEmpty($errors);
    }
}


