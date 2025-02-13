<?php

declare(strict_types=1);

namespace Processor\App;

readonly class Money
{
    public function __construct(
        // TODO: должен ли это быть int?
        public int $amount,
        public string $currency,
    ) {
    }
}