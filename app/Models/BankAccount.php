<?php

namespace App\Models;

use App\Filters\BankAccountFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BankAccount extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = BankAccountFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
		'bank_id',
		'account_number',
		'identity_owner',
		'identity_driver',
		'status',
    ];

	public function bank(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(\App\Models\Bank::class);
	}

}
