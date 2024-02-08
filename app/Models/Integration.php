<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;
    public $table = "integration";
    protected $fillable = [
        'token',
        'user_id',
        'token_type',
        'permssions',
        'expired_at',
    ];
}
