<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'accounts_id',
        'expense_value',
        'description',
        'created_at'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'accounts_id' => 'integer',
        'expense_value' => 'decimal:2',
        'description' => 'string'
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
        'expense_value' => 'required',
        'description' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function setAccountsIdAttribute($value)
    {
        if (empty($value)) {
            $value = auth()->user()->load(['account'])->account->id ?? null;
        }
        $this->attributes['accounts_id'] = $value;
    }

    public function setExpenseValueAttribute($value)
    {
        $this->attributes['expense_value'] = dec($value);
    }

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i:s');
    }
}
