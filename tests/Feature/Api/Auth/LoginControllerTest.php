<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class LoginControllerTest extends TestCase
{
	use WithoutMiddleware, RefreshDatabase;

	protected function setUp(): void
	{
		parent::setUp();
		
        $mock = new MockHandler([new Response(200, [])]);
		$handler = HandlerStack::create($mock);
		$this->client = new Client(['handler' => $handler]);
	}

    public function testLoginUser()
    {
        $response = $this->client->post(route('api.auth.login'), [
            'json' => [
                'email' => 'tony_admin@example.com',
                'password' => 'secret123',
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
