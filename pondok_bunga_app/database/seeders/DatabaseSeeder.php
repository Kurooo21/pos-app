<?php

namespace Database\Seeders;

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
        // Admin User
        \App\Models\User::factory()->create([
            'name' => 'Kurkur Petok',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        // Menu Items
        $menus = [
            ['name' => 'Mujair Bakar', 'price' => 15000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/orange/white?text=Ikan'],
            ['name' => 'Nasi goreng', 'price' => 12000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/red/white?text=NasGor'],
            ['name' => 'Ayam bakar', 'price' => 15000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/brown/white?text=Ayam'],
            ['name' => 'Kangkung', 'price' => 10000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/green/white?text=Kangkung'],
            ['name' => 'Lele goreng', 'price' => 15000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/darkgrey/white?text=Lele'],
            ['name' => 'Gado-gado', 'price' => 10000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/yellow/black?text=Gado'],
            ['name' => 'Sayur sop', 'price' => 10000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/orange/white?text=Sop'],
            ['name' => 'Capjay', 'price' => 10000, 'category' => 'food', 'image' => 'https://placehold.co/200x150/red/white?text=Capjay'],
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }
    }
}
