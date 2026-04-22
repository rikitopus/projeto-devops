<?php

namespace Tests;

use App\Validators\DateValidator;
use PHPUnit\Framework\TestCase;

class DateValidatorTest extends TestCase
{
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

    public function testValidateWithTodayDate(): void
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
