<?php

declare(strict_types=1);

namespace Processor\App;

interface ProviderInterface
{
    public function provide(Purchase $purchase): Result;
}