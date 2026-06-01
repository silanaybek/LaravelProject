<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id'=>1,'name'=>'Samsung Galaxy S24','price'=>32999,'discount_price'=>29999,'stock'=>15,'featured'=>true],
            ['category_id'=>1,'name'=>'iPhone 15 Pro',    'price'=>54999,'discount_price'=>null, 'stock'=>8, 'featured'=>true],
            ['category_id'=>1,'name'=>'MacBook Air M3',   'price'=>67999,'discount_price'=>64999,'stock'=>5, 'featured'=>false],
            ['category_id'=>1,'name'=>'AirPods Pro 2',    'price'=>8999, 'discount_price'=>7499, 'stock'=>20,'featured'=>false],
            ['category_id'=>2,'name'=>'Erkek Slim Fit Takım Elbise','price'=>2499,'discount_price'=>1999,'stock'=>30,'featured'=>true],
            ['category_id'=>2,'name'=>'Kadın Trençkot',   'price'=>1799,'discount_price'=>null,  'stock'=>25,'featured'=>false],
            ['category_id'=>2,'name'=>'Spor Ayakkabı',    'price'=>899, 'discount_price'=>749,  'stock'=>40,'featured'=>false],
            ['category_id'=>3,'name'=>'Ahşap Yemek Masası','price'=>4999,'discount_price'=>4299,'stock'=>10,'featured'=>true],
            ['category_id'=>3,'name'=>'LED Duvar Lambası', 'price'=>349, 'discount_price'=>null, 'stock'=>50,'featured'=>false],
            ['category_id'=>4,'name'=>'Koşu Bandı Pro',   'price'=>12999,'discount_price'=>10999,'stock'=>7,'featured'=>true],
            ['category_id'=>4,'name'=>'Yoga Matı',        'price'=>299, 'discount_price'=>null, 'stock'=>60,'featured'=>false],
            ['category_id'=>5,'name'=>'Dune - Frank Herbert','price'=>129,'discount_price'=>null,'stock'=>100,'featured'=>false],
            ['category_id'=>5,'name'=>'Sapiens - Y.N. Harari','price'=>149,'discount_price'=>119,'stock'=>80,'featured'=>false],
            ['category_id'=>6,'name'=>'Hyaluron Serum',   'price'=>599, 'discount_price'=>449,  'stock'=>35,'featured'=>true],
            ['category_id'=>6,'name'=>'Güneş Koruyucu SPF50','price'=>249,'discount_price'=>null,'stock'=>45,'featured'=>false],
        ];

        foreach ($products as $p) {
            Product::create([
                'category_id'    => $p['category_id'],
                'name'           => $p['name'],
                'slug'           => Str::slug($p['name']),
                'description'    => $p['name'] . ' - Yüksek kaliteli ürün. Hızlı kargo ve güvenli ödeme seçenekleriyle.',
                'price'          => $p['price'],
                'discount_price' => $p['discount_price'],
                'stock'          => $p['stock'],
                'featured'       => $p['featured'],
                'status'         => true,
            ]);
        }
    }
}
