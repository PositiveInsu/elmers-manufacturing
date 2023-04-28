<?php

namespace Tests\Feature;

use App\Http\Common\Converter\HexadecimalToProperty\HexadecimalConverterPropertyDTO;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use RuntimeException;
use Tests\TestCase;

class HexadecimalToPropertyAPITest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    /**
     * HexadecimalToPropertyAPITest Function RESTful API url
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

    public function test_canChangeToPropertyObj_when_uppercase_0xbbf1(): void
    {
        // 1. Given
        $hexadecimal = '0xBBF1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(191)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(true);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_lowercase_0xbbf1(): void
    {
        // 1. Given
        $hexadecimal = '0xbbf1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(191)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(true);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_uppercase_0x33a3(): void
    {
        // 1. Given
        $hexadecimal = '0x33A3';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(true)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(58)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(true);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_uppercase_0x99c1(): void
    {
        // 1. Given
        $hexadecimal = '0x99C1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(156)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(true);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_uppercase_99c1(): void
    {
        // 1. Given
        $hexadecimal = '99C1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(156)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(true);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_0xUppercase_0xbbf1(): void
    {
        // 1. Given
        $hexadecimal = '0XBBF1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(191)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(true);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_0x3(): void
    {
        // 1. Given
        $hexadecimal = '0x3';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(true)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(0)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(false);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_0(): void
    {
        // 1. Given
        $hexadecimal = '0';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(false)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(0)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(false);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
    }

    public function test_canChangeToPropertyObj_when_1(): void
    {
        // 1. Given
        $hexadecimal = '1';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(200);

        $propertyDTO = new HexadecimalConverterPropertyDTO();
        $propertyDTO->setMachineOn(true)
            ->setGrindingBeans(false)
            ->setEmptyGroundsFault(false)
            ->setWaterEmptyFault(false)
            ->setNumberOfCupsToday(0)
            ->setDescaleRequired(false)
            ->setHaveAnotherOneCarl(false);

        $response->assertJson(['data' => json_encode($propertyDTO)]);
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
        $response->assertStatus(400);
        $response->assertJson(['error' => RuntimeException::class]);
        $response->assertJson(['message' => __('messages.invalid_hexadecimal', ['attribute' => $hexadecimal])]);
    }

    public function test_throwException_whenOverTwoByteHexadecimal_10000(): void
    {
        // 1. Given
        $hexadecimal = '10000';

        // 2. When
        $response = $this->get($this->getTestUrlWithHexadecimal($hexadecimal));

        // 3. Then
        $response->assertStatus(400);
        $response->assertJson(['error' => RuntimeException::class]);
        $response->assertJson(['message' => __('messages.invalid_hexadecimal', ['attribute' => $hexadecimal])]);
    }

    private function getTestUrlWithHexadecimal(string $hexadecimal): string
    {
        return $this::URL_API_FUNCTION_HEXADECIMAL_TO_PROPERTY.$hexadecimal;
    }
}
