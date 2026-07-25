<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class ProfileApiController extends Controller
{
    /**
     * Common CORS headers for API responses.
     */
    private array $corsHeaders = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
    ];

    /**
     * Get complete store profile information.
     * Endpoint: GET /api/profile
     */
    public function profile(): JsonResponse
    {
        $settings = Setting::all()->keyBy('key');

        $getSettingVal = function (string $key, $default = '') use ($settings) {
            return isset($settings[$key]) ? $settings[$key]->value : $default;
        };

        $waNumber = $getSettingVal('wa_number');
        $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);

        // Decode branches JSON safely
        $branchesRaw = $getSettingVal('branches', '[]');
        $branches = json_decode($branchesRaw, true);
        if (!is_array($branches)) {
            $branches = [];
        }

        $profileData = [
            'store' => [
                'name'           => $getSettingVal('store_name', 'Pusat Kurma'),
                'logo'           => $getSettingVal('store_logo'),
                'wa_number'      => $waNumber,
                'whatsapp_url'   => $cleanWa ? "https://wa.me/{$cleanWa}" : '',
                'opening_hours'  => $getSettingVal('opening_hours'),
                'address'        => $getSettingVal('address'),
                'shipping_info'  => $getSettingVal('shipping_info'),
                'maps_embed_url' => $getSettingVal('maps_embed_url'),
                'social_media'   => [
                    'instagram' => $getSettingVal('instagram'),
                    'facebook'  => $getSettingVal('facebook'),
                ],
                'branches'       => $branches,
            ],
            'hero_banner' => [
                'tagline'          => $getSettingVal('hero_tagline'),
                'headline'         => $getSettingVal('hero_headline'),
                'sub_headline'     => $getSettingVal('hero_sub'),
                'background_image' => $getSettingVal('hero_bg_image'),
            ],
            'stats' => [
                [
                    'label' => $getSettingVal('stat_1_lbl'),
                    'value' => $getSettingVal('stat_1_val'),
                ],
                [
                    'label' => $getSettingVal('stat_2_lbl'),
                    'value' => $getSettingVal('stat_2_val'),
                ],
                [
                    'label' => $getSettingVal('stat_3_lbl'),
                    'value' => $getSettingVal('stat_3_val'),
                ],
                [
                    'label' => $getSettingVal('stat_4_lbl'),
                    'value' => $getSettingVal('stat_4_val'),
                ],
            ],
            'about' => [
                'headline'      => $getSettingVal('about_headline'),
                'title_detail'  => $getSettingVal('about_title_detail'),
                'sub_headline'  => $getSettingVal('about_sub'),
                'description_1' => $getSettingVal('about_desc_1'),
                'description_2' => $getSettingVal('about_desc_2'),
                'image'         => $getSettingVal('about_image'),
                'highlights'    => [
                    [
                        'icon'  => $getSettingVal('about_h1_icon'),
                        'title' => $getSettingVal('about_h1_title'),
                        'desc'  => $getSettingVal('about_h1_desc'),
                    ],
                    [
                        'icon'  => $getSettingVal('about_h2_icon'),
                        'title' => $getSettingVal('about_h2_title'),
                        'desc'  => $getSettingVal('about_h2_desc'),
                    ],
                    [
                        'icon'  => $getSettingVal('about_h3_icon'),
                        'title' => $getSettingVal('about_h3_title'),
                        'desc'  => $getSettingVal('about_h3_desc'),
                    ],
                    [
                        'icon'  => $getSettingVal('about_h4_icon'),
                        'title' => $getSettingVal('about_h4_title'),
                        'desc'  => $getSettingVal('about_h4_desc'),
                    ],
                ],
                'trust_cards' => [
                    [
                        'icon'  => $getSettingVal('about_c1_icon'),
                        'title' => $getSettingVal('about_c1_title'),
                        'desc'  => $getSettingVal('about_c1_desc'),
                    ],
                    [
                        'icon'  => $getSettingVal('about_c2_icon'),
                        'title' => $getSettingVal('about_c2_title'),
                        'desc'  => $getSettingVal('about_c2_desc'),
                    ],
                    [
                        'icon'  => $getSettingVal('about_c3_icon'),
                        'title' => $getSettingVal('about_c3_title'),
                        'desc'  => $getSettingVal('about_c3_desc'),
                    ],
                ],
            ],
            'cta_banner' => [
                'headline'     => $getSettingVal('cta_headline'),
                'sub_headline' => $getSettingVal('cta_sub'),
            ],
        ];

        return response()->json([
            'status'  => 'success',
            'message' => 'Data profil toko berhasil dimuat',
            'data'    => $profileData,
        ], 200, $this->corsHeaders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get active products catalog.
     * Endpoint: GET /api/products
     */
    public function products(): JsonResponse
    {
        $products = Product::active()->get()->map(function ($product) {
            return [
                'id'              => $product->id,
                'name'            => $product->name,
                'origin'          => $product->origin,
                'description'     => $product->description,
                'price'           => (float) $product->price,
                'formatted_price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
                'old_price'       => $product->old_price ? (float) $product->old_price : null,
                'formatted_old_price' => $product->old_price ? 'Rp ' . number_format($product->old_price, 0, ',', '.') : null,
                'badge_label'     => $product->badge_label,
                'badge_class'     => $product->badge_class,
                'image_url'       => $product->image_url,
                'wa_text'         => $product->wa_text,
                'unit'            => $product->unit,
                'is_featured'     => (bool) $product->is_featured,
            ];
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Daftar produk berhasil dimuat',
            'total'   => count($products),
            'data'    => $products,
        ], 200, $this->corsHeaders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get customer testimonials.
     * Endpoint: GET /api/testimonials
     */
    public function testimonials(): JsonResponse
    {
        $testimonials = Testimonial::active()->get()->map(function ($item) {
            return [
                'id'           => $item->id,
                'name'         => $item->name,
                'initials'     => $item->initials,
                'location'     => $item->location,
                'avatar_color' => $item->avatar_color,
                'review'       => $item->review,
            ];
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Daftar testimoni berhasil dimuat',
            'total'   => count($testimonials),
            'data'    => $testimonials,
        ], 200, $this->corsHeaders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get combined store profile, products, and testimonials in a single payload.
     * Endpoint: GET /api/all
     */
    public function all(): JsonResponse
    {
        $profileResponse = $this->profile()->getData(true);
        $productsResponse = $this->products()->getData(true);
        $testimonialsResponse = $this->testimonials()->getData(true);

        return response()->json([
            'status'  => 'success',
            'message' => 'Seluruh data profil, produk, dan testimoni berhasil dimuat',
            'data'    => [
                'profile'      => $profileResponse['data'] ?? [],
                'products'     => $productsResponse['data'] ?? [],
                'testimonials' => $testimonialsResponse['data'] ?? [],
            ],
        ], 200, $this->corsHeaders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
