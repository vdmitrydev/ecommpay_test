<?php

declare(strict_types=1);

namespace Processor\Infra;

use Processor\App\ProviderInterface;
use Processor\App\Purchase;
use Processor\App\Result;
use Processor\Infra\HttpClient\HttpClientInterface;

readonly class FirstProvider implements ProviderInterface
{
    private const string URL = 'https://provider1.com/provide';

    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    public function provide(Purchase $purchase): Result
    {
        $result = $this->httpClient->request(self::URL, [
            'amount' => $purchase->money->amount,
            'currency' => $purchase->money->currency,
            'pan' => $purchase->card->pan,
            'cvv' => $purchase->card->cvv,
            'expiry' => $purchase->card->expiry->format('m-y'),
        ]);

        // TODO: проверять http code
        if (isset($result['error']['message'])) {
            throw new ProviderException($result['error']['message']);
        }

        return new Result($result['operation_id']);
    }
}