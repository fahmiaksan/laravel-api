<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory(10)->create();

        Category::create([
            'name' => 'Laptop',
            'slug' => 'laptop',
            'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
        ]);

        Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'image' => 'https://plus.unsplash.com/premium_photo-1679056835084-7f21e64a3402?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ]);

        Category::create([
            'name' => 'T-Shirt',
            'slug' => 't-shirt',
            'image' => 'https://plus.unsplash.com/premium_photo-1673356301514-2cad91907f74?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ]);

        Category::create([
            'name' => 'Mens Clothing',
            'slug' => 'mens-clothing',
            'image' => 'https://images.unsplash.com/photo-1578142866716-12c8957d3dc7?q=80&w=1390&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ]);

        Category::create([
            'name' => 'Womens Clothing',
            'slug' => 'womens-clothing',
            'image' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'IdeaPad Slim 3 (14", Gen 8)',
            'price' => 500000,
            'stock' => 10,
            'description' => 'IdeaPad Slim 3 (14", Gen 8) with 15.6" FHD Touch Display',
            'image' => 'https://p4-ofp.static.pub//fes/cms/2024/09/13/spzmghk7e1tv951ptfc3rnxk53xc92310131.png'
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 2,
            'name' => 'Hoodies',
            'price' => 300000,
            'stock' => 41,
            'description' => 'Hoodies with 100% cotton',
            'image' => 'https://plus.unsplash.com/premium_photo-1673356302169-574db56b52cd?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 3,
            'name' => 'T-Shirt Regular Fit',
            'price' => 100000,
            'stock' => 166,
            'description' => 'T-Shirt Regular Fit with 100% cotton and soft fabric',
            'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 4,
            'name' => 'Christian Dior Fit Reguler',
            'price' => 610000,
            'stock' => 16,
            'description' => 'Christian Dior Fit Reguler Premium with 100% cotton and soft fabric',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbLi7kludqedqbIuCSanJ_AW7jH6-NFqs0tQ&s'
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 5,
            'name' => 'Gucci Italic',
            'price' => 400000,
            'stock' => 66,
            'description' => 'Gucci Italic Premium with 100% cotton and soft fabric',
            'image' => 'https://content.italic.com/049efd6c-dbbd-4ad8-ab6f-1603f22e2a6d.jpeg?w=1200&h=900&ixlib=react-9.8.0'
        ]);
    }
}
