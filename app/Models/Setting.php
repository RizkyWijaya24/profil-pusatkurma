<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public function getValueAttribute($value)
    {
        if (empty($value)) {
            return $value;
        }

        // Apply dynamic domain resolver only for image/logo keys
        $imageKeys = ['store_logo', 'hero_bg_image', 'about_image'];
        if (in_array($this->key, $imageKeys)) {
            // Extract the exact relative path if it contains uploads/settings/ or uploads/products/
            if (preg_match('/uploads\/(settings|products)\/.+$/i', $value, $matches)) {
                return asset($matches[0]);
            }

            // If it is already a valid absolute URL (like unsplash or external), return as-is
            if (preg_match('/^https?:/i', $value)) {
                if (!preg_match('/^https?:\/\//i', $value)) {
                    return preg_replace('/^(https?):/i', '$1://', $value);
                }
                return $value;
            }

            // Fallback for custom relative paths
            return asset($value);
        }

        return $value;
    }

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set (upsert) a setting value.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
