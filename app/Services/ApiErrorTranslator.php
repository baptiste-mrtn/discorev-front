<?php

namespace App\Services;

class ApiErrorTranslator
{
    /**
     * Traduit un message d'erreur d'API si une traduction existe
     */
    public function translate(string $message): string
    {
        $translated = __('validation.api.' . $message);
        return $translated !== 'validation.api.' . $message ? $translated : $message;
    }
}
