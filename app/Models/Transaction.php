<?php

namespace App\Models;

use App\Enums\StatusTypes;
use App\Filters\TransactionFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use Filterable, HasFactory, Uuid;

    protected string $default_filters = TransactionFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'transaction_number',
        'json_request',
        'json_response_payment_gateway',
        'payement_gateway',
        'amount',
        'additional_cost',
        'bank_id',
        'expired_date',
        'link_payment',
        'identity_owner',
        'identity_driver',
        'status',
        'type',
        'code_payment_gateway_relation',
        'json_callback',
    ];

    public function bank(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Bank::class);
    }

    public function histories(): HasMany
    {
        return $this->HasMany(\App\Models\TransactionHistory::class)->orderBy('created_at', 'desc');
    }

    public function scopeSaldoCustomer($query, $id_owner)
    {
        $saldo = $query->where('identity_owner', $id_owner)
            ->where('status', StatusTypes::SUCCESSFUL)
            ->selectRaw('SUM(CASE 
							WHEN type = "top_up" THEN amount 
							WHEN type = "pay" AND additional_cost IS NOT NULL THEN -amount - additional_cost 
							ELSE -amount 
						END) as saldo')
            ->value('saldo');

        return $saldo ?? 0;
    }
}
