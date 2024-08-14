<?php

namespace App\Models;

use App\Traits\DefaultActivityLogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends BaseModel
{
    use HasFactory, SoftDeletes, DefaultActivityLogOptions;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outlets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'name',
        'address',
        'phone',
    ];

    /**
     * Get the company that owns the outlet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
