<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'store_name'         => 'required|string|max:100',
            'store_logo'         => 'nullable|image',
            'delete_store_logo'  => 'nullable|boolean',
            'wa_number'          => 'required|string|max:20',
            'address'            => 'required|string',
            'opening_hours'      => 'required|string',
            'shipping_info'      => 'required|string',
            'maps_embed_url'     => 'nullable|string',
            'branches'           => 'nullable|string',
            'instagram'          => 'nullable|url',
            'facebook'           => 'nullable|url',
            
            'hero_tagline'       => 'nullable|string|max:100',
            'hero_headline'      => 'nullable|string|max:150',
            'hero_sub'           => 'nullable|string',
            'hero_bg_image'      => 'nullable|image',
            
            'stat_1_val'         => 'required|string|max:50',
            'stat_1_lbl'         => 'required|string|max:100',
            'stat_2_val'         => 'required|string|max:50',
            'stat_2_lbl'         => 'required|string|max:100',
            'stat_3_val'         => 'required|string|max:50',
            'stat_3_lbl'         => 'required|string|max:100',
            'stat_4_val'         => 'required|string|max:50',
            'stat_4_lbl'         => 'required|string|max:100',
            
            'about_headline'     => 'required|string|max:200',
            'about_sub'          => 'nullable|string',
            'about_image'        => 'nullable|image',
            'about_title_detail' => 'required|string|max:200',
            'about_desc_1'       => 'required|string',
            'about_desc_2'       => 'nullable|string',
            
            'about_h1_icon'      => 'nullable|string|max:50',
            'about_h1_title'     => 'nullable|string|max:100',
            'about_h1_desc'      => 'nullable|string|max:200',
            'about_h2_icon'      => 'nullable|string|max:50',
            'about_h2_title'     => 'nullable|string|max:100',
            'about_h2_desc'      => 'nullable|string|max:200',
            'about_h3_icon'      => 'nullable|string|max:50',
            'about_h3_title'     => 'nullable|string|max:100',
            'about_h3_desc'      => 'nullable|string|max:200',
            'about_h4_icon'      => 'nullable|string|max:50',
            'about_h4_title'     => 'nullable|string|max:100',
            'about_h4_desc'      => 'nullable|string|max:200',
            
            'about_c1_icon'      => 'nullable|string|max:50',
            'about_c1_title'     => 'nullable|string|max:100',
            'about_c1_desc'      => 'nullable|string|max:300',
            'about_c2_icon'      => 'nullable|string|max:50',
            'about_c2_title'     => 'nullable|string|max:100',
            'about_c2_desc'      => 'nullable|string|max:300',
            'about_c3_icon'      => 'nullable|string|max:50',
            'about_c3_title'     => 'nullable|string|max:100',
            'about_c3_desc'      => 'nullable|string|max:300',
            
            'cta_headline'       => 'nullable|string|max:200',
            'cta_sub'            => 'nullable|string',
        ]);

        $keys = [
            'store_name', 'wa_number', 'address', 'opening_hours', 'shipping_info', 'maps_embed_url', 'branches',
            'instagram', 'facebook', 'hero_tagline', 'hero_headline', 'hero_sub',
            'stat_1_val', 'stat_1_lbl', 'stat_2_val', 'stat_2_lbl', 'stat_3_val', 'stat_3_lbl', 'stat_4_val', 'stat_4_lbl',
            'about_headline', 'about_sub', 'about_title_detail', 'about_desc_1', 'about_desc_2',
            'about_h1_icon', 'about_h1_title', 'about_h1_desc', 'about_h2_icon', 'about_h2_title', 'about_h2_desc',
            'about_h3_icon', 'about_h3_title', 'about_h3_desc', 'about_h4_icon', 'about_h4_title', 'about_h4_desc',
            'about_c1_icon', 'about_c1_title', 'about_c1_desc', 'about_c2_icon', 'about_c2_title', 'about_c2_desc',
            'about_c3_icon', 'about_c3_title', 'about_c3_desc', 'cta_headline', 'cta_sub',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        // Handle File Uploads & Deletion
        if ($request->has('delete_store_logo') && $request->input('delete_store_logo') == 1) {
            Setting::set('store_logo', null);
        } elseif ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            $store_logo_url = asset('uploads/settings/' . $filename);
            Setting::set('store_logo', $store_logo_url);
        }

        if ($request->hasFile('hero_bg_image')) {
            $file = $request->file('hero_bg_image');
            $filename = 'hero_bg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            $hero_bg_image_url = asset('uploads/settings/' . $filename);
            Setting::set('hero_bg_image', $hero_bg_image_url);
        }

        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $filename = 'about_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            $about_image_url = asset('uploads/settings/' . $filename);
            Setting::set('about_image', $about_image_url);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
