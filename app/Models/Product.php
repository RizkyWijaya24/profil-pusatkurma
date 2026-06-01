<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'origin', 'description', 'price', 'old_price',
        'badge_label', 'badge_class', 'image_url', 'wa_text',
        'btn_class', 'unit', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function getImageUrlAttribute($value)
    {
        if (empty($value)) {
            return $value;
        }

        $url = $value;

        // Extract the exact relative path if it contains uploads/products/ or uploads/settings/
        if (preg_match('/uploads\/(products|settings)\/.+$/i', $value, $matches)) {
            $url = asset($matches[0]);
        } elseif (!preg_match('/^https?:/i', $value)) {
            // Fallback for custom relative paths
            $url = asset($value);
        }

        // Now, ensure any generated or existing absolute URL has correct double slashes
        if (preg_match('/^https?:/i', $url)) {
            if (!preg_match('/^https?:\/\//i', $url)) {
                $url = preg_replace('/^(https?):/i', '$1://', $url);
            }
        }

        return $url;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
