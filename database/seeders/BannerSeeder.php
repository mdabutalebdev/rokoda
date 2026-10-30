<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::truncate();

        $banners = [
            // Hero slider — main homepage banner
            [
                'title'      => 'বিশেষ অফার — ৫০% ছাড়',
                'image'      => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1400&h=500&fit=crop&auto=format&q=80',
                'link'       => '/shop',
                'type'       => 'hero',
                'sort_order' => 1,
            ],
            [
                'title'      => 'নতুন কালেকশন এসেছে',
                'image'      => 'https://images.unsplash.com/photo-1483985988738-f6d6ede9e7de?w=1400&h=500&fit=crop&auto=format&q=80',
                'link'       => '/shop?category=fashion',
                'type'       => 'hero',
                'sort_order' => 2,
            ],
            [
                'title'      => 'সেরা ইলেকট্রনিক্স ডিল',
                'image'      => 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=1400&h=500&fit=crop&auto=format&q=80',
                'link'       => '/shop?category=electronics',
                'type'       => 'hero',
                'sort_order' => 3,
            ],
            // Left promo banner
            [
                'title'      => 'ফ্যাশন সেল',
                'image'      => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=500&h=350&fit=crop&auto=format&q=80',
                'link'       => '/shop?category=fashion',
                'type'       => 'left',
                'sort_order' => 1,
            ],
            // Right promo banner
            [
                'title'      => 'হোম অ্যাপ্লায়েন্স',
                'image'      => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=500&h=350&fit=crop&auto=format&q=80',
                'link'       => '/shop?category=home-kitchen',
                'type'       => 'right',
                'sort_order' => 1,
            ],
        ];

        foreach ($banners as $b) {
            Banner::create($b);
        }
    }
}
