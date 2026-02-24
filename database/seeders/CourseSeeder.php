<?php

namespace Database\Seeders;

use App\Models\Courses\Course;
use App\Models\Courses\CourseCategory;
use App\Models\Pages\Course\CoursePageInfo;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Kategoriler ─────────────────────────────────────────────
        $categories = [
            ['name' => ['tr' => 'Yazılım', 'en' => 'Software', 'ar' => 'برمجة', 'de' => 'Software'], 'sort_order' => 1],
            ['name' => ['tr' => 'Tasarım', 'en' => 'Design', 'ar' => 'تصميم', 'de' => 'Design'], 'sort_order' => 2],
            ['name' => ['tr' => 'Pazarlama', 'en' => 'Marketing', 'ar' => 'تسويق', 'de' => 'Marketing'], 'sort_order' => 3],
            ['name' => ['tr' => 'İş Geliştirme', 'en' => 'Business', 'ar' => 'تطوير الأعمال', 'de' => 'Geschäftsentwicklung'], 'sort_order' => 4],
            ['name' => ['tr' => 'Dil Eğitimi', 'en' => 'Language', 'ar' => 'تعليم اللغات', 'de' => 'Sprache'], 'sort_order' => 5],
        ];

        $catModels = [];
        foreach ($categories as $cat) {
            $model = CourseCategory::create([
                'name' => $cat['name'],
                'is_active' => true,
                'sort_order' => $cat['sort_order'],
            ]);
            $catModels[] = $model;
        }

        // ─── Kurslar ────────────────────────────────────────────────
        $courses = [
            [
                'title' => ['tr' => 'PHP & Laravel ile Web Geliştirme', 'en' => 'Web Development with PHP & Laravel', 'ar' => 'تطوير الويب باستخدام PHP و Laravel', 'de' => 'Webentwicklung mit PHP & Laravel'],
                'short_description' => ['tr' => 'Sıfırdan profesyonel web uygulamaları geliştirmeyi öğrenin. Laravel framework ile modern backend geliştirme.', 'en' => 'Learn to build professional web applications from scratch. Modern backend development with Laravel framework.', 'ar' => 'تعلم بناء تطبيقات ويب احترافية من الصفر', 'de' => 'Lernen Sie professionelle Webanwendungen von Grund auf zu erstellen.'],
                'content' => ['tr' => '<p>Bu kapsamlı kurs, PHP programlama dilini ve Laravel framework\'ünü derinlemesine öğretir. Veritabanı yönetimi, API geliştirme, kimlik doğrulama ve daha fazlasını kapsayan gerçek dünya projeleri üzerinde çalışacaksınız.</p><p>Kurs boyunca 5 farklı proje geliştirecek ve portföyünüzü güçlendireceksiniz.</p>', 'en' => '<p>This comprehensive course teaches PHP and Laravel framework in depth. You will work on real-world projects covering database management, API development, authentication and more.</p>', 'ar' => '<p>هذه الدورة الشاملة تعلم PHP و Laravel بعمق.</p>', 'de' => '<p>Dieser umfassende Kurs lehrt PHP und das Laravel-Framework eingehend.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>PHP temel ve ileri kavramlar</li><li>Laravel MVC yapısı</li><li>Eloquent ORM ile veritabanı işlemleri</li><li>RESTful API geliştirme</li><li>Authentication ve Authorization</li></ul>', 'en' => '<ul><li>PHP fundamentals and advanced concepts</li><li>Laravel MVC architecture</li><li>Database operations with Eloquent ORM</li><li>RESTful API development</li></ul>', 'ar' => '<ul><li>أساسيات PHP</li><li>بنية Laravel MVC</li></ul>', 'de' => '<ul><li>PHP Grundlagen und fortgeschrittene Konzepte</li><li>Laravel MVC-Architektur</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Uygulamalı projelerle öğrenme</li><li>Uzman eğitmen desteği</li><li>Sertifika ile kariyer desteği</li><li>7/24 destek hattı</li></ul>', 'en' => '<ul><li>Hands-on project learning</li><li>Expert instructor support</li><li>Career support with certificate</li></ul>', 'ar' => '<ul><li>تعلم عملي</li><li>دعم المدربين الخبراء</li></ul>', 'de' => '<ul><li>Praxisnahes Projektlernen</li><li>Expertenunterstützung</li></ul>'],
                'price' => '₺2.500',
                'duration' => '16 Hafta',
                'lesson_count' => 48,
                'language' => 'Türkçe',
                'student_count' => 234,
                'has_certification' => true,
                'instructor_name' => 'Dr. Ahmet Yılmaz',
                'categories' => [0], // Yazılım
                'sort_order' => 1,
            ],
            [
                'title' => ['tr' => 'UI/UX Tasarım Temelleri', 'en' => 'UI/UX Design Fundamentals', 'ar' => 'أساسيات تصميم UI/UX', 'de' => 'UI/UX Design Grundlagen'],
                'short_description' => ['tr' => 'Kullanıcı deneyimi ve arayüz tasarımının temellerini öğrenin. Figma ile modern tasarım workflow\'ları.', 'en' => 'Learn the fundamentals of user experience and interface design. Modern design workflows with Figma.', 'ar' => 'تعلم أساسيات تجربة المستخدم وتصميم الواجهات', 'de' => 'Lernen Sie die Grundlagen von User Experience und Interface Design.'],
                'content' => ['tr' => '<p>Bu kurs, dijital ürün tasarımının temellerini kapsar. Kullanıcı araştırması, wireframing, prototipleme ve görsel tasarım prensiplerini gerçek projeler üzerinde uygulayacaksınız.</p>', 'en' => '<p>This course covers digital product design fundamentals including user research, wireframing, prototyping and visual design principles.</p>', 'ar' => '<p>تغطي هذه الدورة أساسيات تصميم المنتجات الرقمية.</p>', 'de' => '<p>Dieser Kurs behandelt die Grundlagen des digitalen Produktdesigns.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>Figma ile tasarım</li><li>Wireframe ve prototipleme</li><li>Renk teorisi ve tipografi</li><li>Kullanıcı araştırması</li></ul>', 'en' => '<ul><li>Design with Figma</li><li>Wireframing and prototyping</li><li>Color theory and typography</li></ul>', 'ar' => '<ul><li>التصميم باستخدام Figma</li></ul>', 'de' => '<ul><li>Design mit Figma</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Portföy oluşturma desteği</li><li>Gerçek müşteri projeleri</li><li>Sektör uzmanlarıyla networking</li></ul>', 'en' => '<ul><li>Portfolio building support</li><li>Real client projects</li></ul>', 'ar' => '<ul><li>دعم بناء المحفظة</li></ul>', 'de' => '<ul><li>Unterstützung beim Portfolio-Aufbau</li></ul>'],
                'price' => '₺1.800',
                'duration' => '12 Hafta',
                'lesson_count' => 36,
                'language' => 'Türkçe',
                'student_count' => 189,
                'has_certification' => true,
                'instructor_name' => 'Elif Kara',
                'categories' => [1], // Tasarım
                'sort_order' => 2,
            ],
            [
                'title' => ['tr' => 'Dijital Pazarlama Stratejileri', 'en' => 'Digital Marketing Strategies', 'ar' => 'استراتيجيات التسويق الرقمي', 'de' => 'Digitale Marketingstrategien'],
                'short_description' => ['tr' => 'SEO, sosyal medya, Google Ads ve içerik pazarlaması ile markanızı büyütün.', 'en' => 'Grow your brand with SEO, social media, Google Ads and content marketing.', 'ar' => 'قم بتنمية علامتك التجارية مع SEO ووسائل التواصل الاجتماعي', 'de' => 'Wachsen Sie Ihre Marke mit SEO, Social Media und Google Ads.'],
                'content' => ['tr' => '<p>Dijital pazarlamanın tüm boyutlarını kapsayan bu kurs, teorik bilgiyi pratik uygulamalarla birleştirir. Google Analytics, Meta Business Suite ve diğer araçları etkin kullanmayı öğreneceksiniz.</p>', 'en' => '<p>This course covers all dimensions of digital marketing, combining theory with practice.</p>', 'ar' => '<p>تغطي هذه الدورة جميع أبعاد التسويق الرقمي.</p>', 'de' => '<p>Dieser Kurs deckt alle Dimensionen des digitalen Marketings ab.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>SEO optimizasyonu</li><li>Google Ads yönetimi</li><li>Sosyal medya stratejisi</li><li>E-posta pazarlama</li><li>İçerik pazarlama</li></ul>', 'en' => '<ul><li>SEO optimization</li><li>Google Ads management</li><li>Social media strategy</li></ul>', 'ar' => '<ul><li>تحسين محركات البحث</li></ul>', 'de' => '<ul><li>SEO-Optimierung</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Güncel sektör trendleri</li><li>Gerçek kampanya yönetimi</li><li>Google sertifika hazırlığı</li></ul>', 'en' => '<ul><li>Current industry trends</li><li>Real campaign management</li></ul>', 'ar' => '<ul><li>اتجاهات الصناعة الحالية</li></ul>', 'de' => '<ul><li>Aktuelle Branchentrends</li></ul>'],
                'price' => '₺1.200',
                'duration' => '10 Hafta',
                'lesson_count' => 30,
                'language' => 'Türkçe',
                'student_count' => 312,
                'has_certification' => true,
                'instructor_name' => 'Mehmet Demir',
                'categories' => [2], // Pazarlama
                'sort_order' => 3,
            ],
            [
                'title' => ['tr' => 'React.js ile Frontend Geliştirme', 'en' => 'Frontend Development with React.js', 'ar' => 'تطوير الواجهات باستخدام React.js', 'de' => 'Frontend-Entwicklung mit React.js'],
                'short_description' => ['tr' => 'Modern frontend geliştirme teknikleri. React, Redux, hooks ve component mimarisi.', 'en' => 'Modern frontend development techniques. React, Redux, hooks and component architecture.', 'ar' => 'تقنيات تطوير الواجهات الحديثة', 'de' => 'Moderne Frontend-Entwicklungstechniken.'],
                'content' => ['tr' => '<p>React.js ekosistemini baştan sona öğrenin. JSX, state yönetimi, routing, API entegrasyonu ve performans optimizasyonu konularında uzmanlaşın.</p>', 'en' => '<p>Learn the React.js ecosystem from start to finish.</p>', 'ar' => '<p>تعلم نظام React.js البيئي من البداية إلى النهاية.</p>', 'de' => '<p>Lernen Sie das React.js-Ökosystem von Anfang bis Ende.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>React temelleri ve JSX</li><li>Hooks ve state yönetimi</li><li>Redux Toolkit</li><li>React Router</li><li>API entegrasyonu</li></ul>', 'en' => '<ul><li>React fundamentals and JSX</li><li>Hooks and state management</li><li>Redux Toolkit</li></ul>', 'ar' => '<ul><li>أساسيات React و JSX</li></ul>', 'de' => '<ul><li>React Grundlagen und JSX</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>En güncel React 19 müfredatı</li><li>10+ gerçek proje</li><li>Canlı code review seansları</li></ul>', 'en' => '<ul><li>Latest React 19 curriculum</li><li>10+ real projects</li></ul>', 'ar' => '<ul><li>أحدث منهج React 19</li></ul>', 'de' => '<ul><li>Aktuellster React 19 Lehrplan</li></ul>'],
                'price' => '₺2.200',
                'duration' => '14 Hafta',
                'lesson_count' => 42,
                'language' => 'Türkçe',
                'student_count' => 276,
                'has_certification' => true,
                'instructor_name' => 'Zeynep Aydın',
                'categories' => [0], // Yazılım
                'sort_order' => 4,
            ],
            [
                'title' => ['tr' => 'Girişimcilik ve Startup Yönetimi', 'en' => 'Entrepreneurship & Startup Management', 'ar' => 'ريادة الأعمال وإدارة الشركات الناشئة', 'de' => 'Unternehmertum & Startup-Management'],
                'short_description' => ['tr' => 'Fikir aşamasından yatırım turuna kadar startup yolculuğunuzun her adımını planlayın.', 'en' => 'Plan every step of your startup journey from idea to funding round.', 'ar' => 'خطط لكل خطوة من رحلة شركتك الناشئة', 'de' => 'Planen Sie jeden Schritt Ihrer Startup-Reise.'],
                'content' => ['tr' => '<p>Startup ekosistemini anlayın, iş modelinizi oluşturun, MVP geliştirin ve yatırımcılara pitch yapın. Başarılı girişimcilerden gerçek deneyimler dinleyin.</p>', 'en' => '<p>Understand the startup ecosystem, build your business model, develop an MVP and pitch to investors.</p>', 'ar' => '<p>افهم نظام الشركات الناشئة البيئي.</p>', 'de' => '<p>Verstehen Sie das Startup-Ökosystem.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>İş modeli canvas</li><li>MVP geliştirme</li><li>Pitch deck hazırlama</li><li>Finansal planlama</li></ul>', 'en' => '<ul><li>Business model canvas</li><li>MVP development</li><li>Pitch deck preparation</li></ul>', 'ar' => '<ul><li>نموذج العمل التجاري</li></ul>', 'de' => '<ul><li>Business Model Canvas</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Gerçek yatırımcılarla tanışma</li><li>Mentorluk desteği</li><li>Demo Day katılımı</li></ul>', 'en' => '<ul><li>Meet real investors</li><li>Mentorship support</li></ul>', 'ar' => '<ul><li>لقاء مستثمرين حقيقيين</li></ul>', 'de' => '<ul><li>Treffen Sie echte Investoren</li></ul>'],
                'price' => '₺1.500',
                'duration' => '8 Hafta',
                'lesson_count' => 24,
                'language' => 'Türkçe',
                'student_count' => 145,
                'has_certification' => false,
                'instructor_name' => 'Can Özkan',
                'categories' => [3], // İş Geliştirme
                'sort_order' => 5,
            ],
            [
                'title' => ['tr' => 'Python ile Veri Bilimi', 'en' => 'Data Science with Python', 'ar' => 'علم البيانات باستخدام Python', 'de' => 'Data Science mit Python'],
                'short_description' => ['tr' => 'Python, Pandas, NumPy ve makine öğrenmesi ile veri analizi ve görselleştirme.', 'en' => 'Data analysis and visualization with Python, Pandas, NumPy and machine learning.', 'ar' => 'تحليل البيانات والتصور باستخدام Python', 'de' => 'Datenanalyse und Visualisierung mit Python.'],
                'content' => ['tr' => '<p>Veri biliminin temellerinden ileri düzey makine öğrenmesi tekniklerine kadar kapsamlı bir eğitim. Gerçek veri setleri üzerinde projeler geliştirin.</p>', 'en' => '<p>Comprehensive training from data science fundamentals to advanced machine learning techniques.</p>', 'ar' => '<p>تدريب شامل من أساسيات علم البيانات.</p>', 'de' => '<p>Umfassende Schulung von den Grundlagen der Datenwissenschaft.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>Python programlama</li><li>Pandas ve NumPy</li><li>Veri görselleştirme (Matplotlib, Seaborn)</li><li>Makine öğrenmesi (scikit-learn)</li></ul>', 'en' => '<ul><li>Python programming</li><li>Pandas and NumPy</li><li>Data visualization</li></ul>', 'ar' => '<ul><li>برمجة Python</li></ul>', 'de' => '<ul><li>Python-Programmierung</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Sektörde en çok aranan beceri</li><li>Kaggle yarışma hazırlığı</li><li>Kariyer danışmanlığı</li></ul>', 'en' => '<ul><li>Most in-demand industry skill</li><li>Kaggle competition prep</li></ul>', 'ar' => '<ul><li>المهارة الأكثر طلباً</li></ul>', 'de' => '<ul><li>Gefragteste Branchenfähigkeit</li></ul>'],
                'price' => '₺2.800',
                'duration' => '18 Hafta',
                'lesson_count' => 54,
                'language' => 'Türkçe',
                'student_count' => 198,
                'has_certification' => true,
                'instructor_name' => 'Prof. Ayşe Kaya',
                'categories' => [0], // Yazılım
                'sort_order' => 6,
            ],
            [
                'title' => ['tr' => 'İngilizce Konuşma Kursu (B2)', 'en' => 'English Speaking Course (B2)', 'ar' => 'دورة المحادثة الإنجليزية (B2)', 'de' => 'Englisch Sprechkurs (B2)'],
                'short_description' => ['tr' => 'Akıcı İngilizce konuşma becerisi kazanın. Native eğitmenlerle birebir pratik.', 'en' => 'Gain fluent English speaking skills. One-on-one practice with native instructors.', 'ar' => 'اكتسب مهارات التحدث بالإنجليزية بطلاقة', 'de' => 'Fließend Englisch sprechen lernen.'],
                'content' => ['tr' => '<p>Bu kurs, günlük konuşmadan iş İngilizcesine kadar geniş bir yelpazede konuşma pratiği sunar. Her hafta native speaker eğitmenlerle canlı oturumlar.</p>', 'en' => '<p>This course offers speaking practice from everyday conversation to business English.</p>', 'ar' => '<p>تقدم هذه الدورة ممارسة المحادثة.</p>', 'de' => '<p>Dieser Kurs bietet Sprechpraxis vom Alltag bis zum Business-Englisch.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>Günlük konuşma kalıpları</li><li>İş İngilizcesi</li><li>Sunum yapma becerileri</li><li>Telaffuz düzeltme</li></ul>', 'en' => '<ul><li>Daily conversation patterns</li><li>Business English</li><li>Presentation skills</li></ul>', 'ar' => '<ul><li>أنماط المحادثة اليومية</li></ul>', 'de' => '<ul><li>Tägliche Konversationsmuster</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Native speaker eğitmenler</li><li>Küçük grup oturumları (max 6 kişi)</li><li>IELTS hazırlık desteği</li></ul>', 'en' => '<ul><li>Native speaker instructors</li><li>Small group sessions</li></ul>', 'ar' => '<ul><li>مدربون ناطقون أصليون</li></ul>', 'de' => '<ul><li>Muttersprachliche Lehrer</li></ul>'],
                'price' => '₺900',
                'duration' => '12 Hafta',
                'lesson_count' => 24,
                'language' => 'İngilizce / Türkçe',
                'student_count' => 420,
                'has_certification' => true,
                'instructor_name' => 'Sarah Johnson',
                'categories' => [4], // Dil Eğitimi
                'sort_order' => 7,
            ],
            [
                'title' => ['tr' => 'Adobe Illustrator ile Grafik Tasarım', 'en' => 'Graphic Design with Adobe Illustrator', 'ar' => 'التصميم الجرافيكي باستخدام Adobe Illustrator', 'de' => 'Grafikdesign mit Adobe Illustrator'],
                'short_description' => ['tr' => 'Logo, ikon, illüstrasyon ve basılı materyal tasarımında ustalaşın.', 'en' => 'Master logo, icon, illustration and print material design.', 'ar' => 'أتقن تصميم الشعارات والأيقونات والرسوم التوضيحية', 'de' => 'Meistern Sie Logo-, Icon- und Illustrationsdesign.'],
                'content' => ['tr' => '<p>Adobe Illustrator\'ın tüm araçlarını öğrenin. Vektörel çizim, logo tasarım süreçleri, kurumsal kimlik oluşturma ve baskıya hazır dosya üretimi.</p>', 'en' => '<p>Learn all Adobe Illustrator tools. Vector drawing, logo design processes and corporate identity creation.</p>', 'ar' => '<p>تعلم جميع أدوات Adobe Illustrator.</p>', 'de' => '<p>Lernen Sie alle Adobe Illustrator-Werkzeuge.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>Vektörel çizim teknikleri</li><li>Logo tasarım süreci</li><li>Kurumsal kimlik</li><li>Baskı dosyası hazırlama</li></ul>', 'en' => '<ul><li>Vector drawing techniques</li><li>Logo design process</li><li>Corporate identity</li></ul>', 'ar' => '<ul><li>تقنيات الرسم المتجه</li></ul>', 'de' => '<ul><li>Vektorzeichentechniken</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Adobe sertifikalı eğitmen</li><li>Freelance kariyer rehberliği</li><li>50+ uygulama projesi</li></ul>', 'en' => '<ul><li>Adobe certified instructor</li><li>Freelance career guidance</li></ul>', 'ar' => '<ul><li>مدرب معتمد من Adobe</li></ul>', 'de' => '<ul><li>Adobe-zertifizierter Ausbilder</li></ul>'],
                'price' => '₺1.400',
                'duration' => '10 Hafta',
                'lesson_count' => 30,
                'language' => 'Türkçe',
                'student_count' => 167,
                'has_certification' => true,
                'instructor_name' => 'Burak Şahin',
                'categories' => [1], // Tasarım
                'sort_order' => 8,
            ],
            [
                'title' => ['tr' => 'Sosyal Medya Yönetimi', 'en' => 'Social Media Management', 'ar' => 'إدارة وسائل التواصل الاجتماعي', 'de' => 'Social Media Management'],
                'short_description' => ['tr' => 'Instagram, TikTok, LinkedIn ve YouTube için içerik stratejisi ve topluluk yönetimi.', 'en' => 'Content strategy and community management for Instagram, TikTok, LinkedIn and YouTube.', 'ar' => 'استراتيجية المحتوى وإدارة المجتمع', 'de' => 'Content-Strategie und Community-Management.'],
                'content' => ['tr' => '<p>Sosyal medya platformlarını profesyonelce yönetmeyi öğrenin. İçerik planlaması, topluluk yönetimi, reklam optimizasyonu ve analitik raporlama.</p>', 'en' => '<p>Learn to professionally manage social media platforms.</p>', 'ar' => '<p>تعلم إدارة منصات التواصل الاجتماعي باحترافية.</p>', 'de' => '<p>Lernen Sie Social-Media-Plattformen professionell zu verwalten.</p>'],
                'what_you_learn' => ['tr' => '<ul><li>İçerik takvimi planlama</li><li>Reel ve story üretimi</li><li>Reklam yönetimi</li><li>Analitik ve raporlama</li></ul>', 'en' => '<ul><li>Content calendar planning</li><li>Reel and story production</li><li>Ad management</li></ul>', 'ar' => '<ul><li>تخطيط تقويم المحتوى</li></ul>', 'de' => '<ul><li>Content-Kalenderplanung</li></ul>'],
                'why_choose' => ['tr' => '<ul><li>Gerçek marka yönetimi deneyimi</li><li>Canva ve CapCut eğitimi dahil</li><li>Staj imkanı</li></ul>', 'en' => '<ul><li>Real brand management experience</li><li>Canva and CapCut training included</li></ul>', 'ar' => '<ul><li>تجربة إدارة علامة تجارية حقيقية</li></ul>', 'de' => '<ul><li>Echte Markenmanagement-Erfahrung</li></ul>'],
                'price' => '₺950',
                'duration' => '8 Hafta',
                'lesson_count' => 24,
                'language' => 'Türkçe',
                'student_count' => 385,
                'has_certification' => false,
                'instructor_name' => 'Selin Yıldız',
                'categories' => [2], // Pazarlama
                'sort_order' => 9,
            ],
        ];

        foreach ($courses as $courseData) {
            $catIndexes = $courseData['categories'];
            unset($courseData['categories']);

            $course = Course::create([
                'title' => $courseData['title'],
                'short_description' => $courseData['short_description'],
                'content' => $courseData['content'],
                'what_you_learn' => $courseData['what_you_learn'],
                'why_choose' => $courseData['why_choose'],
                'price' => $courseData['price'],
                'duration' => $courseData['duration'],
                'lesson_count' => $courseData['lesson_count'],
                'language' => $courseData['language'],
                'student_count' => $courseData['student_count'],
                'has_certification' => $courseData['has_certification'],
                'instructor_name' => $courseData['instructor_name'],
                'is_active' => true,
                'sort_order' => $courseData['sort_order'],
                'published_at' => now()->subDays(rand(1, 60)),
            ]);

            $categoryIds = array_map(fn($i) => $catModels[$i]->id, $catIndexes);
            $course->categories()->sync($categoryIds);
        }

        // ─── CoursePageInfo ─────────────────────────────────────────
        CoursePageInfo::create([
            'title' => ['tr' => 'Kurslarımız', 'en' => 'Our Courses', 'ar' => 'دوراتنا', 'de' => 'Unsere Kurse'],
            'breadcrumb_home' => ['tr' => 'ANA SAYFA', 'en' => 'HOME', 'ar' => 'الرئيسية', 'de' => 'STARTSEITE'],
            'breadcrumb_current' => ['tr' => 'KURSLAR', 'en' => 'COURSES', 'ar' => 'الدورات', 'de' => 'KURSE'],
            'detail_breadcrumb_current' => ['tr' => 'Kurs Detayı', 'en' => 'Course Details', 'ar' => 'تفاصيل الدورة', 'de' => 'Kursdetails'],
            'search_placeholder' => ['tr' => 'Kursunuzu arayın...', 'en' => 'Search courses...', 'ar' => 'ابحث عن دورتك...', 'de' => 'Kurse suchen...'],
            'search_button_text' => ['tr' => 'Ara', 'en' => 'Search', 'ar' => 'بحث', 'de' => 'Suchen'],
            'detail_what_learn_title' => ['tr' => 'Neler Öğreneceksiniz?', 'en' => 'What Will You Learn?', 'ar' => 'ماذا ستتعلم؟', 'de' => 'Was werden Sie lernen?'],
            'detail_why_choose_title' => ['tr' => 'Neden Bu Kurs?', 'en' => 'Why This Course?', 'ar' => 'لماذا هذه الدورة؟', 'de' => 'Warum dieser Kurs?'],
            'sidebar_info_title' => ['tr' => 'Kurs Bilgileri:', 'en' => 'Course Information:', 'ar' => 'معلومات الدورة:', 'de' => 'Kursinformationen:'],
            'sidebar_price_label' => ['tr' => 'Fiyat:', 'en' => 'Price:', 'ar' => 'السعر:', 'de' => 'Preis:'],
            'sidebar_instructor_label' => ['tr' => 'Eğitmen:', 'en' => 'Instructor:', 'ar' => 'المدرب:', 'de' => 'Dozent:'],
            'sidebar_certification_label' => ['tr' => 'Sertifika:', 'en' => 'Certificate:', 'ar' => 'شهادة:', 'de' => 'Zertifikat:'],
            'sidebar_lessons_label' => ['tr' => 'Dersler:', 'en' => 'Lessons:', 'ar' => 'الدروس:', 'de' => 'Lektionen:'],
            'sidebar_duration_label' => ['tr' => 'Süre:', 'en' => 'Duration:', 'ar' => 'المدة:', 'de' => 'Dauer:'],
            'sidebar_language_label' => ['tr' => 'Dil:', 'en' => 'Language:', 'ar' => 'اللغة:', 'de' => 'Sprache:'],
            'sidebar_students_label' => ['tr' => 'Öğrenciler:', 'en' => 'Students:', 'ar' => 'الطلاب:', 'de' => 'Studenten:'],
            'sidebar_contact_title' => ['tr' => 'İletişim', 'en' => 'Contact Us', 'ar' => 'اتصل بنا', 'de' => 'Kontakt'],
            'sidebar_contact_phone_label' => ['tr' => '7/24 Destek', 'en' => '24/7 Support', 'ar' => 'دعم على مدار الساعة', 'de' => '24/7 Support'],
            'sidebar_contact_phone' => ['tr' => '+90 532 321 33 33', 'en' => '+90 532 321 33 33', 'ar' => '+90 532 321 33 33', 'de' => '+90 532 321 33 33'],
            'sidebar_contact_email_label' => ['tr' => 'Mesaj Gönderin', 'en' => 'Send Message', 'ar' => 'أرسل رسالة', 'de' => 'Nachricht senden'],
            'sidebar_contact_email' => ['tr' => 'info@parosisakademi.com', 'en' => 'info@parosisakademi.com', 'ar' => 'info@parosisakademi.com', 'de' => 'info@parosisakademi.com'],
            'sidebar_contact_address_label' => ['tr' => 'Adresimiz', 'en' => 'Our Address', 'ar' => 'عنواننا', 'de' => 'Unsere Adresse'],
            'sidebar_contact_address' => ['tr' => 'İstanbul, Türkiye', 'en' => 'Istanbul, Turkey', 'ar' => 'إسطنبول، تركيا', 'de' => 'Istanbul, Türkei'],
            'cta_label' => ['tr' => 'HEMEN BAŞLAYIN', 'en' => 'GET STARTED', 'ar' => 'ابدأ الآن', 'de' => 'JETZT STARTEN'],
            'cta_title' => ['tr' => 'Eğitim yolculuğunuza bugün başlayın', 'en' => 'Start your learning journey today', 'ar' => 'ابدأ رحلتك التعليمية اليوم', 'de' => 'Starten Sie Ihre Lernreise heute'],
            'cta_description' => ['tr' => 'Uzman eğitmenlerimizle hedeflerinize ulaşın. Binlerce öğrenci kariyerini Parosis Akademi ile şekillendirdi.', 'en' => 'Reach your goals with our expert instructors. Thousands of students have shaped their careers with Parosis Academy.', 'ar' => 'حقق أهدافك مع مدربينا الخبراء.', 'de' => 'Erreichen Sie Ihre Ziele mit unseren Experten.'],
            'cta_button_text' => ['tr' => 'Hemen Kaydol', 'en' => 'Sign Up Now', 'ar' => 'سجل الآن', 'de' => 'Jetzt anmelden'],
            'cta_button_url' => '/kurslar',
        ]);
    }
}
