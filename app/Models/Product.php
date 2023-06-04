<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'erp_product_id',
        'model',
        'sku',
        'ean',
        'mpn',
        'quantity',
        'manufacturer_id',
        'price',
        'weight',
        'status',
        'created_at',
        'updated_at',
    ];

    public function descriptions(): HasMany
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_to_category', 'product_id', 'category_id');
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'id', 'manufacturer_id');
    }
}
