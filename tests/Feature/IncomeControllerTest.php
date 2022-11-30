<?php

namespace Tests\Feature;

use App\Models\AccountType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class IncomeControllerTest extends TestCase
{
    protected string $url = '/app/api/v1/income';
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
    public function testInsertIncomeCustomerPendingReturnOk(): void
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'accounts_id' => $this->_createAccount(),
            'description' => $this->faker()->realText,
            'deposit_value' => $this->faker()->randomNumber(2),
            'status' => Config::get('constants.INCOMES_STATUS.PENDING'),
            'deposit_voucher_path' => $this->faker()->imageUrl(),
        ]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdateIncomeAdminRejectedReturnOk(): void
    {
        $user = $this->getUser();
        $income = $this->actingAs($user)->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'accounts_id' => $this->_createAccount(),
            'description' => $this->faker()->realText,
            'deposit_value' => $this->faker()->randomNumber(2),
            'status' => Config::get('constants.INCOMES_STATUS.PENDING'),
            'deposit_voucher_path' => $this->faker()->imageUrl(),
        ]);

        $response = $this->actingAs($user)->withoutMiddleware()->withHeaders($this->defaultHeaders)->putJson($this->url . '/' . $income['data']['id'], [
            'status' => Config::get('constants.INCOMES_STATUS.REJECTED'),
        ]);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdateIncomeAdminAcceptedReturnOk(): void
    {
        $income = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'accounts_id' => $this->_createAccount(),
            'description' => $this->faker()->realText,
            'deposit_value' => $this->faker()->randomNumber(2),
            'status' => Config::get('constants.INCOMES_STATUS.PENDING'),
            'deposit_voucher_path' => $this->faker()->imageUrl(),
        ]);
        $response = $this->actingAs($this->getUser())->withoutMiddleware()->withHeaders($this->defaultHeaders)->putJson($this->url . '/' . $income['data']['id'], [
            'status' => Config::get('constants.INCOMES_STATUS.ACCEPTED'),
        ]);
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

    private function _createAccount()
    {
        $response = $this->actingAs($this->getUser())->withHeaders($this->defaultHeaders)->postJson('/app/api/v1/account', [
            "account_types_id" => $this->_getAccountId('constants.USER_TYPES.CUSTOMER'),
            'description' => $this->faker()->realText,
            "name" => $this->faker()->name,
            "email" => $this->faker()->email,
            "password" => $this->faker()->password(8)
        ]);
        return $response['data']['id'];
    }
}
