<?php

namespace App\Models;

use App\Traits\ScopedByCompanyAndOutlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddOn extends BaseModel
{
    use HasFactory, SoftDeletes, ScopedByCompanyAndOutlet;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_ons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'outlet_id',
        'name',
        'price',
    ];

    /**
     * The attributes that are searchable in the query.
     *
     * @var array<int, string>
     */
    protected $searchables = [
        'name',
        'price',
    ];

    /**
     * The columns that are searchable in the query.
     *
     * @var array<string, string>
     */
    protected $searchableColumns = [
        'company_id' => '=',
        'outlet_id' => '=',
        'name' => 'LIKE',
        'price' => 'LIKE',
    ];

    /**
     * Get the company of the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the outlet of the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
