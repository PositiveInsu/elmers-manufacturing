<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DigitToStringAPITest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    /**
     * DigitToString Function RESTful API url
     */
    const URL_API_FUNCTION_DIGIT_TO_STRING = '/api/public-function/digit-to-string/en/';

    public function test_canCallAPI(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
    }

    public function test_canChangeDigitToString_whenOneDigit(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'zero']);
    }

    public function test_canChangeDigitToString_whenTwoDigit(): void
    {
        // 1. Given
        $digit = 13;

        // 2. When
        $result = '';

        // 3. Then
        $this->assertEquals('Thirteen', $result);
    }

    public function test_canChangeDigitToString_whenMultipleDigit(): void
    {
        // 1. Given
        $digitList = [];

        // 2. When
        $result = [];

        // 3. Then
        $this->assertEquals('multiple digit', []);
    }

    public function test_canChangeDigitToString_whenNegativeDigit(): void
    {
        // 1. Given
        $digit = '-10';

        // 2. When
        $result = '';

        // 3. Then
        $this->assertEquals('Negative ten', $result);
    }

    /**
     * [IJ] DigitToString Function only get digit and '-' string.
     * When invalid digit is passed, it will return exception messages.
     */
    public function test_throwInvalidException_whenGivenInvalidString(): void
    {
        // 1. Given

        // 2. When

        // 3. Then
    }

    public function test_canGetKoreanString_whenGivenKORArgument(): void
    {
        // 1. Given

        // 2. When

        // 3. Then
    }

    public function test_throwInvalidException_whenGivenInvalidLanguageCode(): void
    {
        // 1. Given

        // 2. When

        // 3. Then
    }

    /**
     * Get RESTFul API url with digit information
     *
     * @param int $digit
     * @return string
     */
    private function getTestUrlWithDigit(int $digit): string
    {
        return $this::URL_API_FUNCTION_DIGIT_TO_STRING.$digit;
    }
}
