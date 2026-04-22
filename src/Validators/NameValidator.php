<?php

namespace App\Validators;

class NameValidator
{
    /**
     * Valida se o nome está vazio ou contém apenas espaços em branco
     */
    public static function isEmpty(string $name): bool
    {
        return empty(trim($name));
    }

    /**
     * Valida o nome completo
     * Retorna array com erros ou array vazio se válido
     */
    public static function validate(string $name): array
    {
        $errors = [];

        if (self::isEmpty($name)) {
            $errors[] = 'Nome é obrigatório.';
        }

        return $errors;
    }
}
