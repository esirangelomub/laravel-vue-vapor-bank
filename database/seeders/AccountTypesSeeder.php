<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;


class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::query()->insert([
            ['type' => Config::get('constants.USER_TYPES.CUSTOMER')],
            ['type' => Config::get('constants.USER_TYPES.ADMIN')]
        ]);
    }
}
