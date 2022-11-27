<?php

namespace App\Listeners;

use App\Events\AccountRegistered;
use App\Models\AccountType;
use \App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rules\Password;

class CreateUserAccount
{
    protected $input;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AccountRegistered  $event
     * @return void
     */
    public function handle(AccountRegistered $event)
    {
        if (request()->has('users_id') || !request()->has('account_types_id')) {
            return;
        }

        $data = [];
        $account_type = AccountType::find(request('account_types_id'));
        if (is_null($account_type)) {
            return;
        }

        if ($account_type->type === Config::get('constants.USER_TYPES.CUSTOMER')) {
            request()->validate([
                'name' => 'sometimes',
                'email' => 'sometimes',
                'password' => ['sometimes', Password::min(8)]
            ]);
            $data = request()->except('account_types_id');
        }

        if ($account_type->type === Config::get('constants.USER_TYPES.ADMIN')) {
            request()->validate([
                'email' => 'required|email|unique:users'
            ]);
            $data = [
                'name' => 'SysAdmin',
                'email' => request('email'),
                'password' => 'admin@123'
            ];
        }

        $user = User::where('email', request('email'))->first();
        if (is_null($user)) {
            $user = User::create($data);
        }

        request()->request->add(['users_id' => $user->id]);
    }
}
