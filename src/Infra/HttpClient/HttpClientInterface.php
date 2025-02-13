<?php

declare(strict_types=1);

namespace Processor\Infra\HttpClient;

interface HttpClientInterface
{
    // Примитивный HTTP-клиент. Считаем, что указываем только URL и тело запроса.
    public function request(string $url, array $body): array;
}