<?php

namespace App\Validators;

class DateValidator
{
    /**
     * Valida se a data não está vazia
     */
    public static function isEmpty(string $data): bool
    {
        return empty($data);
    }

    /**
     * Valida se a data não é no futuro
     */
    public static function isFuture(string $data): bool
    {
        $today = date('Y-m-d');
        return $data > $today;
    }

    /**
     * Valida a data completa
     * Retorna array com erros ou array vazio se válida
     */
    public static function validate(string $data): array
    {
        $errors = [];

        if (self::isEmpty($data)) {
            $errors[] = 'Data é obrigatória.';
        } elseif (self::isFuture($data)) {
            $errors[] = 'A data não pode ser no futuro.';
        }

        return $errors;
    }
}
