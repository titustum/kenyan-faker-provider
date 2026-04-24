<?php

namespace KenyaFaker\Laravel;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use KenyaFaker\Provider\en_KE\Address;
use KenyaFaker\Provider\en_KE\Company;
use KenyaFaker\Provider\en_KE\Internet;
use KenyaFaker\Provider\en_KE\Payment;
use KenyaFaker\Provider\en_KE\Person;
use KenyaFaker\Provider\en_KE\PhoneNumber;

class KenyanFakerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * This overrides Laravel's default Faker binding so that fake() and
     * $this->faker in seeders/factories automatically use Kenyan data.
     */
    public function register(): void
    {
        // Override the app's faker locale to en_KE
        $this->app['config']->set('app.faker_locale', 'en_KE');

        // Re-bind the Faker generator singleton with Kenyan providers loaded
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create('en_KE');

            $faker->addProvider(new Person($faker));
            $faker->addProvider(new PhoneNumber($faker));
            $faker->addProvider(new Address($faker));
            $faker->addProvider(new Company($faker));
            $faker->addProvider(new Payment($faker));
            $faker->addProvider(new Internet($faker));

            return $faker;
        });

        // Laravel also binds Faker with a locale key — override that too
        $this->app->singleton('faker', function () {
            return $this->app->make(Generator::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}