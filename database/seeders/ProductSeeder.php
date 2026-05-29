<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Kurma Sukari Premium',
                'origin'      => 'Arab Saudi',
                'description' => 'Tekstur lembut bak karamel, manis alami tanpa rasa pahit. Favorit nomor satu keluarga Indonesia. Kaya akan vitamin dan mineral.',
                'price'       => 'Rp 85.000',
                'old_price'   => 'Rp 105.000',
                'badge_label' => '⭐ Best Seller',
                'badge_class' => 'bg-yellow-500 text-emerald-950',
                'image_url'   => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=600&q=80&auto=format&fit=crop',
                'wa_text'     => 'Halo%20Admin%20Pusat%20Kurma%20Premium%20Cianjur%2C%20saya%20mau%20pesan%20Kurma%20Sukari%20Premium.%20Mohon%20info%20total%20harga%20dan%20ongkir%20ke%20area%20Cianjur.%20Terima%20kasih%20%F0%9F%99%8F',
                'btn_class'   => 'bg-emerald-900 hover:bg-emerald-800 text-white',
                'unit'        => 'per 500 gram',
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Kurma Medjool Jumbo',
                'origin'      => 'Maroko',
                'description' => 'Raja dari segala kurma. Ukuran besar, daging tebal, dan rasa karamel yang kaya dan mewah. Cocok untuk hadiah spesial.',
                'price'       => 'Rp 145.000',
                'old_price'   => 'Rp 175.000',
                'badge_label' => '👑 Premium',
                'badge_class' => 'bg-purple-600 text-white',
                'image_url'   => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&q=80&auto=format&fit=crop',
                'wa_text'     => 'Halo%20Admin%20Pusat%20Kurma%20Premium%20Cianjur%2C%20saya%20mau%20pesan%20Kurma%20Medjool%20Jumbo.%20Mohon%20info%20total%20harga%20dan%20ongkir%20ke%20area%20Cianjur.%20Terima%20kasih%20%F0%9F%99%8F',
                'btn_class'   => 'bg-emerald-900 hover:bg-emerald-800 text-white',
                'unit'        => 'per 500 gram',
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Kurma Ajwa Madinah',
                'origin'      => 'Arab Saudi',
                'description' => 'Kurma sunnah Nabi ﷺ yang penuh berkah. Hitam pekat, bertekstur padat, rasa manis yang unik dan khas. Asli dari Madinah.',
                'price'       => 'Rp 165.000',
                'old_price'   => null,
                'badge_label' => '🕌 Madinah',
                'badge_class' => 'bg-emerald-600 text-white',
                'image_url'   => 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=600&q=80&auto=format&fit=crop',
                'wa_text'     => 'Halo%20Admin%20Pusat%20Kurma%20Premium%20Cianjur%2C%20saya%20mau%20pesan%20Kurma%20Ajwa%20Madinah.%20Mohon%20info%20total%20harga%20dan%20ongkir%20ke%20area%20Cianjur.%20Terima%20kasih%20%F0%9F%99%8F',
                'btn_class'   => 'bg-emerald-900 hover:bg-emerald-800 text-white',
                'unit'        => 'per 500 gram',
                'sort_order'  => 3,
            ],
            [
                'name'        => 'Kurma Deglet Nour',
                'origin'      => 'Tunisia',
                'description' => 'Si "cahaya terang" dari Tunisia. Warna coklat keemasan, tekstur semi-kering yang kenyal, dan rasa manis ringan yang menyegarkan.',
                'price'       => 'Rp 78.000',
                'old_price'   => null,
                'badge_label' => '🆕 Baru',
                'badge_class' => 'bg-blue-600 text-white',
                'image_url'   => 'https://images.unsplash.com/photo-1568702846914-96b305d2aaeb?w=600&q=80&auto=format&fit=crop',
                'wa_text'     => 'Halo%20Admin%20Pusat%20Kurma%20Premium%20Cianjur%2C%20saya%20mau%20pesan%20Kurma%20Deglet%20Nour.%20Mohon%20info%20total%20harga%20dan%20ongkir%20ke%20area%20Cianjur.%20Terima%20kasih%20%F0%9F%99%8F',
                'btn_class'   => 'bg-emerald-900 hover:bg-emerald-800 text-white',
                'unit'        => 'per 500 gram',
                'sort_order'  => 4,
            ],
            [
                'name'        => 'Kurma Mabroom Panjang',
                'origin'      => 'Arab Saudi',
                'description' => 'Bentuk memanjang yang cantik, kulit tipis, dan rasa manis yang seimbang dengan sentuhan sedikit asam yang menyegarkan.',
                'price'       => 'Rp 120.000',
                'old_price'   => 'Rp 148.000',
                'badge_label' => '🔥 Favorit',
                'badge_class' => 'bg-orange-500 text-white',
                'image_url'   => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=600&q=80&auto=format&fit=crop',
                'wa_text'     => 'Halo%20Admin%20Pusat%20Kurma%20Premium%20Cianjur%2C%20saya%20mau%20pesan%20Kurma%20Mabroom%20Panjang.%20Mohon%20info%20total%20harga%20dan%20ongkir%20ke%20area%20Cianjur.%20Terima%20kasih%20%F0%9F%99%8F',
                'btn_class'   => 'bg-emerald-900 hover:bg-emerald-800 text-white',
                'unit'        => 'per 500 gram',
                'sort_order'  => 5,
            ],
            [
                'name'        => 'Hampers Kurma Mix Premium',
                'origin'      => 'Paket Hemat',
                'description' => 'Kombinasi sempurna 3 varian kurma premium dalam kotak hampers elegan. Sempurna untuk Lebaran, Haji, Umrah, dan acara spesial.',
                'price'       => 'Rp 250.000',
                'old_price'   => 'Rp 320.000',
                'badge_label' => '🎁 Hampers',
                'badge_class' => 'bg-yellow-500 text-emerald-950',
                'image_url'   => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&q=80&auto=format&fit=crop',
                'wa_text'     => 'Halo%20Admin%20Pusat%20Kurma%20Premium%20Cianjur%2C%20saya%20mau%20pesan%20Hampers%20Kurma%20Mix%20Premium.%20Mohon%20info%20total%20harga%20dan%20ongkir%20ke%20area%20Cianjur.%20Terima%20kasih%20%F0%9F%99%8F',
                'btn_class'   => 'bg-yellow-500 hover:bg-yellow-400 text-emerald-950',
                'unit'        => 'per paket (1.5 kg)',
                'sort_order'  => 6,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
