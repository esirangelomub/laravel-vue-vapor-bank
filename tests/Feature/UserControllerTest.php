<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserControllerTest extends TestCase
{
    protected string $url = '/api/v1/user';
    /**
     * @var array<string>
     */
    protected $defaultHeaders = [
        'Accept' => 'application/json'
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUserReturnOk(): void
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'name' => $this->faker()->name,
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(8)
        ]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function testCreateUserReturnFailNotPassPassword(): void
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'name' => $this->faker()->name,
            'email' => $this->faker()->email()
        ]);
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
    }

    public function testListUserReturnOk(): void
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->getJson($this->url);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function testShowUserByIdReturnOk(): void
    {
        $user = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'name' => $this->faker()->name,
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(8)
        ]);
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->getJson($this->url . '/' . $user['data']['id']);
        $response
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'status' => true,
                'data' => $user['data']
            ]);
    }

    public function testUpdateUserByIdReturnOk(): void
    {
        $user = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'name' => $this->faker()->name,
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(8)
        ]);
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->putJson($this->url . '/' . $user['data']['id'], [
            'name' => $this->faker()->name,
            'password' => $this->faker()->password(8)
        ]);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertEquals($user['data']['id'], $response['data']['id']);
        $this->assertNotEquals($user['data']['name'], $response['data']['name']);
    }

    public function testDeleteUserByIdReturnOk(): void
    {
        $user = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'name' => $this->faker()->name,
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(8)
        ]);
        $response = $this->withHeaders($this->defaultHeaders)->deleteJson($this->url . '/' . $user['data']['id']);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
