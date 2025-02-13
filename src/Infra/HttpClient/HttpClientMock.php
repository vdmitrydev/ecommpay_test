<?php

declare(strict_types=1);

namespace Processor\Infra\HttpClient;

readonly class HttpClientMock implements HttpClientInterface
{
    public function request(string $url, array $body): array
    {
        if ($body['cvv'] === '666') {
            throw new HttpClientException('Network error');
        }

        if ($body['cvv'] === '000') {
            return [
                'operation_id' => '',
                'status' => 'error',
                'error' => [
                    'message' => 'Bad cvv',
                ],
            ];
        }

        return [
            'operation_id' => '123',
            'status' => 'success',
            'error' => [],
        ];
    }
}