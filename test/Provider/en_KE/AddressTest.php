<?php

declare(strict_types=1);

namespace Faker\Provider\en_KE;

use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class AddressTest extends TestCase
{
    public function testPostcodeIsNotEmptyAndIsValid(): void
    {
        $postcode = Address::postcode();

        self::assertTrue(!empty($postcode));
        self::assertIsString($postcode);
        self::assertMatchesRegularExpression('/^\d{5}$/', $postcode);

        $codeNum = (int) $postcode;
        $valid = (
            ($codeNum >= 100 && $codeNum <= 999) ||
            ($codeNum >= 10000 && $codeNum <= 19999) ||
            ($codeNum >= 20000 && $codeNum <= 29999) ||
            ($codeNum >= 30000 && $codeNum <= 39999) ||
            ($codeNum >= 40000 && $codeNum <= 49999)
        );

        self::assertTrue($valid, "Postcode {$postcode} is not in a valid range");
    }

    public function testCountyIsAValidString(): void
    {
        $county = $this->faker->county;

        self::assertTrue(!empty($county));
        self::assertIsString($county);
    }

    public function testRegionIsAValidString(): void
    {
        $region = $this->faker->region;

        self::assertTrue(!empty($region));
        self::assertIsString($region);
    }

    public function testCityIsAValidString(): void
    {
        $city = $this->faker->city;

        self::assertTrue(!empty($city));
        self::assertIsString($city);
    }

    public function testTownIsAliasForCity(): void
    {
        $town = $this->faker->town;
        $city = $this->faker->city;

        self::assertTrue(!empty($town));
        self::assertIsString($town);
    }

    public function testStreetNameIsAValidString(): void
    {
        $street = $this->faker->streetName;

        self::assertTrue(!empty($street));
        self::assertIsString($street);
    }

    public function testStreetAddressIsFormattedCorrectly(): void
    {
        $streetAddress = $this->faker->streetAddress;

        self::assertTrue(!empty($streetAddress));
        self::assertIsString($streetAddress);
        self::assertMatchesRegularExpression('/^\d+ .+$/', $streetAddress);
    }

    protected function getProviders(): iterable
    {
        yield new Address($this->faker);
    }
}
