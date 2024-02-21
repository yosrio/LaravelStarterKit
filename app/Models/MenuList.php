<?php

/**
 * MenuList Model
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
 * MenuList Class
 */
class MenuList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "menu_list";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_group',
        'menu_item',
        'sort_order',
        'store_id',
    ];
}
