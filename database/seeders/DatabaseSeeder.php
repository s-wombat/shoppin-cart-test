<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(2)->create();

        // Product::factory(10)->create();
        // Product::factory()->count(10)->create();

        User::factory()->create(['id' => 1, 'name' => 'Test User', 'email' => 'test@example.com', 'password' => bcrypt('password')]);
        Product::factory(10)->create();

        // Product::factory(10)->create([
        //     'name' => fake()->words(3, true), // Генерируем название из 3 слов
        //     'description' => fake()->paragraph(), // Генерируем абзац текста
        //     'price' => fake()->randomFloat(2, 10, 1000), // Генерируем цену от 10 до 1000 с двумя знаками после запятой
        //     'image' => fake()->imageUrl(640, 480, 'products', true), // Генерируем URL изображения (можно заменить на путь к заглушке)
        // ]);
    }
}
