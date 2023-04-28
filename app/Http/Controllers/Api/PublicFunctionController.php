<?php

namespace App\Http\Controllers\Api;

use App\Http\Common\Converter\DigitToString\DigitToStringConverter;
use App\Http\Services\RestfulApiService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

readonly class PublicFunctionController
{
    public function __construct(
        private ResponseFactory $response,
        private RestfulApiService $restfulApiService,
    ) {}

    public function digitToString(string $language, string|int $digit): JsonResponse
    {
        $result = DigitToStringConverter::getInstance($language)->convert($digit);
        $dataBag = $this->restfulApiService->getDataBag($result);
        return $this->response->json($dataBag);
    }
}
