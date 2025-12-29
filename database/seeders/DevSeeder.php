<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->has(Cart::factory()->state(['name' => 'My cart']))->create([
            'name' => 'Vincent (admin)',
            'email' => 'vincenterhart.formateur@gmail.com',
        ]);

        User::factory()->has(Cart::factory()->state(['name' => 'My cart']))->create([
            'name' => 'Vincent (client)',
            'email' => 'vincent.erhart@laposte.net',
        ]);

        Product::factory()->count(20)->create();
    }
}
