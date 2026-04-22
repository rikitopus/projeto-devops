<?php

namespace App\Validators;

class NameValidator
{
    /**
     * Valida o nome
     * Retorna array com erros ou array vazio se válido
     */
    public static function validate(string $name): array
    {
        $errors = [];

        if (empty(trim($name))) {
            $errors[] = 'Nome é obrigatório.';
        }

        return $errors;
    }
}
