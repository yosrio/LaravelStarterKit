<?php

/**
 * AdminLogActivity Model
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
 * AdminLogActivity Class
 */
class AdminLogActivity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "admin_log_activity";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'activity_type',
        'activity_description',
        'activity_date',
        'activity_data',
        'user_id',
    ];
}
