<?php

namespace App\Http\Services;

class RestfulApiService
{
    public function getDataBag(mixed $data): array
    {
        return ['data' => $data];
    }
}
