<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HexadecimalToPropertyTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    /**
     * HexadecimalToPropertyTest Function RESTful API url
     */
    const URL_API_FUNCTION_HEXADECIMAL_TO_PROPERTY = '/api/public-function/hexadecimal-to-property/';


    public function test_canCallApi(): void
    {
        // 1. Given
        $hexadecimal = '0xBBF1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);
    }

    public function test_canChangeToPropertyObj_when_0xBBF1(): void
    {
        // 1. Given
        $hexadecimal = '0xBBF1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);
    }

    public function test_canChangeToPropertyObj_when_0x33A3(): void
    {
        // 1. Given
        $hexadecimal = '0x33A3';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);
    }

    public function test_canChangeToPropertyObj_when_0x99C1(): void
    {
        // 1. Given
        $hexadecimal = '0x99C1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);
    }

    /**
     * This Api only get 2 byte integer.
     * If over the 2 byte integer then throw the exception.
     *
     * @return void
     */
    public function test_throwException_whenOverTwoByteHexadecimal_0x10000(): void
    {
        // 1. Given
        $hexadecimal = '0x10000';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);
    }

    private function getTestUrlWithHexadecimal(string $hexadecimal): string
    {
        return $this::URL_API_FUNCTION_HEXADECIMAL_TO_PROPERTY.$hexadecimal;
    }
}
