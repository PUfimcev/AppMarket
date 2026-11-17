<?php

namespace Database\Seeders;

use App\DTO\CreateCategoryDTO;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalog = [
            'Mac' => [
                'name' => 'Mac',
                'description' => 'Notebooks and desktops with Apple silicon — updated at the September 2026 event with M5 across key models.',
                'new_text' => 'New',
                'children' => [
                    'MacBook Air' => [
                        'name' => 'MacBook Air',
                        'description' => 'Fanless 13" and 15" laptops with M5, Center Stage camera, and all-day battery for work and travel.',
                        'new_text' => 'New',
                    ],
                    'MacBook Pro' => [
                        'name' => 'MacBook Pro',
                        'description' => '14" and 16" Pro machines with M5 Pro and M5 Max, Nano-texture option, and HDMI 2.2 for creators.',
                        'new_text' => 'New 14” with M5',
                    ],
                    'iMac' => [
                        'name' => 'iMac',
                        'description' => '24" 4.5K Retina all-in-one with M5, updated spatial-audio speakers, and color-matched accessories.',
                        'new_text' => 'New',
                    ],
                    'Mac mini' => [
                        'name' => 'Mac mini',
                        'description' => 'Compact M5 and M5 Pro desktop with front USB-C, ideal for developers and HTPC setups.',
                        'new_text' => null,
                    ],
                    'Mac Studio' => [
                        'name' => 'Mac Studio',
                        'description' => 'Workstation-class box with M5 Ultra for rendering, Xcode builds, and multi-track audio production.',
                        'new_text' => null,
                    ],
                ],
            ],
            'iPhone' => [
                'name' => 'iPhone',
                'description' => 'iPhone 18 family announced September 2026 — A20 chips, iOS 27, and expanded Apple Intelligence on every model.',
                'new_text' => 'New',
                'children' => [
                    'iPhone 18' => [
                        'name' => 'iPhone 18',
                        'description' => '6.3-inch Super Retina XDR, dual Fusion cameras, and A20 for the core iPhone experience.',
                        'new_text' => null,
                    ],
                    'iPhone 18 Plus' => [
                        'name' => 'iPhone 18 Plus',
                        'description' => '6.9-inch display, larger battery, same A20 performance as iPhone 18 in a bigger form factor.',
                        'new_text' => null,
                    ],
                    'iPhone 18 Pro' => [
                        'name' => 'iPhone 18 Pro',
                        'description' => 'Grade 5 titanium frame, triple-camera array with 48 MP main, ProMotion 1–120 Hz, and Action button — flagship Pro tier from September 2026.',
                        'new_text' => 'New',
                    ],
                    'iPhone 18 Pro Max' => [
                        'name' => 'iPhone 18 Pro Max',
                        'description' => 'Largest Pro display, best battery in the lineup, and the full pro video stack including 4K 120 fps Dolby Vision.',
                        'new_text' => 'New',
                    ],
                ],
            ],
            'iPad' => [
                'name' => 'iPad',
                'description' => 'iPad portfolio refreshed through 2026 — M5 iPad Pro at the fall event, strong Air and mini options for every budget.',
                'new_text' => null,
                'children' => [
                    'iPad Pro' => [
                        'name' => 'iPad Pro',
                        'description' => 'Ultra-thin tandem OLED tablets with M5, faster Thunderbolt, and Apple Pencil hover for pro workflows.',
                        'new_text' => null,
                    ],
                    'iPad Air' => [
                        'name' => 'iPad Air',
                        'description' => 'M4 Air in 11" and 13" — balanced power for notes, illustration, and iPadOS multi-window work.',
                        'new_text' => null,
                    ],
                    'iPad Mini' => [
                        'name' => 'iPad Mini',
                        'description' => '8.3-inch A18 Pro tablet with Apple Pencil Pro and cellular option for field and travel use.',
                        'new_text' => null,
                    ],
                ],
            ],
            'Apple Watch' => [
                'name' => 'Apple Watch',
                'description' => 'watchOS 14 watches from the September 2026 event — Series 13 for daily wear and Ultra 4 for endurance sports.',
                'new_text' => 'New',
                'children' => [
                    'Apple Watch Series 13' => [
                        'name' => 'Apple Watch Series 13',
                        'description' => 'Thinner case, brighter wide-angle OLED, advanced vitals sensors, and faster charge to 80% in about 30 minutes.',
                        'new_text' => 'New',
                    ],
                    'Apple Watch Ultra 4' => [
                        'name' => 'Apple Watch Ultra 4',
                        'description' => '49 mm titanium adventure watch with longer LTE battery, precision dual-frequency GPS, depth app to 40 m, and brighter alpine display — announced September 2026.',
                        'new_text' => 'New',
                    ],
                ],
            ],
            'AirPods' => [
                'name' => 'AirPods',
                'description' => 'Hearing and spatial audio lineup updated ahead of holiday 2026 — new Pro tier at the September event.',
                'new_text' => 'New',
                'children' => [
                    'AirPods Pro 3' => [
                        'name' => 'AirPods Pro 3',
                        'description' => 'Third-gen in-ear ANC with improved fit kits, clinical-grade hearing aid features where licensed, and USB-C MagSafe case.',
                        'new_text' => 'New',
                    ],
                    'AirPods Max' => [
                        'name' => 'AirPods Max',
                        'description' => 'Over-ear aluminum headphones with USB-C charging, personalized spatial audio, and new seasonal colors for 2026.',
                        'new_text' => null,
                    ],
                    'AirPods 5' => [
                        'name' => 'AirPods 5',
                        'description' => 'Open-fit earbuds with optional ANC tier, Conversation Boost, and hands-free Siri on iOS 27.',
                        'new_text' => null,
                    ],
                ],
            ],
            'TV & Home' => [
                'name' => 'TV & Home',
                'description' => 'Living-room and HomeKit gear with tvOS 20 and Matter 1.4 support — compatible with September 2026 iPhone and Watch features.',
                'new_text' => 'tvOS 20; Home app updates 2026.',
                'children' => [
                    'Apple TV 4K' => [
                        'name' => 'Apple TV 4K',
                        'description' => 'Set-top with A18 Pro, Wi‑Fi 7, Thread border router, and Siri Remote with Find My for streaming and smart-home hub duty.',
                        'new_text' => 'New',
                    ],
                    'HomePod' => [
                        'name' => 'HomePod',
                        'description' => 'Full-range smart speaker with room-aware EQ, stereo pairs, and intercom tied to iOS 27.',
                        'new_text' => null,
                    ],
                    'HomePod mini' => [
                        'name' => 'HomePod mini',
                        'description' => 'Compact hub for HomeKit, Thread, and Siri in bedrooms — multi-room audio with Apple Music and AirPlay.',
                        'new_text' => null,
                    ],
                ],
            ],
        ];

        foreach ($catalog as $meta) {
            $parentDto = CreateCategoryDTO::from($meta);
            $parent = Category::factory()->parent($parentDto)->create();

            foreach ($meta['children'] as $metaChild) {
                $childDto = CreateCategoryDTO::from($metaChild, $parent->id);
                Category::factory()->child($childDto, $parent->id)->create();
            }
        }
    }
}
