<?php

declare(strict_types=1);

namespace Processor\App;

readonly class Result
{
    // считаем, что нам нужен только ID операции
    public function __construct(
        public ?string $operationId,
    ) {
    }
}