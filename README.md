# Kenyan Faker Provider 🇰🇪

Kenyan-specific locale data for [Faker](https://github.com/FakerPHP/Faker), designed for PHP applications and Laravel projects.

Once installed, **`fake()` and `$this->faker` automatically generate Kenyan data** — no manual setup required.

> 📦 Package: `titustum/kenyan-faker-provider`
> 🇰🇪 Locale: `en_KE`

Supported data:

- Person names (Christian & Islamic names)
- Phone numbers (Safaricom, Airtel, Telkom)
- Counties, Towns & Cities
- Addresses & Postal Codes
- Companies
- MPESA Payments (Paybill & Till)
- Kenyan Internet data (emails, domains, usernames)

---

## 📦 Installation

```bash
composer require titustum/kenyan-faker-provider --dev
```

That's it. Laravel auto-discovers the package and registers the `KenyanFakerServiceProvider` automatically. No changes to `config/app.php` needed.

> **Note:** If you have a cached config, run `php artisan config:clear` and `php artisan package:discover` after installing.

---

## 🚀 Usage

### In Laravel — Zero Configuration

After installation, `fake()` and `$this->faker` are already Kenyan. Use them anywhere:

```php
// In a Factory
public function definition(): array
{
    return [
        'name'    => fake()->name(),           // "Mary Wanjiku"
        'email'   => fake()->email(),          // "mary.wanjiku@kenya.co.ke"
        'phone'   => fake()->phoneNumber(),    // "0722 654 321"
        'county'  => fake()->county(),         // "Kiambu"
        'town'    => fake()->town(),           // "Thika"
        'address' => fake()->address(),        // "Thika, Kiambu 01000"
        'company' => fake()->company(),        // "Rift Valley Traders Ltd"
    ];
}
```

```php
// In a Seeder
class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name'       => $this->faker->name(),
            'email'      => $this->faker->email(),
            'phone'      => $this->faker->phoneNumber(),
            'county'     => $this->faker->county(),
            'mpesa_till' => $this->faker->mpesaTill(),   // "923456"
        ]);
    }
}
```

### Outside Laravel (Plain PHP)

```php
use Faker\Factory;
use KenyaFaker\Provider\en_KE\Person;
use KenyaFaker\Provider\en_KE\PhoneNumber;
use KenyaFaker\Provider\en_KE\Address;
use KenyaFaker\Provider\en_KE\Company;
use KenyaFaker\Provider\en_KE\Payment;
use KenyaFaker\Provider\en_KE\Internet;

$faker = Factory::create('en_KE');

$faker->addProvider(new Person($faker));
$faker->addProvider(new PhoneNumber($faker));
$faker->addProvider(new Address($faker));
$faker->addProvider(new Company($faker));
$faker->addProvider(new Payment($faker));
$faker->addProvider(new Internet($faker));

echo $faker->name();         // "Brian Kiptoo"
echo $faker->county();       // "Uasin Gishu"
echo $faker->phoneNumber();  // "0733 123 456"
```

---

## 🧩 Available Providers

### Person

```php
fake()->name();            // "Mary Wanjiku"
fake()->name('male');      // "James Kiprotich"
fake()->name('female');    // "Amina Akinyi"
fake()->firstName();       // "Amina"
fake()->lastName();        // "Mutua"
```

### Phone Number

```php
fake()->phoneNumber();     // "0722 654 321"
fake()->mobileNumber();    // "0798 123 456"
```

### Address

```php
fake()->county();          // "Kiambu"
fake()->town();            // "Thika"
fake()->city();            // "Garissa"
fake()->postalCode();      // "01000"
fake()->address();         // "Thika, Kiambu 01000"
```

### Company

```php
fake()->company();         // "Rift Valley Traders Ltd"
fake()->companySuffix();   // "Enterprises"
```

### Payment (MPESA)

```php
fake()->mpesaPaybill();    // "345678"
fake()->mpesaTill();       // "923456"
```

### Internet

```php
fake()->email();           // "kevin.kiprotich@kenya.co.ke"
fake()->domainName();      // "nairobitech.co.ke"
fake()->userName();        // "wanjiku.m"
```

---

## ⚙️ How Auto-Discovery Works

When you install the package, Laravel auto-discovers `KenyanFakerServiceProvider` via the `extra.laravel` key in `composer.json`. The service provider:

1. Sets the app's faker locale to `en_KE`
2. Rebinds the `Faker\Generator` singleton with all Kenyan providers pre-loaded
3. Ensures both `fake()` and `$this->faker` point to the same Kenyan instance

This means **you never need to call `Faker::create('en_KE')` or `addProvider()` manually** in a Laravel project.

---

## 🛠 Features

| Provider          | Status    | Description                                      |
|-------------------|-----------|--------------------------------------------------|
| `Person.php`      | ✅ Ready  | Kenyan male/female first & last names            |
| `PhoneNumber.php` | ✅ Ready  | Kenyan mobile numbers (Safaricom, Airtel, Telkom)|
| `Address.php`     | ✅ Ready  | Counties, towns, postal codes                    |
| `Company.php`     | ✅ Ready  | Local business names and suffixes                |
| `Payment.php`     | ✅ Ready  | MPESA Paybill & Till numbers                     |
| `Internet.php`    | ✅ Ready  | Kenyan emails, domains, usernames                |

---

## 🛠 Local Development Setup

To test locally inside another Laravel app:

1. Clone this repo:

   ```bash
   git clone https://github.com/titustum/kenyan-faker-provider.git
   ```

2. In your Laravel app's `composer.json`, add a path repository:

   ```json
   "repositories": [
     {
       "type": "path",
       "url": "../path-to/kenyan-faker-provider"
     }
   ]
   ```

3. Require the package:

   ```bash
   composer require titustum/kenyan-faker-provider --dev
   ```

4. Clear caches:

   ```bash
   php artisan package:discover
   php artisan config:clear
   ```

---

## 🌍 Roadmap

- [x] Person names (Christian, Muslim, regional)
- [x] Phone numbers (Safaricom, Airtel, Telkom)
- [x] Address data (Counties, Towns, P.O. Boxes)
- [x] Company data
- [x] Payment providers (MPESA Paybill & Till)
- [x] Internet data (emails, domains)
- [x] Laravel auto-discovery (zero-config setup)
- [ ] Regional/tribal name sets
- [ ] Sub-county and ward level address data
- [ ] Airtel Money & T-Kash payment numbers

---

## 🙌 Contributing

Pull requests are welcome! Feel free to submit bug fixes, new providers, or improved datasets. Please open an issue first for major changes.

---

## ✍️ Author

**Titus Tum**
📧 [tituskiptanuitum@gmail.com](mailto:tituskiptanuitum@gmail.com)
🔗 [GitHub: @titustum](https://github.com/titustum)

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## ⭐️ Why Use This?

Laravel projects targeting Kenya often lack realistic seed data. This package brings localized names, phone numbers, addresses, and business data — and unlike generic Faker, it works out of the box with zero configuration. Install it once, and every `fake()` call in your app speaks Kenyan.