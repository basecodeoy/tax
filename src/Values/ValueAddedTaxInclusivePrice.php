<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tax\Values;

use Brick\Money\Money;
use Spatie\LaravelData\Data;

final class ValueAddedTaxInclusivePrice extends Data
{
    public function __construct(
        public readonly float $vatPercentage,
        public readonly Money $grossValue,
        public readonly Money $taxedValue,
        public readonly Money $totalValue,
    ) {}
}
