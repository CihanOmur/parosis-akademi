<?php

namespace App\Models\Pages\Navbar;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class NavbarPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $casts = [
        'nav_items'            => 'array',
        'show_search'          => 'boolean',
        'show_register_button' => 'boolean',
        'show_login_button'    => 'boolean',
        'show_social_links'    => 'boolean',
        'show_cart_button'     => 'boolean',
        'show_side_info_button'=> 'boolean',
    ];

    public $translatable = [
        'search_placeholder',
        'search_button_text',
        'register_button_text',
        'login_button_text',
    ];
}
