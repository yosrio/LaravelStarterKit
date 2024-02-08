<?php

/**
 * Integration Model
 *
 * PHP version 8.1
 *
 * @package  App\Models
 * @category Models
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Integration Class
 */
class Integration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "integration";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'user_id',
        'token_type',
        'permissions',
        'expired_at',
    ];
}
