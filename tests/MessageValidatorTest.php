<?php

namespace Tests;

use App\Validators\MessageValidator;
use PHPUnit\Framework\TestCase;

class MessageValidatorTest extends TestCase
{
    public function testValidateWithEmptyMessage(): void
    {
        $errors = MessageValidator::validate('');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('obrigatória', $errors[0]);
    }

    public function testValidateWithOnlyWhitespace(): void
    {
        $errors = MessageValidator::validate('     ');
        $this->assertCount(1, $errors);
    }

    public function testValidateWithValidMessage(): void
    {
        $errors = MessageValidator::validate('Olá, tudo bem?');
        $this->assertEmpty($errors);
    }

    public function testValidateWithMessageExceedingLimit(): void
    {
        $message = str_repeat('a', 201);
        $errors = MessageValidator::validate($message);
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('200 caracteres', $errors[0]);
    }

    public function testValidateWithMessageAtLimit(): void
    {
        $message = str_repeat('a', 200);
        $errors = MessageValidator::validate($message);
        $this->assertEmpty($errors);
    }
}


