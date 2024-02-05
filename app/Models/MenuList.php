<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuList extends Model
{
    use HasFactory;
    public $table = "menu_list";
    protected $fillable = [
        'menu_group',
        'menu_item',
        'sort_order',
        'store_id',
    ];
}
