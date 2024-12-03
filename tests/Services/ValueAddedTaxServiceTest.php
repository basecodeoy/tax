<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Tax\Services\ValueAddedTaxService;
use Brick\Money\Money;

it('can get the rate for country', function (): void {
    expect((new ValueAddedTaxService())->ratesForCountry('EE'))->toBe(22.0);
});

it('can get the rate for country by date', function (): void {
    expect((new ValueAddedTaxService())->ratesForCountryByDate('EE', '2023-01-01'))->toBe(20.0);
    expect((new ValueAddedTaxService())->ratesForCountryByDate('EE', '2024-01-01'))->toBe(22.0);
});

it('can validate registration number', function (): void {
    expect((new ValueAddedTaxService())->validateRegistrationNumber('FI27057218'))->toBeTrue();
    expect((new ValueAddedTaxService())->validateRegistrationNumber('JUNK123'))->toBeFalse();
});

it('can validate registration number format', function (): void {
    expect((new ValueAddedTaxService())->validateRegistrationNumberFormat('FI27057218'))->toBeTrue();
    expect((new ValueAddedTaxService())->validateRegistrationNumberFormat('JUNK123'))->toBeFalse();
});

it('can fetch vat rates', function (): void {
    $valueAddedTaxInclusivePrice = (new ValueAddedTaxService())->calculate(Money::of(100, 'EUR'), 'DE');

    expect($valueAddedTaxInclusivePrice->vatPercentage)->toBe(19.0);
    expect($valueAddedTaxInclusivePrice->grossValue->getAmount()->toFloat())->toBe(100.00);
    expect($valueAddedTaxInclusivePrice->taxedValue->getAmount()->toFloat())->toBe(19.00);
    expect($valueAddedTaxInclusivePrice->totalValue->getAmount()->toFloat())->toBe(119.00);
});
