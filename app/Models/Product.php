<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'sku',
        'price',
        'cost_price',
        'stock',
        'image_path',
    ];

    protected function status(): Attribute
    {
        return Attribute::get(function () {
            if ($this->stock > 10) return 'aman';
            if ($this->stock >= 5) return 'menipis';
            return 'kritis';
        });
    }

    protected function profitPerUnit(): Attribute
    {
        return Attribute::get(fn () => $this->price - $this->cost_price);
    }

    protected function profitMargin(): Attribute
    {
        return Attribute::get(function () {
            if ($this->price <= 0) return 0;
            return round((($this->price - $this->cost_price) / $this->price) * 100, 1);
        });
    }

    protected function totalProfit(): Attribute
    {
        return Attribute::get(fn () => ($this->price - $this->cost_price) * $this->stock);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image_path ? Storage::url($this->image_path) : null;
        });
    }
}
