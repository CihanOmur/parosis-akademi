<?php

namespace Database\Seeders;

use App\Models\Shop\Product;
use App\Models\Shop\ProductAttribute;
use App\Models\Shop\ProductAttributeValue;
use App\Models\Shop\ProductCategory;
use App\Models\Shop\ProductVariant;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        // ── Kategoriler ──────────────────────────────────────
        $catKirtasiye = ProductCategory::create([
            'name'      => ['tr' => 'Kırtasiye', 'en' => 'Stationery'],
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $catKitap = ProductCategory::create([
            'name'      => ['tr' => 'Kitaplar', 'en' => 'Books'],
            'is_active' => true,
            'sort_order' => 2,
        ]);
        $catGiyim = ProductCategory::create([
            'name'      => ['tr' => 'Giyim', 'en' => 'Clothing'],
            'is_active' => true,
            'sort_order' => 3,
        ]);
        $catTeknoloji = ProductCategory::create([
            'name'      => ['tr' => 'Teknoloji', 'en' => 'Technology'],
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // ── Nitelikler ───────────────────────────────────────
        $attrBeden = ProductAttribute::create([
            'name'      => ['tr' => 'Beden', 'en' => 'Size'],
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $attrRenk = ProductAttribute::create([
            'name'      => ['tr' => 'Renk', 'en' => 'Color'],
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Beden değerleri
        $bedenS = ProductAttributeValue::create([
            'product_attribute_id' => $attrBeden->id,
            'name'       => ['tr' => 'S', 'en' => 'S'],
            'is_active'  => true,
            'sort_order' => 1,
        ]);
        $bedenM = ProductAttributeValue::create([
            'product_attribute_id' => $attrBeden->id,
            'name'       => ['tr' => 'M', 'en' => 'M'],
            'is_active'  => true,
            'sort_order' => 2,
        ]);
        $bedenL = ProductAttributeValue::create([
            'product_attribute_id' => $attrBeden->id,
            'name'       => ['tr' => 'L', 'en' => 'L'],
            'is_active'  => true,
            'sort_order' => 3,
        ]);
        $bedenXL = ProductAttributeValue::create([
            'product_attribute_id' => $attrBeden->id,
            'name'       => ['tr' => 'XL', 'en' => 'XL'],
            'is_active'  => true,
            'sort_order' => 4,
        ]);

        // Renk değerleri
        $renkKirmizi = ProductAttributeValue::create([
            'product_attribute_id' => $attrRenk->id,
            'name'       => ['tr' => 'Kırmızı', 'en' => 'Red'],
            'color_code' => '#E53E3E',
            'is_active'  => true,
            'sort_order' => 1,
        ]);
        $renkMavi = ProductAttributeValue::create([
            'product_attribute_id' => $attrRenk->id,
            'name'       => ['tr' => 'Mavi', 'en' => 'Blue'],
            'color_code' => '#3B82F6',
            'is_active'  => true,
            'sort_order' => 2,
        ]);
        $renkSiyah = ProductAttributeValue::create([
            'product_attribute_id' => $attrRenk->id,
            'name'       => ['tr' => 'Siyah', 'en' => 'Black'],
            'color_code' => '#1A1A1A',
            'is_active'  => true,
            'sort_order' => 3,
        ]);
        $renkBeyaz = ProductAttributeValue::create([
            'product_attribute_id' => $attrRenk->id,
            'name'       => ['tr' => 'Beyaz', 'en' => 'White'],
            'color_code' => '#FFFFFF',
            'is_active'  => true,
            'sort_order' => 4,
        ]);

        // ── Ürünler ──────────────────────────────────────────

        // 1) Basit ürün — varyasyonsuz
        $p1 = Product::create([
            'name'              => ['tr' => 'Akademi Defter Seti (3\'lü)', 'en' => 'Academy Notebook Set (3-pack)'],
            'short_description' => ['tr' => 'Çizgili, kareli ve düz defter içerir.', 'en' => 'Includes lined, grid and plain notebooks.'],
            'description'       => ['tr' => 'Parosis Akademi logolu özel tasarım 3\'lü defter seti. A4 boyutunda, 100 yaprak. Dayanıklı spiralli cilt.', 'en' => 'Custom designed 3-pack notebook set with Parosis Academy logo. A4 size, 100 sheets. Durable spiral binding.'],
            'sku'               => 'DEFTER-SET-3',
            'price'             => 149.90,
            'sale_price'        => 119.90,
            'stock'             => 50,
            'manage_stock'      => true,
            'is_active'         => true,
            'sort_order'        => 1,
        ]);
        $p1->categories()->attach([$catKirtasiye->id]);

        // 2) Basit ürün — varyasyonsuz
        $p2 = Product::create([
            'name'              => ['tr' => 'Matematik Problemleri Kitabı', 'en' => 'Mathematics Problems Book'],
            'short_description' => ['tr' => 'İleri düzey matematik problemleri ve çözümleri.', 'en' => 'Advanced math problems and solutions.'],
            'description'       => ['tr' => '500+ problem içeren kapsamlı matematik kitabı. Üniversite sınavlarına hazırlık için idealdir. Detaylı çözümler bölümü mevcuttur.', 'en' => 'Comprehensive mathematics book with 500+ problems. Ideal for university entrance exam preparation. Detailed solutions section included.'],
            'sku'               => 'KITAP-MAT-001',
            'price'             => 89.90,
            'stock'             => 120,
            'manage_stock'      => true,
            'is_active'         => true,
            'sort_order'        => 2,
        ]);
        $p2->categories()->attach([$catKitap->id]);

        // 3) Basit ürün — varyasyonsuz
        $p3 = Product::create([
            'name'              => ['tr' => 'Türkçe Dilbilgisi Rehberi', 'en' => 'Turkish Grammar Guide'],
            'short_description' => ['tr' => 'Kapsamlı Türkçe dilbilgisi kaynağı.', 'en' => 'Comprehensive Turkish grammar resource.'],
            'description'       => ['tr' => 'A\'dan Z\'ye Türkçe dilbilgisi kuralları. Alıştırmalar ve sınav soruları ile pekiştirme bölümleri.', 'en' => 'Turkish grammar rules from A to Z. Practice exercises and exam questions for reinforcement.'],
            'sku'               => 'KITAP-TR-001',
            'price'             => 69.90,
            'stock'             => 80,
            'manage_stock'      => true,
            'is_active'         => true,
            'sort_order'        => 3,
        ]);
        $p3->categories()->attach([$catKitap->id]);

        // 4) Varyasyonlu ürün — Beden + Renk (Tişört)
        $p4 = Product::create([
            'name'              => ['tr' => 'Akademi Logolu Tişört', 'en' => 'Academy Logo T-Shirt'],
            'short_description' => ['tr' => '%100 pamuk, rahat kesim.', 'en' => '100% cotton, comfortable fit.'],
            'description'       => ['tr' => 'Parosis Akademi logolu özel tasarım tişört. %100 organik pamuk, 180 gr/m² kumaş. Bisiklet yaka, rahat kesim.', 'en' => 'Custom designed t-shirt with Parosis Academy logo. 100% organic cotton, 180 gsm fabric. Crew neck, comfortable fit.'],
            'sku'               => 'TISORT-AKD',
            'price'             => 199.90,
            'stock'             => 0,
            'manage_stock'      => false,
            'is_active'         => true,
            'sort_order'        => 4,
        ]);
        $p4->categories()->attach([$catGiyim->id]);

        // Tişört varyantları: Beden x Renk
        $sortOrder = 0;
        foreach ([$bedenS, $bedenM, $bedenL, $bedenXL] as $beden) {
            foreach ([$renkKirmizi, $renkMavi, $renkSiyah] as $renk) {
                $sortOrder++;
                $variant = ProductVariant::create([
                    'product_id' => $p4->id,
                    'sku'        => 'TISORT-AKD-' . $beden->getTranslation('name', 'tr') . '-' . $renk->getTranslation('name', 'tr'),
                    'price'      => $beden->getTranslation('name', 'tr') === 'XL' ? 219.90 : null, // XL ekstra fiyatlı
                    'stock'      => rand(5, 30),
                    'is_active'  => true,
                    'sort_order' => $sortOrder,
                ]);
                $variant->attributeValues()->attach([$beden->id, $renk->id]);
            }
        }

        // 5) Varyasyonlu ürün — Sadece Renk (Kalem Seti)
        $p5 = Product::create([
            'name'              => ['tr' => 'Premium Kalem Seti', 'en' => 'Premium Pen Set'],
            'short_description' => ['tr' => '5 farklı kalınlıkta fineliner kalem seti.', 'en' => '5 different thickness fineliner pen set.'],
            'description'       => ['tr' => 'Profesyonel kalitede fineliner kalem seti. 0.1mm ile 0.8mm arası 5 farklı uç. Not alma, çizim ve yazı için ideal.', 'en' => 'Professional quality fineliner pen set. 5 different tips from 0.1mm to 0.8mm. Ideal for note-taking, drawing and writing.'],
            'sku'               => 'KALEM-PRM',
            'price'             => 59.90,
            'stock'             => 0,
            'manage_stock'      => false,
            'is_active'         => true,
            'sort_order'        => 5,
        ]);
        $p5->categories()->attach([$catKirtasiye->id]);

        foreach ([$renkKirmizi, $renkMavi, $renkSiyah, $renkBeyaz] as $i => $renk) {
            $variant = ProductVariant::create([
                'product_id' => $p5->id,
                'sku'        => 'KALEM-PRM-' . $renk->getTranslation('name', 'tr'),
                'stock'      => rand(10, 50),
                'is_active'  => true,
                'sort_order' => $i + 1,
            ]);
            $variant->attributeValues()->attach([$renk->id]);
        }

        // 6) Varyasyonlu ürün — Sadece Beden (Sweatshirt)
        $p6 = Product::create([
            'name'              => ['tr' => 'Akademi Sweatshirt', 'en' => 'Academy Sweatshirt'],
            'short_description' => ['tr' => 'Sıcak tutan, şık tasarım.', 'en' => 'Warm and stylish design.'],
            'description'       => ['tr' => 'Kış ayları için ideal Parosis Akademi sweatshirt. İç yüzü yumuşak polar kumaş. Kanguru cepli, kapüşonlu.', 'en' => 'Ideal Parosis Academy sweatshirt for winter months. Inner fleece fabric. Kangaroo pocket, hooded.'],
            'sku'               => 'SWEAT-AKD',
            'price'             => 349.90,
            'sale_price'        => 299.90,
            'stock'             => 0,
            'manage_stock'      => false,
            'is_active'         => true,
            'sort_order'        => 6,
        ]);
        $p6->categories()->attach([$catGiyim->id]);

        foreach ([$bedenS, $bedenM, $bedenL, $bedenXL] as $i => $beden) {
            $variant = ProductVariant::create([
                'product_id' => $p6->id,
                'sku'        => 'SWEAT-AKD-' . $beden->getTranslation('name', 'tr'),
                'price'      => $beden->getTranslation('name', 'tr') === 'XL' ? 329.90 : null,
                'stock'      => rand(5, 20),
                'is_active'  => true,
                'sort_order' => $i + 1,
            ]);
            $variant->attributeValues()->attach([$beden->id]);
        }

        // 7) Basit ürün — varyasyonsuz
        $p7 = Product::create([
            'name'              => ['tr' => 'Bilim ve Teknoloji Ansiklopedisi', 'en' => 'Science & Technology Encyclopedia'],
            'short_description' => ['tr' => 'Görsel destekli kapsamlı ansiklopedi.', 'en' => 'Comprehensive visual encyclopedia.'],
            'description'       => ['tr' => '1000 sayfalık görsel destekli bilim ve teknoloji ansiklopedisi. 8-16 yaş arası öğrenciler için tasarlanmıştır.', 'en' => '1000-page visual science and technology encyclopedia. Designed for students aged 8-16.'],
            'sku'               => 'KITAP-ANS-001',
            'price'             => 249.90,
            'stock'             => 35,
            'manage_stock'      => true,
            'is_active'         => true,
            'sort_order'        => 7,
        ]);
        $p7->categories()->attach([$catKitap->id, $catTeknoloji->id]);

        // 8) Basit ürün — varyasyonsuz
        $p8 = Product::create([
            'name'              => ['tr' => 'Grafik Tablet (Başlangıç)', 'en' => 'Graphics Tablet (Starter)'],
            'short_description' => ['tr' => 'Dijital çizim için giriş seviyesi tablet.', 'en' => 'Entry-level tablet for digital drawing.'],
            'description'       => ['tr' => 'Başlangıç seviyesi grafik tablet. 6x4 inç çalışma alanı, 8192 basınç hassasiyeti. USB bağlantılı, Windows/Mac uyumlu.', 'en' => 'Starter level graphics tablet. 6x4 inch work area, 8192 pressure sensitivity. USB connected, Windows/Mac compatible.'],
            'sku'               => 'TECH-TABLET-001',
            'price'             => 599.90,
            'sale_price'        => 449.90,
            'stock'             => 15,
            'manage_stock'      => true,
            'is_active'         => true,
            'sort_order'        => 8,
        ]);
        $p8->categories()->attach([$catTeknoloji->id]);

        // 9) Basit ürün — varyasyonsuz
        $p9 = Product::create([
            'name'              => ['tr' => 'Renkli Yapışkan Not Seti', 'en' => 'Colorful Sticky Note Set'],
            'short_description' => ['tr' => '6 renk, 600 yaprak yapışkan not.', 'en' => '6 colors, 600 sheets sticky notes.'],
            'description'       => ['tr' => '6 farklı pastel renkte yapışkan not seti. Her renk 100 yaprak. 76x76mm boyutunda. Güçlü yapışkan, iz bırakmaz.', 'en' => '6 different pastel color sticky note set. 100 sheets each color. 76x76mm size. Strong adhesive, no residue.'],
            'sku'               => 'KIRT-NOT-006',
            'price'             => 39.90,
            'stock'             => 200,
            'manage_stock'      => true,
            'is_active'         => true,
            'sort_order'        => 9,
        ]);
        $p9->categories()->attach([$catKirtasiye->id]);

        // 10) Basit ürün — varyasyonsuz (pasif ürün)
        $p10 = Product::create([
            'name'              => ['tr' => 'Eskiz Defteri A3', 'en' => 'Sketch Pad A3'],
            'short_description' => ['tr' => 'Kalın dokulu kağıt, 50 yaprak.', 'en' => 'Thick textured paper, 50 sheets.'],
            'description'       => ['tr' => 'A3 boyutunda profesyonel eskiz defteri. 200 gr/m² dokulu kağıt. Karakalem, kömür ve pastel çalışmaları için idealdir.', 'en' => 'A3 size professional sketch pad. 200 gsm textured paper. Ideal for pencil, charcoal and pastel works.'],
            'sku'               => 'KIRT-ESKIZ-A3',
            'price'             => 129.90,
            'stock'             => 0,
            'manage_stock'      => true,
            'is_active'         => false,
            'sort_order'        => 10,
        ]);
        $p10->categories()->attach([$catKirtasiye->id]);
    }
}
