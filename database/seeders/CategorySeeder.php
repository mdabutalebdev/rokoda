<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->update([
            'is_active'    => false,
            'show_in_nav'  => false,
            'show_on_home' => false,
        ]);

        // name_en, name_bn, slug, promo_image (absolute URL or local path), icon, sort_order
        $categories = [
            [
                'Electronics & Gadgets',
                'ইলেকট্রনিক্স ও গ্যাজেট',
                'electronics',
                'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-laptop',
                1,
            ],
            [
                'Fashion & Clothing',
                'পোশাক ও ফ্যাশন',
                'fashion',
                'https://images.unsplash.com/photo-1445205170230-053b83016050?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-shirt',
                2,
            ],
            [
                'Home & Kitchen',
                'ঘর ও রান্নাঘর',
                'home-kitchen',
                'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-house',
                3,
            ],
            [
                'Beauty & Health',
                'সৌন্দর্য ও স্বাস্থ্য',
                'beauty-health',
                'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-spa',
                4,
            ],
            [
                'Sports & Fitness',
                'স্পোর্টস ও ফিটনেস',
                'sports-fitness',
                'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-dumbbell',
                5,
            ],
            [
                'Bags & Luggage',
                'ব্যাগ ও লাগেজ',
                'bags-luggage',
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-bag-shopping',
                6,
            ],
            [
                'Watches & Accessories',
                'ঘড়ি ও অ্যাক্সেসরিজ',
                'watches-accessories',
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-clock',
                7,
            ],
            [
                'Toys & Kids',
                'শিশু পণ্য ও খেলনা',
                'toys-kids',
                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=900&h=400&fit=crop&auto=format&q=80',
                'fa-solid fa-child',
                8,
            ],
        ];

        foreach ($categories as [$en, $bn, $slug, $promo, $icon, $order]) {
            Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name_en'      => $en,
                    'name_bn'      => $bn,
                    'promo_image'  => $promo,
                    'icon'         => $icon,
                    'sort_order'   => $order,
                    'show_in_nav'  => false,
                    'show_on_home' => true,
                    'is_active'    => true,
                    'parent_id'    => null,
                ]
            );
        }
    }
}
