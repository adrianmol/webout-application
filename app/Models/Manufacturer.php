<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'erp_id',
        'name',
        'code',
        'updated_at'
    ];
}
