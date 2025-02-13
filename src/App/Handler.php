<?php

declare(strict_types=1);

namespace Processor\App;

readonly class Handler
{
    public function __construct(
        private ProviderInterface $provider,
    ) {
    }

    public function handle(Purchase $purchase): Result
    {
        // Тут должна быть авторизация, то есть нам нужно убедиться, что у пользователя есть
        // права для совершения операции, но для простоты считаем, что все авторизованы.

        // Также в слое приложения обычно выполняется логирование, если это необходимо.

        // В нашем случае просто обращаемся в провайдер через интерфейс и отдаем результат.
        return $this->provider->provide($purchase);
    }
}