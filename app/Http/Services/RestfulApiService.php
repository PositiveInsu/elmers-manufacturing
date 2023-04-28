<?php

namespace App\Http\Services;

use Exception;
use RuntimeException;

class RestfulApiService
{
    public function getDataBag(mixed $data): array
    {
        return ['data' => $data];
    }

    public function getErrorBag(Exception|RuntimeException $e): array
    {
        return [
            'error' => $e::class,
            'message' => $e->getMessage()
        ];
    }
}
