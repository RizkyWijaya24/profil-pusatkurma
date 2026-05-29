<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'         => 'Siti Nurhaliza',
                'initials'     => 'SN',
                'location'     => 'Cianjur Kota',
                'avatar_color' => 'bg-emerald-700',
                'review'       => '"Kurma Sukari-nya enak banget, manis alami dan ukurannya besar-besar. Kemasan juga rapi dan higienis. Sudah beli berkali-kali dan tidak pernah kecewa!"',
                'sort_order'   => 1,
            ],
            [
                'name'         => 'Ahmad Hidayat',
                'initials'     => 'AH',
                'location'     => 'Sukabumi',
                'avatar_color' => 'bg-yellow-600',
                'review'       => '"Pesen Kurma Ajwa Madinah untuk oleh-oleh umrah, dan semua orang yang diberi kurma ini langsung suka! Asli benar dari Madinah, beda rasanya dengan yang di pasaran."',
                'sort_order'   => 2,
            ],
            [
                'name'         => 'Rizki Wulandari',
                'initials'     => 'RW',
                'location'     => 'Bandung',
                'avatar_color' => 'bg-purple-700',
                'review'       => '"Hampers kurma premium-nya cantik banget untuk dijadikan hadiah Lebaran! Responsif, pengiriman cepat, dan harganya sangat worth it. Highly recommended!"',
                'sort_order'   => 3,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create($data);
        }
    }
}
