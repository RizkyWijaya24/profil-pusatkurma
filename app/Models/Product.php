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

    /**
     * Get the product's image URL with dynamic local domain cleanup and asset wrapping.
     */
    public function getImageUrlAttribute($value)
    {
        if (empty($value)) {
            return $value;
        }

        $localPatterns = [
            '/^https?:\/\/localhost(:\d+)?\//i',
            '/^https?:\/\/127\.0\.0\.1(:\d+)?\//i'
        ];

        foreach ($localPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                $relativePath = preg_replace($pattern, '', $value);
                return asset($relativePath);
            }
        }

        // If it is a relative path (not starting with http:// or https://), wrap it in asset()
        if (!preg_match('/^https?:\/\//i', $value)) {
            return asset($value);
        }

        return $value;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
