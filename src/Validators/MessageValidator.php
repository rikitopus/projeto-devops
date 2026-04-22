<?php

namespace App\Validators;

class MessageValidator
{
    private const MAX_LENGTH = 200;

    /**
     * Valida se a mensagem está vazia ou contém apenas espaços em branco
     */
    public static function isEmpty(string $message): bool
    {
        return empty(trim($message));
    }

    /**
     * Valida se a mensagem excede o limite de caracteres
     */
    public static function isExceedingLimit(string $message): bool
    {
        return strlen(trim($message)) > self::MAX_LENGTH;
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
        } elseif (self::isExceedingLimit($message)) {
            $errors[] = 'Mensagem não pode ter mais de ' . self::MAX_LENGTH . ' caracteres.';
        }

        return $errors;
    }
}

