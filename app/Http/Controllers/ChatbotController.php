<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Handle incoming chatbot messages and generate intelligent responses.
     */
    public function message(Request $request): JsonResponse
    {
        try {
            $input = trim($request->input('message', ''));
            $msg = strtolower($input);

            if (empty($input)) {
                return response()->json([
                    'status' => 'success',
                    'reply'  => 'Halo! Ada yang bisa saya bantu terkait produk kurma dan oleh-oleh Timur Tengah di Pusat Kurma?',
                    'quick_replies' => ['Rekomendasi Kurma', 'Katalog & Harga', 'Lokasi & Jam Buka', 'COD & Pengiriman']
                ]);
            }

            // Fetch dynamic settings & products safely
            $settings = Setting::all()->pluck('value', 'key');
            $storeName = $settings['store_name'] ?? 'Pusat Kurma';
            $waNumClean = preg_replace('/[^0-9]/', '', $settings['wa_number'] ?? '6281234567890');
            $address = $settings['address'] ?? 'Jl. Dr. Muwardi No.48, Cianjur';
            $hours = $settings['opening_hours'] ?? 'Buka setiap hari jam 08.00 - 20.00 WIB';
            $shipping = $settings['shipping_info'] ?? 'Antar gratis area Cianjur kota (min 500g), COD & pengiriman seluruh Indonesia.';

            // Branch info
            $branchesRaw = json_decode($settings['branches'] ?? '[]', true);
            $branchListStr = "";
            if (is_array($branchesRaw) && !empty($branchesRaw)) {
                $branchListStr = "\n📍 **Cabang Toko Kami:**\n";
                foreach ($branchesRaw as $b) {
                    if (!empty($b['name'])) {
                        $bAddr = $b['address'] ?? '';
                        $branchListStr .= "• **{$b['name']}**: {$bAddr}\n";
                    }
                }
            }

            // ─── INTENT MATCHING ──────────────────────────────────────────

            // 1. Rekomendasi Khusus
            if (preg_match('/(rekomendasi|rekomendasikan|pilihan|terbaik|favorit)/i', $msg)) {
                $reply = "🌴 **Rekomendasi Varian Kurma Terbaik & Terfavorit:**\n\n"
                       . "1. 👑 **Kurma Sukari Raja (Al Qassim)**\n   Tekstur sangat lembut, basah, & manis legit seperti karamel. *Paling favorit keluarga!*\n\n"
                       . "2. 🌙 **Kurma Ajwa Nabi (Madinah)**\n   Kurma sunnah autentik Madinah. Manis pas, serat halus, & kaya berkah untuk kesehatan.\n\n"
                       . "3. 🌴 **Kurma Medjool Jumbo**\n   Ukuran super jumbo, daging sangat tebal, manis lezat. *Mewah untuk hampers & tamu.*\n\n"
                       . "4. 🌾 **Kurma Tunisia Tangkai**\n   Tekstur lebih renyah, manis sedang, & tidak lengket.\n\n"
                       . "Varian mana yang ingin Anda pilih?";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'quick_replies' => ['Pesan Sukari', 'Pesan Ajwa', 'Medjool Jumbo', 'Lokasi Toko'],
                    'action' => [
                        'label' => 'Konsultasi WA Admin 💬',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, saya mau minta rekomendasi kurma terbaik.")
                    ]
                ]);
            }

            // 2. Salam / Greet
            if (preg_match('/(halo|hai|hi|assalamu|salam|pagi|siang|sore|malam|bot|min|admin)/i', $msg)) {
                $reply = "Assalamu'alaikum & Selamat datang di **{$storeName}**! 🌴\n\nSaya asisten virtual siap membantu Anda. Silakan pilih atau tanyakan hal berikut:\n\n• 🌴 **Rekomendasi Varian Kurma**\n• 💰 **Daftar Harga & Katalog**\n• 📍 **Alamat & Jam Buka**\n• 🚚 **Layanan COD & Pengiriman**\n• 🕋 **Paket Oleh-Oleh Haji/Umrah**";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'quick_replies' => ['Rekomendasi Kurma', 'Katalog & Harga', 'Lokasi & Jam Buka', 'COD & Pengiriman']
                ]);
            }

            // 3. Lokasi / Alamat / Cabang / Jam Buka
            if (preg_match('/(lokasi|alamat|cabang|dimana|posisi|toko|buka|jam|operasional|map|gmaps)/i', $msg)) {
                $reply = "🏪 **Informasi Toko & Lokasi {$storeName}:**\n\n"
                       . "📍 **Alamat Utama:**\n{$address}\n\n"
                       . "⏰ **Jam Operasional:**\n{$hours}\n"
                       . $branchListStr
                       . "\n🚚 **Pengiriman:**\n{$shipping}\n\n"
                       . "Ingin pesan langsung atau konsultasi rute? Klik tombol di bawah untuk chat WA Admin!";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Chat Admin via WA 💬',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin {$storeName}, saya mau tanya rute/lokasi toko.")
                    ]
                ]);
            }

            // 4. Produk Spesifik (Sukari, Ajwa, Medjool, Tunisia, Zamzam)
            if (preg_match('/(sukari|raja|al qassim)/i', $msg)) {
                $reply = "👑 **Kurma Sukari (Sukari Raja / Al-Qassim)**\n\nKurma paling favorit di toko kami! Bertekstur sangat lembut, manis legit alami seperti karamel, dan kaya nutrisi.\n\n✨ *Cocok untuk konsumsi harian keluarga & menjaga stamina.*";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Pesan Sukari via WA 🛒',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, saya berminat pesan Kurma Sukari.")
                    ]
                ]);
            }

            if (preg_match('/(ajwa|nabi)/i', $msg)) {
                $reply = "🌙 **Kurma Ajwa (Kurma Nabi Madinah)**\n\nKurma sunnah autentik dari Madinah. Berwarna hitam pekat dengan serat khas manis pas/tidak berlebihan.\n\n✨ *Sangat disarankan untuk kesehatan, ibu hamil, & ikhtiar pengobatan sunnah.*";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Pesan Kurma Ajwa 🛒',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, saya mau tanya stok Kurma Ajwa Madinah.")
                    ]
                ]);
            }

            if (preg_match('/(medjool|jumbo|palestina|california)/i', $msg)) {
                $reply = "🌴 **Kurma Medjool Jumbo**\n\nDikenal sebagai *Raja Kurma*. Berukuran super besar (jumbo), daging buah sangat tebal, berserat halus, & manis lezat.\n\n✨ *Sangat mewah untuk sajian tamu maupun bingkisan hampers.*";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Pesan Medjool Jumbo 🛒',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, saya mau order Kurma Medjool Jumbo.")
                    ]
                ]);
            }

            if (preg_match('/(zamzam|zam zam|air zamzam)/i', $msg)) {
                $reply = "💧 **Air Zamzam Murni & Autentik**\n\nKami menyediakan Air Zamzam kemasan resmi galon/botol yang terjamin 100% keasliannya dari Tanah Suci Makkah.\n\n✨ *Cocok untuk oleh-oleh ibadah & kebutuhan kesehatan.*";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Pesan Air Zamzam 💧',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, apakah Air Zamzam masih ready stock?")
                    ]
                ]);
            }

            if (preg_match('/(haji|umroh|umrah|souvenir|hampers|paket)/i', $msg)) {
                $reply = "🕋 **Paket Oleh-Oleh Haji & Umrah**\n\nKami melayani pembuatan souvenir & hampers custom berisi Kurma, Air Zamzam, Kacang Pistachio/Almond, Kismis, Sajadah, hingga Cokelat Arab.\n\n✨ *Praktis, higienis, dan ekonomis tanpa perlu repot membawa banyak barang dari Tanah Suci.*";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Konsultasi Paket Haji/Umrah 📦',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, saya mau pesan paket oleh-oleh Haji/Umrah.")
                    ]
                ]);
            }

            // 5. Katalog / Harga / Produk umum
            if (preg_match('/(katalog|produk|harga|daftar|jual|stok|ready)/i', $msg)) {
                $productListStr = "";
                try {
                    $activeProducts = Product::active()->get();
                    if ($activeProducts && $activeProducts->count() > 0) {
                        $productListStr = "\n🛍️ **Katalog Produk Ready Stock:**\n";
                        foreach ($activeProducts->take(6) as $p) {
                            $pPrice = 'Rp ' . number_format($p->price ?? 0, 0, ',', '.');
                            $pUnit = $p->unit ?? 'pack';
                            $productListStr .= "• **{$p->name}**: {$pPrice} ({$pUnit})\n";
                        }
                    }
                } catch (\Throwable $ex) {
                    $productListStr = "";
                }

                if (empty($productListStr)) {
                    $productListStr = "\n🛍️ Kami menyediakan Kurma Sukari, Ajwa Madinah, Medjool Jumbo, Tunisia, Air Zamzam, & Kacang-kacangan Timur Tengah.";
                }

                $reply = "Berikut adalah daftar produk unggulan di **{$storeName}**:" . $productListStr . "\n\nIngin melihat detail gambar atau memesan varian tertentu?";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'quick_replies' => ['Pesan Sukari', 'Pesan Ajwa', 'Air Zamzam', 'Lokasi Toko'],
                    'action' => [
                        'label' => 'Pesan via WhatsApp Admin 💬',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, saya mau info katalog & harga lengkap.")
                    ]
                ]);
            }

            // 6. COD / Pengiriman / Ongkir
            if (preg_match('/(cod|ongkir|kirim|antar|sicepat|jne|jnt|pengiriman|bayar di tempat)/i', $msg)) {
                $reply = "🚚 **Layanan Pengiriman & COD:**\n\n"
                       . "✅ **Gratis Ongkir / Antar Langsung:** Khusus Cianjur Kota (min. order 500g).\n"
                       . "✅ **Cash On Delivery (COD):** Layanan bayar saat barang sampai untuk area Cianjur & sekitarnya.\n"
                       . "✅ **Pengiriman Luar Kota:** Melalui JNE, J&T, SiCepat, & Cargo ke seluruh wilayah Indonesia.";
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply,
                    'action' => [
                        'label' => 'Cek Ongkir via WA 🛵',
                        'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin, berapa ongkir ke lokasi saya?")
                    ]
                ]);
            }

            // 7. Default Fallback Response
            $reply = "Terima kasih telah menghubungi **{$storeName}**! 🌴\n\nAda yang bisa saya bantu terkait varian kurma, alamat toko, atau pengiriman? Anda juga dapat berkonsultasi langsung dengan Admin kami via WhatsApp.";
            return response()->json([
                'status' => 'success',
                'reply' => $reply,
                'quick_replies' => ['Rekomendasi Kurma', 'Katalog & Harga', 'Lokasi & Jam Buka', 'COD & Pengiriman'],
                'action' => [
                    'label' => 'Chat Langsung WA Admin 💬',
                    'url' => "https://api.whatsapp.com/send?phone={$waNumClean}&text=" . urlencode("Halo Admin {$storeName}, " . $input)
                ]
            ]);
        } catch (\Throwable $e) {
            Log::error('Chatbot Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            
            return response()->json([
                'status' => 'success',
                'reply'  => 'Ada yang bisa saya bantu mengenai produk kurma, lokasi toko, atau pengiriman?',
                'quick_replies' => ['Rekomendasi Kurma', 'Katalog & Harga', 'Lokasi & Jam Buka', 'COD & Pengiriman']
            ]);
        }
    }
}
