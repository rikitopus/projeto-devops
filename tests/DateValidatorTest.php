<?php

namespace Tests;

use App\Validators\DateValidator;
use PHPUnit\Framework\TestCase;

class DateValidatorTest extends TestCase
{
    public function testIsEmptyWithEmptyString(): void
    {
        $this->assertTrue(DateValidator::isEmpty(''));
    }

    public function testIsEmptyWithValidDate(): void
    {
        $this->assertFalse(DateValidator::isEmpty('2026-04-21'));
    }

    public function testIsFutureWithFutureDate(): void
    {
        $futureDate = date('Y-m-d', strtotime('+1 day'));
        $this->assertTrue(DateValidator::isFuture($futureDate));
    }

    public function testIsFutureWithTodayDate(): void
    {
        $today = date('Y-m-d');
        $this->assertFalse(DateValidator::isFuture($today));
    }

    public function testIsFutureWithPastDate(): void
    {
        $pastDate = date('Y-m-d', strtotime('-1 day'));
        $this->assertFalse(DateValidator::isFuture($pastDate));
    }

    public function testValidateWithEmptyDate(): void
    {
        $errors = DateValidator::validate('');
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('obrigatória', $errors[0]);
    }

    public function testValidateWithFutureDate(): void
    {
        $futureDate = date('Y-m-d', strtotime('+1 day'));
        $errors = DateValidator::validate($futureDate);
        $this->assertCount(1, $errors);
        $this->assertStringContainsString('futuro', $errors[0]);
    }

    public function testValidateWithValidDate(): void
    {
        $today = date('Y-m-d');
        $errors = DateValidator::validate($today);
        $this->assertEmpty($errors);
    }

    public function testValidateWithPastDate(): void
    {
        $pastDate = date('Y-m-d', strtotime('-1 day'));
        $errors = DateValidator::validate($pastDate);
        $this->assertEmpty($errors);
    }
}
