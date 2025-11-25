<?php
// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description',
        'status'
    ];

    // Relasi dengan Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scope untuk kategori aktif
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
}
