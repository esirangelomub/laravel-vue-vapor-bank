<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'balance',
        'users_id',
        'account_types_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'balance' => 'decimal:2',
        'users_id' => 'integer',
        'account_types_id' => 'integer',
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @var string[]
     */
    public static array $rules = [
        'balance' => 'required',
        'users_id' => 'required',
        'account_types_id' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function account_type(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }
}
