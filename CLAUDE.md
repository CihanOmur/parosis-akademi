# Claude Code Ayar Dosyası

Bu dosya her konuşmada okunmalı. Yeni projede de aynı kuralları uygular.

---

## 1. Ortam Kurulumu

PHP ve Composer bu container'da varsayılan yüklü gelmez. İhtiyaç duyulduğunda (artisan, composer komutu vb.) yüklü mü kontrol et, yoksa kur:

```bash
# PHP
php -v 2>/dev/null || (apt-get update -qq && apt-get install -y -qq php php-mysql php-xml php-curl php-zip php-mbstring php-bcmath)
# Composer
composer -V 2>/dev/null || (curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer)
# Node bağımlılıkları (vite vb.)
test -d node_modules || npm install
```

## 2. Genel Kurallar

- Her konuşmanın başında ve uzun konuşmalarda bu CLAUDE.md dosyasını tekrar oku.
- Kullanıcı Türkçe yazıyorsa Türkçe cevap ver.
- Gereksiz açıklama yapma, kısa ve net ol.
- Türkçe yazarken imla kurallarına uy, özel karakterleri (ç, ş, ğ, ü, ö, ı, İ) doğru kullan.

## 3. Laravel Kuralları

- Frontend dosyaları (resources/views, resources/js, resources/css vb.) değiştiğinde her zaman `npm run build` çalıştır.
- Migration oluşturulduğunda `php artisan migrate` çalıştır.
- Route, controller veya config değiştiğinde `php artisan optimize:clear` çalıştır.

## 4. Görev Takip Sistemi

- Proje kökünde `tasks.md` dosyası olmalı. Yoksa oluştur.
- Aynı dosyanın bir kopyası `/root/.claude/projects/-home-coder-project/memory/tasks.md` yolunda tutulmalı. İki dosya her zaman senkron kalmalı.
- Kullanıcı görev verdiğinde "Bekleyen"e yaz, tarih ekle.
- Göreve başladığında "Devam Eden"e taşı.
- Görev bittiğinde "Tamamlanan"a taşı.
- Her konuşma başında tasks.md oku, bekleyen görev varsa kullanıcıya hatırlat.

### tasks.md şablonu (yoksa bunu oluştur):

```markdown
# Görev Takibi

## Bekleyen

## Devam Eden

## Tamamlanan
```

## 5. Proje Bilgileri (projeye göre güncelle)

- Framework: Laravel 12 (PHP 8.2+)
- DB: MySQL (host: mysql, port: 3306, db: maltepe_db, user: devuser, pass: devpass)
- Session driver: database
- Frontend: Vite (npm run build)
- Çalışma dizini: /home/coder/project
