<?php

declare(strict_types=1);

namespace Processor\Ui;

use Throwable;

readonly class ExceptionHandler
{
    public function handle(Throwable $e): void {
        // Считаем, что у нас два типа ошибок:
        // - ошибки клиента, возвращаем текст ошибки, чтобы клиент знал, что пошло не так
        // - ошибки сервера, возвращаем какой-то общий текст, клиент все равно ни на что повлиять не сможем

        // Здесь можно/нужно сделать логирование, но для простоты опустим этот момент.

        $message = 'Server error';
        $code = 500;

        if ($e instanceof ValidationException) {
            $message = $e->getMessage();
            $code = 400;
        }

        http_response_code($code);
        echo json_encode([
            'error' => $message,
        ]);
    }
}