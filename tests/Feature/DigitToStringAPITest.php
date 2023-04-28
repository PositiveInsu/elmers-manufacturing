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

    public function test_canChangeDigitToString_when0(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Zero']);
    }

    public function test_canChangeDigitToString_when13(): void
    {
        // 1. Given
        $digit = 13;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Thirteen']);
    }

    public function test_canChangeDigitToString_when85(): void
    {
        // 1. Given
        $digit = 85;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Eighty five']);
    }

    public function test_canChangeDigitToString_when237(): void
    {
        // 1. Given
        $digit = 237;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Two hundred and thirty seven']);
    }

    public function test_canChangeDigitToString_when5237(): void
    {
        // 1. Given
        $digit = 5237;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Five thousand two hundred and thirty seven']);
    }

    public function test_canChangeDigitToString_when125237(): void
    {
        // 1. Given
        $digit = 125237;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'One hundred twenty five thousand two hundred and thirty seven']);
    }

    public function test_canChangeDigitToString_when2147483647(): void
    {
        // 1. Given
        $digit = 2147483647;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Two billion one hundred forty seven million four hundred eighty three thousand six hundred and forty seven']);
    }

    public function test_canChangeDigitToString_whenNegativeDigit(): void
    {
        // 1. Given
        $digit = '-10';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Negative ten']);
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
