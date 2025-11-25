<?php

declare(strict_types=1);

namespace KenyaFaker\Provider\en_KE;

use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PaymentTest extends TestCase
{
    public function test_mobile_money_provider_is_valid(): void
    {
        $provider = Payment::mobileMoneyProvider();

        $providers = (new \ReflectionClass(Payment::class))->getStaticPropertyValue('mobileMoneyProviders');

        self::assertContains($provider, $providers);
    }

    public function test_paybill_number_is_valid(): void
    {
        $paybill = Payment::paybillNumber();

        $paybills = (new \ReflectionClass(Payment::class))->getStaticPropertyValue('paybillNumbers');

        self::assertContains($paybill, $paybills);
    }

    public function test_transaction_code_format(): void
    {
        $code = Payment::transactionCode();

        self::assertMatchesRegularExpression('/^[A-Z]{2}\d[A-Z]\d{2}[A-Z]{2}\d{2}$/', $code);
        self::assertEquals(10, strlen($code));
    }

    public function test_bank_is_valid(): void
    {
        $bank = Payment::bank();

        $banks = (new \ReflectionClass(Payment::class))->getStaticPropertyValue('banks');

        self::assertContains($bank, $banks);
    }

    public function test_bank_account_number_format(): void
    {
        $accountNumber = Payment::bankAccountNumber();

        self::assertMatchesRegularExpression('/^01\d{10}$/', $accountNumber);
        self::assertEquals(12, strlen($accountNumber));
    }

    public function test_mobile_money_number_format(): void
    {
        $mobileNumber = Payment::mobileMoneyNumber();

        self::assertMatchesRegularExpression('/^07\d{8}$/', $mobileNumber);
        self::assertEquals(10, strlen($mobileNumber));
    }

    public function test_mobile_money_statement_structure(): void
    {
        $statement = Payment::mobileMoneyStatement();

        self::assertIsArray($statement);
        self::assertArrayHasKey('provider', $statement);
        self::assertArrayHasKey('number', $statement);
        self::assertArrayHasKey('transaction_code', $statement);
        self::assertArrayHasKey('amount', $statement);
        self::assertArrayHasKey('paybill', $statement);
        self::assertArrayHasKey('date', $statement);

        $this->assertContains($statement['provider'], (new \ReflectionClass(Payment::class))->getStaticPropertyValue('mobileMoneyProviders'));
        self::assertMatchesRegularExpression('/^07\d{8}$/', $statement['number']);
        self::assertMatchesRegularExpression('/^[A-Z]{2}\d[A-Z]\d{2}[A-Z]{2}\d{2}$/', $statement['transaction_code']);
        self::assertIsFloat($statement['amount']);
        self::assertContains($statement['paybill'], (new \ReflectionClass(Payment::class))->getStaticPropertyValue('paybillNumbers'));
        self::assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $statement['date']);
    }

    protected function getProviders(): iterable
    {
        yield new Payment($this->faker);
    }
}
