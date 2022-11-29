<?php

namespace Tests;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker, RefreshDatabase;

    private $user;

    /**
     * @return Builder|Model|null
     */
    public function getUser()
    {
        $this->user = User::query()->create([
            "name" => $this->faker()->name,
            "email" => $this->faker()->email,
            "password" => $this->faker()->password(8)
        ]);
        return $this->user;
    }

}
