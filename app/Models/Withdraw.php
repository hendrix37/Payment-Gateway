<?php

namespace App\Models;

use App\Filters\WithdrawFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Withdraw
 *
 * @property int $id
 * @property string $uuid
 * @property string $json_request
 * @property string $account_number
 * @property string $bank_code
 * @property float $amount
 * @property string|null $remark
 * @property string $idempotency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WithdrawFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw useFilters(?string $filterClass = null, ?\Essa\APIToolKit\Filters\DTO\FiltersDTO $filteredDTO = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereBankCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereIdempotency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereJsonRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUuid($value)
 * @mixin \Eloquent
 */
class Withdraw extends Model
{
    use Filterable, HasFactory, Uuid;

    protected string $default_filters = WithdrawFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'json_request',
        'account_number',
        'bank_code',
        'amount',
        'remark',
        'idempotency',
    ];
}
