<?php

declare(strict_types=1);

namespace Processor\App;

readonly class Purchase
{
    public function __construct(
        public Money $money,
        public Card $card,
    ) {
    }
}