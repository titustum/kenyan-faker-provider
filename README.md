
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

### A. In Laravel Seeder

```php
use Faker\Factory as Faker;

$faker = Faker::create();
$faker->addProvider(new \KenyaFaker\Provider\en_KE\Person($faker));
$faker->addProvider(new \KenyaFaker\Provider\en_KE\PhoneNumber($faker));

echo $faker->name('male');
echo $faker->phoneNumber();
```

### B. With Locale (if mapped to `en_KE`)

If you're following Faker's locale conventions:

```php
$faker = Faker::create('en_KE');
echo $faker->name('female');
```

> This will automatically use the `Faker\Provider\en_KE` providers if they're properly autoloaded.

---

## 🧩 Features

| Provider          | Status  | Description                                     |
| ----------------- | ------- | ----------------------------------------------- |
| `Person.php`      | ✅ Ready | Kenyan male/female first & last names           |
| `PhoneNumber.php` | ✅ Ready | Kenyan mobile phone numbers (Safaricom, Airtel) |
| `Address.php`     | 🚧 WIP  | Kenyan counties, towns, postal codes            |
| `Company.php`     | 🚧 WIP  | Local business suffixes and names               |
| `Payment.php`     | 🚧 WIP  | Mock MPESA Paybill, Till numbers                |

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
* [ ] Address data (Counties, Sub-counties, P.O. Boxes)
* [ ] Company data
* [ ] Payment providers (MPESA, Airtel Money, etc.)

---

## ⭐️ Why Use This?

Laravel projects targeting Kenya often lack realistic seed data. This package brings localized names, phone numbers, and business data so your app looks and behaves closer to real-world usage in Kenya.
 