#!/bin/bash

# Root yetkisi kontrolü
if [[ $EUID -ne 0 ]]; then
   echo "Bu script root olarak çalıştırılmalı." 
   exit 1
fi

# Site adı sor
read -p "Site adı (örnek: proje1): " sitename

# Apache config dosya yolu
conf_path="/etc/apache2/sites-available/site.conf"

# Config dosyasını oluştur
cat <<EOF > $conf_path
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/${sitename}/public

    <Directory /var/www/${sitename}/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/${sitename}_error.log
    CustomLog \${APACHE_LOG_DIR}/${sitename}_access.log combined
</VirtualHost>
EOF

echo "Apache config dosyası oluşturuldu: $conf_path"

# site'ı etkinleştir
a2ensite site.conf

# default site'i devre dışı bırak
a2dissite 000-default.conf

# Apache yeniden yükle
service apache2 reload

# Laravel klasör izinleri
chown -R www-data:www-data /var/www/${sitename}/storage /var/www/${sitename}/bootstrap/cache
chmod -R 775 /var/www/${sitename}/storage /var/www/${sitename}/bootstrap/cache

# Laravel kurulum işlemleri
cd /var/www/${sitename}

echo "Composer install çalıştırılıyor..."
composer install 

echo "NPM install çalıştırılıyor..."
npm install

echo "NPM build çalıştırılıyor..."
npm run build

echo "✅ Site ${sitename} başarıyla kuruldu, Apache yeniden yüklendi ve Laravel hazır hale getirildi!"
