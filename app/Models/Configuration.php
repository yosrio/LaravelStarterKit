<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    public $table = "configuration";
    protected $fillable = [
        'group',
        'name',
        'value',
    ];
}
