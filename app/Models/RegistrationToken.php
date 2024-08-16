<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationToken extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registration_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'token',
        'payload',
        'expired_at',
    ];
}
