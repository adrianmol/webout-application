<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // protected $with = ['category_description'];

    protected $fillable = [
        'erp_category_id',
        'parent_id',
        'sort_order',
        'status',
        'updated_at',
    ];

    public function descriptions(): HasMany
    {
        return $this->hasMany(CategoryDescription::class, 'category_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_to_category', 'category_id', 'product_id');
    }
}
