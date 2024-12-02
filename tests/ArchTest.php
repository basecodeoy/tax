<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

arch('globals')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();

// arch('BaseCodeOy\Tax')
//     ->expect('BaseCodeOy\Tax')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tax\Exceptions')
//     ->expect('BaseCodeOy\Tax\Exceptions')
//     ->toExtend('InvalidArgumentException');

// arch('BaseCodeOy\Tax\Services')
//     ->expect('BaseCodeOy\Tax\Services')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toBeReadonly();

// arch('BaseCodeOy\Tax\Values')
//     ->expect('BaseCodeOy\Tax\Values')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toExtend(Spatie\LaravelData\Data::class);
