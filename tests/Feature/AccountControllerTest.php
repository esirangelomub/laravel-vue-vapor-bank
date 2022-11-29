<?php

namespace Tests\Feature;

use App\Models\AccountType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    protected string $url = '/api/v1/account';
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
    public function testCreateAccountCustomerReturnOk(): void
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            "account_types_id" => $this->_getAccountId('constants.USER_TYPES.CUSTOMER'),
            "name" => $this->faker()->name,
            "email" => $this->faker()->email,
            "password" => $this->faker()->password(8)
        ]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function testListAccountReturnOk(): void
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->getJson($this->url);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function testShowAccountByIdReturnOk(): void
    {
        $user = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            "account_types_id" => $this->_getAccountId('constants.USER_TYPES.CUSTOMER'),
            "name" => $this->faker()->name,
            "email" => $this->faker()->email,
            "password" => $this->faker()->password(8)
        ]);
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->getJson($this->url . '/' . $user['data']['id']);
        $response
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'status' => true,
                'data' => $user['data']
            ]);
    }

    public function testUpdateAccountByIdReturnOk(): void
    {
        $account = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            "account_types_id" => $this->_getAccountId('constants.USER_TYPES.CUSTOMER'),
            "name" => $this->faker()->name,
            "email" => $this->faker()->email,
            "password" => $this->faker()->password(8),
            "balance" => 0.00
        ]);
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->putJson($this->url . '/' . $account['data']['id'], [
            "users_id" => $account['data']['users_id'],
            "balance" => 12345.67
        ]);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertEquals($account['data']['id'], $response['data']['id']);
        $this->assertNotEquals($account['data']['balance'], $response['data']['balance']);
    }

    public function testDeleteAccountByIdReturnOk(): void
    {
        $user = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            "account_types_id" => $this->_getAccountId('constants.USER_TYPES.CUSTOMER'),
            "name" => $this->faker()->name,
            "email" => $this->faker()->email,
            "password" => $this->faker()->password(8)
        ]);
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->deleteJson($this->url . '/' . $user['data']['id']);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    private function _getAccountId($key)
    {
        $account_type = AccountType::where(['type' => Config::get($key)])->first(['id']);
        if (is_null($account_type)) {
            $account_type = AccountType::create(['type' => Config::get($key)]);
        }
        return $account_type->id;
    }
}
