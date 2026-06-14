# Görev Takibi

## Bekleyen

## Devam Eden

## Tamamlanan
- 2026-06-14 — Yarışmalar (Competitions) modülü: CRUD katalogu (`/panel/competitions`), öğrenci profilinde 4. tab "Yarışmalar", veli izin/pasaport/vize/ödeme statüleri, kayıt ücreti (tutar + para birimi), sonuç girişi (rank + label + notes), yarışma sonucundan tek tıkla sertifika oluşturma, kurum bazlı katılan öğrenciler listesi, sidebar + tab-menu güncellemeleri, CompetitionSeeder (5 yarışma + 8 atama dummy data)
- 2026-06-13 — Sertifika filtreleme: Danışmanlık Kurumları index'e sertifika sayısı badge, kurum bazlı sertifika listesi sayfası (`/panel/consulting-institutions/{id}/sertifikalar`), öğrenci sertifika sayfasına "Yazdır / CV" çıktısı + print CSS
- 2026-06-13 — CertificateController kritik bug fix: store/update/destroy'da eksik `;` (3 yer) → patlama düzeltildi
- 2026-06-13 — Sertifika dummy data (CertificateSeeder): 14 sertifika, 4 öğrenciye 3 tipte (kurumsal/danışmanlık/yarışma) dağıtıldı
