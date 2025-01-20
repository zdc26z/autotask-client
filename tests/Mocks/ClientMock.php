<?php

namespace Tests\Mocks;

use Anteris\Autotask\Client;
use Anteris\Autotask\HttpClient;

class ClientMock extends Client
{
    protected HttpClient $client;

    public function __construct() 
    {
        $this->client = new HttpClientMock();
    }
}
