<?php

namespace App\Models;

use App\Filters\TransactionHistoryFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TransactionHistory
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $json_before_value
 * @property string $json_after_value
 * @property string $action
 * @property int $transaction_id
 * @property string|null $status_transaction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Transaction $transaction
 *
 * @method static \Database\Factories\TransactionHistoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereJsonAfterValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereJsonBeforeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereStatusTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionHistory whereUuid($value)
 *
 * @mixin \Eloquent
 */
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
