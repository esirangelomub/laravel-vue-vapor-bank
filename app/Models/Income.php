<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'accounts_id',
        'description',
        'deposit_value',
        'status',
        'deposit_voucher_path',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'accounts_id' => 'integer',
        'description' => 'string',
        'deposit_value' => 'decimal:2',
        'status' => 'string',
        'deposit_voucher_path' => 'string',
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @var string[]
     */
    public static array $rules = [
        'accounts_id' => 'required',
        'deposit_value' => 'required',
        'status' => 'required',
        'deposit_voucher_path' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
