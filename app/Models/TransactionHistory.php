<?php

namespace App\Models;

use App\Filters\TransactionHistoryFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use Filterable, HasFactory, Uuid;

    protected string $default_filters = TransactionHistoryFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'json_before_value',
        'json_after_value',
        'action',
        'transaction_id',
        'status_transaction',
    ];

    public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Transaction::class);
    }
}
