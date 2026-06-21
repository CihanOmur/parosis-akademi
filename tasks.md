# Görev Takibi

## Bekleyen

## Devam Eden

## Tamamlanan
- 2026-06-21 — Production deployment (parosisakademi.com). Local main (a532333+c2be13c) GitHub'a push, sunucuda git pull (111 commit), composer install, npm build, 96 migration (96/96 başarılı + 2 manuel düzeltme: shop_page_infos CREATE migration tarih sırası, modular_permissions_v3 'content' yokken patlıyordu), 7 eksik izin (developer/language/menu/page/settings/shop/shop_delete) manuel eklendi, SuperAdmin/Admin'e tüm izinler sync, 21 dil local'den sunucuya import. Mevcut canlı veriler korundu (11 user, 85 öğrenci, 86 veli, 85 ödeme, 626 taksit, 17 sınıf). Smoke test: tüm front sayfalar 200, panel 302/200.
- 2026-06-21 — Sunucu DB'sini local'e (8003) taşıma: 1027 satır, 9 tablo (users/students/student_guardians/emergency_contacts/lesson_classes/lesson_class_days/student_payments/student_payments_installments/model_has_roles). MD5 hash bit-bit doğrulama: 9/9 tablo birebir aynı (lesson_classes course_id kolonu hariç).
- 2026-06-17 — İzin sisteminin tam modüler yeniden yapılandırılması: 22 → 37 izin. `content`/`content_delete` parçalandı → `blog`, `course`, `faq`, `teacher`, `testimonial`, `client_logo`, `slider` (her birinin `_delete` varyantı). `role`/`role_delete` (kullanıcı izninden ayrıldı), `theme` (settings'den ayrıldı) eklendi. routes/web.php tüm middleware'leri + aside.blade.php 14 @canany + admin/roles/index.blade.php @can güncellendi. Eski rolelere otomatik karşılık atama yapan migration (content → 7 modül, user → role, settings → theme).
- 2026-06-14 — Yarışmalar v2: spec'e göre eksikler tamamlandı. (Sidebar Eğitmenler altına ayrı top-level link · Index KART layout · Ülke/Şehir/Son kayıt tarihi/Web URL alanları · Kategori tablosu + Tom Select tagging (yeni etiketler otomatik oluşturuluyor) · Çoklu öğrenci atama (yarışma sayfasından) · Pivot'a kategori + takım adı + passport_valid_6m checkbox + result_file dosya yükleme · Statü etiketleri spec'e göre güncellendi (Alınmadı/İmzalı Geldi/Sistemde Yüklü · Muaf/Başvuruldu/Onaylandı/Reddedildi · Ödenmedi/Kısmi/Tamamı Ödendi) · Show sayfasında kombinasyon filtreleri (kategori + vize + ödeme) · Index'te kategori bazlı filtre)
- 2026-06-14 — Yarışmalar (Competitions) v1 modülü: CRUD katalogu, öğrenci profilinde 4. tab "Yarışmalar", veli izin/pasaport/vize/ödeme statüleri, kayıt ücreti, sonuç girişi, yarışma sonucundan tek tıkla sertifika oluşturma
- 2026-06-13 — Sertifika filtreleme: Danışmanlık Kurumları index'e sertifika sayısı badge, kurum bazlı sertifika listesi sayfası (`/panel/consulting-institutions/{id}/sertifikalar`), öğrenci sertifika sayfasına "Yazdır / CV" çıktısı + print CSS
- 2026-06-13 — CertificateController kritik bug fix: store/update/destroy'da eksik `;` (3 yer) → patlama düzeltildi
- 2026-06-13 — Sertifika dummy data (CertificateSeeder): 14 sertifika, 4 öğrenciye 3 tipte (kurumsal/danışmanlık/yarışma) dağıtıldı
