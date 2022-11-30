<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        DB::statement("TRUNCATE TABLE account_types;");
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
        AccountType::query()->insert([
            ['id' => 1, 'type' => Config::get('constants.USER_TYPES.CUSTOMER')],
            ['id' => 2, 'type' => Config::get('constants.USER_TYPES.ADMIN')]
        ]);
    }
}
