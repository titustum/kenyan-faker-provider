
# Kenyan Faker Provider

Kenyan-specific locale data for [Faker](https://github.com/FakerPHP/Faker), designed for use with PHP applications and Laravel projects.

This package adds support for realistic Kenyan: 
- Person names (including Christian & Islamic names)
- Phone numbers (Safaricom, Airtel, etc.)
- Addresses (coming soon)
- Companies, Payments, and more

> 📦 Package: `titustum/kenyan-faker-provider`  
> 🇰🇪 Locale: `en_KE`

---

## 📦 Installation

### A. Using Composer

```bash
composer require titustum/kenyan-faker-provider --dev
````

> Make sure `fakerphp/faker` is also installed (Laravel includes it by default).

---

## 🚀 Usage

### A. In a Laravel Seeder (Recommended)

You can load the Kenyan Faker providers manually or rely on locale auto-loading.

#### **1. Manual Registration of Providers**

```php
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Register Kenyan providers
        $faker->addProvider(new \KenyaFaker\Provider\en_KE\Person($faker));
        $faker->addProvider(new \KenyaFaker\Provider\en_KE\PhoneNumber($faker));
        $faker->addProvider(new \KenyaFaker\Provider\en_KE\Address($faker));
        $faker->addProvider(new \KenyaFaker\Provider\en_KE\Company($faker));
        $faker->addProvider(new \KenyaFaker\Provider\en_KE\Payment($faker));
        $faker->addProvider(new \KenyaFaker\Provider\en_KE\Internet($faker));

        DB::table('users')->insert([
          'name'       => $faker->name('male'),      // e.g. "James Kiprotich"
          'email'      => $faker->email(),           // e.g. "j.kiprotich@example.co.ke"
          'phone'      => $faker->phoneNumber(),     // e.g. "0722 456 789"
          'county'     => $faker->county(),          // e.g. "Uasin Gishu"
          'address'    => $faker->address(),         // e.g. "Eldoret, Uasin Gishu 30100"
          'company'    => $faker->company(),         // e.g. "Kilimanjaro Supplies Ltd"
          'mpesa_till' => $faker->mpesaTill(),       // e.g. "923456"
      ]);

    }
}
```

---

### B. Using the Kenyan Locale (`en_KE`)

If you follow standard Faker locale conventions, you can load all providers automatically:

```php
$faker = Faker::create('en_KE');

echo $faker->name();            // e.g., "Brian Kiptoo"
echo $faker->phoneNumber();     // e.g., "0722 123 456"
echo $faker->county();          // e.g., "Nairobi"
echo $faker->company();         // e.g., "Kilimanjaro Logistics Ltd"
echo $faker->mpesaPaybill();    // e.g., "123456"
echo $faker->email();           // e.g., "mary.wanjiru@example.co.ke"
```

No manual provider registration required — Laravel auto-discovers the package.

---

### C. Quick Examples (All Providers)

#### **Person**

```php
$faker->name();          // "Mary Wanjiku"
$faker->firstName();     // "Amina"
$faker->lastName();      // "Mutua"
```

#### **Phone Number**

```php
$faker->phoneNumber();   // "0722 654 321"
$faker->mobileNumber();  // "0798 123 456"
```

#### **Address**

```php
$faker->county();        // "Kiambu"
$faker->town();          // "Thika"
$faker->postalCode();    // "01000"
$faker->address();       // "Thika, Kiambu 01000"
```

#### **Company**

```php
$faker->company();       // "Rift Valley Traders Ltd"
$faker->companySuffix(); // "Enterprises"
```

#### **Payment (MPESA)**

```php
$faker->mpesaPaybill();  // "345678"
$faker->mpesaTill();     // "923456"
```

#### **Internet**

```php
$faker->email();         // "kevin.kiprotich@kenya.co.ke"
$faker->domainName();    // "nairobitech.co.ke"
$faker->userName();      // "wanjiku.m"
```

> This will automatically use the `Faker\Provider\en_KE` providers if they're properly autoloaded.

---

## 🧩 Features

| Provider          | Status  | Description                                     |
| ----------------- | ------- | ----------------------------------------------- |
| `Person.php`      | ✅ Ready | Kenyan male/female first & last names           |
| `PhoneNumber.php` | ✅ Ready | Kenyan mobile phone numbers (Safaricom, Airtel) |
| `Address.php`     | ✅ Ready  | Kenyan counties, towns, postal codes            |
| `Company.php`     | ✅ Ready  | Local business suffixes and names               |
| `Payment.php`     | ✅ Ready  | Mock MPESA Paybill, Till numbers                |

---

## ⚙️ Laravel Auto-Discovery

This package supports Laravel auto-discovery via `KenyaFaker\Laravel\KenyanFakerServiceProvider`.

---

## 🛠 Local Development Setup

To test locally in another Laravel app:

1. Clone this repo:

   ```bash
   git clone https://github.com/titustum/kenyan-faker-provider.git
   ```

2. In your Laravel app `composer.json`:

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

---

## ✍️ Author

**Titus Tum**
📧 [tituskiptanuitum@gmail.com](mailto:tituskiptanuitum@gmail.com)
🔗 [GitHub: @titustum](https://github.com/titustum)

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙌 Contributing

Pull requests are welcome! Feel free to submit bug fixes, new providers, or improved datasets.

---

## 🌍 Roadmap

* [x] Person names (Christian, Muslim, regional)
* [x] Phone numbers (Safaricom, Airtel, Telkom)
* [x] Address data (Counties, Sub-counties, P.O. Boxes)
* [x] Company data
* [x] Payment providers (MPESA, Airtel Money, etc.)
* [ ] Add reginal/tribal based names

---

## ⭐️ Why Use This?

Laravel projects targeting Kenya often lack realistic seed data. This package brings localized names, phone numbers, and business data so your app looks and behaves closer to real-world usage in Kenya.
 