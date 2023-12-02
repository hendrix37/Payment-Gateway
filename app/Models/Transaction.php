<?php

namespace App\Models;

use App\Enums\StatusTypes;
use App\Filters\TransactionFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $uuid
 * @property string $transaction_number
 * @property string $json_request
 * @property string|null $json_response_payment_gateway
 * @property string $payement_gateway
 * @property float $amount
 * @property float|null $additional_cost
 * @property int|null $bank_id
 * @property string $expired_date
 * @property string|null $link_payment
 * @property string|null $identity_owner
 * @property string|null $identity_driver
 * @property string|null $status
 * @property string|null $type
 * @property string|null $code_payment_gateway_relation
 * @property string|null $json_callback
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bank|null $bank
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransactionHistory> $histories
 * @property-read int|null $histories_count
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction saldoCustomer($id_owner)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAdditionalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCodePaymentGatewayRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereExpiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIdentityDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIdentityOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereJsonCallback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereJsonRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereJsonResponsePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLinkPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayementGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUuid($value)
 * @mixin \Eloquent
 */
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
