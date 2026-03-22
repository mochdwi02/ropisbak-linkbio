<?php

return [
    'brand_name' => env('LINKBIO_BRAND_NAME', 'Ropisbak 74'),
    'brand_short' => env('LINKBIO_BRAND_SHORT', 'R74'),
    'hero_badge' => env('LINKBIO_HERO_BADGE', 'Freshly toasted • Sweet comfort food'),
    'brand_description' => env('LINKBIO_BRAND_DESCRIPTION', 'Roti pisang bakar hangat dengan rasa manis yang cocok untuk teman santai kapan saja.'),
    'brand_subdescription' => env('LINKBIO_BRAND_SUBDESCRIPTION', 'Order cepat • Delivery online • Lokasi outlet'),
    'profile_image' => env('LINKBIO_PROFILE_IMAGE', 'images/images.png'),
    'footer_note' => env('LINKBIO_FOOTER_NOTE', 'Semua akses penting brand dalam satu halaman sederhana.'),

    'feature_pills' => [
        'Order WhatsApp',
        'Delivery Online',
        'Cek Lokasi',
    ],

    'theme' => [
        'bg' => '#dfc09e',
        'bg_soft' => '#f4e6d4',
        'card' => '#efd8bb',
        'surface' => '#fffdf8',
        'surface_soft' => '#f9f0e5',
        'text' => '#2f1d11',
        'muted' => '#73543b',
        'border' => '#8d6748',
        'shadow' => 'rgba(101, 67, 35, 0.18)',
        'accent' => '#c68a50',
        'accent_soft' => '#fbe2c6',
    ],

    'socials' => [
        [
            'icon' => 'bxl-instagram-alt',
            'url' => env('LINKBIO_INSTAGRAM_URL', 'https://instagram.com/ropisbak.74'),
            'label' => 'Instagram',
        ],
        [
            'icon' => 'bxl-whatsapp',
            'url' => env('LINKBIO_WHATSAPP_URL', 'https://wa.me/6283876086640'),
            'label' => 'WhatsApp',
        ],
        [
            'icon' => 'bx-map',
            'url' => env('LINKBIO_MAPS_URL', 'https://maps.google.com'),
            'label' => 'Maps',
        ],
    ],
];
