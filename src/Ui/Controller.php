<?php

declare(strict_types=1);

namespace Processor\Ui;

use DateTimeImmutable;
use Processor\App\Card;
use Processor\App\Money;
use Processor\App\Handler;
use Processor\App\Purchase;

readonly class Controller
{
    public function __construct(
        private Handler $handler,
    ) {
    }

    public function process(): void
    {
        // Тут также должна осуществляться аутентификация, но для простоты считаем, что к сервису
        // имеют доступ только "разрешенные" клиенты.

        $body = $this->getBody();
        $this->validateBody($body);

        // собираем дтошку слоя приложения из данных http-запроса
        $purchase = new Purchase(
            new Money(
                $body['amount'],
                $body['currency']
            ),
            new Card(
                $body['pan'],
                $body['cvv'],
                new DateTimeImmutable($body['expiry'])
            ),
        );

        // передаем это дтошку на выполнение в слой приложения
        $result = $this->handler->handle($purchase);

        // сериализуем результат приложения и "выводим на экран"
        echo json_encode($result);
    }

    private function getBody(): array
    {
        $json = file_get_contents('php://input');

        return json_decode($json, true);
    }

    private function validateBody(array $body): void
    {
        // для примера валидируем один параметр
        if (
            !isset($body['pan']) ||
            !is_string($body['pan']) ||
            !preg_match('/^\d{16}$/', $body['pan'])
        ) {
            throw new ValidationException('Invalid PAN');
        }

        // ...
    }
}
