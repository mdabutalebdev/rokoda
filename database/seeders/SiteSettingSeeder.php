<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Rokda',
            'site_tagline' => 'Your Trusted Online Shopping in Bangladesh',
            'topbar_text' => 'Free Delivery all over Bangladesh & Cash on Delivery',
            'phone' => '+8801770-980028',
            'whatsapp' => '8801575513701',
            'email' => 'info@rokdabd.com',
            'address' => 'Banasree, Rampura, Dhaka-1219',
            'facebook' => 'https://facebook.com/rokdabd',
            'instagram' => 'https://instagram.com/rokdabd',
            'youtube' => 'https://youtube.com/@rokdabd',
            'tiktok' => 'https://tiktok.com/@rokdabd',
            'telegram' => 'https://t.me/rokdabd',
            'shipping_inside_dhaka' => '60',
            'shipping_outside_dhaka' => '120',
            'footer_text' => 'Rokda — your trusted online shopping platform delivering quality products across Bangladesh.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
