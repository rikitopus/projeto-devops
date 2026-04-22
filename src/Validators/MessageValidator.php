<?php

namespace App\Validators;

class MessageValidator
{
    /**
     * Valida se a mensagem está vazia ou contém apenas espaços em branco
     */
    public static function isEmpty(string $message): bool
    {
        return empty(trim($message));
    }

    /**
     * Valida a mensagem completa
     * Retorna array com erros ou array vazio se válido
     */
    public static function validate(string $message): array
    {
        $errors = [];

        if (self::isEmpty($message)) {
            $errors[] = 'Mensagem é obrigatória.';
        }

        return $errors;
    }
}
