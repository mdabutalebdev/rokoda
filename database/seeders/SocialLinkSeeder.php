<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            ['name' => 'Facebook', 'url' => '#', 'icon_class' => 'fa-brands fa-facebook-f', 'sort_order' => 1],
            ['name' => 'Instagram', 'url' => '#', 'icon_class' => 'fa-brands fa-instagram', 'sort_order' => 2],
            ['name' => 'YouTube', 'url' => '#', 'icon_class' => 'fa-brands fa-youtube', 'sort_order' => 3],
            ['name' => 'TikTok', 'url' => '#', 'icon_class' => 'fa-brands fa-tiktok', 'sort_order' => 4],
            ['name' => 'Telegram', 'url' => '#', 'icon_class' => 'fa-brands fa-telegram', 'sort_order' => 5],
            ['name' => 'WhatsApp', 'url' => '#', 'icon_class' => 'fa-brands fa-whatsapp', 'sort_order' => 6],
        ];

        foreach ($links as $link) {
            \App\Models\SocialLink::create($link);
        }
    }
}
