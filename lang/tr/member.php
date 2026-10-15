<?php

// Site üyeliği ön yüz ifadeleri (pencere, /uye/*, /hesabim, başlık).
// Doğrulama mesajları Türkçede ValidationMessageService'ten gelir (panel → Doğrulama Mesajları);
// bu dosyaya 'validation' anahtarı EKLENMEZ (bkz. ValidationMessageService::getMessagesForLocale).
return [
    'login'                  => 'Giriş Yap',
    'register'               => 'Kayıt Ol',
    'logout'                 => 'Çıkış Yap',
    'account'                => 'Hesabım',
    'home'                   => 'Ana Sayfa',
    'close'                  => 'Kapat',
    'no_account'             => 'Hesabınız yok mu?',
    'have_account'           => 'Zaten hesabınız var mı?',

    'email_placeholder'      => 'E-posta adresiniz',
    'password_placeholder'   => 'Şifreniz',
    'remember'               => 'Beni hatırla',
    'name_placeholder'       => 'Adınız soyadınız',
    'phone_placeholder'      => 'Telefon numaranız',
    'new_password_placeholder' => 'Şifre (en az 8 karakter)',
    'password_confirm_placeholder' => 'Şifre (tekrar)',
    'privacy_policy'         => 'Gizlilik Politikası',
    'privacy_accept'         => ':link\'nı okudum, kabul ediyorum.',
    'website_label'          => 'Web siteniz',

    'hello'                  => 'Merhaba, :name',
    'member_since'           => 'Üyelik tarihi: :date',
    'my_info'                => 'Bilgilerim',
    'name'                   => 'Ad soyad',
    'email'                  => 'E-posta adresi',
    'phone'                  => 'Telefon',
    'save'                   => 'Kaydet',
    'change_password'        => 'Şifre Değiştir',
    'current_password'       => 'Mevcut şifre',
    'new_password'           => 'Yeni şifre (en az 8 karakter)',
    'new_password_confirm'   => 'Yeni şifre (tekrar)',
    'change_password_button' => 'Şifreyi Değiştir',

    'login_failed'           => 'E-posta adresi veya şifre hatalı.',
    'too_many_attempts'      => 'Çok fazla deneme yaptınız. Lütfen :seconds saniye sonra tekrar deneyin.',
    'welcome'                => 'Hoş geldiniz! Hesabınız oluşturuldu.',
    'info_updated'           => 'Bilgileriniz güncellendi.',
    'password_changed'       => 'Şifreniz değiştirildi.',
];
