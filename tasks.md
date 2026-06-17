# Görev Takibi

## Bekleyen

## Devam Eden

## Tamamlanan
- 2026-06-17 — İzin sisteminin tam modüler yeniden yapılandırılması: 22 → 37 izin. `content`/`content_delete` parçalandı → `blog`, `course`, `faq`, `teacher`, `testimonial`, `client_logo`, `slider` (her birinin `_delete` varyantı). `role`/`role_delete` (kullanıcı izninden ayrıldı), `theme` (settings'den ayrıldı) eklendi. routes/web.php tüm middleware'leri + aside.blade.php 14 @canany + admin/roles/index.blade.php @can güncellendi. Eski rolelere otomatik karşılık atama yapan migration (content → 7 modül, user → role, settings → theme).
- 2026-06-14 — Yarışmalar v2: spec'e göre eksikler tamamlandı. (Sidebar Eğitmenler altına ayrı top-level link · Index KART layout · Ülke/Şehir/Son kayıt tarihi/Web URL alanları · Kategori tablosu + Tom Select tagging (yeni etiketler otomatik oluşturuluyor) · Çoklu öğrenci atama (yarışma sayfasından) · Pivot'a kategori + takım adı + passport_valid_6m checkbox + result_file dosya yükleme · Statü etiketleri spec'e göre güncellendi (Alınmadı/İmzalı Geldi/Sistemde Yüklü · Muaf/Başvuruldu/Onaylandı/Reddedildi · Ödenmedi/Kısmi/Tamamı Ödendi) · Show sayfasında kombinasyon filtreleri (kategori + vize + ödeme) · Index'te kategori bazlı filtre)
- 2026-06-14 — Yarışmalar (Competitions) v1 modülü: CRUD katalogu, öğrenci profilinde 4. tab "Yarışmalar", veli izin/pasaport/vize/ödeme statüleri, kayıt ücreti, sonuç girişi, yarışma sonucundan tek tıkla sertifika oluşturma
- 2026-06-13 — Sertifika filtreleme: Danışmanlık Kurumları index'e sertifika sayısı badge, kurum bazlı sertifika listesi sayfası (`/panel/consulting-institutions/{id}/sertifikalar`), öğrenci sertifika sayfasına "Yazdır / CV" çıktısı + print CSS
- 2026-06-13 — CertificateController kritik bug fix: store/update/destroy'da eksik `;` (3 yer) → patlama düzeltildi
- 2026-06-13 — Sertifika dummy data (CertificateSeeder): 14 sertifika, 4 öğrenciye 3 tipte (kurumsal/danışmanlık/yarışma) dağıtıldı
