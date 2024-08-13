<?php

namespace App\Models;

use App\Traits\ScopedByCompanyAndOutlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use HasFactory, SoftDeletes, ScopedByCompanyAndOutlet;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'outlet_id',
        'product_type_id',
        'name',
        'unit',
        'price',
        'fraction_quantity',
        'minimum_quantity',
        'duration_time',
        'duration_type',
        'wash',
        'dry',
        'iron',
    ];

    /**
     * The attributes that are searchable in the query.
     *
     * @var array<int, string>
     */
    protected $searchables = [
        'name',
        'price',
        'unit',
    ];

    /**
     * The columns that are searchable in the query.
     *
     * @var array<string, string>
     */
    protected $searchableColumns = [
        'company_id' => '=',
        'outlet_id' => '=',
        'product_type_id' => '=',
        'name' => 'LIKE',
        'price' => 'LIKE',
        'unit' => 'LIKE',
        'wash' => '=',
        'dry' => '=',
        'iron' => '=',
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

    /**
     * Get the type of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
}
