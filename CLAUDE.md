# Parosis Akademi — Claude Rehber Dosyası

> ## ✅ BU TURDA YAPILANLAR — 2026-07-29
>
> **1. 56 commit GitHub'a push edildi.** `fix/about-faq-spacing` branch'i sunucu dışında
> hiçbir yerde yoktu. Kimlik doğrulama da yoktu; token başka bir sunucudan
> (`parosis-vnc`, aynı GitHub hesabı) `~/.git-credentials`'e taşındı, `credential.helper store`
> ayarlandı. Git kimliği `Your Name <you@example.com>` → `CihanOmur <furkansoydas2000@gmail.com>`.
>
> **2. Production yapılandırması düzeltildi.**
> `APP_ENV=local` → `production`, `APP_DEBUG=true` → **`false`**,
> `APP_URL=http://localhost` → `https://parosisakademi.com`.
> `.env` yedeği: `~/env-yedek-20260729`. Doğrulama: `/tr`, `/tr/hakkimizda`, `/tr/kurslar`,
> `/tr/iletisim`, `/en`, `/robots.txt`, `/sitemap.xml` hepsi **200**; hata sayfasında
> stack trace / APP_KEY sızıntısı **yok**.
>
> **3. Repoda durmaması gereken dosyalar silindi** (commit `c0f0b13`):
> `parosis-akademi.sql` (212 KB DB dump'ı), `siteconfig.sh` (Apache kuruyordu, sunucu nginx),
> `claude-setup.sh` (container içindi), `docker-compose.yml` (docker kurulu değil),
> `storage/logs/laravel_pre_deploy_20260622.log` (1,6 MB).
> `.gitignore`'a `*.sql` ve `*_pre_deploy_*.log` eklendi.
> ⚠️ Silinen `.sql` git **geçmişinde** duruyor — tam temizlik history rewrite ister, yapılmadı.
>
> **Ele alınmayanlar** (kullanıcı bu turda istemedi): branch adının içerikle alakasız olması
> ve main'e merge edilmemesi, kullanılmayan modeller, zamanlanmış görev/queue worker olmaması,
> `developer` izninin kapsamının netleşmemiş olması.


> Bu dosya her konuşmanın başında okunmalı. Uzun konuşmalarda tekrar okunmalı.
> Son güncelleme: 2026-07-28 (canlı sunucu üzerinde kod + veritabanı incelenerek üretildi)
>
> **DİKKAT: Bu dizin CANLI PRODUCTION ortamıdır.** https://parosisakademi.com bu koddan
> servis edilir. Yerel bir kopya değildir. Bkz. §17 Çalışma Kuralları.

---

## İçindekiler

1. [Proje Özeti ve Amaç](#1-proje-özeti-ve-amaç)
2. [Teknoloji Stack'i](#2-teknoloji-stacki)
3. [Sunucu ve Altyapı](#3-sunucu-ve-altyapı)
4. [Dizin Yapısı](#4-dizin-yapısı)
5. [Veri Modeli](#5-veri-modeli--tablolar-ve-kolonlar)
6. [Modeller](#6-modeller)
7. [Controller ve Route Haritası](#7-controller-ve-route-haritası)
8. [İş Akışları / İçerik Yönetimi](#8-iş-akışları--i̇çerik-yönetimi)
9. [Yetki ve Rol Sistemi](#9-yetki-ve-rol-sistemi)
10. [Arayüz ve Tema](#10-arayüz-ve-tema)
11. [Kurulum ve Çalıştırma](#11-kurulum-ve-çalıştırma)
12. [Deploy](#12-deploy--bu-sunucuda-güncelleme-nasıl-yapılır)
13. [Zamanlanmış Görevler](#13-zamanlanmış-görevler)
14. [Git Durumu](#14-git-durumu)
15. [Bilinen Sorunlar, Eksikler ve TODO](#15-bilinen-sorunlar-eksikler-ve-todo)
16. [Gotcha'lar](#16-gotchalar)
17. [Çalışma Kuralları](#17-çalışma-kuralları)

---

## 1. Proje Özeti ve Amaç

**Parosis Akademi**, tek bir Laravel 12 uygulaması içinde iki ayrı dünyayı barındıran
kurumsal bir web sitesi + yönetim sistemidir:

**A) Kurumsal / Halka Açık Site (front)**
Çok dilli (locale prefix'li) tanıtım sitesi: ana sayfa, hakkımızda, kurslar, kurs detayı,
eğitmenler, eğitmen detayı, blog, blog detayı, SSS, iletişim, site içi arama.
Ayrıca tam işleyen bir **e-ticaret (mağaza)** bölümü: ürün listesi, ürün detayı
(varyantlı), sepet, 3 adımlı ödeme akışı, kupon, stok bildirim talebi ("Haber Ver"),
kurs online başvuru formu.

**B) Yönetim Paneli (`/panel`)**
İki farklı işlevi bir arada tutar:
- **CMS tarafı** — Sitedeki *her metnin* panelden düzenlenebilmesi hedeflenmiş.
  Sayfa metinleri (`*_page_infos` tabloları), menüler, slider, blog, kurs, eğitmen,
  SSS, referans logoları, yorumlar (testimonial), footer/navbar, SEO, sitemap,
  mail ayarları, tema renkleri.
- **Akademi/ERP tarafı** — Öğrenci kayıt (ön kayıt + normal kayıt), veli ve acil
  durum kişisi bilgileri, sınıf/ders yönetimi, taksitli ödeme takibi, PDF belge
  üretimi (kayıt formu / sözleşme / ödeme sözleşmesi), sertifikalar,
  danışmanlık kurumları, yarışmalar ve yarışma katılım takibi.

Bu ikili yapı proje boyunca en kritik bilgidir: `students`, `lesson_classes`,
`student_payments*`, `certificates`, `competitions` tabloları **gerçek canlı iş
verisidir** (85 öğrenci, 86 veli, 626 taksit kaydı). Bunlara asla test/dummy veri
yazılmamalı, migration ile dokunulmamalıdır.

---

## 2. Teknoloji Stack'i

### Backend

| Bileşen | Sürüm / Değer |
|---|---|
| Laravel Framework | **12.60.2** |
| PHP (CLI) | **8.3.16** |
| PHP (FPM havuzu) | `parosisakademi.com` havuzu **PHP 8.4** altında tanımlı (`/etc/php/8.4/fpm/pool.d/parosisakademi.com.conf`) |
| Composer | 2.8.5 |
| Veritabanı | **MariaDB 10.11.8** (MySQL sürücüsü) |
| Spatie Permission | 6.25.0 (`spatie/laravel-permission ^6.21`) |
| Spatie Translatable | `spatie/laravel-translatable ^6.11` |
| PDF | `barryvdh/laravel-dompdf ^3.1` |
| Tinker | `laravel/tinker ^2.10.1` |

`composer.json` içinde `autoload.files` ile **`app/Helpers.php`** global yükleniyor.

Dev bağımlılıkları: `fakerphp/faker`, `laravel/pail`, `laravel/pint`, `laravel/sail`,
`mockery/mockery`, `nunomaduro/collision`, `phpunit/phpunit ^11.5.3`.

### Frontend

| Bileşen | Sürüm | Nerede |
|---|---|---|
| Vite | ^7.0.4 | build aracı |
| Tailwind CSS | **v4.1.11** (`@tailwindcss/vite`) | hem panel hem front |
| Flowbite | ^3.1.2 | panel UI bileşenleri |
| TinyMCE | ^8.6.0 | panel rich-text editör (npm'den `public/tinymce`'a kopyalanır) |
| Alpine.js | 3.x (CDN) | panel reaktivite, sidebar, modal, toast |
| Alpine collapse plugin | 3.x (CDN) | panel — Alpine'dan ÖNCE yüklenmeli |
| jQuery | 3.6.0 (CDN) | panel |
| Select2 | 4.1.0-rc.0 (CDN) | panel dropdown |
| TomSelect | `public/tomselect.css` + CDN | panel çoklu seçim / tagging |
| Sortable.js | (CDN) | panel drag & drop sıralama |
| Swiper | `public/assets-front/css/vendors/swiper-bundle.min.css` | front slider |
| jos.js / menu.css | assets-front | front animasyon + mobil menü |
| Inter font | fonts.bunny.net | panel |
| Poppins + Aeonik Pro | `assets-front/fonts/webfonts/` | front |

**Vite giriş dosyaları** (`vite.config.js`):
```
resources/css/app.css        → panel CSS
resources/js/app.js          → panel JS
resources/css/front.css      → front CSS (Tailwind)
resources/js/tinymce-init.js → TinyMCE başlatıcı
```

**Build komutu**: `npm run build` = `npm run tinymce:copy && vite build`
(`tinymce:copy` = `rm -rf public/tinymce && cp -r node_modules/tinymce public/tinymce`)

### Kaynak Şablon

`parosisakademifront/` klasörü, front tasarımın **satın alınmış orijinal HTML şablonudur**
(index.html, about-2.html, course-details.html, product.html, checkout.html, blog.html,
teacher.html … + `assets/`, `tailwind.config.js`, `pnpm-lock.yaml`). Blade'e port edilirken
referans olarak tutuluyor. Üretimde kullanılmaz — ama **silinmemeli**, yeni sayfa
port edilirken buradan bakılıyor.

`public/assets-front/` = bu şablonun derlenmiş/kopyalanmış statik varlıkları (css, js, img, fonts).
Front layout bunları `asset()` ile doğrudan çeker; Vite'tan geçmez.

---

## 3. Sunucu ve Altyapı

### Erişim

```bash
ssh parosisakademi@159.69.213.197
# Proje kökü:
cd /home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi
```

- **Sunucu:** Hetzner, IP `159.69.213.197`
- **Panel:** **CloudPanel** (Docker YOK — native PHP-FPM + nginx)
- **Sistem kullanıcısı:** `parosisakademi` (root değil; `/etc/nginx/` okunamıyor)
- **Site kökü:** `/home/parosisakademi/htdocs/parosisakademi.com/`
  - `parosis-akademi/` → Laravel projesi (document root = `parosis-akademi/public`, doğrulanmadı; nginx conf'a erişim yok)
  - `public/` → CloudPanel'in oluşturduğu boş varsayılan klasör (kullanılmıyor)
- **Diğer klasörler:** `~/backups`, `~/logs`, `~/tmp`

### Web katmanı

- PHP-FPM havuzu: `[parosisakademi.com]`, `listen = 127.0.0.1:19001`,
  `user/group = parosisakademi`, `pm = ondemand`, `pm.max_children = 250`,
  `pm.max_requests = 100`, `request_terminate_timeout = 7200s`.
  Havuz dosyası **PHP 8.4** altında. (CLI `php` ise 8.3.16 — bkz. §16 Gotcha)
- nginx: CloudPanel yönetiyor, vhost dosyası bu kullanıcı ile okunamıyor (doğrulanmadı).
- **Cloudflare proxy arkasında** — canlı yanıt header'ı `server: cloudflare`, `cf-ray`, `alt-svc: h3`.
  `bootstrap/app.php` içinde `trustProxies(at: '*')` tanımlı; `X-Forwarded-Proto` ile
  HTTPS doğru algılanıyor.
- SSL: Cloudflare edge sertifikası. Origin sertifikası doğrulanamadı.

### Canlı doğrulama (2026-07-28)

| URL | Sonuç |
|---|---|
| `https://parosisakademi.com/` | **302 → `/tr`** |
| `https://parosisakademi.com/tr` | **200** |
| `https://parosisakademi.com/panel/login` | **200** |
| `https://parosisakademi.com/sitemap.xml` | **200** |

Session cookie adı: `parosis_akademi_session` (secure, httponly, samesite=lax).
Güvenlik header'ları mevcut: `X-Frame-Options: SAMEORIGIN`, `X-Content-Type-Options: nosniff`,
`X-XSS-Protection`, `Referrer-Policy: same-origin`.

### Veritabanı

| Anahtar | Değer |
|---|---|
| Sürücü | mysql (MariaDB 10.11.8) |
| Host / Port | `127.0.0.1` : `3306` |
| Veritabanı adı | **`parosis-akademi`** (tire içerir → SQL'de backtick şart) |
| Kullanıcı | `parosis-akademi` |
| Şifre | `.env` içinde `DB_PASSWORD` (dokümana yazılmaz) |
| Tablo sayısı | **68** |
| Toplam boyut | ~2.17 MB |

Sorgu örneği (backtick zorunlu):
```bash
DBP=$(grep '^DB_PASSWORD=' .env | cut -d= -f2-)
mysql -h127.0.0.1 -u'parosis-akademi' -p"$DBP" -e "SELECT * FROM \`parosis-akademi\`.students LIMIT 1"
```

### .env anahtarları (DEĞERLER yazılmaz — sadece isimler)

```
APP_NAME  APP_ENV  APP_KEY  APP_DEBUG  APP_URL  APP_LOCALE  APP_FALLBACK_LOCALE
APP_FAKER_LOCALE  APP_MAINTENANCE_DRIVER  PHP_CLI_SERVER_WORKERS  BCRYPT_ROUNDS
LOG_CHANNEL  LOG_STACK  LOG_DEPRECATIONS_CHANNEL  LOG_LEVEL
DB_CONNECTION  DB_HOST  DB_PORT  DB_DATABASE  DB_USERNAME  DB_PASSWORD
SESSION_DRIVER  SESSION_LIFETIME  SESSION_ENCRYPT  SESSION_PATH  SESSION_DOMAIN
BROADCAST_CONNECTION  FILESYSTEM_DISK  QUEUE_CONNECTION  CACHE_STORE
MEMCACHED_HOST  REDIS_CLIENT  REDIS_HOST  REDIS_PASSWORD  REDIS_PORT
MAIL_MAILER  MAIL_SCHEME  MAIL_HOST  MAIL_PORT  MAIL_USERNAME  MAIL_PASSWORD
MAIL_FROM_ADDRESS  MAIL_FROM_NAME
AWS_ACCESS_KEY_ID  AWS_SECRET_ACCESS_KEY  AWS_DEFAULT_REGION  AWS_BUCKET
AWS_USE_PATH_STYLE_ENDPOINT  VITE_APP_NAME
```

**Mevcut (sorunlu) değerler** — bkz. §15:
```
APP_ENV=local        ← production'da "local"
APP_DEBUG=true       ← production'da debug AÇIK
APP_URL=http://localhost
MAIL_MAILER=log      ← .env'de log; panel ayarları bunu runtime'da override ediyor
```

### Driver'lar (artisan about)

| | |
|---|---|
| Cache | database (`cache` tablosu, 117 satır) |
| Session | database (`sessions` tablosu) |
| Queue | database (`jobs` / `failed_jobs`, ikisi de boş) |
| Broadcasting | log |
| Mail | log (`.env`) — **AppServiceProvider DB ayarlarıyla override ediyor** |
| Filesystem | local |
| Timezone | UTC |
| Locale | tr |
| Maintenance Mode (Laravel) | OFF |
| Config / Events / Routes cache | NOT CACHED |
| Views cache | CACHED |
| `public/storage` symlink | LINKED → `storage/app/public` |

---

## 4. Dizin Yapısı

```
parosis-akademi/
├── ADMIN_PANEL_UI.md         # 96 KB — panel UI bileşen referansı (kopyala-yapıştır kütüphanesi)
├── CLAUDE.md                 # bu dosya
├── README.md                 # Laravel varsayılan
├── todo.md                   # proje TODO / tamamlananlar listesi (8 KB, kısmen eski)
├── tasks.md                  # görev takibi (Bekleyen/Devam Eden/Tamamlanan)
├── claude-setup.sh           # Claude ortam kurulum scripti (container içindi, burada gereksiz)
├── siteconfig.sh             # Apache vhost kurulum scripti (bu sunucuda kullanılmıyor — nginx var)
├── docker-compose.yml        # ESKİ yerel geliştirme (macOS yol içerir) — sunucuda kullanılmaz
├── parosis-akademi.sql       # 214 KB DB dump (yedek)
├── .claude/settings.json     # Claude izinleri (hepsi allow)
├── app/
│   ├── Console/Commands/     # 3 komut (rol/izin üretici)
│   ├── Enums/ResponseCode.php
│   ├── Helpers.php           # global fonksiyonlar (autoload.files ile yüklenir)
│   ├── Http/
│   │   ├── Controllers/      # 47 controller (alt klasörlere ayrılmış)
│   │   └── Middleware/       # SetLocale, SharedDatas, CheckMaintenanceMode
│   ├── Mail/                 # ContactFormMail, OrderConfirmationMail, OrderStatusMail
│   ├── Models/               # ~80 model dosyası
│   ├── Providers/AppServiceProvider.php
│   └── Services/ValidationMessageService.php
├── bootstrap/app.php         # middleware alias, cookie şifreleme istisnası, trustProxies
├── bootstrap/providers.php   # sadece AppServiceProvider
├── config/                   # app, auth, cache, database, filesystems, logging, mail,
│                             # permission, queue, services, session, turkiye_iller
├── database/
│   ├── migrations/           # 119 migration (DB'de kayıtlı)
│   ├── seeders/              # 11 seeder
│   └── factories/
├── lang/
│   ├── tr/validation.php
│   └── *.json                # 22 dil JSON dosyası
├── public/
│   ├── assets-front/         # front şablon statikleri (css/js/img/fonts)
│   ├── build/                # Vite çıktısı (gitignore)
│   ├── tinymce/              # npm'den kopyalanan TinyMCE (gitignore)
│   ├── uploads/              # panelden yüklenen dosyalar — 91 MB (gitignore, .gitkeep hariç)
│   │   ├── blogs/ courses/ pages/ products/ settings/ sliders/ testimonials/
│   ├── storage → ../storage/app/public   (symlink)
│   ├── index.php  .htaccess  robots.txt  favicon.ico  tomselect.css
├── parosisakademifront/      # orijinal satın alınmış HTML şablon (referans)
├── resources/
│   ├── css/  app.css (panel) · front.css (front)
│   ├── js/   app.js · bootstrap.js · tinymce-init.js
│   └── views/                # 216 blade dosyası
├── routes/
│   ├── web.php               # 56 KB — TÜM route'lar burada
│   └── console.php           # sadece `inspire` komutu — ZAMANLANMIŞ GÖREV YOK
├── storage/                  # 4.4 MB · logs/laravel.log (111 KB)
└── vendor/  node_modules/
```

### Blade view ağacı

```
resources/views/
├── admin/
│   ├── layouts/     app · aside · navbar · theme-vars · toast
│   ├── components/  action-button-student · are-you-sure-modal · language-tabs
│   │                payment-alert · student-new-add-modal · tab-menu-student
│   ├── blog/ (+categories, tags) · classes · client-logo
│   ├── competitions/ (+partials) · consulting-institutions · coupons
│   ├── course/ (+categories) · course-applications · faq · languages
│   ├── menu-items · orders · pages/ (+partials) · product-attributes
│   ├── product-categories · products · reference · roles
│   ├── settings/ (+partials: tab-general/logos/seo/mail/social/advanced)
│   ├── slider/ (+items) · stock-requests · students/ (+partials)
│   ├── students-payments · teacher · testimonial · theme · users
├── auth/login.blade.php
├── components/      # global x-components
│   action-menu · back-button · checkbox-dropdown · count-badge
│   form-button · image-upload · textarea · text-input
├── dashboard/index.blade.php
├── emails/          layout · contact-form · order-confirmation · order-status
├── errors/          401 402 403 404 419 429 500 503 + layout + minimal
├── front/
│   ├── layouts/app.blade.php
│   ├── partials/  header · footer · modals · blog-card · category-card
│   │              course-card · checkout-stepper
│   ├── pages/     home · about · courses · course-details · teachers
│   │              teacher-details · blog · blog-details · faq · contact
│   │              search · products · product-details · cart · checkout
│   │              checkout-confirm
│   └── maintenance.blade.php
├── vendor/pagination/   # tailwind + simple-tailwind (AppServiceProvider'da set edilir)
└── welcome.blade.php
```

---

## 5. Veri Modeli — Tablolar ve Kolonlar

68 tablo. Aşağıdaki kolon listeleri **canlı `information_schema`'dan** çekilmiştir.
Satır sayıları 2026-07-28 itibarıyladır.

### 5.1 Laravel çekirdek

| Tablo | Satır | Kolonlar |
|---|---|---|
| `migrations` | 119 | id, migration, batch |
| `cache` | 117 | key (PK), value, expiration |
| `cache_locks` | 0 | key (PK), owner, expiration |
| `jobs` | 0 | id, queue, payload, attempts, reserved_at, available_at, created_at |
| `job_batches` | 0 | id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at |
| `failed_jobs` | 0 | id, uuid (UNI), connection, queue, payload, exception, failed_at |
| `sessions` | 74 | id (PK), user_id, ip_address, user_agent, payload, last_activity |
| `password_reset_tokens` | 0 | email (PK), token, created_at |

### 5.2 Kullanıcı / Yetki

**`users`** (11 satır)
`id, name, email(UNI), username, image_url, email_verified_at, password, remember_token,
created_at, updated_at, is_visible(tinyint, def 1), phone`

`is_visible=0` → kullanıcı listelerinde gizlenir (SuperAdmin gizli hesap için).

**`roles`** (6) — `id, name(UNI), guard_name, is_visible(def 1), created_at, updated_at`
**`permissions`** (37) — `id, name(UNI), guard_name, created_at, updated_at`
**`model_has_roles`** (15) — `role_id, model_type, model_id` (bileşik PK)
**`model_has_permissions`** (0) — `permission_id, model_type, model_id`
**`role_has_permissions`** (87) — `permission_id, role_id`

### 5.3 Akademi / Öğrenci (CANLI İŞ VERİSİ — DOKUNMA)

**`students`** (85)
`id, registration_type enum('1','2') NOT NULL, full_name, gender enum('Erkek','Kadın') NOT NULL,
birth_date, school_name, national_id, blood_type, notes, class_id(FK lesson_classes, nullable),
has_allergy(bool def 0), allergy_detail, created_at, updated_at, is_active(def 1),
student_phone, registiration_term(text), meets_status`

> `registration_type`: `1` / `2` — ön kayıt ve normal kayıt ayrımı için kullanılıyor
> (hangisinin hangisi olduğu kod içinde `PreRegistrationController` üzerinden takip edilmeli).
> **`registiration_term` yazım hatası bilinçli değil ama şemada böyle — düzeltilirse migration gerekir.**

**`student_guardians`** (86) — veli bilgileri (öğrenci başına en fazla 2)
`id, student_id(FK), full_name, national_id, relationship, birth_date, education_level,
job, phone_1, phone_2, email, home_address(text), work_address(text), active(def 1),
created_at, updated_at`

**`emergency_contacts`** (85)
`id, student_id(FK), full_name, relationship, phone, address(text), created_at, updated_at`

**`lesson_classes`** (17)
`id, name, day, time(time def '07:00:00'), end_time(time def '07:00:00'), price decimal(12,2),
quota int unsigned, teacher_id **varchar(255)**, course_id(FK courses, nullable),
start_date, end_date, course_time, created_at, updated_at`

> **`teacher_id` varchar** — FK değil, `users` tablosundaki eğitmen id'sini string tutuyor.
> `LessonClass::teacher()` ilişkisi `HasOne` olarak tanımlı (mantıken BelongsTo olmalıydı).

**`lesson_class_days`** (17)
`id, lesson_class_id(FK), day, start_time(def '07:00:00'), end_time(def '07:00:00'),
created_at, updated_at`

**`student_payments`** (85)
`id, student_id(FK), class_id(FK), installment_count int unsigned def 0,
total_price **varchar(230)** def '0', total_payed_price **varchar(230)** def '0',
start_date, created_at, updated_at, registiration_term(text)`

**`student_payments_installments`** (626)
`id, student_id(FK), student_payment_id(FK), order int unsigned, payment_date,
installment_price **varchar(230)** def '0', payed_price **varchar(230)** def '0',
payment_type varchar def 'Nakit', created_at, updated_at, payyed_date(date), note(text)`

> **Para alanları decimal değil VARCHAR.** Toplama/karşılaştırma yaparken cast gerekir.
> `payyed_date` yazım hatası şemada mevcut (çift y).

### 5.4 Sertifika / Yarışma / Danışmanlık

**`consulting_institutions`** (6)
`id, name(200), contact_email, contact_phone, notes(text), is_active(def 1), sort_order, ts`

**`certificates`** (15)
`id, student_id(FK), type varchar(20) [indexed], name(200),
consulting_institution_id(FK nullable), issuer_text(200), category_id(FK nullable),
issue_date(date, NOT NULL), certificate_number(100), file_path, notes(text), ts`

> `type` = sertifika tipi (kurumsal / danışmanlık / yarışma). `Certificate` modelinde
> `getIssuerNameAttribute()` ve `getTypeLabelAttribute()` accessor'ları var.

**`competitions`** (6)
`id, name(200), organizer(200), country(100), city(100), location(200), start_date,
end_date, internal_deadline(date), description(text), website_url(500), is_active(def 1),
sort_order, ts`

**`competition_categories`** (7) — `id, name(200), slug(220, UNI), ts`
(model `booted()` içinde slug otomatik üretiliyor)

**`competition_competition_category`** (14) — pivot: `competition_id`, `competition_category_id`

**`competition_student`** (13) — yarışma katılım kaydı (zengin pivot)
```
id, student_id(FK), competition_id(FK), competition_category_id(FK nullable),
team_name(200),
parent_consent_status varchar(20) def 'bekliyor',
passport_valid_6m tinyint def 0,
passport_status     varchar(20) def 'yok',
visa_status         varchar(20) def 'gerekli_degil',
payment_status      varchar(20) def 'bekliyor',
payment_amount decimal(10,2), payment_currency varchar(5) def 'TRY',
result_rank int unsigned [indexed], result_label(100), result_notes(text),
result_file(255), joined_at(date), ts
```
`CompetitionStudent` modelinde 4 label accessor: `getParentConsentLabelAttribute`,
`getPassportLabelAttribute`, `getVisaLabelAttribute`, `getPaymentLabelAttribute`.

### 5.5 Çok dillilik ve içerik

**`languages`** (21)
`id, name **longtext (JSON — translatable)**, locale varchar(230), is_active(def 0),
is_visible(def 0), is_default(def 0), sort_order int unsigned, status(def 1), ts`

Canlı durum:

| locale | is_active | is_visible | is_default | sort | Not |
|---|---|---|---|---|---|
| `tr` | 1 | 1 | **1** | 0 | Varsayılan dil |
| `en` | 1 | 1 | 0 | 3 | Yayında |
| `de` `ar` `en-gb` `es` `fa` `fr` `hi` `it` `ja` `ko` `nl` `pl` `pt` `pt-br` `ru` `sv` `ur` `zh-cn` `zh-tw` | 0 | 0 | 0 | 1–20 | Tanımlı ama kapalı |

> Yani **canlıda yalnızca `tr` ve `en` yayında.** 19 dil hazır bekliyor.
> `status` = kayıt aktif mi; `is_active` = sitede kullanılabilir mi; `is_visible` = müşteriye/dil
> seçicide görünür mü. Üçü de ayrı ayrı kontrol ediliyor.

**Sayfa içerik tabloları (`*_page_infos`) — hepsi tek satırlık (singleton)**

Ortak desen: her tablo `breadcrumb_bg_color`, `breadcrumb_bg_image`, `cta_enabled`,
`field_styles` (JSON), `default_styles` (JSON) + kendi alanları.
`longtext` olan tüm metin alanları Spatie Translatable JSON'ı tutar.

| Tablo | Satır | Öne çıkan alanlar |
|---|---|---|
| `home_page_infos` | 1 | welcome_*, categories_*, features, courses_*, blog_*, why_*, client_logo_text, funfact_image/items, testimonial_*, cta_* |
| `about_us_page_infos` | 1 | section1_* (label/title/desc/features/feature1-2/image1-2/stat), section2_*, categories_*, video_image/url, logos_text, testimonial_*, faq_* (+faq_image1-3), blog_*, cta_* |
| `contact_page_infos` | 1 | title, subtitle, description, form_*, phones/emails/addresses (JSON), phone_1/2, email_1/2, address_line_1/2, map_embed_url, contact_form_image, form_action_url, cta_* |
| `faq_page_infos` | 1 | title, subtitle, description, section_*, form_*, cta_* |
| `blog_page_infos` | 1 | title, sidebar_search_*, sidebar_categories/popular/contact/tags_title, sidebar_contact_phone/email/address(+label), detail_breadcrumb_current, cta_* |
| `course_page_infos` | 1 | title, search_*, result_text, detail_what_learn_title, detail_why_choose_title, sidebar_* (info/price/instructor/certification/lessons/duration/language/students/contact), cta_* |
| `teacher_page_infos` | 1 | title, subtitle, breadcrumb_*, detail_breadcrumb_current, cta_* |
| `shop_page_infos` | 1 | **~90 kolon** — products_*, detail_*, cart_*, checkout_* (3 adım, kart önizleme etiketleri, tüm placeholder'lar) |
| `navbar_page_infos` | 1 | nav_items(JSON), search_placeholder/button, register/login_button_text, show_search / show_register_button / show_login_button / show_social_links / show_cart_button / show_side_info_button (görünürlük anahtarları) |
| `footer_page_infos` | 1 | logo, about_text, links_title, contact_title, newsletter_* , copyright_text, support/email/address_label, social_links(JSON), nav_links(JSON) |

**`menu_items`** (7) — hiyerarşik navigasyon
`id, parent_id(self FK), label(longtext translatable), url(def '#'), target(def '_self'),
sort_order, is_active(def 1), ts`
Model `getLocalizedUrlAttribute()` ile locale-aware URL üretiyor; 3 seviyeye kadar
`children` eager-load ediliyor (`SharedDatas`).

**`sliders`** (2) — `id, name, sort_order, is_active(def 0), ts`
**`slider_items`** (6) — `id, slider_id(FK), title, highlight_text, description, button_text,
button_url, image, background_image, sort_order, is_active(def 1), ts`
(title/highlight_text/description/button_text translatable)

**`blogs`** (6) — `id, title, content, short_description, image, published_at, is_active, sort_order, ts`
**`blog_categories`** (5) — `id, name, description, image, is_active, sort_order, ts`
**`blog_tags`** (7) — `id, name, is_active, sort_order, ts`
**`blog_blog_category`** (8) / **`blog_blog_tag`** (10) — pivotlar

**`courses`** (8)
`id, title, short_description, content, what_you_learn, why_choose, image, inner_image,
price(varchar), duration, lesson_count(int), language, student_count(int),
has_certification(bool), instructor_name, instructor_image, is_active, sort_order,
published_at, ts`

**`course_categories`** (6) — `id, name, description, icon, color, is_active, sort_order, ts`
**`course_course_category`** (17) — pivot

**`course_applications`** (2) — kurs online başvuru formu
`id, course_id(FK nullable), student_name, student_age tinyint unsigned, school, grade,
parent_name, phone, email, status varchar def 'pending', note(text), contacted_at, ts`

**`teachers`** (7)
`id, name, title, short_description, bio, image, phone, email,
facebook_url, twitter_url, dribbble_url, instagram_url, is_active, sort_order, ts`

**`faqs`** (7) — `id, question, answer, category_id(FK nullable), sort_order, is_active, ts`
**`testimonials`** (6) — `id, name, role, quote, image, **gender varchar(10)**, rating(def 5), sort_order, is_active, ts`
**`client_logos`** (9) — `id, name, image(NOT NULL), url, sort_order, is_active, ts`

### 5.6 Mağaza (E-ticaret)

**`products`** (3)
`id, name, short_description, description, features, sku(UNI), image, price decimal(10,2) def 0,
sale_price decimal(10,2), stock int def 0, manage_stock(def 1), is_active(def 1),
**free_shipping(def 0)**, sort_order, ts`

**`product_categories`** (4) — `id, name, image, is_active, sort_order, ts`
**`product_product_category`** (3) — pivot

**`product_attributes`** (2) — `id, name, is_active, sort_order, ts`
**`product_attribute_values`** (8) — `id, product_attribute_id(FK), name, **color_code**, is_active, sort_order, ts`
**`product_variants`** (16) — `id, product_id(FK), sku, price decimal(10,2) nullable, stock, image, is_active, sort_order, ts`
**`product_variant_attribute_value`** (28) — pivot: variant ↔ attribute value
**`product_images`** (3) — `id, product_id(FK), image, sort_order, ts`

**`orders`** (9)
```
id, order_number(UNI),
status enum('pending','processing','shipped','delivered','cancelled') def 'pending',
customer_name, customer_email, customer_phone,
shipping_address, shipping_city, shipping_district, shipping_zip,
shipping_country def 'Türkiye',
subtotal / shipping_cost / total decimal(10,2) def 0,
coupon_id(FK nullable), coupon_code, discount_amount decimal(10,2) def 0,
customer_note(text), admin_note(text), ts
```

**`order_items`** (15)
`id, order_id(FK), product_id(FK nullable), product_variant_id(FK nullable),
product_name, variant_info(longtext), product_image, quantity(def 1),
unit_price, total_price, ts`
(ürün silinse bile sipariş satırı adı/görseli snapshot olarak saklanıyor)

**`coupons`** (8)
`id, code(UNI), type enum('percentage','fixed'), value decimal(10,2),
min_order_amount def 0, max_discount_amount, usage_limit, used_count def 0,
starts_at(date), expires_at(date), is_active(def 1), ts`

**`stock_notification_requests`** (0) — "Haber Ver" talepleri
`id, product_id(FK), email, note(text), notified_at, ts`

### 5.7 Site ayarları / SEO

**`settings`** (35) — `id, group(def 'general', indexed), key, value(longtext), ts`
Grup → anahtar dökümü (canlıdaki gerçek kayıtlar):

| group | key'ler |
|---|---|
| `general` | site_name, site_description, site_email, site_phone, site_address, copyright_text, timezone |
| `logos` | header_logo, footer_logo, admin_logo, favicon |
| `seo` | meta_title, meta_description, meta_keywords, robots_txt, sitemap_url, google_analytics_id, google_tag_manager_id |
| `mail` | mail_mailer, mail_host, mail_port, mail_username, mail_encryption, mail_from_address, mail_from_name (+ `mail_password` — şifreli) |
| `social` | facebook_url, instagram_url, twitter_url, linkedin_url, youtube_url, tiktok_url, whatsapp_number |
| `advanced` | maintenance_mode, custom_head_code, custom_body_code |

Ayrıca kod tarafından kullanılan (henüz kayıt olmayabilir) gruplar:
`sidebar_theme` (tema renkleri), `validation_messages`, `validation_attributes`,
`vm_<formKey>` (form bazlı doğrulama mesajı override'ları).

**`sitemap_entries`** (0) — `id, loc, changefreq(def 'monthly'), priority(def '0.5'), is_active(def 1), sort_order, ts`

---

## 6. Modeller

`app/Models/` altında ~80 dosya; alt klasörlerle gruplanmış. Bir kısmı **eski/kullanılmayan**
şablon modelleridir (Teams, Projects, References, Services, Contact*, Category) —
bunların migration'ı yok, sadece kod olarak duruyor (bkz. §15).

### 6.1 Spatie Translatable kullanan modeller

`use HasTranslations;` + `public $translatable = [...]`:

| Model | translatable alanlar |
|---|---|
| `Languages\Languages` | (dil adları — çok dilli) |
| `Blogs\Blog` | title, content |
| `Blogs\BlogCategory` | name, description |
| `Blogs\BlogTag` | name |
| `Courses\Course` | title, short_description, content, what_you_learn, why_choose |
| `Courses\CourseCategory` | name, description |
| `Teacher\Teacher` | (name, title, short_description, bio …) |
| `Faq\Faq` | question, answer |
| `Testimonial\Testimonial` | (role, quote …) |
| `MenuItem` | label |
| `Slider\SliderItem` | title, highlight_text, description, button_text |
| `Shop\Product` | name, short_description, description, features |
| `Shop\ProductCategory` | name |
| `Shop\ProductAttribute` | name |
| `Shop\ProductAttributeValue` | name |
| `Pages\*\*PageInfo` (11 adet) | ilgili tüm metin alanları |
| **Kullanılmayanlar:** `Teams\*`, `Projects\*`, `References`, `Services`, `Category`, `Contact\ContactAddress` | — |

**Erişim deseni:** `translateAttribute($model, 'title', $locale)` global helper'ı
(`app/Helpers.php`) — model `$translatable` içinde değilse ham değeri döndürür,
varsa `getTranslation()` kullanır.

### 6.2 Öne çıkan ilişki ve accessor'lar

**`Student\Student`**
`guardians()` HasMany · `emergencyContact()` · `lessonClass()` · `payments()` ·
`certificates()` HasMany · `competitions()` BelongsToMany (pivot: competition_student) ·
`competitionEntries()` HasMany

**`Student\StudentPayments`** — `installments()` HasMany · `class()` BelongsTo · `student()` BelongsTo

**`Competition`** — `categories()` BelongsToMany · `participants()` BelongsToMany ·
`entries()` HasMany · `getDateRangeAttribute()` · `getCountryCityAttribute()`

**`CompetitionStudent`** (`protected $table = 'competition_student'`) —
`student()` · `competition()` · `category()` + 4 label accessor

**`Certificate`** — `student()` · `consultingInstitution()` · `category()` ·
`getIssuerNameAttribute()` (kurum varsa kurum adı, yoksa `issuer_text`) · `getTypeLabelAttribute()`

**`Shop\Product`** — `categories()` · `variants()` · `images()` ·
`getEffectivePriceAttribute()` (sale_price varsa o) · `hasVariants()`

**`Shop\ProductVariant`** — `product()` · `attributeValues()` ·
`getEffectivePriceAttribute()` (varyant fiyatı yoksa ürün fiyatı) · `getLabelAttribute()`

**`Shop\Order`** — `items()` · `coupon()` · `static generateOrderNumber()` ·
`getStatusLabelAttribute()` · `getStatusColorAttribute()`

**`Shop\Coupon`** — `isValid($subtotal)` · `calculateDiscount($subtotal)` · `incrementUsage()`

**`MenuItem`** — `parent()` · `children()` · `allChildren()` (recursive) · `getLocalizedUrlAttribute()`

**`Blogs\Blog`** — `categories()` · `blogTags()` · `shortDescription()` Attribute cast
(içerikten otomatik kısa açıklama türetiyor)

**`Slider\Slider`** — `items()` · `activeItems()`

**`Setting`** — statik API: `get($key,$default,$group)` · `set()` · `getGroup($group)` ·
`saveGroup($group,$data)`.
- **24 saatlik `Cache::remember`** ile cache'lenir (`setting.{group}.{key}`, `settings.group.{group}`).
- `mail.mail_password` **`Crypt::encryptString` ile şifreli saklanır** (`$encryptedKeys`).
  Eski düz metin değerler decrypt hatasında olduğu gibi döner (geriye dönük uyum).

**`User\User`** — `HasRoles` (Spatie) + `casts()`.
**`Role\Role`, `Role\Permission`** — Spatie modellerini genişletir; `roles()`/`permissions()`/`users()`.

---

## 7. Controller ve Route Haritası

**Toplam 320 route.** Hepsi tek dosyada: `routes/web.php` (56 KB).
API route dosyası **yok** (`bootstrap/app.php` yalnızca `web` + `console` + `health: /up` kaydeder).

### 7.1 Middleware alias'ları (`bootstrap/app.php`)

```php
'role'              => Spatie\Permission\Middleware\RoleMiddleware
'permission'        => Spatie\Permission\Middleware\PermissionMiddleware
'role_or_permission'=> Spatie\Permission\Middleware\RoleOrPermissionMiddleware
'setlocale'         => App\Http\Middleware\SetLocale
```

Ayrıca:
- `encryptCookies(except: ['app_locale'])` — dil cookie'si düz saklanır (SetLocale doğruluyor)
- `trustProxies(at: '*', headers: FOR|HOST|PORT|PROTO|AWS_ELB)` — Cloudflare için

Alias'ı olmayan ama sınıf olarak kullanılan middleware'ler:
`App\Http\Middleware\SharedDatas::class`, `App\Http\Middleware\CheckMaintenanceMode::class`

### 7.2 Panel route'ları — `/panel` · `middleware(['auth', SharedDatas])`

| Prefix | name. | Controller | İzin (permission:) |
|---|---|---|---|
| `` (kök) | `dashboard.index` | `DashboardController@index` | — (sadece auth) |
| `languages` | `languages.` | `Languages\LanguagesController` | `language` |
| `roles` | `roles.` | `Role\RoleController` | `role` / delete: `role_delete` |
| `users` | `users.` | `User\UserController` | `user` / delete: `user_delete` / detail: `user\|class\|student` |
| `class` | `class.` | `Class\LessonClassController` | `class` / `class_delete` |
| `students` | `students.` | `Student\*` (5 controller) | `student` / `student_delete` / `accounting` |
| `faq` | `faq.` | `Faq\FaqController` | `faq` / `faq_delete` |
| `teachers` | `teachers.` | `Teacher\TeacherController` | `teacher` / `teacher_delete` |
| `blogs` | `blogs.` | `Blog\BlogController` | `blog` / `blog_delete` |
| `blog-categories` | `blogCategories.` | `Blog\BlogCategoryController` | `blog` / `blog_delete` |
| `blog-tags` | `blogTags.` | `Blog\BlogTagController` | `blog` / `blog_delete` |
| `courses` | `courses.` | `Course\CourseController` | `course` / `course_delete` |
| `course-categories` | `courseCategories.` | `Course\CourseCategoryController` | `course` / `course_delete` |
| `course-applications` | `course-applications.` | `Courses\CourseApplicationController` | `course\|course_delete` |
| `consulting-institutions` | `consultingInstitutions.` | `ConsultingInstitution\*` | `consulting_institution` / `_delete` |
| `competitions` | `competitions.` | `Competition\CompetitionController` | `competition` / `competition_delete` |
| `testimonials` | `testimonials.` | `Testimonial\TestimonialController` | `testimonial` / `testimonial_delete` |
| `client-logos` | `client-logos.` | `ClientLogo\ClientLogoController` | `client_logo` / `client_logo_delete` |
| `sliders` | `sliders.` | `Slider\SliderController` | `slider` / `slider_delete` |
| `sliders/{sliderId}/items` | `sliders.items.` | `Slider\SliderItemController` | `slider` (grup seviyesinde) |
| `menu-items` | `menu-items.` | `MenuItem\MenuItemController` | `menu` (grup seviyesinde) |
| `product-categories` | `productCategories.` | `Shop\ProductCategoryController` | `shop` / `shop_delete` |
| `product-attributes` | `productAttributes.` | `Shop\ProductAttributeController` | `shop` / `shop_delete` |
| `products` | `products.` | `Shop\ProductController` | `shop` / `shop_delete` |
| `siparisler` | `orders.` | `Shop\OrderController` | `shop` / `shop_delete` |
| `kuponlar` | `coupons.` | `Shop\CouponController` | `shop` / `shop_delete` |
| `stock-requests` | `stock-requests.` | `Shop\StockNotificationController` | `shop\|shop_delete` |
| `pages` | `pages.` | `Pages\PagesController` | `page` (grup seviyesinde) |
| `settings` | `settings.` | `Settings\SettingsController` | `settings` (grup seviyesinde) |
| `theme` | `theme.` | `Theme\ThemeController` | `theme` (grup seviyesinde) |
| `settings/validation-messages` | `settings.validationMessages.` | `Settings\ValidationMessageController` | **`developer`** |
| `reference` | `reference.index` | closure → `admin.reference.index` | **izin yok** (bkz. §15) |

#### Standart CRUD deseni (neredeyse tüm içerik modülleri)

```
GET    /panel/<x>                        → index          permission:<p>|<p>_delete
GET    /panel/<x>/create                 → create         permission:<p>
POST   /panel/<x>/store                  → store          permission:<p>
GET    /panel/<x>/{id}/edit              → edit           permission:<p>
POST   /panel/<x>/{id}/update            → update         permission:<p>
DELETE /panel/<x>/{id}                   → delete         permission:<p>_delete
POST   /panel/<x>/update-order           → updateOrder    permission:<p>   (Sortable.js)
POST   /panel/<x>/{id}/toggle            → toggleActive   permission:<p>
GET    /panel/<x>/{id}/translate/{lang}  → editTranslate  permission:<p>
POST   /panel/<x>/{id}/translate         → updateTranslate permission:<p>
```

> **`update`/`store` POST'tur, PUT/PATCH değil.** Tek istisna sitemap-entries
> (`PUT`, `PATCH`, `DELETE` kullanıyor).

#### Dil yönetimi — özel kural

`permission:language` grubu içinde, şu 5 işlem ayrıca **`role:SuperAdmin`** ister:
```
GET  /panel/languages/create        languages.create
POST /panel/languages/store         languages.store
POST /panel/languages/set-default   languages.setDefault
POST /panel/languages/toggle-visibility  languages.toggleVisibility
DELETE /panel/languages/{id}        languages.delete
```
`index`, `toggle`, `update-order`, `edit`, `update` ise `language` izni olan herkese açık.

#### Öğrenci modülü route'ları (en karmaşık grup)

```
GET    /panel/students                              students.index        student|student_delete|accounting
GET    /panel/students/create                       students.create       student
POST   /panel/students/store                        students.store        student
GET    /panel/students/{id}/edit                    students.edit         student
POST   /panel/students/{id}/update                  students.update       student
POST   /panel/students/{id}/change-activity         students.changeActivity  student
DELETE /panel/students/{id}                         students.delete       student_delete

# Yeniden kayıt
GET/POST /panel/students/{id}/re-create             students.reCreate / reCreateUpdate   student

# Ödeme
GET  /panel/students/{id}/payment                   students.payment      student|accounting
POST /panel/students/{id}/payment                   students.paymentUpdate student|accounting
GET  /panel/students/{id}/payments                  students.allPayments  student|accounting

# Sekmeler
GET  /panel/students/{id}/certificates              students.certificates   student|accounting|certificate
GET  /panel/students/{id}/competitions              students.competitions   student|accounting|competition

# PDF belgeler (POST)
POST /panel/students/downloadRegistrationForm       students.downloadRegistrationForm  student|student_delete|accounting
POST /panel/students/downloadContract               students.downloadContract          student|accounting|student_delete
POST /panel/students/downloadPayment                students.downloadPayment           student|accounting|student_delete

# Ön kayıt
GET  /panel/students/create-pre-registiration       students.pre.createPreRegistiration  student
POST /panel/students/store-pre-registiration        students.pre.storePreRegistiration   student
GET  /panel/students/{id}/edit-pre-registiration    students.pre.editPreRegistiration    student
POST /panel/students/{id}/update-pre-registiration  students.pre.updatePreRegistiration  student
GET  /panel/students/pre/students                   students.pre.students                student
GET/POST /panel/students/{id}/pre-to-normal         students.pre-to-normal(.post)        student

# Sertifika (öğrenci altında)
POST   /panel/students/{student}/certificates                          certificates.store     student|certificate
POST   /panel/students/{student}/certificates/{certificate}/update     certificates.update    student|certificate
DELETE /panel/students/{student}/certificates/{certificate}            certificates.destroy   student_delete|certificate_delete
GET    /panel/students/{student}/certificates/{certificate}/download   certificates.download  student|accounting|certificate

# Yarışma katılımı (öğrenci altında)
POST   /panel/students/{student}/competitions                                    competitions.attach     student|competition
DELETE /panel/students/{student}/competitions/{entry}                            competitions.detach     student_delete|competition_delete
POST   /panel/students/{student}/competitions/{entry}/statuses                   competitions.statuses   student|competition
POST   /panel/students/{student}/competitions/{entry}/result                     competitions.result     student|competition
GET    /panel/students/{student}/competitions/{entry}/result-file                competitions.resultFile student|accounting|competition
POST   /panel/students/{student}/competitions/{entry}/create-certificate         competitions.createCertificate  student|certificate
```

> **Not:** URL'lerde `pre-registiration` yazım hatası var (registration değil).
> Route adları da öyle. Değiştirilirse tüm blade `route()` çağrıları kırılır.

#### Ürün modülü ek route'ları

```
POST   /panel/products/{id}/generate-variants   products.generateVariants  shop
POST   /panel/products/{id}/update-variants     products.updateVariants    shop
DELETE /panel/products/variants/{variantId}     products.variants.delete   shop_delete
POST   /panel/products/{id}/upload-gallery      products.uploadGallery     shop
DELETE /panel/products/images/{imageId}         products.images.delete     shop
POST   /panel/products/images/update-order      products.images.updateOrder shop
```

#### Ayarlar route'ları (`permission:settings`)

```
GET   /panel/settings                        settings.index
POST  /panel/settings/general                settings.updateGeneral
POST  /panel/settings/logos                  settings.updateLogos
POST  /panel/settings/seo                    settings.updateSeo
POST  /panel/settings/mail                   settings.updateMail
POST  /panel/settings/mail/test              settings.testMail
POST  /panel/settings/social                 settings.updateSocial
POST  /panel/settings/advanced               settings.updateAdvanced
POST   /panel/settings/sitemap-entries                      settings.sitemapEntries.store
PUT    /panel/settings/sitemap-entries/{sitemapEntry}       settings.sitemapEntries.update
PATCH  /panel/settings/sitemap-entries/{sitemapEntry}/toggle settings.sitemapEntries.toggle
DELETE /panel/settings/sitemap-entries/{sitemapEntry}       settings.sitemapEntries.destroy
```

### 7.3 Auth route'ları

```
GET  /panel/login    → closure, view('auth.login')      name: login
POST /panel/login    → UserController@login             name: loginPost   throttle:5,1
POST /panel/logout   → UserController@logout            name: logout
```
Kayıt (register) / şifre sıfırlama route'u **yok** — kullanıcılar sadece panelden açılır.

### 7.4 Front route'ları — `/{locale}` prefix

```php
Route::prefix('{locale}')
  ->where(['locale' => '[a-z]{2}(-[a-z]{2,4})?'])
  ->middleware(['setlocale', SharedDatas::class, CheckMaintenanceMode::class])
  ->name('front.')
```

| Method | URI | name | Controller |
|---|---|---|---|
| GET | `/{locale}` | `front.home` | `FrontController@home` |
| GET | `/{locale}/hakkimizda` | `front.about` | `FrontController@about` |
| GET | `/{locale}/ara` | `front.search` | `FrontController@search` |
| GET | `/{locale}/ara/suggest` | `front.search.suggest` | `FrontController@searchSuggest` |
| GET | `/{locale}/kurslar` | `front.courses` | `FrontController@courses` |
| GET | `/{locale}/kurs-detay/{id}` | `front.course.details` | `FrontController@courseDetails` |
| GET | `/{locale}/egitmenler` | `front.teachers` | `FrontController@teachers` |
| GET | `/{locale}/egitmen-detay/{id}` | `front.teacher.details` | `FrontController@teacherDetails` |
| GET | `/{locale}/blog` | `front.blog` | `FrontController@blog` |
| GET | `/{locale}/blog-detay/{id}` | `front.blog.details` | `FrontController@blogDetails` |
| GET | `/{locale}/sss` | `front.faq` | `FrontController@faq` |
| GET | `/{locale}/iletisim` | `front.contact` | `FrontController@contact` |
| POST | `/{locale}/iletisim` | `front.contact.send` | `ContactController@send` · **throttle:5,1** |
| POST | `/{locale}/kurs-basvuru` | `front.course.application.store` | `CourseApplicationController@store` · **throttle:5,1** |
| GET | `/{locale}/urunler` | `front.products` | `ShopFrontController@products` |
| GET | `/{locale}/urun-detay/{id}` | `front.product.details` | `ShopFrontController@productDetails` |
| GET | `/{locale}/sepet` | `front.cart` | `CartController@show` |
| POST | `/{locale}/sepet/ekle` | `front.cart.add` | `CartController@add` |
| POST | `/{locale}/sepet/guncelle` | `front.cart.update` | `CartController@update` |
| POST | `/{locale}/sepet/sil` | `front.cart.remove` | `CartController@remove` |
| GET | `/{locale}/odeme` | `front.checkout` | `CheckoutController@show` |
| POST | `/{locale}/odeme` | `front.checkout.save-shipping` | `CheckoutController@saveShipping` |
| GET | `/{locale}/odeme/onay` | `front.checkout.confirm` | `CheckoutController@confirm` |
| POST | `/{locale}/odeme/tamamla` | `front.checkout.process` | `CheckoutController@process` |
| POST | `/{locale}/kupon-uygula` | `front.coupon.apply` | `CheckoutController@applyCoupon` · **throttle:20,1** |
| POST | `/{locale}/kupon-kaldir` | `front.coupon.remove` | `CheckoutController@removeCoupon` |

### 7.5 Locale'siz route'lar

```
GET  /              → root      closure: cookie(app_locale) geçerliyse ona, değilse
                                 is_default dile redirect (fallback config('app.locale'))
POST /haber-ver     → stock.notify   Shop\StockNotificationController@store
GET  /robots.txt    → robots     closure — settings.seo.robots_txt + sitemap_url
GET  /sitemap.xml   → sitemap    SitemapController@index
GET  /up            → Laravel health check
GET|PUT /storage/{path}  → Laravel local storage servisi
```

### 7.6 Controller metod dökümü

```
Blog\BlogController              index create store edit update delete updateOrder toggleActive editTranslate uploadImage updateTranslate
Blog\BlogCategoryController      index create store edit update delete updateOrder toggleActive editTranslate updateTranslate
Blog\BlogTagController           (aynı desen)
Certificate\CertificateController          store update destroy download
Class\LessonClassController                index create store edit update delete
ClientLogo\ClientLogoController            index create store edit update delete updateOrder toggleActive
Competition\CompetitionController          index create store edit update show delete toggleActive updateOrder
Competition\StudentCompetitionController   attach attachMultiple detach updateStatuses updateResult downloadResultFile createCertificateFromResult
ConsultingInstitution\...Controller        index show create store edit update delete toggleActive updateOrder
Course\CourseController / CourseCategoryController   (standart CRUD + translate)
Courses\CourseApplicationController        store index markContacted destroy
DashboardController                        index          (sadece view döner, veri yok)
Faq\FaqController                          (standart CRUD + translate)
Front\ContactController                    send
Front\FrontController                      home about courses search searchSuggest courseDetails teachers teacherDetails blog blogDetails contact faq
Languages\LanguagesController              index toggleVisibility toggleActive create store edit update setDefault updateOrder delete
MenuItem\MenuItemController                index create store edit update delete updateOrder indent outdent toggleActive editTranslate updateTranslate
Pages\PagesController                      index edit update editTranslate updateTranslate uploadImage
Role\RoleController                        index create store edit update delete
Settings\SettingsController                index updateGeneral updateLogos updateSeo updateMail testMail updateSocial updateAdvanced storeSitemapEntry updateSitemapEntry toggleSitemapEntry destroySitemapEntry
Settings\ValidationMessageController       index updateForm resetForm
Shop\CartController                        show add update remove
Shop\CheckoutController                    show saveShipping confirm process applyCoupon removeCoupon
Shop\CouponController                      index create store edit update delete toggleActive
Shop\OrderController                       index show updateStatus delete
Shop\ProductAttributeController            + storeValue updateValue deleteValue toggleValue
Shop\ProductCategoryController             (standart CRUD + translate)
Shop\ProductController                     + generateVariants updateVariants deleteVariant uploadGallery deleteImage updateImageOrder
Shop\ShopFrontController                   products productDetails
Shop\StockNotificationController           store index destroy markNotified
SitemapController                          index
Slider\SliderController                    index create store edit update delete updateOrder toggleActive
Slider\SliderItemController                (+ editTranslate updateTranslate)
Student\PreRegistrationController          index create store edit update convertToNormal convertToNormalPost
Student\StudentController                  index create store edit certificates competitions update changeActivity delete
Student\StudentDocumentController          downloadRegistrationForm downloadContract downloadPayment
Student\StudentPaymentController           payment paymentUpdate allPayments
Student\StudentReCreateController          show update
Teacher\TeacherController                  (standart CRUD + translate)
Testimonial\TestimonialController          (standart CRUD + translate)
Theme\ThemeController                      edit update reset
User\UserController                        index create store edit update delete detail login logout
```

---

## 8. İş Akışları / İçerik Yönetimi

### 8.1 Çok dillilik (en kritik alt sistem)

Üç katmanlı bir yapı:

**1) Arayüz metinleri — `lang/*.json`**
22 dosya: `tr, en, en-gb, ar, de, es, es-mx, fa, fr, hi, it, ja, ko, nl, pl, pt, pt-br,
ru, sv, ur, zh-cn, zh-tw` + `lang/tr/validation.php`.
Blade'de `__('...')` ile kullanılır.

**2) İçerik metinleri — Spatie Translatable (DB'de JSON)**
Model alanı `longtext` olarak saklanır; içerik `{"tr":"...","en":"..."}` JSON'ıdır.
Panelde her modülün `translate/{lang}` sayfası bir dili düzenler.

**3) Dil kayıtları — `languages` tablosu**
3 ayrı bayrak: `status` (kayıt aktif), `is_active` (sitede kullanılabilir), `is_visible`
(dil seçicide görünür). `is_default` varsayılan dil.

**Akış:**
```
GET /  →  app_locale cookie'si var ve o locale (status=1 AND is_active=1) ise → /{cookie}
          değilse → is_default=1 olan dilin locale'i → /{default}
          hiçbiri yoksa → config('app.locale') = 'tr'

GET /{locale}/... → SetLocale middleware:
      Languages::where(locale)->where(status,1)->where(is_active,1)->exists()
      YOKSA → abort(404)
      VARSA → app()->setLocale($locale)
              URL::defaults(['locale' => $locale])
              yanıtla birlikte 60*24*365 dk'lık `app_locale` cookie'si kuyruğa alınır
```

`app_locale` cookie'si **şifrelenmez** (`encryptCookies(except: ['app_locale'])`) —
çünkü SetLocale her okuduğunda DB'ye karşı doğruluyor.

`AppServiceProvider::setDefaultRouteLocale()` → `URL::defaults(['locale' => config('app.locale')])`.
Bu sayede panelden / mail'den / artisan'dan `route('front.blog')` çağrısı `{locale}`
parametresi verilmeden çalışır.

**Yeni dil ekleme:** yalnızca SuperAdmin (`role:SuperAdmin` middleware). Dil silme de öyle.

### 8.2 Sayfa Yönetimi (`/panel/pages`)

`PagesController` bir **dispatcher**'dır: `edit/{id}` ve `update/{id}` içindeki `$id`
sayfa anahtarıdır ve `match()` ile ilgili özel metoda yönlenir.

Geçerli sayfa anahtarları (10):
```
home · about · contact · faq · teachers · blog · courses · footer · navbar · shop
```
Bilinmeyen anahtar → `abort(404)`.

Her anahtar için 4 metod çifti vardır:
`editX()` / `updateX()` / `editXTranslate($lang)` / `updateXTranslate()`.
Blade karşılıkları: `admin/pages/edit-<key>.blade.php` ve `edit-<key>-translate.blade.php`.

`POST /panel/pages/upload-image` → TinyMCE içi görsel yükleme uç noktası.

**`field_styles` / `default_styles`**: her `*_page_infos` tablosunda bulunan JSON kolonlar.
Panelden alan bazlı stil (renk, boyut vb.) override edilebiliyor; `default_styles`
sıfırlama referansı.

### 8.3 Mağaza / Sipariş akışı

```
Ürün listesi (/urunler)
  → Ürün detay (/urun-detay/{id})   varyant seçimi (attribute × value kombinasyonları)
      → stok yoksa: "Haber Ver"  POST /haber-ver → stock_notification_requests
  → Sepete ekle  POST /{locale}/sepet/ekle     (SESSION tabanlı sepet — DB'de cart yok)
  → Sepet (/sepet)  kupon uygula/kaldır
  → Adım 1: /odeme          (GET show)       teslimat + iletişim bilgileri
  → Adım 2: POST /odeme     (saveShipping)   session'a yazar
  → Adım 3: /odeme/onay     (GET confirm)    3D kart önizlemeli onay ekranı
  → POST /odeme/tamamla     (process)        Order + OrderItem oluşturur,
                                              kupon used_count++, OrderConfirmationMail
```

- Sepet **session**'da tutulur (`session('cart')`), kupon `session('coupon')`.
- `SharedDatas` middleware her front isteğinde `globalCart`, `globalCartCount`,
  `globalCartTotal`, `globalCouponDiscount` view değişkenlerini paylaşır.
- Kupon geçerliliği her istekte `Coupon::isValid($subtotal)` ile yeniden doğrulanır.
- Panelden sipariş durumu değiştiğinde `OrderStatusMail` gönderilir.
- `products.free_shipping` ürün bazlı ücretsiz kargo bayrağı.

> **Ödeme entegrasyonu (sanal POS) YOKTUR.** `/odeme/onay` sayfasındaki kart formu
> görsel bir önizlemedir; `process()` sipariş kaydı oluşturur, tahsilat yapmaz.
> (Kod içinde ödeme sağlayıcısı SDK'sı bulunmuyor.)

### 8.4 Öğrenci kayıt akışı

```
Ön kayıt oluştur  →  /panel/students/create-pre-registiration
Ön kayıtlılar listesi → /panel/students/pre/students
Ön kayıt → Normal kayıt dönüşümü → /panel/students/{id}/pre-to-normal (GET form, POST uygula)
Normal kayıt → /panel/students/create
Yeniden kayıt (dönem yenileme) → /panel/students/{id}/re-create
```
Her öğrenci için: en fazla 2 veli (`student_guardians`), 1 acil durum kişisi
(`emergency_contacts`), 1 ödeme planı (`student_payments`) + N taksit
(`student_payments_installments`).

**PDF belgeler** (`barryvdh/laravel-dompdf`, `StudentDocumentController`):
kayıt formu, öğrenci sözleşmesi, ödeme sözleşmesi. Hepsi **POST** ile üretilir.
`app/Helpers.php::numberToWords()` tutarı Türkçe yazıya çevirir (sözleşmelerde kullanılır).

### 8.5 Sertifika & Yarışma akışı

```
Danışmanlık Kurumları (katalog)
  → /panel/consulting-institutions/{id}/sertifikalar   kurum bazlı sertifika listesi

Öğrenci profili → "Sertifikalar" sekmesi
  → sertifika ekle/güncelle/sil/indir  (type: kurumsal / danışmanlık / yarışma)

Yarışmalar (katalog)  → /panel/competitions
  → /panel/competitions/{id}/katilanlar        katılımcı listesi + filtreler
  → POST /panel/competitions/{id}/attach-students   toplu öğrenci atama

Öğrenci profili → "Yarışmalar" sekmesi
  → yarışmaya ekle, statüleri güncelle (veli izni / pasaport / vize / ödeme),
    sonuç gir (+ sonuç dosyası yükle),
    POST .../create-certificate → sonuçtan tek tıkla sertifika üretir
```

### 8.6 Bakım modu

`CheckMaintenanceMode` middleware **yalnızca front route grubunda** çalışır.
`Setting::get('maintenance_mode','0','advanced') === '1'` ise
`front.maintenance` view'i **503** ile döner.
**Panel etkilenmez** — bakım modundayken bile `/panel` erişilebilir.
(Laravel'in kendi `artisan down` mekanizmasından bağımsızdır.)

### 8.7 SEO / Sitemap / robots

- `GET /robots.txt` → `settings.seo.robots_txt` (varsayılan `User-agent: *\nAllow: /`)
  + `settings.seo.sitemap_url` doluysa sonuna `Sitemap: <url>` eklenir.
- `GET /sitemap.xml` → `SitemapController@index`, dinamik olarak üretir:
  - 8 statik sayfa (home 1.0/daily, about 0.8/monthly, courses 0.9/weekly,
    teachers 0.8/weekly, blog 0.9/daily, products 0.9/daily, contact 0.7/monthly, faq 0.6/monthly)
  - Aktif kurslar (0.8/weekly), eğitmenler (0.7/monthly), blog yazıları, ürünler
  - + `sitemap_entries` tablosundaki manuel kayıtlar (şu an 0 satır)
- Front layout: `meta_title`/`meta_description`/`meta_keywords`, favicon,
  Google Analytics (`google_analytics_id`), GTM (`google_tag_manager_id`),
  `custom_head_code` / `custom_body_code` (`{!! !!}` ile ham basılır).

### 8.8 Mail

3 Mailable:

| Sınıf | Konu | View |
|---|---|---|
| `ContactFormMail` | `Yeni İletişim Formu — {siteName}` | `emails.contact-form` |
| `OrderConfirmationMail` | `Sipariş Onayı #{order_number} — {siteName}` | `emails.order-confirmation` |
| `OrderStatusMail` | `Sipariş Durumu Güncellendi: {statusLabel} — #{order_number}` | `emails.order-status` |

**Mail yapılandırması runtime'da DB'den gelir.**
`AppServiceProvider::overrideMailConfig()` boot'ta `Setting::getGroup('mail')` okur ve
`config(['mail.default' => ..., 'mail.mailers.smtp.host' => ...])` şeklinde `.env`'i
ezer. Yani `.env`'deki `MAIL_MAILER=log` panelde SMTP ayarlıysa geçersizdir.

`ContactController@send`: alıcı = `Setting::get('site_email', null, 'general')`.
Gönderim `try/catch` içinde; hata `Log::error` ile yazılır ama kullanıcıya **her zaman
başarı mesajı** gösterilir (sessiz hata — bkz. §15).

### 8.9 Doğrulama mesajları sistemi (`developer` izni)

`App\Services\ValidationMessageService` — statik `$modules` dizisinde tüm formların
alan/kural tanımları tutulur. 5 modül:

| Modül | Form anahtarları (örnek) |
|---|---|
| `blog` | blog_store, blog_update, blog_order, blog_translate, blog_cat_*, blog_tag_* |
| `course` | course_store/update/order/translate, course_cat_* |
| `shop` | product_store/update/order/translate/variants/gallery/image_order, product_cat_*, product_attr_*, product_attr_value_*, coupon_store/update, order_status, cart_add/update/remove, checkout_process, checkout_coupon |
| `education` | class_store/update, pre_reg_store/update/convert, student_store_pre, student_store_normal, student_update_pre, student_update_normal, student_recreate_pre, student_recreate_normal |
| `content` | teacher_*, testimonial_*, faq_*, slider_*, slider_item_*, (+ contact_send vb.) |

Akış:
```
ValidationMessageService::getMessages('blog_store')
   = generateFormMessages(form tanımı)          ← Türkçe varsayılan mesajlar
   + Setting::getGroup('vm_blog_store')         ← panelden yapılan override'lar
```
Controller'lar `$request->validate($rules, ValidationMessageService::getMessages('<formKey>'))`
şeklinde çağırır.

Ek olarak `AppServiceProvider::overrideValidationMessages()` boot'ta
`Setting::getGroup('validation_messages')` ve `validation_attributes` gruplarını okuyup
`translator->addLines(...)` ile global `validation.*` çevirilerini ezer.

Panel ekranı: `/panel/settings/validation-messages` → **`permission:developer`**.

---

## 9. Yetki ve Rol Sistemi

Spatie Permission v6.25, guard: `web`, teams: kapalı, wildcard: kapalı,
cache: 24 saat (`spatie.permission.cache`).

### 9.1 İzinler (37 adet, canlı DB)

**"Modüler izinler v3"** (migration `2026_06_17_063335_modular_permissions_v3`).
Her modül için `<modül>` (görüntüle+düzenle) ve `<modül>_delete` (silme) ikilisi:

| # | İzin | Kapsam |
|---|---|---|
| 1 | `accounting` | Muhasebe/ödeme görüntüleme |
| 2/3 | `student` / `student_delete` | Öğrenci yönetimi |
| 4/5 | `class` / `class_delete` | Sınıf yönetimi |
| 6/7 | `user` / `user_delete` | Kullanıcı yönetimi |
| 8/9 | `competition` / `competition_delete` | Yarışmalar |
| 10/11 | `consulting_institution` / `consulting_institution_delete` | Danışmanlık kurumları |
| 12/13 | `certificate` / `certificate_delete` | Sertifikalar |
| 31/32 | `blog` / `blog_delete` | Blog + kategori + etiket |
| 33/34 | `course` / `course_delete` | Kurs + kategori + kurs başvuruları |
| 35/36 | `faq` / `faq_delete` | SSS |
| 37/38 | `teacher` / `teacher_delete` | Eğitmenler |
| 39/40 | `testimonial` / `testimonial_delete` | Yorumlar |
| 41/42 | `client_logo` / `client_logo_delete` | Referans logoları |
| 43/44 | `slider` / `slider_delete` | Slider + slider öğeleri |
| 45/46 | `role` / `role_delete` | Rol yönetimi |
| 47 | `theme` | Sidebar tema renkleri |
| 48 | **`developer`** | Doğrulama Mesajları ekranı |
| 49 | `language` | Dil yönetimi (kısıtlı; bazı işlemler SuperAdmin ister) |
| 50 | `menu` | Menü öğeleri |
| 51 | `page` | Sayfa yönetimi |
| 52 | `settings` | Site ayarları |
| 53/54 | `shop` / `shop_delete` | Ürün, kategori, nitelik, sipariş, kupon, stok talebi |

> ID 14–30 boştur — v2/v3 yeniden yapılandırmasında `content`/`content_delete`
> parçalanırken eski kayıtlar silinmiştir.

### 9.2 Roller (6 adet, canlı DB)

| Rol | is_visible | İzinler |
|---|---|---|
| **SuperAdmin** | **0** (gizli) | 37 iznin tamamı (`developer` dahil) |
| **Admin** | 1 | `developer` **hariç** 36 izin |
| **Kordinatör** | 1 | accounting, student(+delete), certificate(+delete), competition(+delete), consulting_institution(+delete) |
| **Eğitmen** | 1 | sadece `class` |
| **Muhasebe** | 1 | sadece `accounting` |
| **Mağaza Yöneticisi** | 1 | accounting, shop, shop_delete |

**SuperAdmin ile Admin arasındaki tek fark: `developer` izni.**
Ayrıca `role:SuperAdmin` middleware'i dil oluşturma/silme/varsayılan yapma/görünürlük
toggle'ında ayrıca kontrol edilir — bu izinle değil rol adıyla yapılır.

### 9.3 Kullanıcılar (11, canlı)

| ID | Ad | E-posta | Roller | is_visible |
|---|---|---|---|---|
| 1 | Super Admin | developer@admin.com (`superadmin`) | SuperAdmin | **0 (gizli)** |
| 3 | Ömer Boyaci | omerboyaci@parosis.com | Admin | 1 |
| 4 | Yusuf Çelik | yusufcelik@parosis.com | Eğitmen, Kordinatör | 1 |
| 5 | Pınar Bengi ARGITLI | bargitli.1994@outlook.com | Eğitmen | 1 |
| 6 | Yiğit Turgut ARGITLI | turgutargitli@parosis.com | Admin | 1 |
| 7 | Cansu SÖNMEZ | egitmen5@parosis.com | Eğitmen | 1 |
| 9 | Yakup Ercan KİZİL | yakupkizil@parosis.com | Eğitmen | 1 |
| 10 | Enes Kandilli | egitmen6@parosis.com | Eğitmen | 1 |
| 11 | Metin Baydarakçı | metinbaydarakci@parosis.com | Admin, Eğitmen, Kordinatör, Muhasebe | 1 |
| 12 | Ahmet Çöm | egitmen7@parosis.com | Eğitmen | 1 |
| 13 | Musa Kazım DEMİRTAŞ | musademirtas@parosis.com | Eğitmen | 1 |

(Şifreler burada tutulmaz. ID 2 ve 8 silinmiş.)

### 9.4 Sidebar'da izin kontrolleri

`resources/views/admin/layouts/aside.blade.php` — 27 `@canany` / `@can` bloğu.
Menü grupları:

```
Eğitim   @canany(class, class_delete, student, student_delete, accounting,
                  course, course_delete, consulting_institution)
   ├ Sınıflar               @canany(class, class_delete)
   ├ Öğrenciler             @canany(student, student_delete, accounting)
   ├ Kurslar/Kategoriler    @canany(course, course_delete)
   └ Danışmanlık Kurumları  @canany(consulting_institution)
Eğitmenler   @canany(teacher, teacher_delete)
Yarışmalar   @canany(competition)
Mağaza       @canany(shop, shop_delete)    → ürünler, kategoriler, nitelikler,
                                              siparişler, kuponlar, stok talepleri
Sayfa Yönetimi @can(page)
Blog         @canany(blog, blog_delete)
Referans Logoları @canany(client_logo, client_logo_delete)
SSS          @canany(faq, faq_delete)
Görünüm      @canany(slider, slider_delete, menu, language)
   ├ Slider  @canany(slider, slider_delete)
   ├ Menü    @can(menu)
   └ Diller  @can(language)
Sistem       @canany(testimonial, testimonial_delete, developer, user, user_delete,
                     role, role_delete, settings, theme)
   ├ Yorumlar            @canany(testimonial, testimonial_delete)
   ├ Doğrulama Mesajları @can(developer)
   ├ Kullanıcılar/Roller @canany(user, user_delete, role, role_delete)
   └ Ayarlar / Tema      @can(settings)
```

> **Dikkat:** Tema (`theme.edit`) sidebar'da `@can('settings')` altında gösteriliyor
> ama route `permission:theme` istiyor. `settings` iznine sahip olup `theme` iznine
> sahip olmayan bir rol linki görür ama 403 alır. (Şu an tüm rollerde ikisi birlikte,
> pratikte sorun yaratmıyor.)

### 9.5 Rol/izin üretme komutları

```bash
php artisan app:make-permission "<izin adı>"
php artisan app:make-role "<rol adı>" --is_visible=1
php artisan app:a-p-r "<izin adı>" "<rol adı>"     # izni role ata
```

---

## 10. Arayüz ve Tema

### 10.1 Admin panel

`resources/views/admin/layouts/app.blade.php` iskeleti:
- `@vite(['resources/css/app.css','resources/js/app.js'])`
- Inter font (fonts.bunny.net), Alpine collapse plugin → Alpine → jQuery → Select2 (CDN sırası önemli)
- `@include('admin.layouts.theme-vars')` → CSS custom property'leri basar
- `<body x-data="{ sidebarOpen, sidebarCollapsed }">`, `sidebarCollapsed` **localStorage**'da
- `is-loading` sınıfı `$nextTick` sonrası kaldırılır (FOUC engelleme)
- Sayfa başlığı: `@yield('title', Setting::get('site_name','Parosis Akademi'))`

**Global blade component'leri** (`resources/views/components/`):
`<x-text-input>`, `<x-textarea>`, `<x-form-button>`, `<x-image-upload>`,
`<x-checkbox-dropdown>`, `<x-count-badge>`, `<x-action-menu>` (kebap menü),
`<x-back-button>` (sol chevron + başlık yanı).

**Panel'e özel partial'lar** (`resources/views/admin/components/`):
`language-tabs` (çeviri sekmeleri), `are-you-sure-modal`, `payment-alert`,
`student-new-add-modal`, `tab-menu-student`, `action-button-student`.

**Referans dosyası:** `ADMIN_PANEL_UI.md` (96 KB) — 17 bölümlük kopyala-yapıştır
bileşen kütüphanesi (layout, sidebar, navbar, form, buton, tablo, badge, modal, toast,
dropdown, SVG ikonlar, renk sistemi, CSS/JS pattern'leri, permission kullanımı).
**Yeni panel ekranı yazmadan önce buraya bak.**
Ayrıca canlı örnek sayfa: `/panel/reference`.

### 10.2 Sidebar tema sistemi (`ThemeController`)

`Setting` grubu: **`sidebar_theme`**.

- `DEFAULTS` — 27 zorunlu renk: sidebar_bg, sidebar_border, section_title_text,
  section_divider, menu_text(+active), menu_bg_active/hover, icon_bg/text(+active),
  submenu_text(+active), submenu_bg_active/hover, avatar_from/to,
  btn_primary_from/to/text, btn_secondary_bg/text/border, btn_danger_bg/text.
- `COLOR_OPTIONAL` — 6 opsiyonel: panel_bg, card_bg, card_border, form_bg, hover_bg, badge_bg.
  Boş bırakılırsa sidebar paletinden **otomatik türetilir**
  (CSS `var(--panel-bg-color, var(--sb-bg))` fallback deseni).
- `MIX_DEFAULTS` — karışım yüzdeleri: panel_bg_mix 35, card_bg_mix 12,
  card_border_mix 60, form_bg_mix 8, hover_bg_mix 22, hover_bg_strong_mix 26, badge_bg_mix 10.

Route: `GET/POST /panel/theme`, `POST /panel/theme/reset` (`permission:theme`).
Değerler `admin/layouts/theme-vars.blade.php` içinde CSS değişkeni olarak basılır.

> `todo.md` "dark mode" ve "fuchsia tema"dan bahseder — bunlar **eski** notlardır;
> panel artık DB tabanlı tema sistemi kullanıyor, dark mode kaldırılmıştır (doğrulanmadı,
> `app.css` içinde dark: sınıflarının kalıntısı olabilir).

### 10.3 Front

`resources/views/front/layouts/app.blade.php`:
- `bg-[#FAF9F6]` krem zemin
- Fontlar: Poppins + Aeonik Pro (assets-front)
- Vendor CSS: swiper-bundle, jos.css, menu.css, custom.css (hepsi `assets-front`)
- `@vite(['resources/css/front.css'])` — Tailwind v4
- SEO/GA/GTM/custom_head_code enjeksiyonu
- `@include('front.partials.header')` + `modals` + `footer`
- `main.js` include'una `filemtime` cache-bust eklenmiş (commit `a4e3754`)

Partial'lar: `header`, `footer`, `modals` (kurs başvuru modalı burada),
`blog-card`, `category-card`, `course-card`, `checkout-stepper`.

Sayfalama görünümleri `AppServiceProvider`'da özelleştirilmiş:
`Paginator::defaultView('vendor.pagination.tailwind')`,
`defaultSimpleView('vendor.pagination.simple-tailwind')`.
(`Paginator::useBootstrapFive()` de çağrılıyor ama hemen ardından Tailwind view'leri
set edildiği için etkisiz.)

### 10.4 Yükleme dizinleri

Panelden yüklenen dosyalar `public/uploads/<modül>/` altına gider (91 MB):
`blogs/ courses/ pages/ products/ settings/ sliders/ testimonials/`.
`.gitignore` ile takip edilmez (`!/public/uploads/.gitkeep` hariç).

`public/storage` → `storage/app/public` symlink'i **kurulu**.

**SVG desteği:** commit `54234d1`/`c07a35c` ile tüm görsel doğrulamalarına SVG eklendi.
**Görsel silme:** `remove_image` / `remove_icon` / `remove_background_image` alanları
controller'larda işleniyor (commit `d281e37`).

---

## 11. Kurulum ve Çalıştırma

> **Bu sunucuda PHP, Composer ve Node zaten kuruludur.**
> Eski `claude-setup.sh` / eski CLAUDE.md'deki `apt-get install php ...` adımları
> BU SUNUCU İÇİN GEÇERSİZDİR (root yetkisi de yok).

### Doğrulama komutları (güvenli, salt-okunur)

```bash
cd /home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi
php -v                 # 8.3.16
composer -V            # 2.8.5
node -v ; npm -v
php artisan about
php artisan route:list
git status
```

### Yerel geliştirme (başka bir makinede)

```bash
composer install
npm install
cp .env.example .env && php artisan key:generate
# .env: DB ayarlarını gir
php artisan migrate
php artisan db:seed          # LanguageSeeder, PermissionSeeder, RoleSeeder, UserSeeder,
                             # SettingsSeeder, CourseSeeder, ShopSeeder,
                             # CertificateSeeder, CompetitionSeeder,
                             # ConsultingInstitutionSeeder
php artisan storage:link
npm run build                # veya: npm run dev
```

`composer dev` scripti (yerelde): `php artisan serve` + `queue:listen` + `pail` + `npm run dev`
birlikte (concurrently).

`docker-compose.yml` **eski yerel kurulumdur** — macOS mutlak yolu içerir
(`/Users/cihanomur/Desktop/...`), portlar 8014/5175. Bu sunucuda kullanılmaz.

---

## 12. Deploy — bu sunucuda güncelleme nasıl yapılır

> Bu adımlar **yazma işlemidir**; kullanıcı açıkça istemeden çalıştırma (§17).

Tipik akış (2026-06-21 deployment'ında izlenen yol, `tasks.md`):

```bash
cd /home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi

# 1) Kod
git pull                       # veya ilgili branch'i çek

# 2) Bağımlılıklar (değiştiyse)
composer install --no-dev --optimize-autoloader
npm ci        # veya npm install

# 3) Migration (varsa)
php artisan migrate --force    # DİKKAT: canlı veri var

# 4) Frontend build
npm run build                  # tinymce kopyalama DAHİL

# 5) Cache
php artisan optimize:clear     # route/config/view cache temizle
```

**Deploy sonrası mutlaka:**
- `storage/` ve `bootstrap/cache/` yazılabilir mi kontrol et
- `public/storage` symlink'i duruyor mu (`ls -la public/`)
- Smoke test: `/`, `/tr`, `/tr/kurslar`, `/tr/urunler`, `/panel/login`, `/sitemap.xml`
- `storage/logs/laravel.log` son satırlarına bak

**Artisan komutlarını root ile çalıştırma** — dosya sahipliği bozulur
(bu sunucuda zaten `parosisakademi` kullanıcısıyla giriliyor, sorun yok).

**Geçmiş deploy notu (2026-06-21):** 111 commit çekildi, 96 migration koştu
(2 manuel düzeltme gerekti: `shop_page_infos` CREATE migration'ın tarih sırası,
`modular_permissions_v3` migration'ı `content` izni yokken patlıyordu),
7 izin manuel eklendi (developer/language/menu/page/settings/shop/shop_delete),
21 dil import edildi. Canlı veriler korundu.

---

## 13. Zamanlanmış Görevler

**HİÇBİRİ YOK. Kesin olarak doğrulandı:**

- `crontab -l` → `no crontab for parosisakademi`
- `routes/console.php` → sadece Laravel'in varsayılan `inspire` komutu; `Schedule::` çağrısı yok
- `bootstrap/app.php` → `withSchedule()` bloğu yok
- Queue tabloları (`jobs`, `job_batches`, `failed_jobs`) **boş**;
  `queue:work` / `queue:listen` çalışmıyor.

> **Sonuç:** `QUEUE_CONNECTION=database` olmasına rağmen kuyruk işleyicisi yok.
> Şu an kuyruğa iş atan kod yok (mailler senkron `Mail::send` ile gidiyor).
> İleride `ShouldQueue` kullanan bir job eklenirse **mailler asla gönderilmez** —
> önce bir worker/cron kurulmalı.

Muhtemel gelecek ihtiyaç (henüz kurulmadı):
```
* * * * * cd /home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi && php artisan schedule:run >> /dev/null 2>&1
```

---

## 14. Git Durumu

```
Repo:    https://github.com/CihanOmur/parosis-akademi.git  (remote: origin)
Branch:  fix/about-faq-spacing          ← AKTİF (checked out)
Diğer:   main, origin/main
Çalışma alanı: TEMİZ (nothing to commit)
```

### 14.1 Branch topolojisi

```
origin/main   b39bb0c  2026-07-09  feat(header): mobilde sticky
     │
     └── main  00470a2  2026-07-16  ui(header): Giris Yap butonu rengi
     │         (main, origin/main'in 21 commit ÖNÜNDE — PUSH EDİLMEMİŞ)
     │
     └── fix/about-faq-spacing  b05d667  2026-07-24  refactor(admin): back-button component
               (main'in 55 commit ÖNÜNDE — MERGE EDİLMEMİŞ)
```

- `main` → `origin/main`: **21 commit push edilmemiş**
  (stok bildirim sistemi "Haber Ver", ürün bazlı ücretsiz kargo, footer CTA düzeltmeleri,
  "Sepete Ekle" buton tasarım iterasyonları, header giriş butonu rengi)
- `fix/about-faq-spacing` → `main`: **55 commit merge edilmemiş**
- `main`, HEAD'in içinde tamamen mevcut (`git rev-list --left-right --count main...HEAD` = `0 55`)

### 14.2 `fix/about-faq-spacing` branch'i ne yapıyor?

**Adı yanıltıcı — kapsam çok genişlemiş.**

Dallanma noktası: `00470a2` (2026-07-16). İlk commit `af94653`
"fix(about): FAQ accordion animasyonu + mobil resim + blog altı boşluk" —
**branch'in asıl amacı bu ve tamamlanmış.**

Sonrasında 54 commit daha eklenmiş; branch fiilen bir "genel geliştirme dalı"na dönüşmüş:

| Grup | İçerik |
|---|---|
| Front boşluk/layout | `pb-44 → pb-16 lg:pb-20` tüm sayfalarda, footer z-index/bg düzeltmeleri, footer overlap |
| Hero slider | `h-[100svh]`, layout shift giderme, mobil taşma düzeltmeleri (8 commit) |
| Mobil menü | Head'e logo, dil bölümü ayrık buton, logo hizalama (3 commit) |
| Blog | Kart komple tıklanabilir, locale-aware tarih (TR "Şubat"), blog-details sadeleştirme, kategori filtreleme |
| Kurslar | Çoklu kategori badge + kategori tıklamada filtreleme, course-card partial |
| İletişim | Gizlilik metnine markdown link desteği, link stili |
| **Kurs online başvuru** | `course_applications` tablosu + modal form + panel listesi + telefon/isim input maskeleri |
| **Checkout 3 adımlı akış** | Sepet → Ödeme → Onay; `checkout-confirm.blade.php` (298 satır yeni), `checkout-stepper` partial, 3D kart önizleme, duplicate stepper/wrapper temizliği, adres yapısı + `config/turkiye_iller.php` (81 il) |
| Testimonial | Cinsiyet alanı + fotoğraf yoksa cinsiyete göre varsayılan avatar |
| Upload | SVG desteği (validation + image-upload component), fotoğraf silme (`remove_image`/`icon`/`background_image`) |
| **Panel UI refactor** | Kebap menü component (`x-action-menu`) tüm index sayfalarına, `x-back-button` component tüm create/edit/translate sayfalarına, sortable satırlarda mobil metin seçimi engelleme, touch-delay 600ms, admin footer copyright |

**Diff istatistiği:** `141 dosya, +2543 / −2197`.
Yeni migration'lar: `2026_07_17_120000_create_course_applications_table`,
`2026_07_18_100000_add_gender_to_testimonials_table`
(**ikisi de canlı DB'ye uygulanmış** — `course_applications` 2 satır, `testimonials.gender` mevcut).

**Durum:** Fonksiyonel olarak bitmiş görünüyor (çalışma alanı temiz, canlı site
bu branch'ten servis ediliyor, tablolar migrate edilmiş). Ancak **main'e merge
edilmemiş ve GitHub'a push edilmemiş.** Yani `origin/main` canlı ile 76 commit geride.

> **Risk:** Sunucuda `git checkout main` yapılırsa canlı site anında 76 commit geriye
> döner (checkout 3 adımlı akış, kurs başvuru formu, panel UI yenilemesi kaybolur)
> ama DB'de `course_applications` tablosu ve `testimonials.gender` kolonu kalır.
> **Bu sunucuda asla branch değiştirme.**

### 14.3 Commit formatı

Conventional Commits kullanılıyor. Bu projede görülen prefix'ler:
`feat:` `fix:` `refactor:` `ui:` `chore:` `perf:`
Kapsam parantez içinde: `fix(admin):`, `feat(checkout):`, `ui(front):`.
Commit mesajları Türkçe (çoğunlukla ASCII, Türkçe karaktersiz).

Commit author'ı `Your Name` olarak görünüyor — sunucudaki git kimliği ayarlanmamış.

---

## 15. Bilinen Sorunlar, Eksikler ve TODO

### 15.1 KRİTİK — Production yapılandırması

> ✅ **ÇÖZÜLDÜ (2026-07-29)** — APP_ENV=production, APP_DEBUG=false, APP_URL düzeltildi. Aşağısı eski durumu anlatır.

| # | Sorun | Detay |
|---|---|---|
| **1** | **`APP_DEBUG=true`** | Canlı sitede debug açık. Hata sayfalarında **stack trace, dosya yolları, .env değişkenleri ve DB bilgileri** sızabilir. → `false` yapılmalı. |
| **2** | **`APP_ENV=local`** | Laravel canlıyı "local" sanıyor. Bazı optimizasyonlar/koruma davranışları devre dışı kalır. → `production` olmalı. |
| **3** | `APP_URL=http://localhost` | `route()`/`url()` CLI'dan (mail, sitemap, artisan) `http://localhost/...` üretir. Web istekleri `trustProxies` sayesinde doğru; ama **mail içindeki linkler ve CLI'dan üretilen sitemap yanlış olabilir.** → `https://parosisakademi.com` |
| 4 | Config/route cache yok | `php artisan config:cache` + `route:cache` yapılmamış → her istekte dosya okuma. Performans kaybı. (Ancak §16'daki DB-tabanlı config override'ları yüzünden dikkatli olunmalı.) |

> Bunların düzeltilmesi **kullanıcı onayı gerektiren yazma işlemidir** — kendiliğinden yapma.

### 15.2 Git / sürüm yönetimi

> ✅ **KISMEN ÇÖZÜLDÜ (2026-07-29)** — 56 commit push edildi, git kimliği düzeltildi. Branch hâlâ main'e merge edilmedi.

5. `origin/main` canlıdan **76 commit geride**. Sunucu dışında hiçbir yerde bu kodun
   yedeği yok (sadece `.git` içinde). Repo'ya push edilmeli.
6. Aktif branch adı (`fix/about-faq-spacing`) içeriğiyle alakasız — merge edilip
   kapatılmalı.
7. Git kimliği ayarsız (`Your Name`).

### 15.3 `developer` izninin kapsamı — HENÜZ NETLEŞMEDİ

Şu anda `developer` izni **yalnızca** şunu açıyor:
```
/panel/settings/validation-messages   (Doğrulama Mesajları ekranı)
```
Ve sidebar'da `@can('developer')` ile bu tek link gösteriliyor.

Aday kapsam genişletmeleri (kullanıcı ile konuşulacak, henüz karar yok):
- ✅ **Doğrulama Mesajları** — zaten `developer` altında (doğrulandı)
- ⏳ **Dil silme** — şu an `permission:language` + **`role:SuperAdmin`** ile korunuyor,
  `developer` ile DEĞİL. `developer`'a taşınması düşünülüyor.
  (Aynı grupta: dil oluşturma, varsayılan yapma, görünürlük toggle'ı da SuperAdmin'de.)

**Karar verilmesi gerekenler:** `developer` bir "gizli geliştirici modu" mu olacak,
yoksa SuperAdmin'in alt kümesi mi? Şu an sadece SuperAdmin'de var (Admin'de yok).

### 15.4 Kod hijyeni / ölü kod

> ✅ **KISMEN ÇÖZÜLDÜ (2026-07-29)** — .sql dump, siteconfig.sh, claude-setup.sh, docker-compose.yml ve eski deploy logu silindi (commit c0f0b13). Kullanılmayan modeller duruyor.

8. **Kullanılmayan modeller** — migration'ı ve tablosu olmayan, eski şablondan kalma:
   `Teams\Teams`, `Teams\TeamComment`, `Teams\TeamsUserPersonelInfo`,
   `Pages\Teams\TeamsPageInfo`, `Pages\Teams\TeamsPageGallery`,
   `Projects\Projects`, `Projects\ProjectGallery`, `Projects\ProjectInfoItems`,
   `Pages\Projects\ProjectsPageInfo`, `References\References`,
   `Pages\References\ReferencesPageInfo`, `Service\Services`,
   `Pages\Services\ServicesPageInfo`, `Category\Category`,
   `Contact\Contact`, `Contact\ContactAddress`, `Contact\ContactPhone`, `Contact\ContactMail`,
   `Pages\AboutUs\AboutUsPageGallery`, `Blogs\BlogCategories` (çoğul — `BlogCategory` ile çakışıyor).
   → DB'de karşılıkları yok; silmeden önce `grep -r` ile kullanım kontrol edilmeli.
9. `app/Enums/ResponseCode.php` — tanımlı ama kullanımı sınırlı (doğrulanmadı).
10. `siteconfig.sh` — Apache vhost kuran script; bu sunucu **nginx** kullanıyor, geçersiz.
11. `claude-setup.sh` — container ortamı içindi, bu sunucuda anlamsız (root yok).
12. `docker-compose.yml` — macOS mutlak yolu içeren eski yerel kurulum.
13. `parosis-akademi.sql` (214 KB) — repo içinde DB dump'ı duruyor.
14. `storage/logs/laravel_pre_deploy_20260622.log` — 1.6 MB eski log dosyası.

### 15.5 İşlevsel eksikler

15. **Sanal POS / ödeme entegrasyonu yok.** `/odeme/onay` kart formu görsel önizleme;
    `CheckoutController@process` tahsilat yapmadan sipariş oluşturur.
16. **Şifre sıfırlama akışı yok.** `password_reset_tokens` tablosu var (0 satır) ama
    route/controller yok. Kullanıcı şifresini unutursa panelden Admin sıfırlamalı.
17. **Kullanıcı kaydı (register) yok** — bilinçli.
18. `/panel/reference` route'unda **izin kontrolü yok** — `auth` yeterli.
    Sadece UI referans sayfası olduğu için kritik değil, ama tutarsız.
19. **Sidebar'da tema linki `@can('settings')`, route ise `permission:theme`** —
    izinler ayrışırsa 403 gösterir (§9.4).
20. `ContactController@send` mail hatasını yutuyor; kullanıcıya her zaman başarı
    mesajı gösteriyor. Log'a bakılmadan sorun fark edilmez.
21. `sitemap_entries` tablosu boş — manuel sitemap girişi özelliği kullanılmıyor.
22. `stock_notification_requests` boş — özellik canlıya çıktı, henüz kullanım yok.
23. `model_has_permissions` boş — doğrudan kullanıcıya izin verilmiyor, hep rol üzerinden.

### 15.6 Şema kalitesi

24. `student_payments.total_price`, `total_payed_price`,
    `student_payments_installments.installment_price`, `payed_price` → **VARCHAR(230)**,
    decimal değil. Toplama/sıralama yapılırken cast gerekir.
25. `lesson_classes.teacher_id` → **varchar(255)**, FK değil.
26. Yazım hataları şemada kalıcı: `registiration_term`, `payyed_date`,
    URL'lerde `pre-registiration`.
27. `courses.price` → varchar (kampanya metni yazılabilsin diye olabilir, doğrulanmadı).
28. `faqs.category_id` FK var ama `faq_categories` tablosu **yok** — `Faq::category()`
    ilişkisi `Category\Category` modeline gidiyor, o modelin de tablosu yok. Ölü ilişki.

### 15.7 Dokümantasyon senkronizasyonu

29. `todo.md` içindeki bazı bilgiler eskimiş: "17 dil" (şimdi 21 kayıt/22 json),
    "Port 8014 / 5175" (yerel docker), "dark mode", "fuchsia tema", eski izin listesi
    (`user, user_delete, class, class_delete, student, student_delete, accounting` — şimdi 37 izin).
30. `tasks.md`'de "Bekleyen" ve "Devam Eden" bölümleri **boş**.
31. Eski `CLAUDE.md` bu sunucu için tamamen yanlış bilgi içeriyordu (bkz. §17.5).

---

## 16. Gotcha'lar

**1. Veritabanı adında tire var.**
`parosis-akademi` — SQL'de her zaman backtick: `` `parosis-akademi`.students ``

**2. CLI PHP 8.3, FPM havuzu 8.4.**
`php artisan ...` 8.3.16 ile çalışır; web istekleri 8.4 FPM havuzundan geçiyor
(havuz dosyası `/etc/php/8.4/fpm/pool.d/parosisakademi.com.conf`).
Sürüme duyarlı bir davranış görürsen bunu hatırla. (nginx conf okunamadığı için
8.4'e yönlendirme %100 doğrulanmadı.)

**3. Mail ayarları `.env`'den DEĞİL, DB'den gelir.**
`AppServiceProvider::overrideMailConfig()` boot'ta `settings` tablosunun `mail` grubunu
okuyup `config('mail.*')`'ı ezer. `.env`'de `MAIL_MAILER=log` yazması hiçbir şey ifade
etmez. `mail_password` `Crypt::encryptString` ile şifreli saklanır — **`APP_KEY`
değişirse mail şifresi çözülemez.**

**4. `Setting` 24 saat cache'lenir.**
DB'de doğrudan `settings` satırı değiştirirsen panelde/sitede 24 saat görünmez.
`Setting::set()`/`saveGroup()` kullanıldığında cache otomatik temizlenir.
Manuel değişiklikten sonra `php artisan cache:clear` gerekir (**yazma işlemi — izin al**).

**5. `config:cache` yaparsan mail/validation override'ları hâlâ çalışır**
(runtime `config()` çağrısı olduğu için) — ama `.env` okumayı bırakır.
Bu proje şu an cache'siz çalışıyor; cache açmadan önce test et.

**6. Locale yoksa 404, geçersizse 404.**
`SetLocale` DB'ye bakar: `status=1 AND is_active=1`. Bir dili panelden pasifleştirirsen
o dildeki tüm URL'ler anında 404 döner (Google indeksindeki linkler dahil).

**7. `app_locale` cookie'si şifrelenmez.**
`encryptCookies(except: ['app_locale'])`. Kullanıcı elle değiştirebilir ama
SetLocale her istekte DB'ye karşı doğruladığı için güvenlik sorunu değil.

**8. Cloudflare Flexible SSL tuzağı.**
`trustProxies(at: '*')` olmasaydı `route()` `http://` üretir ve mixed-content /
sonsuz redirect olurdu. **Bu ayarı kaldırma.**
Ayrıca `*.corwus.com` deneyiminden: HTTP→HTTPS redirect'i vhost'a ekleme, loop yapar.

**9. `update`/`store` route'ları POST, PUT/PATCH değil.**
Blade formlarında `@method('PUT')` ekleme. Tek istisna sitemap-entries.

**10. Route adı tuzakları.**
`students.pre.createPreRegistiration` (yazım hatası korunmalı),
`client-logos.index` (tire), `blogCategories.index` (camelCase),
`course-applications.index` (tire), `menu-items.index` (tire).
Tutarsız ama **değiştirilirse 216 blade dosyasındaki `route()` çağrıları kırılır.**

**11. Front route'ları `{locale}` parametresi ister.**
`URL::defaults` sayesinde `route('front.blog')` çalışır; ama farklı bir dil için
link üretecekseniz `route('front.blog', ['locale' => 'en'])` yazmalısınız.

**12. Sepet session'da, DB'de değil.**
Session driver `database` olduğu için `sessions` tablosu temizlenirse tüm sepetler gider.

**13. `SharedDatas` her front isteğinde ~8 sorgu çalıştırır**
(diller, navbar, footer, contact, menü ağacı 3 seviye, shop info, settings 5 grup).
Settings cache'li ama diğerleri değil. Front performansında ilk bakılacak yer.

**14. `public/uploads` git'te yok (91 MB).**
Yeni sunucuya taşırken **ayrıca kopyalanmalı**, yoksa tüm görseller kırılır.

**15. `npm run build` TinyMCE'yi de kopyalar.**
Sadece `vite build` çalıştırırsan `public/tinymce` eksik/eski kalır ve panel editörü patlar.

**16. Frontend değiştiyse build ŞART.**
`resources/views`, `resources/css`, `resources/js` değişikliğinden sonra
`npm run build` (aksi halde canlıda eski asset görünür).
Blade değişikliği için build gerekmez ama view cache'i CACHED durumda — şüphede
`php artisan view:clear` (yazma işlemi, izin al).

**17. Route/controller/config değiştiyse `php artisan optimize:clear`.**

**18. `is_visible` üç yerde farklı anlama gelir.**
`users.is_visible` (kullanıcı listesinde gizle), `roles.is_visible` (rol seçiminde gizle),
`languages.is_visible` (dil seçicide göster). Karıştırma.

**19. Bakım modu paneli kapatmaz.**
`CheckMaintenanceMode` sadece front grubunda. Bu bilinçli.

**20. Seeder'lar canlıda çalıştırılamaz.**
`CertificateSeeder`, `CompetitionSeeder`, `CourseSeeder`, `ShopSeeder` dummy veri üretir.
`php artisan db:seed` canlıda **kesinlikle çalıştırılmamalı**.

**21. Spatie permission cache'i 24 saat.**
İzin/rol değişikliği sonrası `php artisan permission:cache-reset` gerekebilir.

---

## 17. Çalışma Kuralları

### 17.1 🔴 PRODUCTION UYARISI — ÖNCE BUNU OKU

**`/home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi` CANLI SİTEDİR.**
https://parosisakademi.com bu dosyalardan servis edilir. Yerel kopya, staging veya
test ortamı değildir. Veritabanında **gerçek öğrenci, veli, ödeme ve sipariş verisi** vardır.

**Kullanıcı açıkça istemedikçe ASLA:**
- Dosya değiştirme / silme / oluşturma
- `git commit` · `git push` · `git checkout` · `git stash` · `git reset` · `git pull`
- `php artisan migrate` · `migrate:rollback` · `migrate:fresh` · `db:seed` · `db:wipe`
- `php artisan cache:clear` · `config:cache` · `optimize` · `view:clear` · `route:cache`
- `composer install/update` · `npm install` · `npm run build`
- Servis restart (`systemctl`, `php-fpm reload`, `nginx reload`)
- `chmod` / `chown`
- SQL `INSERT` / `UPDATE` / `DELETE` / `DROP` / `ALTER` / `TRUNCATE`

**İzin verilen (salt-okunur):**
`cat` `ls` `grep` `find` `head` `tail` `wc` `du`
`git status` `git log` `git branch` `git diff --stat` `git show`
`php artisan route:list` `php artisan about` `php artisan db:show` `php -l`
SQL `SELECT` (information_schema dahil)

Şüphe duyduğun komutu **çalıştırma, sor.**

### 17.2 Geliştirme süreci

1. **Planlama** — Kod yazmadan önce kısa plan: sorun/ihtiyaç, etkilenecek dosyalar,
   riskler, adımlar.
2. **Onay** — Büyük değişiklikte plan sun ve onay bekle. Küçük/düşük riskli işte
   kısa plan verip devam edebilirsin. **Bu projede "küçük" eşiği düşüktür — production.**
3. **Branch** — Her yeni iş için ayrı branch: `feature/` `fix/` `refactor/` `hotfix/`.
   **Ama bu sunucuda branch oluşturma/değiştirme yapma** (§14.2 riski);
   geliştirme yerel kopyada yapılıp buraya deploy edilmeli.
4. **Küçük adımlar** — Tek seferde geniş kapsamlı değişiklik yapma.
5. **Mevcut yapıyı koru** — Çalışan kodu gereksiz silme, mimariyi tek seferde değiştirme.
   Kırıcı değişiklik yapacaksan önce belirt.
6. **Her anlamlı değişiklik sonrası kontrol** — `php -l <dosya>`, ilgili ekran/akış
   mantık kontrolü, mümkünse build doğrulaması.
7. **Temiz kod** — Analyze hatası, null/type hatası, kullanılmayan import, kırık yapı bırakma.
8. **Commit formatı** — Conventional Commits: `feat:` `fix:` `refactor:` `chore:` `perf:` `ui:`
9. **Self-review** — Hangi dosyalar değişti, ne çözüldü, risk kaldı mı, sonraki adım ne.
10. **Refactor kuralları** — Davranışı değiştirme, küçük parçalara böl, adım adım ilerle.

### 17.3 İletişim

- **Türkçe yanıt ver.** İmla kurallarına uy, Türkçe karakterleri (ç, ş, ğ, ü, ö, ı, İ)
  doğru kullan.
- Her tool çağrısından önce **tek cümlelik canlı anlatım** yap (kullanıcı izlerken
  ne yaptığını anlasın).
- Gereksiz açıklama yapma, kısa ve net ol.
- Emoji kullanma.

### 17.4 Görev takibi

- Proje kökünde `tasks.md` var: **Bekleyen / Devam Eden / Tamamlanan** bölümleri.
- Kullanıcı görev verdiğinde "Bekleyen"e tarihle yaz; başlayınca "Devam Eden"e,
  bitince "Tamamlanan"a taşı.
- Her konuşma başında `tasks.md` oku, bekleyen görev varsa hatırlat.
- **Not:** Eski CLAUDE.md `/root/.claude/projects/-home-coder-project/memory/tasks.md`
  ile senkron tutulmasını söylüyordu. **Bu yol bu sunucuda mevcut değildir**
  (farklı makine). Senkronizasyon yalnızca geliştirme makinesinde geçerlidir.

### 17.5 Eski CLAUDE.md'den DÜZELTİLEN bilgiler

Bu dosyanın önceki sürümü jenerik bir şablondu ve bu proje için hatalıydı:

| Eski (YANLIŞ) | Doğrusu |
|---|---|
| `DB: mysql:3306, db=maltepe_db, user=devuser, pass=devpass` | `127.0.0.1:3306`, db=**`parosis-akademi`**, user=`parosis-akademi` (MariaDB 10.11.8) |
| `Çalışma dizini: /home/coder/project` | `/home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi` |
| "PHP ve Composer bu container'da yüklü gelmez, `apt-get install php ...` ile kur" | Sunucuda PHP 8.3.16 + Composer 2.8.5 **zaten kurulu**; root yetkisi yok, `apt-get` çalışmaz |
| "Migration oluşturulduğunda `php artisan migrate` çalıştır" | **Production** — migrate sadece açık onayla |
| "Route/controller/config değiştiğinde `php artisan optimize:clear` çalıştır" | Doğru ama production'da onay gerektirir |
| `tasks.md` kopyası `/root/.claude/.../memory/tasks.md` | Bu yol bu sunucuda yok |
| "Framework: Laravel 12 (PHP 8.2+)" | Doğru ama eksik: Laravel **12.60.2**, PHP CLI 8.3.16 / FPM 8.4 |
| "Session driver: database" | Doğru (korundu) |
| "Frontend: Vite (npm run build)" | Doğru ama eksik: `build` = `tinymce:copy` + `vite build` |
| Proje amacı / mimari / veri modeli / route / izin bilgisi | **Hiç yoktu** — bu dosyada eklendi |

Korunan doğru kurallar: Türkçe yanıt, imla, kısa/net olma, frontend değişince build,
route/config değişince `optimize:clear`, tasks.md görev takibi, konuşma başında bu
dosyayı okuma.

---

## Hızlı Referans

```bash
# Bağlan
ssh parosisakademi@159.69.213.197
cd /home/parosisakademi/htdocs/parosisakademi.com/parosis-akademi

# Durum (güvenli)
git status && git log --oneline -5
php artisan about
php artisan route:list | grep <arama>
tail -50 storage/logs/laravel.log

# DB (SELECT — güvenli)
DBP=$(grep '^DB_PASSWORD=' .env | cut -d= -f2-)
mysql -h127.0.0.1 -u'parosis-akademi' -p"$DBP" -e "SELECT COUNT(*) FROM \`parosis-akademi\`.students"

# Canlı kontrol
curl -sSI https://parosisakademi.com/ | head -3
curl -so /dev/null -w '%{http_code}\n' https://parosisakademi.com/tr
```

| Bilmek istediğin | Bak |
|---|---|
| Tüm route'lar | `routes/web.php` (tek dosya) veya `php artisan route:list` |
| Bir sayfanın metinleri nerede | `<sayfa>_page_infos` tablosu + `admin/pages/edit-<key>.blade.php` |
| Panel UI bileşeni nasıl yazılır | `ADMIN_PANEL_UI.md` + `/panel/reference` |
| Bir formun hata mesajları | `app/Services/ValidationMessageService.php` `$modules` |
| İzin nasıl kontrol ediliyor | `routes/web.php` middleware + `admin/layouts/aside.blade.php` |
| Global view değişkenleri | `app/Http/Middleware/SharedDatas.php` |
| Mail/validation config override'ı | `app/Providers/AppServiceProvider.php` |
| Sidebar renkleri | `app/Http/Controllers/Theme/ThemeController.php` sabitleri |
| Yapılacaklar / yapılanlar | `tasks.md`, `todo.md` |
