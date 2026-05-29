<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'store_name',         'value' => 'Pusat Kurma Premium Cianjur'],
            ['key' => 'wa_number',          'value' => '6281234567890'],
            ['key' => 'address',            'value' => 'Jl. Merdeka No. 45, Kel. Solokpandan, Kec. Cianjur, Kab. Cianjur, Jawa Barat 43214'],
            ['key' => 'opening_hours',      'value' => 'Senin–Jumat: 08.00–20.00 WIB | Sabtu: 08.00–17.00 WIB'],
            ['key' => 'shipping_info',      'value' => 'Antar gratis area Cianjur kota (min. order 500g). Pengiriman seluruh Indonesia via JNE, J&T, SiCepat.'],
            ['key' => 'maps_embed_url',     'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15837.356714929936!2d107.13403!3d-6.82185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68a96e1b5a9cf9%3A0x20e0d4987d91a09c!2sCianjur%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid'],
            ['key' => 'instagram',          'value' => 'https://instagram.com/pusatkurmacianjur'],
            ['key' => 'facebook',           'value' => 'https://facebook.com/pusatkurmacianjur'],
            
            // Hero section
            ['key' => 'hero_tagline',       'value' => 'Kurma Impor Terpercaya · Cianjur'],
            ['key' => 'hero_headline',      'value' => 'Kurma Premium Asli & Terjamin'],
            ['key' => 'hero_sub',           'value' => 'Nikmati cita rasa kurma pilihan terbaik — manis alami, higienis, dan autentik. Tersedia dalam berbagai varian premium untuk kebutuhan keluarga, oleh-oleh, hingga acara spesial Anda.'],
            ['key' => 'hero_bg_image',      'value' => 'https://images.unsplash.com/photo-1571680322279-a226e6a4cc2a?w=1600&q=80&auto=format&fit=crop'],
            
            // Statistics
            ['key' => 'stat_1_val',         'value' => '10+'],
            ['key' => 'stat_1_lbl',         'value' => 'Tahun Berpengalaman'],
            ['key' => 'stat_2_val',         'value' => '2.300+'],
            ['key' => 'stat_2_lbl',         'value' => 'Pelanggan Setia'],
            ['key' => 'stat_3_val',         'value' => '15+'],
            ['key' => 'stat_3_lbl',         'value' => 'Varian Kurma Premium'],
            ['key' => 'stat_4_val',         'value' => '100%'],
            ['key' => 'stat_4_lbl',         'value' => 'Produk Halal & Autentik'],
            
            // About Us
            ['key' => 'about_headline',     'value' => 'Kepercayaan yang Dibangun Sejak Puluhan Tahun'],
            ['key' => 'about_sub',          'value' => 'Kami bukan sekadar toko kurma. Kami adalah mitra Anda dalam menghadirkan kelezatan, kebaikan, dan keberkahan dari buah terbaik bumi Allah.'],
            ['key' => 'about_image',        'value' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=800&q=80&auto=format&fit=crop'],
            ['key' => 'about_title_detail', 'value' => 'Menghadirkan Kurma Terbaik Langsung ke Tangan Anda'],
            ['key' => 'about_desc_1',       'value' => 'Pusat Kurma Premium Cianjur berkomitmen menghadirkan kurma impor berkualitas tinggi langsung dari Arab Saudi, Tunisia, dan Mesir. Setiap buah kurma kami dipilih secara cermat, dikemas secara higienis, dan dijamin keasliannya.'],
            ['key' => 'about_desc_2',       'value' => 'Berlokasi strategis di Cianjur, kami melayani pembelian eceran maupun grosir untuk kebutuhan pribadi, hampers Lebaran, pernikahan, hingga oleh-oleh haji dan umrah.'],
            
            // About Highlights
            ['key' => 'about_h1_icon',      'value' => '🌿'],
            ['key' => 'about_h1_title',     'value' => '100% Organik'],
            ['key' => 'about_h1_desc',      'value' => 'Tanpa pengawet buatan'],
            ['key' => 'about_h2_icon',      'value' => '🛡️'],
            ['key' => 'about_h2_title',     'value' => 'Bersertifikat Halal'],
            ['key' => 'about_h2_desc',      'value' => 'Dijamin MUI & BPOM'],
            ['key' => 'about_h3_icon',      'value' => '✈️'],
            ['key' => 'about_h3_title',     'value' => 'Langsung Impor'],
            ['key' => 'about_h3_desc',      'value' => 'Arab, Tunisia, Mesir'],
            ['key' => 'about_h4_icon',      'value' => '📦'],
            ['key' => 'about_h4_title',     'value' => 'Kemasan Premium'],
            ['key' => 'about_h4_desc',      'value' => 'Higienis & elegan'],
            
            // About Trust Cards
            ['key' => 'about_c1_icon',      'value' => '🌴'],
            ['key' => 'about_c1_title',     'value' => 'Stok Selalu Fresh'],
            ['key' => 'about_c1_desc',      'value' => 'Produk kami selalu diperbarui secara berkala untuk memastikan kesegaran dan kualitas terbaik setiap saat.'],
            ['key' => 'about_c2_icon',      'value' => '🧼'],
            ['key' => 'about_c2_title',     'value' => 'Penanganan Higienis'],
            ['key' => 'about_c2_desc',      'value' => 'Proses sortir, pengemasan, hingga pengiriman dilakukan dengan standar kebersihan dan higienitas yang ketat.'],
            ['key' => 'about_c3_icon',      'value' => '💚'],
            ['key' => 'about_c3_title',     'value' => 'Amanah & Jujur'],
            ['key' => 'about_c3_desc',      'value' => 'Kami menjual apa yang kami janjikan. Tidak ada pemalsuan produk. Kepercayaan adalah segalanya.'],
            
            // CTA Banner
            ['key' => 'cta_headline',       'value' => 'Siap Order Kurma Premium Terbaik? 🌴'],
            ['key' => 'cta_sub',            'value' => 'Hubungi kami sekarang via WhatsApp dan dapatkan konsultasi gratis seputar pilihan kurma terbaik sesuai kebutuhan & budget Anda.'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
