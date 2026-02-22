# Parosis Akademi - Proje TODO

## Proje Genel Bilgisi
- **Framework:** Laravel 12 + Blade Templates
- **CSS:** Tailwind CSS v4 + Flowbite
- **Veritabanı:** MySQL
- **PDF:** Barryvdh DomPDF
- **Roller:** Spatie Laravel Permission
- **Çoklu Dil:** Spatie Laravel Translatable
- **Port:** 8014 (Laravel), 5175 (Vite)

---

## ✅ TAMAMLANANLAR

### Admin Panel UI (Modern Yenileme)
- [x] `app.css` - Inter font, glass efekt, sidebar-collapsed stilleri, x-cloak
- [x] `app.blade.php` - Alpine.js (dark mode, sidebar collapse, toast), global confirm/alert modal
- [x] `aside.blade.php` - Collapsible sidebar (w-72 → w-20), flyout menü, kullanıcı profili, fuchsia renk teması
- [x] `navbar.blade.php` - Glass navbar, dark mode toggle, "Siteyi Gör" butonu, Alpine dropdown
- [x] `toast.blade.php` - Modern toast (progress bar animasyonu, dark mode uyumlu)

---

### Auth / Kullanıcı Yönetimi
- [x] Login / Logout sistemi
- [x] Kullanıcı CRUD (oluştur, düzenle, sil, listele)
- [x] Rol tabanlı yetkilendirme (Spatie Permission)
- [x] Yetkiler: `user`, `user_delete`, `class`, `class_delete`, `student`, `student_delete`, `accounting`

### Öğrenci Yönetimi
- [x] Öğrenci listesi (arama + filtreleme - ad, sınıf, dönem)
- [x] Öğrenci oluşturma (normal kayıt)
- [x] Öğrenci düzenleme
- [x] Öğrenci silme
- [x] Öğrenci aktif/pasif durumu değiştirme
- [x] Ön kayıt oluşturma (`createPreRegistiration`)
- [x] Ön kayıt düzenleme
- [x] Ön kayıt → Normal kayıt dönüştürme (`pre-to-normal`)
- [x] Ön kayıtlı öğrenciler listesi
- [x] Öğrenci yeniden kaydı (`re-create`)
- [x] Veli bilgileri (en fazla 2 veli)
- [x] Acil iletişim kişisi bilgileri

### Sınıf / Ders Yönetimi
- [x] Sınıf CRUD (oluştur, düzenle, sil, listele)
- [x] Sınıf detayları: ad, gün, saat, fiyat, kontenjan, öğretmen, süre, başlangıç/bitiş tarihi
- [x] Ders günleri yönetimi (`lesson_class_days`)
- [x] Öğretmen atama

### Ödeme Yönetimi
- [x] Öğrenci ödeme planı oluşturma
- [x] Taksitli ödeme takibi
- [x] Ödeme durumu (ödendi / ödenmedi)
- [x] Ödeme türü (Nakit vb.)
- [x] Ödeme tarihi takibi
- [x] Tüm ödemeler listesi (`allPayments`)

### PDF / Belge Üretimi
- [x] Kayıt formu PDF indirme
- [x] Öğrenci sözleşmesi PDF
- [x] Ödeme sözleşmesi PDF

### Çoklu Dil Sistemi
- [x] 17 dil tanımlı (tr_TR, en_US, en_GB, ar_SA, de_DE, es_ES, es_MX, fr_FR, hi_IN, it_IT, ja_JP, ko_KR, pt_BR, pt_PT, ru_RU, zh_CN, zh_TW)
- [x] Dil yönetim ekranı (`/panel/languages/`)
- [x] Model bazlı çeviriler (Spatie Translatable) - içerik DB'de JSON olarak tutuluyor
- [x] SharedDatas middleware (aktif dilleri tüm panel view'larına paylaşıyor)

### Veritabanı Modelleri (Tanımlanmış)
- [x] `User`, `LessonClass`, `LessonClassDays`
- [x] `Student`, `StudentGuardian`, `EmergencyContact`
- [x] `StudentPayments`, `StudentPaymentsInstallment`
- [x] `Projects`, `Blog`, `Teams`, `Services`, `References`, `Faq`, `Category`
- [x] `AboutUsPageInfo`, `AboutUsPageGallery`
- [x] `TeamsPageInfo`, `TeamsPageGallery`
- [x] `ProjectsPageInfo`, `ReferencesPageInfo`, `ServicesPageInfo`, `ContactPageInfo`
- [x] `Contact`, `ContactAddress`, `ContactPhone`, `ContactMail`
- [x] `Languages`

### Admin Panel UI
- [x] Admin layout (navbar, sidebar, toast)
- [x] Öğrenci sekme menüsü componenti
- [x] Onay modalı componenti
- [x] Ödeme alert componenti

---

## 🔄 DEVAM EDEN / YARIM KALAN

### İçerik Yönetimi (CMS) - View'lar var, Controller/Route YOK
- [ ] **Hakkımızda** sayfası düzenleme controller + route (`pages/edit-about-us`)
- [ ] **Hakkımızda** çeviri yönetimi (`pages/edit-about-us-translate`)
- [ ] **Ekip / Takım** sayfası düzenleme (`pages/edit-teams`)
- [ ] **Ekip** çeviri yönetimi (`pages/edit-teams-translate`)
- [ ] **Projeler** sayfası düzenleme (`pages/edit-projects`)
- [ ] **Projeler** çeviri yönetimi (`pages/edit-projects-translate`)
- [ ] **Hizmetler** sayfası düzenleme (`pages/edit-services`)
- [ ] **Hizmetler** çeviri yönetimi (`pages/edit-services-translate`)
- [ ] **Referanslar** sayfası düzenleme (`pages/edit-references`)
- [ ] **Referanslar** çeviri yönetimi (`pages/edit-references-translate`)
- [ ] **İletişim** sayfası düzenleme (`pages/edit-contact`)
- [ ] **İletişim** çeviri yönetimi (`pages/edit-contact-translate`)
- [ ] CMS pages route'ları ve PagesController

---

## ❌ YAPILACAKLAR

### Dashboard
- [ ] Dashboard istatistikleri (toplam öğrenci, aktif sınıf, aylık ödeme, bekleyen taksitler)
- [ ] Grafikler / chartlar (ödeme durumu, öğrenci sayısı, sınıf doluluk oranı)
- [ ] Yaklaşan ödeme tarihleri listesi
- [ ] Son kayıtlar özeti

### İçerik Yönetimi (CMS) - CRUD Modülleri eksik
- [ ] **Blog** yönetimi: liste, oluştur, düzenle, sil, çeviri
- [ ] **Proje** yönetimi: liste, oluştur, düzenle, sil, çeviri
- [ ] **Hizmet** yönetimi: liste, oluştur, düzenle, sil, çeviri
- [ ] **Referans** yönetimi: liste, oluştur, düzenle, sil, çeviri
- [ ] **SSS (FAQ)** yönetimi: liste, oluştur, düzenle, sil, çeviri
- [ ] **Ekip Üyesi** yönetimi: liste, oluştur, düzenle, sil, çeviri
- [ ] **Kategori** yönetimi: liste, oluştur, düzenle, sil, çeviri (Blog, Proje, Hizmet, Referans, SSS için)
- [ ] Galeri yönetimi (Hakkımızda, Ekip galerileri için resim yükleme/silme)
- [ ] **İletişim bilgileri** yönetimi (adres, telefon, e-posta CRUD)

### Dosya Yükleme
- [ ] Resim yükleme mekanizması (galeri, proje görselleri, ekip fotoğrafları)
- [ ] Dosya yönetimi (storage dizini, thumbnail oluşturma)
- [ ] Resim silme

### Public Frontend (Ziyaretçi Sitesi)
- [ ] Ana sayfa (`/`) - dinamik içerikle
- [ ] Hakkımızda sayfası (`/about`)
- [ ] Hizmetler sayfası (`/services`)
- [ ] Projeler sayfası (`/projects`)
- [ ] Proje detay sayfası (`/projects/{slug}`)
- [ ] Blog sayfası (`/blog`)
- [ ] Blog detay sayfası (`/blog/{slug}`)
- [ ] Ekip sayfası (`/team`)
- [ ] Referanslar sayfası (`/references`)
- [ ] SSS sayfası (`/faq`)
- [ ] İletişim sayfası (`/contact`)
- [ ] İletişim formu (form gönderme + mail)
- [ ] Dil değiştirme (public frontend için locale switcher)
- [ ] FrontController oluşturma

### Dışa Aktarma / Raporlama
- [ ] Öğrenci listesi Excel/CSV export
- [ ] Ödeme raporu Excel/CSV export
- [ ] Sınıf bazlı öğrenci listesi raporu

### Bildirimler
- [ ] Ödeme tarihi yaklaşınca e-mail/bildirim
- [ ] Yeni kayıt bildirimi
- [ ] İletişim formu gelince admin'e e-mail

### Öğrenci Yönetimi - İyileştirmeler
- [ ] Gelişmiş filtreleme (ödeme durumu, cinsiyet, yaş aralığı)
- [ ] Öğrenci profil fotoğrafı
- [ ] Devamsızlık takibi

### Sınıf Yönetimi - İyileştirmeler
- [ ] Sınıf doluluk göstergesi (kayıtlı / kontenjan)
- [ ] Sınıf bazlı öğrenci listesi görünümü

### Ödeme Yönetimi - İyileştirmeler
- [ ] Toplu ödeme görünümü (tüm öğrencilerin bu ayki ödemeleri)
- [ ] Gecikmiş ödeme listesi
- [ ] Ödeme makbuzu PDF

### Teknik / Altyapı
- [ ] Form validation birleştirme (tüm controller'larda tutarlı validation)
- [ ] Activity log (kim ne zaman ne yaptı)
- [ ] Hata yönetimi (custom exception handler)
- [ ] Test yazımı (Feature tests için StudentController, UserController, ClassController)
- [ ] Sidebar'da aktif sayfa vurgusu

---

## 📋 ÖNCELIK SIRASI (Önerilen)

1. **Dashboard istatistikleri** - Admin'in hızlı özet görmesi için kritik
2. **CMS controller + route'ları** - View'lar zaten var, bağlamak gerekiyor
3. **Blog / Proje / Hizmet / SSS CRUD** - İçerik yönetimi için şart
4. **Dosya yükleme** - Galeri ve görseller için gerekli
5. **Public Frontend** - Ziyaretçi sitesi
6. **Dışa aktarma (Excel/CSV)** - Muhasebe için önemli
7. **Bildirimler** - Ödeme takibi için faydalı
8. **Testler** - Kalite güvencesi

---

## 🗂️ Önemli Dosya Yolları

| Alan | Yol |
|------|-----|
| Controller'lar | `app/Http/Controllers/` |
| Modeller | `app/Models/` |
| View'lar (Admin) | `resources/views/admin/` |
| View'lar (Front) | `resources/views/front/` |
| Route'lar | `routes/web.php` |
| Migration'lar | `database/migrations/` |
| Dil dosyaları | `lang/` |
| CSS | `resources/css/app.css` |
| JS | `resources/js/app.js` |
| Config | `config/` |
| Helpers | `app/Helpers.php` |
| Middleware | `app/Http/Middleware/SharedDatas.php` |
