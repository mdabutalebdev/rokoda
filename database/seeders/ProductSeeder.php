<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cats = Category::pluck('id', 'slug');

        Product::query()->update(['is_active' => false]);

        // name, category_slug, image_url, price, old_price, short_desc_bn, sku_prefix
        $rows = [
            // ── Electronics ──────────────────────────────────────────────
            [
                'Samsung Galaxy A55 5G — 8GB/256GB',
                'electronics',
                'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=600&fit=crop&auto=format&q=80',
                42999, 49999,
                'স্যামসাং গ্যালাক্সি A55 — ৫G নেটওয়ার্ক, ৫০MP ক্যামেরা, ৫০০০mAh ব্যাটারি।',
            ],
            [
                'Wireless Bluetooth Earbuds — Noise Cancelling',
                'electronics',
                'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop&auto=format&q=80',
                1299, 1999,
                'নয়েজ ক্যান্সেলিং ইয়ারবাড, ৩০ ঘণ্টা ব্যাটারি লাইফ, IPX5 ওয়াটারপ্রুফ।',
            ],
            [
                'Smart Watch — Heart Rate & GPS',
                'electronics',
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=600&fit=crop&auto=format&q=80',
                3499, 4500,
                'হার্ট রেট মনিটর, GPS ট্র্যাকিং, ৭ দিনের ব্যাটারি ব্যাকআপ।',
            ],

            // ── Fashion ──────────────────────────────────────────────────
            [
                'Men\'s Premium Cotton T-Shirt',
                'fashion',
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&h=600&fit=crop&auto=format&q=80',
                599, 899,
                '১০০% কটন, সফট ও ব্রিদেবল ফেব্রিক, সব সাইজে পাওয়া যাচ্ছে।',
            ],
            [
                'Women\'s Casual Summer Dress',
                'fashion',
                'https://images.unsplash.com/photo-1539109136131-e49fd1a9413b?w=600&h=600&fit=crop&auto=format&q=80',
                1199, 1699,
                'হালকা ও আরামদায়ক সামার ড্রেস — বিভিন্ন রঙে পাওয়া যাচ্ছে।',
            ],
            [
                'Men\'s Running Sneakers — Lightweight',
                'fashion',
                'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=600&fit=crop&auto=format&q=80',
                2299, 2999,
                'লাইটওয়েট ও কুশনড সোল, দীর্ঘ ওয়াক বা রানিংয়ের জন্য আদর্শ।',
            ],

            // ── Home & Kitchen ────────────────────────────────────────────
            [
                'Non-Stick Cookware Set — 5 Pieces',
                'home-kitchen',
                'https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?w=600&h=600&fit=crop&auto=format&q=80',
                2899, 3999,
                '৫ পিস নন-স্টিক কুকওয়্যার সেট — তাপ সহনীয় হ্যান্ডেল, সহজে পরিষ্কারযোগ্য।',
            ],
            [
                'Electric Kettle — 1.8L Fast Boil',
                'home-kitchen',
                'https://images.unsplash.com/photo-1621703289009-30aaaad38f67?w=600&h=600&fit=crop&auto=format&q=80',
                1499, 1999,
                '১.৮ লিটার ক্যাপাসিটি, দ্রুত গরম করে মাত্র ৩ মিনিটে, অটো-শাটঅফ।',
            ],
            [
                'Air Purifier — HEPA Filter Room Cleaner',
                'home-kitchen',
                'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=600&h=600&fit=crop&auto=format&q=80',
                8999, 12000,
                'HEPA ফিল্টার, ৯৯.৯% ধুলো ও জীবাণু দূর করে, কম শব্দ ও কম বিদ্যুৎ খরচ।',
            ],

            // ── Beauty & Health ───────────────────────────────────────────
            [
                'Luxury Perfume For Men — 100ml',
                'beauty-health',
                'https://images.unsplash.com/photo-1541643600-f8af87787d2e?w=600&h=600&fit=crop&auto=format&q=80',
                1899, 2499,
                'দীর্ঘস্থায়ী সুগন্ধ, ১০০ml বোতল — অফিস ও স্পেশাল অকেশনের জন্য আদর্শ।',
            ],
            [
                'Vitamin C Serum — Anti-Aging Brightening',
                'beauty-health',
                'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600&h=600&fit=crop&auto=format&q=80',
                799, 1199,
                'ভিটামিন C সিরাম, ত্বক উজ্জ্বল করে, বলিরেখা কমায়, ৩০ml।',
            ],

            // ── Sports & Fitness ──────────────────────────────────────────
            [
                'Yoga Mat — Non-Slip 6mm Thick',
                'sports-fitness',
                'https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?w=600&h=600&fit=crop&auto=format&q=80',
                899, 1299,
                '৬mm পুরু নন-স্লিপ যোগা ম্যাট, পরিবেশবান্ধব উপাদান, বহনযোগ্য।',
            ],
            [
                'Official Size Football — Size 5',
                'sports-fitness',
                'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=600&h=600&fit=crop&auto=format&q=80',
                899, 1299,
                'সাইজ ৫ অফিশিয়াল ফুটবল, টেকসই পিভিসি লেদার, মাঠ ও আউটডোরের জন্য।',
            ],

            // ── Bags & Luggage ────────────────────────────────────────────
            [
                'Laptop Backpack — 15.6 inch Waterproof',
                'bags-luggage',
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&h=600&fit=crop&auto=format&q=80',
                1799, 2499,
                '১৫.৬ ইঞ্চি ল্যাপটপ কম্পার্টমেন্ট, ওয়াটারপ্রুফ, USB চার্জিং পোর্ট সহ।',
            ],

            // ── Watches & Accessories ─────────────────────────────────────
            [
                'Polarized Sunglasses — UV400 Protection',
                'watches-accessories',
                'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=600&h=600&fit=crop&auto=format&q=80',
                699, 999,
                'পোলারাইজড লেন্স, UV400 সুরক্ষা, হালকা ওজন, ছেলে ও মেয়ে উভয়ের জন্য।',
            ],
            [
                'Leather Wallet — Slim RFID Blocking',
                'watches-accessories',
                'https://images.unsplash.com/photo-1627123424584-1b3e2041ffe2?w=600&h=600&fit=crop&auto=format&q=80',
                799, 1199,
                'জেনুইন লেদার, RFID ব্লকিং, স্লিম ডিজাইন, ৮টি কার্ড স্লট।',
            ],
        ];

        $i = 0;
        foreach ($rows as [$name, $catSlug, $image, $price, $old, $shortBn]) {
            $i++;
            Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'category_id'       => $cats[$catSlug] ?? null,
                    'name'              => $name,
                    'main_image'        => $image,
                    'short_description' => $shortBn,
                    'description'       => "<p>{$shortBn}</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি। ৩ দিনের রিটার্ন পলিসি।</p>",
                    'price'             => $price,
                    'old_price'         => $old,
                    'stock'             => rand(20, 150),
                    'sku'               => 'RKD-'.str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                    'rating'            => 5,
                    'reviews_count'     => rand(5, 120),
                    'is_active'         => true,
                    'is_flash_sale'     => $i <= 4,
                    'is_featured'       => true,
                    'is_best_seller'    => $i % 2 === 0,
                    'is_new_arrival'    => $i > 10,
                    'sort_order'        => $i,
                ]
            );
        }
    }
}
