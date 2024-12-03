<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tax\Values;

use BaseCodeOy\Tax\Exceptions\ValueAddedTaxRegistrationNumberFormatMismatchException;
use BaseCodeOy\Tax\Services\ValueAddedTaxService;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class ValueAddedTaxRegistrationNumber extends Data implements \Stringable, Castable
{
    public function __construct(
        public readonly string $registrationNumber,
        public readonly string $countryCode,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->registrationNumber;
    }

    public static function createFromString(string $registrationNumber): self
    {
        $valueAddedTaxService = new ValueAddedTaxService();

        if ($valueAddedTaxService->validateRegistrationNumberFormat($registrationNumber)) {
            return new self(
                $registrationNumber,
                \mb_substr($registrationNumber, 0, 2),
            );
        }

        throw new ValueAddedTaxRegistrationNumberFormatMismatchException();
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $dataProperty, mixed $value, array $properties, CreationContext $creationContext): mixed
            {
                return ValueAddedTaxRegistrationNumber::createFromString((string) $value);
            }
        };
    }

    public function toString(): string
    {
        return $this->registrationNumber;
    }
}
