<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tax\Services;

use BaseCodeOy\Tax\Values\ValueAddedTaxInclusivePrice;
use Brick\Money\Money;
use Ibericode\Vat\Rates;
use Ibericode\Vat\Validator;
use Illuminate\Support\Facades\App;

final readonly class ValueAddedTaxService
{
    private Rates $rates;

    private Validator $validator;

    public function __construct()
    {
        $this->rates = new Rates(App::storagePath('app/value-added-tax-rates.txt'));
        $this->validator = new Validator();
    }

    public function ratesForCountry(string $countryCode, string $type = Rates::RATE_STANDARD): float
    {
        return $this->rates->getRateForCountry($countryCode, $type);
    }

    public function ratesForCountryByDate(string $countryCode, string|\DateTimeInterface $date, string $type = Rates::RATE_STANDARD): float
    {
        if (\is_string($date)) {
            $date = new \DateTimeImmutable($date);
        }

        return $this->rates->getRateForCountryOnDate($countryCode, $date, $type);
    }

    public function validateRegistrationNumber(string $registrationNumber): bool
    {
        return $this->validator->validateVatNumber($registrationNumber);
    }

    public function validateRegistrationNumberFormat(string $registrationNumber): bool
    {
        return $this->validator->validateVatNumberFormat($registrationNumber);
    }

    public function calculate(Money $grossValue, string $countryCode): ValueAddedTaxInclusivePrice
    {
        $vatPercentage = $this->ratesForCountry($countryCode);

        return ValueAddedTaxInclusivePrice::from([
            'vatPercentage' => $vatPercentage,
            'grossValue' => $grossValue,
            'taxedValue' => $taxedValue = $grossValue->multipliedBy($vatPercentage)->dividedBy(100),
            'totalValue' => $grossValue->plus($taxedValue),
        ]);
    }
}
