<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Brand , Category ,BrandCategory};

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();

        if ($categories->isEmpty() || $brands->isEmpty()) {
            $this->command->info('No hay marcas o categorías para relacionar.');
            return;
        }



        foreach ($brands as $brand) {
            $randomCats = $categories->random(2);
            foreach ($randomCats as $category) {
                BrandCategory::create([
                    'brand_id' => $brand->id,
                    'category_id' => $category->id,
                ]);
            }
        }

    }
}
