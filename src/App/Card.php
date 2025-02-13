<?php

declare(strict_types=1);

namespace Processor\App;

use DateTimeInterface;

readonly class Card
{
    public function __construct(
        public string $pan,
        public string $cvv,
        // TODO: точно ли этот формат
        public DateTimeInterface $expiry,
    ) {
    }
}