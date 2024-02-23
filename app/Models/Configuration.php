<?php

/**
 * Configuration Model
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
use App\Models\Image;

/**
 * Configuration Class
 */
class Configuration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "configuration";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group',
        'name',
        'value',
    ];

    public static function storeImage($image)
    {
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/admin/images', $filename);

        // return self::create(['filename' => $filename]);
    }
}
