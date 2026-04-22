<?php

namespace Tests;

use App\Validators\MessageValidator;
use PHPUnit\Framework\TestCase;

class MessageValidatorTest extends TestCase
{
    public function testIsEmptyWithEmptyString(): void
    {
        $this->assertTrue(MessageValidator::isEmpty(''));
    }

    public function testIsEmptyWithOnlyWhitespace(): void
    {
        $this->assertTrue(MessageValidator::isEmpty('     '));
        $this->assertTrue(MessageValidator::isEmpty("\t"));
        $this->assertTrue(MessageValidator::isEmpty("\n"));
    }

    public function testIsEmptyWithValidMessage(): void
    {
        $this->assertFalse(MessageValidator::isEmpty('Olá, tudo bem?'));
    }

    public function testIsEmptyWithMessageContainingWhitespace(): void
    {
        $this->assertFalse(MessageValidator::isEmpty('  Este é um recado  '));
    }

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
        $this->assertStringContainsString('obrigatória', $errors[0]);
    }

    public function testValidateWithValidMessage(): void
    {
        $errors = MessageValidator::validate('Olá, tudo bem?');
        $this->assertEmpty($errors);
    }

    public function testValidateWithMessageContainingWhitespace(): void
    {
        $errors = MessageValidator::validate('  Este é um recado  ');
        $this->assertEmpty($errors);
    }

    public function testValidateWithLongMessage(): void
    {
        $longMessage = 'Este é um recado muito longo que contém várias palavras e serve para testar se a validação funciona corretamente com mensagens extensas.';
        $errors = MessageValidator::validate($longMessage);
        $this->assertEmpty($errors);
    }
}
