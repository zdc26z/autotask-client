<?php

namespace Tests\Mocks;

use Anteris\Autotask\HttpClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class HttpClientMock extends HttpClient
{
    protected GuzzleClient $client;

    public function __construct()
    {
        $mock = new MockHandler();
        $handlerStack = HandlerStack::create($mock);
        $this->client = new GuzzleClient(['handler' => $handlerStack]);
    }
}
