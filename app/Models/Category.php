<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryDescription;

class Category extends Model
{
    use HasFactory;

    // protected $with = ['category_description'];

    protected $fillable = [
        'erp_id',
        'parent_id',
        'sort_order',
        'status',
        'updated_at'
    ];

    public function description(): HasMany
    {
        return $this->hasMany(CategoryDescription::class, 'category_id', 'id');
    }
}
