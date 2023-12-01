<?php

namespace App\Models;

use App\Filters\BankFilters;
use App\Traits\Uuid;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use Filterable, HasFactory, Uuid;

    protected string $default_filters = BankFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'code',
        'fee',
        'queue',
        'status',
    ];
}
