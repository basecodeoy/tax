<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tax\Exceptions;

final class ValueAddedTaxRegistrationNumberFormatMismatchException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The VAT Registration Number does not match the expected country format.');
    }
}
