<?php

namespace App\Services;

use App\Models\Setting;

class ValidationMessageService
{
    /**
     * Controller validate() çağrısı için mesajları döndürür.
     * Önce default mesajları üretir, sonra DB override'larını birleştirir.
     */
    public static function getMessages(string $formKey): array
    {
        $form = static::getForm($formKey);
        if (!$form) {
            return [];
        }

        $defaults = static::generateFormMessages($form);
        $overrides = Setting::getGroup("vm_{$formKey}");

        return array_merge($defaults, $overrides);
    }

    /**
     * Bir formun default mesajlarını döndürür (DB override olmadan).
     */
    public static function getDefaults(string $formKey): array
    {
        $form = static::getForm($formKey);
        return $form ? static::generateFormMessages($form) : [];
    }

    /**
     * Admin sayfası için tüm modülleri döndürür.
     */
    public static function getModules(): array
    {
        return static::$modules;
    }

    /**
     * Tekil form tanımını döndürür.
     */
    public static function getForm(string $formKey): ?array
    {
        foreach (static::$modules as $module) {
            if (isset($module['forms'][$formKey])) {
                return $module['forms'][$formKey];
            }
        }
        return null;
    }

    /**
     * Form tanımından mesaj dizisi üretir.
     */
    public static function generateFormMessages(array $form): array
    {
        $messages = [];
        foreach ($form['fields'] as $fieldKey => $field) {
            $label = $field['label'];
            $type = $field['type'] ?? 'string';
            foreach ($field['rules'] as $rule) {
                $msg = static::ruleMessage($label, $rule, $type);
                if ($msg !== '') {
                    $messages["{$fieldKey}.{$rule}"] = $msg;
                }
            }
        }
        return $messages;
    }

    /**
     * Alan adı + kural adı + tip'ten Türkçe mesaj üretir.
     */
    public static function ruleMessage(string $label, string $rule, string $type = 'string'): string
    {
        return match ($rule) {
            'required'      => "{$label} zorunludur.",
            'required_if'   => "{$label} bu durumda zorunludur.",
            'string'        => "{$label} metin formatında olmalıdır.",
            'integer'       => "{$label} bir tamsayı olmalıdır.",
            'numeric'       => "{$label} sayısal bir değer olmalıdır.",
            'boolean'       => "{$label} doğru veya yanlış olmalıdır.",
            'array'         => "{$label} bir dizi olmalıdır.",
            'email'         => "{$label} geçerli bir e-posta adresi olmalıdır.",
            'url'           => "{$label} geçerli bir URL olmalıdır.",
            'date'          => "{$label} geçerli bir tarih olmalıdır.",
            'date_format'   => "{$label} belirtilen formatta olmalıdır.",
            'after_or_equal' => "{$label} başlangıç tarihinden sonra veya aynı tarih olmalıdır.",
            'file'          => "{$label} bir dosya olmalıdır.",
            'image'         => "{$label} bir görsel dosyası olmalıdır.",
            'mimes'         => "{$label} yalnızca :values formatlarında olabilir.",
            'unique'        => "{$label} zaten kullanılmaktadır.",
            'exists'        => "Seçilen {$label} geçersizdir.",
            'in'            => "Seçilen {$label} geçersizdir.",
            'regex'         => "{$label} geçersiz formatta.",
            'confirmed'     => "{$label} tekrarı eşleşmiyor.",
            'max' => match ($type) {
                'file'    => "{$label} en fazla :max kilobayt olabilir.",
                'array'   => "{$label} en fazla :max öğe içerebilir.",
                'numeric' => "{$label} en fazla :max olabilir.",
                default   => "{$label} en fazla :max karakter olabilir.",
            },
            'min' => match ($type) {
                'file'    => "{$label} en az :min kilobayt olmalıdır.",
                'numeric' => "{$label} en az :min olmalıdır.",
                default   => "{$label} en az :min karakter olmalıdır.",
            },
            default => '',
        };
    }

    // ─── Modül ve Form Tanımları ─────────────────────────────────────────────

    protected static array $modules = [

        // ═══════════════════════════════════════════════════════════════
        // BLOG
        // ═══════════════════════════════════════════════════════════════
        'blog' => [
            'label' => 'Blog',
            'forms' => [
                'blog_store' => [
                    'label' => 'Blog - Yazı Oluştur',
                    'fields' => [
                        'title' => ['label' => 'Başlık', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Görsel', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'category_ids' => ['label' => 'Kategoriler', 'type' => 'array', 'rules' => ['array']],
                        'category_ids.*' => ['label' => 'Kategori', 'type' => 'numeric', 'rules' => ['exists']],
                        'tag_ids' => ['label' => 'Etiketler', 'type' => 'array', 'rules' => ['array']],
                        'tag_ids.*' => ['label' => 'Etiket', 'type' => 'numeric', 'rules' => ['exists']],
                    ],
                ],
                'blog_update' => [
                    'label' => 'Blog - Yazı Güncelle',
                    'fields' => [
                        'title' => ['label' => 'Başlık', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Görsel', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'category_ids' => ['label' => 'Kategoriler', 'type' => 'array', 'rules' => ['array']],
                        'category_ids.*' => ['label' => 'Kategori', 'type' => 'numeric', 'rules' => ['exists']],
                        'tag_ids' => ['label' => 'Etiketler', 'type' => 'array', 'rules' => ['array']],
                        'tag_ids.*' => ['label' => 'Etiket', 'type' => 'numeric', 'rules' => ['exists']],
                    ],
                ],
                'blog_order' => [
                    'label' => 'Blog - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'blog_translate' => [
                    'label' => 'Blog - Çeviri',
                    'fields' => [
                        'title' => ['label' => 'Başlık', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Blog Kategori
                'blog_cat_store' => [
                    'label' => 'Blog Kategori - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'blog_cat_update' => [
                    'label' => 'Blog Kategori - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'blog_cat_order' => [
                    'label' => 'Blog Kategori - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'blog_cat_translate' => [
                    'label' => 'Blog Kategori - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Blog Etiket
                'blog_tag_store' => [
                    'label' => 'Blog Etiket - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Etiket adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'blog_tag_update' => [
                    'label' => 'Blog Etiket - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Etiket adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'blog_tag_order' => [
                    'label' => 'Blog Etiket - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'blog_tag_translate' => [
                    'label' => 'Blog Etiket - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Etiket adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],
            ],
        ],

        // ═══════════════════════════════════════════════════════════════
        // KURSLAR
        // ═══════════════════════════════════════════════════════════════
        'course' => [
            'label' => 'Kurslar',
            'forms' => [
                'course_store' => [
                    'label' => 'Kurs - Oluştur',
                    'fields' => [
                        'title' => ['label' => 'Kurs başlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Kurs görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'inner_image' => ['label' => 'İç görsel', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'instructor_image' => ['label' => 'Eğitmen görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'category_ids' => ['label' => 'Kategoriler', 'type' => 'array', 'rules' => ['array']],
                        'category_ids.*' => ['label' => 'Kategori', 'type' => 'numeric', 'rules' => ['exists']],
                    ],
                ],
                'course_update' => [
                    'label' => 'Kurs - Güncelle',
                    'fields' => [
                        'title' => ['label' => 'Kurs başlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Kurs görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'inner_image' => ['label' => 'İç görsel', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'instructor_image' => ['label' => 'Eğitmen görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'category_ids' => ['label' => 'Kategoriler', 'type' => 'array', 'rules' => ['array']],
                        'category_ids.*' => ['label' => 'Kategori', 'type' => 'numeric', 'rules' => ['exists']],
                    ],
                ],
                'course_order' => [
                    'label' => 'Kurs - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'course_translate' => [
                    'label' => 'Kurs - Çeviri',
                    'fields' => [
                        'title' => ['label' => 'Kurs başlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Kurs Kategori
                'course_cat_store' => [
                    'label' => 'Kurs Kategori - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'icon' => ['label' => 'İkon', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'color' => ['label' => 'Renk', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'course_cat_update' => [
                    'label' => 'Kurs Kategori - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'icon' => ['label' => 'İkon', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'color' => ['label' => 'Renk', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'course_cat_order' => [
                    'label' => 'Kurs Kategori - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'course_cat_translate' => [
                    'label' => 'Kurs Kategori - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],
            ],
        ],

        // ═══════════════════════════════════════════════════════════════
        // MAĞAZA
        // ═══════════════════════════════════════════════════════════════
        'shop' => [
            'label' => 'Mağaza',
            'forms' => [
                'product_store' => [
                    'label' => 'Ürün - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Ürün adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'short_description' => ['label' => 'Kısa açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'description' => ['label' => 'Açıklama', 'type' => 'string', 'rules' => ['string']],
                        'features' => ['label' => 'Özellikler', 'type' => 'string', 'rules' => ['string']],
                        'sku' => ['label' => 'Stok kodu', 'type' => 'string', 'rules' => ['string', 'max', 'unique']],
                        'price' => ['label' => 'Fiyat', 'type' => 'numeric', 'rules' => ['required', 'numeric', 'min']],
                        'sale_price' => ['label' => 'İndirimli fiyat', 'type' => 'numeric', 'rules' => ['numeric', 'min']],
                        'stock' => ['label' => 'Stok', 'type' => 'numeric', 'rules' => ['integer', 'min']],
                        'image' => ['label' => 'Ürün görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'product_update' => [
                    'label' => 'Ürün - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Ürün adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'short_description' => ['label' => 'Kısa açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'description' => ['label' => 'Açıklama', 'type' => 'string', 'rules' => ['string']],
                        'features' => ['label' => 'Özellikler', 'type' => 'string', 'rules' => ['string']],
                        'sku' => ['label' => 'Stok kodu', 'type' => 'string', 'rules' => ['string', 'max', 'unique']],
                        'price' => ['label' => 'Fiyat', 'type' => 'numeric', 'rules' => ['required', 'numeric', 'min']],
                        'sale_price' => ['label' => 'İndirimli fiyat', 'type' => 'numeric', 'rules' => ['numeric', 'min']],
                        'stock' => ['label' => 'Stok', 'type' => 'numeric', 'rules' => ['integer', 'min']],
                        'image' => ['label' => 'Ürün görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'product_order' => [
                    'label' => 'Ürün - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'product_translate' => [
                    'label' => 'Ürün - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Ürün adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'short_description' => ['label' => 'Kısa açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'description' => ['label' => 'Açıklama', 'type' => 'string', 'rules' => ['string']],
                        'features' => ['label' => 'Özellikler', 'type' => 'string', 'rules' => ['string']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],
                'product_variants' => [
                    'label' => 'Ürün - Varyant Oluştur',
                    'fields' => [
                        'attribute_ids' => ['label' => 'Nitelikler', 'type' => 'array', 'rules' => ['required', 'array', 'min']],
                        'attribute_ids.*' => ['label' => 'Nitelik', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'product_gallery' => [
                    'label' => 'Ürün - Galeri Yükle',
                    'fields' => [
                        'images' => ['label' => 'Görseller', 'type' => 'array', 'rules' => ['required', 'array']],
                        'images.*' => ['label' => 'Görsel', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'product_image_order' => [
                    'label' => 'Ürün - Görsel Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],

                // Ürün Kategori
                'product_cat_store' => [
                    'label' => 'Ürün Kategori - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Kategori görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'product_cat_update' => [
                    'label' => 'Ürün Kategori - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Kategori görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'product_cat_order' => [
                    'label' => 'Ürün Kategori - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'product_cat_translate' => [
                    'label' => 'Ürün Kategori - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Kategori adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Ürün Nitelik
                'product_attr_store' => [
                    'label' => 'Ürün Nitelik - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Nitelik adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'product_attr_update' => [
                    'label' => 'Ürün Nitelik - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Nitelik adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'product_attr_order' => [
                    'label' => 'Ürün Nitelik - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'product_attr_translate' => [
                    'label' => 'Ürün Nitelik - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Nitelik adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],
                'product_attr_value_store' => [
                    'label' => 'Nitelik Değeri - Oluştur',
                    'fields' => [
                        'value_name' => ['label' => 'Değer adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'color_code' => ['label' => 'Renk kodu', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'product_attr_value_update' => [
                    'label' => 'Nitelik Değeri - Güncelle',
                    'fields' => [
                        'value_name' => ['label' => 'Değer adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'color_code' => ['label' => 'Renk kodu', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],

                // Kupon
                'coupon_store' => [
                    'label' => 'Kupon - Oluştur',
                    'fields' => [
                        'code' => ['label' => 'Kupon kodu', 'type' => 'string', 'rules' => ['required', 'string', 'max', 'unique']],
                        'type' => ['label' => 'İndirim türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'value' => ['label' => 'İndirim değeri', 'type' => 'numeric', 'rules' => ['required', 'numeric', 'min']],
                        'min_order_amount' => ['label' => 'Minimum sipariş tutarı', 'type' => 'numeric', 'rules' => ['numeric', 'min']],
                        'max_discount_amount' => ['label' => 'Maksimum indirim tutarı', 'type' => 'numeric', 'rules' => ['numeric', 'min']],
                        'usage_limit' => ['label' => 'Kullanım limiti', 'type' => 'numeric', 'rules' => ['integer', 'min']],
                        'starts_at' => ['label' => 'Başlangıç tarihi', 'type' => 'date', 'rules' => ['date']],
                        'expires_at' => ['label' => 'Bitiş tarihi', 'type' => 'date', 'rules' => ['date', 'after_or_equal']],
                    ],
                ],
                'coupon_update' => [
                    'label' => 'Kupon - Güncelle',
                    'fields' => [
                        'code' => ['label' => 'Kupon kodu', 'type' => 'string', 'rules' => ['required', 'string', 'max', 'unique']],
                        'type' => ['label' => 'İndirim türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'value' => ['label' => 'İndirim değeri', 'type' => 'numeric', 'rules' => ['required', 'numeric', 'min']],
                        'min_order_amount' => ['label' => 'Minimum sipariş tutarı', 'type' => 'numeric', 'rules' => ['numeric', 'min']],
                        'max_discount_amount' => ['label' => 'Maksimum indirim tutarı', 'type' => 'numeric', 'rules' => ['numeric', 'min']],
                        'usage_limit' => ['label' => 'Kullanım limiti', 'type' => 'numeric', 'rules' => ['integer', 'min']],
                        'starts_at' => ['label' => 'Başlangıç tarihi', 'type' => 'date', 'rules' => ['date']],
                        'expires_at' => ['label' => 'Bitiş tarihi', 'type' => 'date', 'rules' => ['date', 'after_or_equal']],
                    ],
                ],

                // Sipariş
                'order_status' => [
                    'label' => 'Sipariş - Durum Güncelle',
                    'fields' => [
                        'status' => ['label' => 'Sipariş durumu', 'type' => 'string', 'rules' => ['required', 'in']],
                    ],
                ],

                // Sepet
                'cart_add' => [
                    'label' => 'Sepet - Ürün Ekle',
                    'fields' => [
                        'product_id' => ['label' => 'Ürün', 'type' => 'numeric', 'rules' => ['required', 'integer', 'exists']],
                        'variant_id' => ['label' => 'Varyant', 'type' => 'numeric', 'rules' => ['integer']],
                        'quantity' => ['label' => 'Miktar', 'type' => 'numeric', 'rules' => ['integer', 'min', 'max']],
                    ],
                ],
                'cart_update' => [
                    'label' => 'Sepet - Miktar Güncelle',
                    'fields' => [
                        'key' => ['label' => 'Sepet anahtarı', 'type' => 'string', 'rules' => ['required', 'string']],
                        'quantity' => ['label' => 'Miktar', 'type' => 'numeric', 'rules' => ['required', 'integer', 'min', 'max']],
                    ],
                ],
                'cart_remove' => [
                    'label' => 'Sepet - Ürün Kaldır',
                    'fields' => [
                        'key' => ['label' => 'Sepet anahtarı', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Ödeme
                'checkout_process' => [
                    'label' => 'Ödeme - İşlem',
                    'fields' => [
                        'customer_name' => ['label' => 'Müşteri adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'customer_email' => ['label' => 'Müşteri e-postası', 'type' => 'string', 'rules' => ['required', 'email', 'max']],
                        'customer_phone' => ['label' => 'Müşteri telefonu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'shipping_address' => ['label' => 'Teslimat adresi', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'shipping_city' => ['label' => 'Teslimat şehri', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'shipping_district' => ['label' => 'Teslimat ilçesi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'customer_note' => ['label' => 'Müşteri notu', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'checkout_coupon' => [
                    'label' => 'Ödeme - Kupon Uygula',
                    'fields' => [
                        'code' => ['label' => 'Kupon kodu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
            ],
        ],

        // ═══════════════════════════════════════════════════════════════
        // EĞİTİM
        // ═══════════════════════════════════════════════════════════════
        'education' => [
            'label' => 'Eğitim',
            'forms' => [
                'class_store' => [
                    'label' => 'Sınıf - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Sınıf adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'quota' => ['label' => 'Kontenjan', 'type' => 'numeric', 'rules' => ['required', 'integer', 'min']],
                        'teacher_id' => ['label' => 'Eğitmen', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                        'start_date' => ['label' => 'Başlangıç tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'end_date' => ['label' => 'Bitiş tarihi', 'type' => 'date', 'rules' => ['required', 'date', 'after_or_equal']],
                        'course_time' => ['label' => 'Ders saati', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'day_data' => ['label' => 'Gün verileri', 'type' => 'array', 'rules' => ['required', 'array']],
                        'day_data.*.day' => ['label' => 'Gün', 'type' => 'string', 'rules' => ['required', 'in']],
                        'day_data.*.start_time' => ['label' => 'Başlangıç saati', 'type' => 'string', 'rules' => ['required', 'date_format']],
                        'day_data.*.end_time' => ['label' => 'Bitiş saati', 'type' => 'string', 'rules' => ['required', 'date_format']],
                    ],
                ],
                'class_update' => [
                    'label' => 'Sınıf - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Sınıf adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'quota' => ['label' => 'Kontenjan', 'type' => 'numeric', 'rules' => ['required', 'integer', 'min']],
                        'teacher_id' => ['label' => 'Eğitmen', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                        'start_date' => ['label' => 'Başlangıç tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'end_date' => ['label' => 'Bitiş tarihi', 'type' => 'date', 'rules' => ['required', 'date', 'after_or_equal']],
                        'course_time' => ['label' => 'Ders saati', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'day_data' => ['label' => 'Gün verileri', 'type' => 'array', 'rules' => ['required', 'array']],
                        'day_data.*.day' => ['label' => 'Gün', 'type' => 'string', 'rules' => ['required', 'in']],
                        'day_data.*.start_time' => ['label' => 'Başlangıç saati', 'type' => 'string', 'rules' => ['required', 'date_format']],
                        'day_data.*.end_time' => ['label' => 'Bitiş saati', 'type' => 'string', 'rules' => ['required', 'date_format']],
                    ],
                ],
                'pre_reg_store' => [
                    'label' => 'Ön Kayıt - Oluştur',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Ad soyad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_full_name' => ['label' => 'Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_relationship' => ['label' => 'Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_1' => ['label' => 'Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => 'Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'pre_reg_update' => [
                    'label' => 'Ön Kayıt - Güncelle',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Ad soyad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'guardian1_full_name' => ['label' => 'Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_relationship' => ['label' => 'Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_1' => ['label' => 'Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => 'Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'pre_reg_convert' => [
                    'label' => 'Ön Kayıt - Kesin Kayıta Dönüştür',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Ad soyad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['in']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'tc_no' => ['label' => 'T.C. Kimlik No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['string', 'max']],
                        'student_phone' => ['label' => 'Öğrenci telefonu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],

                // Öğrenci Kayıt (Ön Kayıt Türü)
                'student_store_pre' => [
                    'label' => 'Öğrenci - Kayıt (Ön Kayıt)',
                    'fields' => [
                        'first_registration_date' => ['label' => 'İlk kayıt tarihi', 'type' => 'date', 'rules' => ['date']],
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Öğrencinin adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'student_phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['in']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'tc_no' => ['label' => 'TC Kimlik Numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['required_if', 'max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_full_name' => ['label' => '2. Veli adı soyadı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_national_id' => ['label' => '2. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_relationship' => ['label' => '2. Veli yakınlığı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_birth_date' => ['label' => '2. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian2_education_level' => ['label' => '2. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_job' => ['label' => '2. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_phone_1' => ['label' => '2. Veli telefonu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_2' => ['label' => '2. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_email' => ['label' => '2. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian2_home_address' => ['label' => '2. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_work_address' => ['label' => '2. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'student_store_normal' => [
                    'label' => 'Öğrenci - Kayıt (Kesin Kayıt)',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Öğrencinin adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['required', 'in']],
                        'student_phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'tc_no' => ['label' => 'TC Kimlik Numarası', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['required_if', 'max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['string', 'max']],
                        'registiration_term' => ['label' => 'Dönem', 'type' => 'string', 'rules' => ['required']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['required', 'email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_full_name' => ['label' => '2. Veli adı soyadı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_national_id' => ['label' => '2. Veli T.C. No', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_relationship' => ['label' => '2. Veli yakınlığı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_birth_date' => ['label' => '2. Veli doğum tarihi', 'type' => 'date', 'rules' => ['required_if', 'date']],
                        'guardian2_education_level' => ['label' => '2. Veli eğitim durumu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_job' => ['label' => '2. Veli mesleği', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_1' => ['label' => '2. Veli telefonu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_2' => ['label' => '2. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_email' => ['label' => '2. Veli e-postası', 'type' => 'string', 'rules' => ['required_if', 'email', 'max']],
                        'guardian2_home_address' => ['label' => '2. Veli ev adresi', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_work_address' => ['label' => '2. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],

                // Öğrenci Güncelle (Ön Kayıt Türü)
                'student_update_pre' => [
                    'label' => 'Öğrenci - Güncelle (Ön Kayıt)',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Öğrencinin adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['in']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'tc_no' => ['label' => 'TC Kimlik Numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['required_if', 'max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'student_phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_full_name' => ['label' => '2. Veli adı soyadı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_national_id' => ['label' => '2. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_relationship' => ['label' => '2. Veli yakınlığı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_birth_date' => ['label' => '2. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian2_education_level' => ['label' => '2. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_job' => ['label' => '2. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_phone_1' => ['label' => '2. Veli telefonu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_2' => ['label' => '2. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_email' => ['label' => '2. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian2_home_address' => ['label' => '2. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_work_address' => ['label' => '2. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'student_update_normal' => [
                    'label' => 'Öğrenci - Güncelle (Kesin Kayıt)',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Öğrencinin adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['required', 'in']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'tc_no' => ['label' => 'TC Kimlik Numarası', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['required_if', 'max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['string', 'max']],
                        'student_phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'registiration_term' => ['label' => 'Dönem', 'type' => 'string', 'rules' => ['required']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['required', 'email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_full_name' => ['label' => '2. Veli adı soyadı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_national_id' => ['label' => '2. Veli T.C. No', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_relationship' => ['label' => '2. Veli yakınlığı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_birth_date' => ['label' => '2. Veli doğum tarihi', 'type' => 'date', 'rules' => ['required_if', 'date']],
                        'guardian2_education_level' => ['label' => '2. Veli eğitim durumu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_job' => ['label' => '2. Veli mesleği', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_1' => ['label' => '2. Veli telefonu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_2' => ['label' => '2. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_email' => ['label' => '2. Veli e-postası', 'type' => 'string', 'rules' => ['required_if', 'email', 'max']],
                        'guardian2_home_address' => ['label' => '2. Veli ev adresi', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_work_address' => ['label' => '2. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],

                // Öğrenci Yeniden Kayıt (Ön Kayıt Türü)
                'student_recreate_pre' => [
                    'label' => 'Öğrenci - Yeniden Kayıt (Ön Kayıt)',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Öğrencinin adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['in']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'tc_no' => ['label' => 'TC Kimlik Numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['required_if', 'max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'student_phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'recrate_registration_date' => ['label' => 'Yeniden kayıt tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_full_name' => ['label' => '2. Veli adı soyadı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_national_id' => ['label' => '2. Veli T.C. No', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_relationship' => ['label' => '2. Veli yakınlığı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_birth_date' => ['label' => '2. Veli doğum tarihi', 'type' => 'date', 'rules' => ['date']],
                        'guardian2_education_level' => ['label' => '2. Veli eğitim durumu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_job' => ['label' => '2. Veli mesleği', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_phone_1' => ['label' => '2. Veli telefonu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_2' => ['label' => '2. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_email' => ['label' => '2. Veli e-postası', 'type' => 'string', 'rules' => ['email', 'max']],
                        'guardian2_home_address' => ['label' => '2. Veli ev adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_work_address' => ['label' => '2. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'student_recreate_normal' => [
                    'label' => 'Öğrenci - Yeniden Kayıt (Kesin Kayıt)',
                    'fields' => [
                        'registiration_type' => ['label' => 'Kayıt türü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'full_name' => ['label' => 'Öğrencinin adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'gender' => ['label' => 'Cinsiyet', 'type' => 'string', 'rules' => ['required', 'in']],
                        'birth_date' => ['label' => 'Doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'school_name' => ['label' => 'Okul adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'tc_no' => ['label' => 'TC Kimlik Numarası', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'blood_type' => ['label' => 'Kan grubu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'class_id' => ['label' => 'Sınıf', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                        'allergy_detail' => ['label' => 'Alerji detayı', 'type' => 'string', 'rules' => ['required_if', 'max']],
                        'notes' => ['label' => 'Notlar', 'type' => 'string', 'rules' => ['string', 'max']],
                        'student_phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                        'registiration_term' => ['label' => 'Dönem', 'type' => 'string', 'rules' => ['required']],
                        'guardian1_full_name' => ['label' => '1. Veli adı soyadı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_national_id' => ['label' => '1. Veli T.C. No', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_relationship' => ['label' => '1. Veli yakınlığı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_birth_date' => ['label' => '1. Veli doğum tarihi', 'type' => 'date', 'rules' => ['required', 'date']],
                        'guardian1_education_level' => ['label' => '1. Veli eğitim durumu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_job' => ['label' => '1. Veli mesleği', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_1' => ['label' => '1. Veli telefonu', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_phone_2' => ['label' => '1. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian1_email' => ['label' => '1. Veli e-postası', 'type' => 'string', 'rules' => ['required', 'email', 'max']],
                        'guardian1_home_address' => ['label' => '1. Veli ev adresi', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'guardian1_work_address' => ['label' => '1. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_full_name' => ['label' => '2. Veli adı soyadı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_national_id' => ['label' => '2. Veli T.C. No', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_relationship' => ['label' => '2. Veli yakınlığı', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_birth_date' => ['label' => '2. Veli doğum tarihi', 'type' => 'date', 'rules' => ['required_if', 'date']],
                        'guardian2_education_level' => ['label' => '2. Veli eğitim durumu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_job' => ['label' => '2. Veli mesleği', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_1' => ['label' => '2. Veli telefonu', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_phone_2' => ['label' => '2. Veli 2. telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'guardian2_email' => ['label' => '2. Veli e-postası', 'type' => 'string', 'rules' => ['required_if', 'email', 'max']],
                        'guardian2_home_address' => ['label' => '2. Veli ev adresi', 'type' => 'string', 'rules' => ['required_if', 'string', 'max']],
                        'guardian2_work_address' => ['label' => '2. Veli iş adresi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
            ],
        ],

        // ═══════════════════════════════════════════════════════════════
        // İÇERİK
        // ═══════════════════════════════════════════════════════════════
        'content' => [
            'label' => 'İçerik',
            'forms' => [
                // Eğitmen
                'teacher_store' => [
                    'label' => 'Eğitmen - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Eğitmen adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'title' => ['label' => 'Eğitmen unvanı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Eğitmen görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'teacher_update' => [
                    'label' => 'Eğitmen - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Eğitmen adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'title' => ['label' => 'Eğitmen unvanı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Eğitmen görseli', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'teacher_order' => [
                    'label' => 'Eğitmen - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'teacher_translate' => [
                    'label' => 'Eğitmen - Çeviri',
                    'fields' => [
                        'name' => ['label' => 'Eğitmen adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'title' => ['label' => 'Eğitmen unvanı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Yorum
                'testimonial_store' => [
                    'label' => 'Yorum - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Kişi adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'role' => ['label' => 'Unvan', 'type' => 'string', 'rules' => ['string', 'max']],
                        'quote' => ['label' => 'Yorum metni', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Kişi görseli', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'rating' => ['label' => 'Puan', 'type' => 'numeric', 'rules' => ['required', 'integer', 'min', 'max']],
                    ],
                ],
                'testimonial_update' => [
                    'label' => 'Yorum - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Kişi adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'role' => ['label' => 'Unvan', 'type' => 'string', 'rules' => ['string', 'max']],
                        'quote' => ['label' => 'Yorum metni', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'image' => ['label' => 'Kişi görseli', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'rating' => ['label' => 'Puan', 'type' => 'numeric', 'rules' => ['required', 'integer', 'min', 'max']],
                    ],
                ],
                'testimonial_order' => [
                    'label' => 'Yorum - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'testimonial_translate' => [
                    'label' => 'Yorum - Çeviri',
                    'fields' => [
                        'role' => ['label' => 'Unvan', 'type' => 'string', 'rules' => ['string', 'max']],
                        'quote' => ['label' => 'Yorum metni', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // SSS
                'faq_store' => [
                    'label' => 'SSS - Oluştur',
                    'fields' => [
                        'question' => ['label' => 'Soru', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'answer' => ['label' => 'Cevap', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'faq_update' => [
                    'label' => 'SSS - Güncelle',
                    'fields' => [
                        'question' => ['label' => 'Soru', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'answer' => ['label' => 'Cevap', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'faq_order' => [
                    'label' => 'SSS - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'faq_translate' => [
                    'label' => 'SSS - Çeviri',
                    'fields' => [
                        'question' => ['label' => 'Soru', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'answer' => ['label' => 'Cevap', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Slider
                'slider_store' => [
                    'label' => 'Slider - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Slider adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'slider_update' => [
                    'label' => 'Slider - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Slider adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'slider_order' => [
                    'label' => 'Slider - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],

                // Slider Öğesi
                'slider_item_store' => [
                    'label' => 'Slider Öğesi - Oluştur',
                    'fields' => [
                        'title' => ['label' => 'Başlık', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'highlight_text' => ['label' => 'Vurgulu metin', 'type' => 'string', 'rules' => ['string', 'max']],
                        'description' => ['label' => 'Açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'button_text' => ['label' => 'Buton metni', 'type' => 'string', 'rules' => ['string', 'max']],
                        'button_url' => ['label' => 'Buton URL', 'type' => 'string', 'rules' => ['string', 'max']],
                        'image' => ['label' => 'Görsel', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'background_image' => ['label' => 'Arka plan görseli', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                    ],
                ],
                'slider_item_update' => [
                    'label' => 'Slider Öğesi - Güncelle',
                    'fields' => [
                        'title' => ['label' => 'Başlık', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'highlight_text' => ['label' => 'Vurgulu metin', 'type' => 'string', 'rules' => ['string', 'max']],
                        'description' => ['label' => 'Açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'button_text' => ['label' => 'Buton metni', 'type' => 'string', 'rules' => ['string', 'max']],
                        'button_url' => ['label' => 'Buton URL', 'type' => 'string', 'rules' => ['string', 'max']],
                        'image' => ['label' => 'Görsel', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'background_image' => ['label' => 'Arka plan görseli', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                    ],
                ],
                'slider_item_order' => [
                    'label' => 'Slider Öğesi - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'slider_item_translate' => [
                    'label' => 'Slider Öğesi - Çeviri',
                    'fields' => [
                        'title' => ['label' => 'Başlık', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'highlight_text' => ['label' => 'Vurgulu metin', 'type' => 'string', 'rules' => ['string', 'max']],
                        'description' => ['label' => 'Açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'button_text' => ['label' => 'Buton metni', 'type' => 'string', 'rules' => ['string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // İş Ortağı Logosu
                'client_logo_store' => [
                    'label' => 'İş Ortağı Logosu - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'İş ortağı adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'image' => ['label' => 'Logo görseli', 'type' => 'file', 'rules' => ['required', 'image', 'mimes', 'max']],
                        'url' => ['label' => 'Web sitesi', 'type' => 'string', 'rules' => ['url', 'max']],
                    ],
                ],
                'client_logo_update' => [
                    'label' => 'İş Ortağı Logosu - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'İş ortağı adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'image' => ['label' => 'Logo görseli', 'type' => 'file', 'rules' => ['image', 'mimes', 'max']],
                        'url' => ['label' => 'Web sitesi', 'type' => 'string', 'rules' => ['url', 'max']],
                    ],
                ],
                'client_logo_order' => [
                    'label' => 'İş Ortağı Logosu - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],

                // İletişim Formu
                'contact_send' => [
                    'label' => 'İletişim Formu',
                    'fields' => [
                        'contact-name' => ['label' => 'Ad soyad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'contact-email' => ['label' => 'E-posta adresi', 'type' => 'string', 'rules' => ['required', 'email', 'max']],
                        'message' => ['label' => 'Mesaj', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],

                // Sayfa Görsel Yükleme
                'page_upload_image' => [
                    'label' => 'Sayfa - Görsel Yükle',
                    'fields' => [
                        'image' => ['label' => 'Görsel', 'type' => 'file', 'rules' => ['required', 'file', 'mimes', 'max']],
                    ],
                ],
            ],
        ],

        // ═══════════════════════════════════════════════════════════════
        // SİSTEM
        // ═══════════════════════════════════════════════════════════════
        'system' => [
            'label' => 'Sistem',
            'forms' => [
                // Ayarlar
                'settings_general' => [
                    'label' => 'Ayarlar - Genel',
                    'fields' => [
                        'site_name' => ['label' => 'Site adı', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'site_description' => ['label' => 'Site açıklaması', 'type' => 'string', 'rules' => ['string', 'max']],
                        'site_phone' => ['label' => 'Telefon', 'type' => 'string', 'rules' => ['string', 'max']],
                        'site_email' => ['label' => 'E-posta', 'type' => 'string', 'rules' => ['email', 'max']],
                        'site_address' => ['label' => 'Adres', 'type' => 'string', 'rules' => ['string', 'max']],
                        'copyright_text' => ['label' => 'Telif hakkı metni', 'type' => 'string', 'rules' => ['string', 'max']],
                        'timezone' => ['label' => 'Saat dilimi', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'settings_logos' => [
                    'label' => 'Ayarlar - Logolar',
                    'fields' => [
                        'header_logo' => ['label' => 'Üst logo', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'footer_logo' => ['label' => 'Alt logo', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'favicon' => ['label' => 'Favicon', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                        'admin_logo' => ['label' => 'Yönetim paneli logosu', 'type' => 'file', 'rules' => ['file', 'mimes', 'max']],
                    ],
                ],
                'settings_seo' => [
                    'label' => 'Ayarlar - SEO',
                    'fields' => [
                        'meta_title' => ['label' => 'Meta başlık', 'type' => 'string', 'rules' => ['string', 'max']],
                        'meta_description' => ['label' => 'Meta açıklama', 'type' => 'string', 'rules' => ['string', 'max']],
                        'meta_keywords' => ['label' => 'Meta anahtar kelimeler', 'type' => 'string', 'rules' => ['string', 'max']],
                        'google_analytics_id' => ['label' => 'Google Analytics ID', 'type' => 'string', 'rules' => ['string', 'max']],
                        'google_tag_manager_id' => ['label' => 'Google Tag Manager ID', 'type' => 'string', 'rules' => ['string', 'max']],
                        'sitemap_url' => ['label' => 'Sitemap URL', 'type' => 'string', 'rules' => ['string', 'max']],
                        'robots_txt' => ['label' => 'Robots.txt', 'type' => 'string', 'rules' => ['string']],
                    ],
                ],
                'settings_mail' => [
                    'label' => 'Ayarlar - E-posta',
                    'fields' => [
                        'mail_mailer' => ['label' => 'E-posta sürücüsü', 'type' => 'string', 'rules' => ['required', 'in']],
                        'mail_host' => ['label' => 'E-posta sunucusu', 'type' => 'string', 'rules' => ['string', 'max']],
                        'mail_port' => ['label' => 'E-posta portu', 'type' => 'numeric', 'rules' => ['integer', 'min', 'max']],
                        'mail_username' => ['label' => 'E-posta kullanıcı adı', 'type' => 'string', 'rules' => ['string', 'max']],
                        'mail_password' => ['label' => 'E-posta şifresi', 'type' => 'string', 'rules' => ['string', 'max']],
                        'mail_encryption' => ['label' => 'E-posta şifreleme', 'type' => 'string', 'rules' => ['in']],
                        'mail_from_address' => ['label' => 'Gönderen adresi', 'type' => 'string', 'rules' => ['email', 'max']],
                        'mail_from_name' => ['label' => 'Gönderen adı', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'settings_test_mail' => [
                    'label' => 'Ayarlar - Test E-posta',
                    'fields' => [
                        'test_email' => ['label' => 'Test e-posta adresi', 'type' => 'string', 'rules' => ['required', 'email']],
                    ],
                ],
                'settings_social' => [
                    'label' => 'Ayarlar - Sosyal Medya',
                    'fields' => [
                        'facebook_url' => ['label' => 'Facebook URL', 'type' => 'string', 'rules' => ['url', 'max']],
                        'twitter_url' => ['label' => 'Twitter URL', 'type' => 'string', 'rules' => ['url', 'max']],
                        'instagram_url' => ['label' => 'Instagram URL', 'type' => 'string', 'rules' => ['url', 'max']],
                        'linkedin_url' => ['label' => 'LinkedIn URL', 'type' => 'string', 'rules' => ['url', 'max']],
                        'youtube_url' => ['label' => 'YouTube URL', 'type' => 'string', 'rules' => ['url', 'max']],
                        'tiktok_url' => ['label' => 'TikTok URL', 'type' => 'string', 'rules' => ['url', 'max']],
                        'whatsapp_number' => ['label' => 'WhatsApp numarası', 'type' => 'string', 'rules' => ['string', 'max']],
                    ],
                ],
                'settings_sitemap_store' => [
                    'label' => 'Sitemap - Ekle',
                    'fields' => [
                        'loc' => ['label' => 'Konum URL', 'type' => 'string', 'rules' => ['required', 'url', 'max']],
                        'changefreq' => ['label' => 'Değişim sıklığı', 'type' => 'string', 'rules' => ['required', 'in']],
                        'priority' => ['label' => 'Öncelik', 'type' => 'string', 'rules' => ['required', 'in']],
                    ],
                ],
                'settings_sitemap_update' => [
                    'label' => 'Sitemap - Güncelle',
                    'fields' => [
                        'loc' => ['label' => 'Konum URL', 'type' => 'string', 'rules' => ['required', 'url', 'max']],
                        'changefreq' => ['label' => 'Değişim sıklığı', 'type' => 'string', 'rules' => ['required', 'in']],
                        'priority' => ['label' => 'Öncelik', 'type' => 'string', 'rules' => ['required', 'in']],
                    ],
                ],

                // Diller
                'language_store' => [
                    'label' => 'Dil - Oluştur',
                    'fields' => [
                        'locale' => ['label' => 'Dil kodu', 'type' => 'string', 'rules' => ['required', 'string', 'regex', 'unique']],
                        'default_name' => ['label' => 'Varsayılan ad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'language_update' => [
                    'label' => 'Dil - Güncelle',
                    'fields' => [
                        'locale' => ['label' => 'Dil kodu', 'type' => 'string', 'rules' => ['required', 'string', 'regex', 'unique']],
                        'default_name' => ['label' => 'Varsayılan ad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                    ],
                ],
                'language_toggle' => [
                    'label' => 'Dil - Durum Değiştir',
                    'fields' => [
                        'id' => ['label' => 'Dil', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                    ],
                ],
                'language_default' => [
                    'label' => 'Dil - Varsayılan Yap',
                    'fields' => [
                        'id' => ['label' => 'Dil', 'type' => 'numeric', 'rules' => ['required', 'exists']],
                    ],
                ],
                'language_order' => [
                    'label' => 'Dil - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],

                // Menü
                'menu_store' => [
                    'label' => 'Menü Öğesi - Oluştur',
                    'fields' => [
                        'label' => ['label' => 'Etiket', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'url' => ['label' => 'URL', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'target' => ['label' => 'Hedef', 'type' => 'string', 'rules' => ['required', 'in']],
                        'parent_id' => ['label' => 'Üst menü', 'type' => 'numeric', 'rules' => ['exists']],
                    ],
                ],
                'menu_update' => [
                    'label' => 'Menü Öğesi - Güncelle',
                    'fields' => [
                        'label' => ['label' => 'Etiket', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'url' => ['label' => 'URL', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'target' => ['label' => 'Hedef', 'type' => 'string', 'rules' => ['required', 'in']],
                        'parent_id' => ['label' => 'Üst menü', 'type' => 'numeric', 'rules' => ['exists']],
                    ],
                ],
                'menu_order' => [
                    'label' => 'Menü Öğesi - Sıralama',
                    'fields' => [
                        'order' => ['label' => 'Sıralama', 'type' => 'array', 'rules' => ['required', 'array']],
                        'order.*' => ['label' => 'Sıralama öğesi', 'type' => 'numeric', 'rules' => ['integer', 'exists']],
                    ],
                ],
                'menu_translate' => [
                    'label' => 'Menü Öğesi - Çeviri',
                    'fields' => [
                        'label' => ['label' => 'Etiket', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'lang' => ['label' => 'Dil', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Kullanıcı
                'user_store' => [
                    'label' => 'Kullanıcı - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Ad soyad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'email' => ['label' => 'E-posta adresi', 'type' => 'string', 'rules' => ['required', 'email', 'max', 'unique']],
                        'phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['required', 'string', 'max', 'unique']],
                        'password' => ['label' => 'Şifre', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'role' => ['label' => 'Roller', 'type' => 'array', 'rules' => ['required', 'array']],
                        'role.*' => ['label' => 'Rol', 'type' => 'string', 'rules' => ['exists']],
                    ],
                ],
                'user_update' => [
                    'label' => 'Kullanıcı - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Ad soyad', 'type' => 'string', 'rules' => ['required', 'string', 'max']],
                        'email' => ['label' => 'E-posta adresi', 'type' => 'string', 'rules' => ['required', 'email', 'max', 'unique']],
                        'phone' => ['label' => 'Telefon numarası', 'type' => 'string', 'rules' => ['required', 'string', 'max', 'unique']],
                        'password' => ['label' => 'Şifre', 'type' => 'string', 'rules' => ['string', 'max']],
                        'role' => ['label' => 'Roller', 'type' => 'array', 'rules' => ['required', 'array']],
                        'role.*' => ['label' => 'Rol', 'type' => 'string', 'rules' => ['exists']],
                    ],
                ],
                'user_login' => [
                    'label' => 'Giriş Yap',
                    'fields' => [
                        'email' => ['label' => 'E-posta adresi', 'type' => 'string', 'rules' => ['required', 'email', 'max']],
                        'password' => ['label' => 'Şifre', 'type' => 'string', 'rules' => ['required', 'string']],
                    ],
                ],

                // Rol
                'role_store' => [
                    'label' => 'Rol - Oluştur',
                    'fields' => [
                        'name' => ['label' => 'Rol adı', 'type' => 'string', 'rules' => ['required', 'string', 'max', 'unique']],
                        'permissions' => ['label' => 'İzinler', 'type' => 'array', 'rules' => ['array']],
                        'permissions.*' => ['label' => 'İzin', 'type' => 'string', 'rules' => ['exists']],
                    ],
                ],
                'role_update' => [
                    'label' => 'Rol - Güncelle',
                    'fields' => [
                        'name' => ['label' => 'Rol adı', 'type' => 'string', 'rules' => ['required', 'string', 'max', 'unique']],
                        'permissions' => ['label' => 'İzinler', 'type' => 'array', 'rules' => ['array']],
                        'permissions.*' => ['label' => 'İzin', 'type' => 'string', 'rules' => ['exists']],
                    ],
                ],
            ],
        ],
    ];
}
