<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get the setting's value with dynamic local domain cleanup and asset wrapping.
     */
    public function getValueAttribute($value)
    {
        if (empty($value)) {
            return $value;
        }

        // Apply dynamic domain resolver only for image/logo keys
        $imageKeys = ['store_logo', 'hero_bg_image', 'about_image'];
        if (in_array($this->key, $imageKeys)) {
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

            // If it is a relative path, wrap it in asset() dynamically
            if (!preg_match('/^https?:\/\//i', $value)) {
                return asset($value);
            }
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
