<?php

namespace App\Http\Controllers\Api;

use App\Http\Common\Converter\DigitToWord\DigitToWordConverter;
use App\Http\Common\Converter\HexadecimalToProperty\HexadecimalToPropertyConverter;
use App\Http\Services\RestfulApiService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use RuntimeException;

readonly class PublicFunctionController
{
    public function __construct(
        private ResponseFactory $response,
        private RestfulApiService $restfulApiService,
    ) {}

    public function digitToWord(string $language, string|int $digit): JsonResponse
    {
        /**
         * Exception handing logic can move to the Middleware for unified way.
         * But I just implement the exception logic simply in the controller for coding test now.
         */
        try {
            $result = DigitToWordConverter::getInstance($language)->convert($digit);
            $dataBag = $this->restfulApiService->getDataBag($result);
            $httpStatus = 200;
        } catch (RuntimeException $e) {
            $dataBag = $this->restfulApiService->getErrorBag($e);
            $httpStatus = 400;
        }
        return $this->response->json($dataBag, $httpStatus);
    }

    public function hexadecimalToProperty(string $hexadecimal): JsonResponse
    {
        try {
            $result = HexadecimalToPropertyConverter::getInstance()->convert($hexadecimal);
            $dataBag = $this->restfulApiService->getDataBag(json_encode($result));
            $httpStatus = 200;
        } catch (RuntimeException $e) {
            $dataBag = $this->restfulApiService->getErrorBag($e);
            $httpStatus = 400;
        }

        return $this->response->json($dataBag, $httpStatus);
    }
}
