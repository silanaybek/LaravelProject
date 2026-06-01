<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik',    'description' => 'Telefon, bilgisayar, tablet ve daha fazlası'],
            ['name' => 'Giyim',         'description' => 'Erkek, kadın ve çocuk giyim ürünleri'],
            ['name' => 'Ev & Yaşam',    'description' => 'Ev dekorasyonu ve yaşam ürünleri'],
            ['name' => 'Spor',          'description' => 'Spor ekipmanları ve aksesuarlar'],
            ['name' => 'Kitap',         'description' => 'Roman, bilim, eğitim ve daha fazlası'],
            ['name' => 'Kozmetik',      'description' => 'Cilt bakımı ve güzellik ürünleri'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
                'status'      => true,
            ]);
        }
    }
}
