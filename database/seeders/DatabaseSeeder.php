<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create Categories
        $tactical = Category::create([
            'name' => 'Tactical Knives',
            'slug' => 'tactical-knives',
            'description' => 'Military-grade tactical knives for professionals and enthusiasts.',
        ]);

        $kitchen = Category::create([
            'name' => 'Kitchen Knives',
            'slug' => 'kitchen-knives',
            'description' => 'Professional chef knives for culinary excellence.',
        ]);

        $pocket = Category::create([
            'name' => 'Pocket Knives',
            'slug' => 'pocket-knives',
            'description' => 'Compact and portable everyday carry knives.',
        ]);

        $hunting = Category::create([
            'name' => 'Hunting Knives',
            'slug' => 'hunting-knives',
            'description' => 'Durable hunting and survival knives for outdoor adventures.',
        ]);

        // Create Tactical Knives
        Product::create([
            'category_id' => $tactical->id,
            'name' => 'Karambit Elite',
            'slug' => 'karambit-elite',
            'description' => 'Premium karambit knife with curved blade and ergonomic handle. Perfect for tactical operations and self-defense. Features a razor-sharp edge and comfortable grip.',
            'price' => 2499.00,
            'stock' => 15,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $tactical->id,
            'name' => 'Combat Tanto',
            'slug' => 'combat-tanto',
            'description' => 'Military-style tanto blade with exceptional piercing capability. Made from high-carbon steel with a non-reflective coating. Includes tactical sheath.',
            'price' => 3299.00,
            'stock' => 10,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $tactical->id,
            'name' => 'Tactical Fixed Blade',
            'slug' => 'tactical-fixed-blade',
            'description' => 'Full-tang fixed blade designed for extreme conditions. Paracord-wrapped handle and MOLLE-compatible sheath included.',
            'price' => 2899.00,
            'stock' => 20,
            'is_featured' => false,
        ]);

        // Create Kitchen Knives
        Product::create([
            'category_id' => $kitchen->id,
            'name' => 'Chef\'s Knife Pro',
            'slug' => 'chefs-knife-pro',
            'description' => '8-inch professional chef knife with German steel blade. Perfectly balanced for precision cutting. Ideal for vegetables, meat, and fish.',
            'price' => 1899.00,
            'stock' => 25,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $kitchen->id,
            'name' => 'Santoku Master',
            'slug' => 'santoku-master',
            'description' => 'Japanese-style santoku knife with Granton edge. Prevents food from sticking to blade. Perfect for slicing, dicing, and mincing.',
            'price' => 1699.00,
            'stock' => 30,
            'is_featured' => false,
        ]);

        Product::create([
            'category_id' => $kitchen->id,
            'name' => 'Paring Knife Set',
            'slug' => 'paring-knife-set',
            'description' => 'Set of 3 precision paring knives. Essential for detailed work, peeling, and trimming. Includes protective blade covers.',
            'price' => 899.00,
            'stock' => 40,
            'is_featured' => false,
        ]);

        // Create Pocket Knives
        Product::create([
            'category_id' => $pocket->id,
            'name' => 'EDC Flipper',
            'slug' => 'edc-flipper',
            'description' => 'Everyday carry folding knife with smooth flipper action. Titanium frame lock and pocket clip. Compact and reliable.',
            'price' => 1499.00,
            'stock' => 35,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $pocket->id,
            'name' => 'Classic Swiss Army',
            'slug' => 'classic-swiss-army',
            'description' => 'Multi-tool pocket knife with 12 functions. Includes scissors, screwdrivers, bottle opener, and more. Lifetime warranty.',
            'price' => 1199.00,
            'stock' => 50,
            'is_featured' => false,
        ]);

        // Create Hunting Knives
        Product::create([
            'category_id' => $hunting->id,
            'name' => 'Survival Hunter',
            'slug' => 'survival-hunter',
            'description' => 'Heavy-duty hunting knife with gut hook and saw back. Includes fire starter and leather sheath. Built for the wilderness.',
            'price' => 2199.00,
            'stock' => 18,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $hunting->id,
            'name' => 'Skinning Blade',
            'slug' => 'skinning-blade',
            'description' => 'Specialized skinning knife with curved blade. Surgical-grade steel maintains edge longer. Perfect for field dressing.',
            'price' => 1799.00,
            'stock' => 22,
            'is_featured' => false,
        ]);
    }
}
