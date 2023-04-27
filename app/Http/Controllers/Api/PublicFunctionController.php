<?php

namespace App\Http\Controllers\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicFunctionController
{

    public function __construct(
        private ResponseFactory $response
    ) {}

    public function digitToString(Request $request, string|int $digit): JsonResponse
    {
        return $this->response->json([], 200);
    }
}
