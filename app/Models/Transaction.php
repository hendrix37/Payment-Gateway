<?php

namespace App\Models;

use App\Filters\TransactionFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
	use HasFactory, Filterable, Uuid;

	protected string $default_filters = TransactionFilters::class;

	/**
	 * Mass-assignable attributes.
	 *
	 * @var array
	 */
	protected $fillable = [
		'uuid',
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
		return $this->HasMany(\App\Models\TransactionHistory::class);
	}
}
