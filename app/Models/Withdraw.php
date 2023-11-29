<?php

namespace App\Models;

use App\Filters\WithdrawFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Withdraw extends Model
{
    use HasFactory, Filterable, Uuid;

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
