<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Tax\Values\ValueAddedTaxRegistrationNumber;

dataset('valid_vat_numbers', fn (): array => [
    ['AT', 'ATU12345678'],
    ['BE', 'BE0123456789'],
    ['BG', 'BG1234567890'],
    ['CY', 'CY12345678A'],
    ['CZ', 'CZ1234567890'],
    ['DE', 'DE123456789'],
    ['DK', 'DK12 34 56 78'],
    ['EE', 'EE123456789'],
    ['EL', 'EL123456789'],
    ['ES', 'ESA1234567Z'],
    ['EU', 'EU123456789'],
    ['FI', 'FI12345678'],
    ['FR', 'FRAB123456789'],
    ['GB', 'GB123456789'],
    ['GB', 'GB123456789012'],
    ['GB', 'GBGD123'],
    ['HR', 'HR12345678901'],
    ['HU', 'HU12345678'],
    ['IE', 'IE12345678A'],
    ['IT', 'IT12345678901'],
    ['LT', 'LT123456789'],
    ['LT', 'LT123456789012'],
    ['LU', 'LU12345678'],
    ['LV', 'LV12345678901'],
    ['MT', 'MT12345678'],
    ['NL', 'NL123456789B01'],
    ['PL', 'PL1234567890'],
    ['PT', 'PT123456789'],
    ['RO', 'RO12'],
    ['RO', 'RO1234567890'],
    ['SE', 'SE123456789012'],
    ['SI', 'SI12345678'],
    ['SK', 'SK1234567890'],
    ['SM', 'SM12345'],
]);

it('creates from valid string', function (string $countryCode, string $vatNumber): void {
    $valueAddedTaxRegistrationNumber = ValueAddedTaxRegistrationNumber::createFromString($vatNumber);

    expect($valueAddedTaxRegistrationNumber->countryCode)->toEqual($countryCode);
    expect($valueAddedTaxRegistrationNumber->registrationNumber)->toEqual($vatNumber);
})->with('valid_vat_numbers');
