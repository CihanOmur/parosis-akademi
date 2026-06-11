<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'content',
        'image', 'published_at', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public $translatable = ['title', 'content'];

    /**
     * content'ten otomatik üretilen düz metin özet (160 karakter).
     * <img>, <figure>, <iframe>, <script>, <style> tag'leri ve içerikleri silinir,
     * kalan HTML strip edilir, çoklu boşluklar normalize edilir.
     */
    protected function shortDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => self::generateShortDescription($this->content),
        );
    }

    public static function generateShortDescription(?string $html, int $limit = 160): string
    {
        if (empty($html)) {
            return '';
        }

        $cleaned = preg_replace('#<(img|figure|picture|iframe|script|style|video|audio|source)\b[^>]*>.*?</\1>#is', ' ', $html);
        $cleaned = preg_replace('#<(img|source|br|hr|input)\b[^>]*/?>#i', ' ', $cleaned ?? '');
        $text = strip_tags($cleaned ?? '');
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);
        $text = trim($text ?? '');

        return Str::limit($text, $limit, '...');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category');
    }

    public function blogTags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_blog_tag');
    }
}
