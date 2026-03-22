<?php

namespace Database\Seeders;

use App\Models\BioLink;
use Illuminate\Database\Seeder;

class BioLinkSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Order Cepat via WhatsApp', 'url' => 'https://wa.me/6283876086640?text=Halo%20saya%20ingin%20order%20Ropisbak%2074', 'category' => 'Order Cepat', 'icon' => 'bx bxl-whatsapp', 'sort_order' => 1],
            ['title' => 'Pre-Order / Reservasi', 'url' => 'https://wa.me/6283876086640?text=Halo%20saya%20ingin%20pre-order%20Ropisbak%2074', 'category' => 'Order Cepat', 'icon' => 'bx bx-calendar-check', 'sort_order' => 2],
            ['title' => 'Menu & Price List', 'url' => 'https://example.com/menu-ropisbak-74', 'category' => 'Order Cepat', 'icon' => 'bx bx-food-menu', 'sort_order' => 3],

            ['title' => 'Instagram Ropisbak 74', 'url' => 'https://instagram.com/ropisbak.74', 'category' => 'Info Brand', 'icon' => 'bx bxl-instagram', 'sort_order' => 10],
            ['title' => 'Promo Hari Ini', 'url' => 'https://example.com/promo-ropisbak-74', 'category' => 'Info Brand', 'icon' => 'bx bx-purchase-tag-alt', 'sort_order' => 11],
            ['title' => 'Hubungi Admin', 'url' => 'https://wa.me/6283876086640', 'category' => 'Info Brand', 'icon' => 'bx bx-message-dots', 'sort_order' => 12],

            ['title' => 'Lokasi Outlet Utama', 'url' => 'https://maps.google.com/?q=Ropisbak+74', 'category' => 'Lokasi Outlet', 'icon' => 'bx bx-map', 'sort_order' => 20],
            ['title' => 'Google Maps', 'url' => 'https://maps.google.com/?q=Ropisbak+74', 'category' => 'Lokasi Outlet', 'icon' => 'bx bx-current-location', 'sort_order' => 21],

            ['title' => 'Order via GoFood', 'url' => 'https://gofood.link', 'category' => 'Delivery Online', 'icon' => 'bx bx-store-alt', 'sort_order' => 30],
            ['title' => 'Order via GrabFood', 'url' => 'https://food.grab.com', 'category' => 'Delivery Online', 'icon' => 'bx bx-package', 'sort_order' => 31],
        ];

        foreach ($items as $item) {
            BioLink::updateOrCreate(
                [
                    'title' => $item['title'],
                ],
                $item + ['is_active' => true]
            );
        }
    }
}
