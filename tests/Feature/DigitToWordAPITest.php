<?php

namespace Tests\Feature;

use App\Http\Enums\LanguageEnum;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use RuntimeException;
use Tests\TestCase;

class DigitToWordAPITest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    /**
     * DigitToWord Function RESTful API url
     */
    const URL_API_FUNCTION_DIGIT_TO_WORD = '/api/public-function/digit-to-word/';

    public function test_canCallApi(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
    }

    public function test_throwException_whenCallWrongApi(): void
    {
        // 1. Given

        // 2. When
        $response = $this->get($this::URL_API_FUNCTION_DIGIT_TO_WORD);

        // 3. Then
        $response->assertStatus(404);
    }


    public function test_canChangeDigitToWord_when_0(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Zero']);
    }

    public function test_canChangeDigitToWord_when_13(): void
    {
        // 1. Given
        $digit = 13;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Thirteen']);
    }

    public function test_canChangeDigitToWord_when_85(): void
    {
        // 1. Given
        $digit = 85;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Eighty five']);
    }

    public function test_canChangeDigitToWord_when_237(): void
    {
        // 1. Given
        $digit = 237;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Two hundred and thirty seven']);
    }

    public function test_canChangeDigitToWord_when_5237(): void
    {
        // 1. Given
        $digit = 5237;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Five thousand two hundred and thirty seven']);
    }

    public function test_canChangeDigitToWord_when_5_237(): void
    {
        // 1. Given
        $digit = '5 237';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Five thousand two hundred and thirty seven']);
    }

    public function test_canChangeDigitToWord_when_125237(): void
    {
        // 1. Given
        $digit = 125237;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'One hundred twenty five thousand two hundred and thirty seven']);
    }

    public function test_canChangeDigitToWord_when_2147483647(): void
    {
        // 1. Given
        $digit = 2147483647;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Two billion one hundred forty seven million four hundred eighty three thousand six hundred and forty seven']);
    }

    public function test_canChangeDigitToWord_when_2_147_483_647(): void
    {
        // 1. Given
        $digit = '2 147 483 647';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Two billion one hundred forty seven million four hundred eighty three thousand six hundred and forty seven']);
    }

    public function test_canChangeDigitToWord_whenNegative_0(): void
    {
        // 1. Given
        $digit = '-0';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Zero']);
    }

    public function test_canChangeDigitToWord_whenNegative_10(): void
    {
        // 1. Given
        $digit = '-10';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Negative ten']);
    }

    public function test_canChangeDigitToWord_whenNegative_2147483648(): void
    {
        // 1. Given
        $digit = -2147483648;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Negative two billion one hundred forty seven million four hundred eighty three thousand six hundred and forty eight']);
    }

    public function test_canChangeDigitToWord_whenNegative_2_147_483_648(): void
    {
        // 1. Given
        $digit = '-2 147 483 648';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Negative two billion one hundred forty seven million four hundred eighty three thousand six hundred and forty eight']);
    }

    /**
     * In order to check the language change, I just test the zero word simply
     */
    public function test_canGetKoreanString_whenGivenKorArgument(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit, LanguageEnum::KOREAN->value));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => '영']);
    }

    /**
     * English is the default word set
     * If the language is not exist, Api return the english word
     * I decided the language argument is not the exception attribute
     *
     * @return void
     */
    public function test_canChangeDigitToEnglishWord_whenGivenInvalidLanguageCode(): void
    {
        // 1. Given
        $digit = 0;

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit, 'fr'));

        // 3. Then
        $response->assertStatus(200);
        $response->assertJson(['data' => 'Zero']);
    }

    /**
     * DigitToWord Function only get digit and '-' string.
     * When invalid digit is passed, it will return exception messages.
     */
    public function test_throwInvalidException_whenGivenInvalidString(): void
    {
        // 1. Given
        $digit = '-214748a47';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(400);
        $response->assertJson(['error' => RuntimeException::class]);
        $response->assertJson(['message' => __('messages.invalid_32bit_integer', ['attribute' => $digit])]);
    }

    /**
     * In the PHP 32bit system, Maximum value is 2147483647 and Minimum value is -2147483648
     * please look at https://www.php.net/manual/en/language.types.integer.php
     * If over that number then PHP consider that number is a float(double)
     * So DigitToWord Function only get number between -2147483648 and 2147483647
     * When invalid 32bit integer is passed, it will return exception messages.
     */
    public function test_throwInvalidException_whenOver32bitInteger_2147483648(): void
    {
        // 1. Given
        $digit = '2147483648';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(400);
        $response->assertJson(['error' => RuntimeException::class]);
        $response->assertJson(['message' => __('messages.invalid_32bit_integer', ['attribute' => $digit])]);
    }

    public function test_throwInvalidException_whenOver32bitInteger_negative_2147483649(): void
    {
        // 1. Given
        $digit = '-2147483649';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(400);
        $response->assertJson(['error' => RuntimeException::class]);
        $response->assertJson(['message' => __('messages.invalid_32bit_integer', ['attribute' => $digit])]);
    }

    public function test_throwInvalidException_whenOver32bitInteger_negative_2_147_483_649(): void
    {
        // 1. Given
        $digit = '-2_147_483_649';

        // 2. When
        $response = $this->get($this->getTestUrlWithDigit($digit));

        // 3. Then
        $response->assertStatus(400);
        $response->assertJson(['error' => RuntimeException::class]);
        $response->assertJson(['message' => __('messages.invalid_32bit_integer', ['attribute' => $digit])]);
    }

    /**
     * Get RESTFul API url with digit information
     *
     * @param int|string $digit
     * @param string $language
     * @return string
     */
    private function getTestUrlWithDigit(int|string $digit, string $language = LanguageEnum::ENGLISH->value): string
    {
        return $this::URL_API_FUNCTION_DIGIT_TO_WORD.$language.'/'.$digit;
    }
}
