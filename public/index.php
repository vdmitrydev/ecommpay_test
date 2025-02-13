<?php

declare(strict_types=1);

use Processor\App\Handler;
use Processor\Infra\FirstProvider;
use Processor\Infra\HttpClient\HttpClientMock;
use Processor\Ui\Controller;
use Processor\Ui\ExceptionHandler;

require '../vendor/autoload.php';

// Для простоты делаем обработку исключений на самом высоком уровне,
// чтобы минимально использовать try/catch.
set_exception_handler(new ExceptionHandler()->handle(...));

header('Content-Type: application/json');

// Тут обычно идет инициализация ядра, отвечающего за пайплайн http-запроса,
// маршрутизатора, сервис-контейнера и пр.
// Для простоты считаем, что у нас один контроллер на все роуты и собираем его прямо здесь.
$controller = new Controller(new Handler(new FirstProvider(new HttpClientMock())));
$controller->process();