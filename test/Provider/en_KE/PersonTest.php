<?php

declare(strict_types=1);

namespace KenyaFaker\Test\Provider\en_KE;

use Faker\Provider\en_KE\Person;
use Faker\Test\TestCase;

final class PersonTest extends TestCase
{
    public function test_first_name_male(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $name = $this->faker->firstNameMale();
            self::assertIsString($name);
            self::assertNotEmpty($name);
        }
    }

    public function test_first_name_female(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $name = $this->faker->firstNameFemale();
            self::assertIsString($name);
            self::assertNotEmpty($name);
        }
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }
}
