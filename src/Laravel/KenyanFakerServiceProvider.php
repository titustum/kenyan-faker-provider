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
    /**
     * Register bindings in the container.
     *
     * Laravel's fake() helper resolves Faker using a locale-suffixed container key:
     *   \Faker\Generator::class . ':' . $locale   (e.g. "Faker\Generator:en_US")
     *
     * $this->faker in factories/seeders resolves plain \Faker\Generator::class.
     *
     * We must bind ALL of these to ensure every entry point uses Kenyan data.
     */
    public function register(): void
    {
        // Read whatever locale the app currently has (default: en_US)
        $currentLocale = $this->app['config']->get('app.faker_locale', 'en_US');

        // Override to en_KE so future fake($locale) calls default to Kenyan
        $this->app['config']->set('app.faker_locale', 'en_KE');

        // Build a shared Kenyan Faker instance
        $makeKenyanFaker = function (): Generator {
            $faker = Factory::create('en_KE');

            $faker->addProvider(new Person($faker));
            $faker->addProvider(new PhoneNumber($faker));
            $faker->addProvider(new Address($faker));
            $faker->addProvider(new Company($faker));
            $faker->addProvider(new Payment($faker));
            $faker->addProvider(new Internet($faker));

            return $faker;
        };

        // 1. Plain Generator::class — used by $this->faker in factories & seeders
        $this->app->singleton(Generator::class, $makeKenyanFaker);

        // 2. Locale-suffixed key for the OLD locale — fake() resolves this key
        //    based on whatever locale was set BEFORE our provider ran (usually en_US)
        $this->app->singleton(Generator::class . ':' . $currentLocale, $makeKenyanFaker);

        // 3. Locale-suffixed key for en_KE — covers fake() calls made after boot
        //    and any explicit fake('en_KE') calls
        $this->app->singleton(Generator::class . ':en_KE', $makeKenyanFaker);

        // 4. The legacy 'faker' string binding used by older Laravel internals
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
