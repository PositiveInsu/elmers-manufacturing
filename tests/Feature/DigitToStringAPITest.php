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
    const URL_API_FUNCTION_DIGIT_TO_STRING = '/api/elmers-manufacturing/digit-to-string';

    public function test_canChangeDigitToString(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When


        // 3. Then
        $this->assertTrue(true);
    }
}
