<?php

declare(strict_types=1);

namespace KenyaFaker\Provider\en_KE;

use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class AddressTest extends TestCase
{
    public function test_postcode_is_not_empty_and_is_valid(): void
    {
        $postcode = Address::postcode();

        self::assertTrue(! empty($postcode));
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

    public function test_county_is_a_valid_string(): void
    {
        $county = $this->faker->county;

        self::assertTrue(! empty($county));
        self::assertIsString($county);
    }

    public function test_region_is_a_valid_string(): void
    {
        $region = $this->faker->region;

        self::assertTrue(! empty($region));
        self::assertIsString($region);
    }

    public function test_city_is_a_valid_string(): void
    {
        $city = $this->faker->city;

        self::assertTrue(! empty($city));
        self::assertIsString($city);
    }

    public function test_town_is_alias_for_city(): void
    {
        $town = $this->faker->town;
        $city = $this->faker->city;

        self::assertTrue(! empty($town));
        self::assertIsString($town);
    }

    public function test_street_name_is_a_valid_string(): void
    {
        $street = $this->faker->streetName;

        self::assertTrue(! empty($street));
        self::assertIsString($street);
    }

    public function test_street_address_is_formatted_correctly(): void
    {
        $streetAddress = $this->faker->streetAddress;

        self::assertTrue(! empty($streetAddress));
        self::assertIsString($streetAddress);
        self::assertMatchesRegularExpression('/^\d+ .+$/', $streetAddress);
    }

    protected function getProviders(): iterable
    {
        yield new Address($this->faker);
    }
}
