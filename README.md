# 🛒 PikselPazar

PikselPazar, **Laravel 12** ve **PHP 8.2** ile geliştirilmiş çok kategorili bir e-ticaret web uygulamasıdır. Ziyaretçiler ürünleri kategorilere göre inceleyebilir, arayabilir, sepete ekleyip sipariş verebilir ve yorum yapabilir. Yönetici paneli üzerinden ürün, kategori, sipariş, kullanıcı, yorum ve site ayarları yönetilir.

---

## 👩‍💻 Proje Bilgileri

| | |
|---|---|
| **Geliştiren** | Şilan Aybek |
| **Öğrenci No** | 20222022413 |
| **Üniversite** | İstanbul Nişantaşı Üniversitesi |
| **Bölüm** | Yazılım Mühendisliği |


---

## ✨ Özellikler

### Müşteri (Frontend)
- Kullanıcı kayıt, giriş ve çıkış işlemleri
- Kategoriye göre ürün listeleme ve anahtar kelimeyle arama
- Fiyata göre sıralama (artan / azalan)
- Ürün detay sayfası ve benzer ürün önerileri
- Beden seçimi ve indirimli fiyat desteği
- Oturum tabanlı alışveriş sepeti (ekle / güncelle / çıkar / temizle)
- Sipariş oluşturma ve **ödeme yöntemi seçimi** (Kapıda Ödeme, Banka Havalesi / EFT, Kredi Kartı)
- **Siparişlerim** sayfası ile geçmiş siparişleri ve durumlarını takip etme
- Ürünlere yorum ve puan verme
- İletişim formu

### Yönetici (Admin Panel)
- İstatistikli kontrol paneli (toplam sipariş, gelir, ürün, kullanıcı sayıları)
- Ürün yönetimi (CRUD)
- Kategori yönetimi (CRUD)
- Sipariş yönetimi: listeleme, durum filtreleme, durum güncelleme ve detay görüntüleme
- Kullanıcı yönetimi
- Yorum yönetimi
- İletişim mesajları
- SSS (Sık Sorulan Sorular) ve site ayarları yönetimi
- Rol tabanlı erişim (`user` / `admin`)

---

## 🧰 Kullanılan Teknolojiler

| Katman | Teknoloji |
|--------|-----------|
| Backend | Laravel 12, PHP 8.2 |
| Veritabanı | MySQL |
| Frontend | Blade, Bootstrap 5 |
| Admin Panel | AdminLTE 3 |
| İkonlar | Font Awesome 6 |
| Derleme | Vite |

---

## ⚙️ Kurulum

Projeyi yerel ortamda çalıştırmak için aşağıdaki adımları izleyin:

```bash
# 1. Projeyi klonla
git clone https://github.com/silanaybek/PikselPazar-laravel-.git
cd PikselPazar-laravel-

# 2. PHP bağımlılıklarını yükle
composer install

# 3. Arayüz bağımlılıklarını yükle
npm install

# 4. Ortam dosyasını oluştur
cp .env.example .env
php artisan key:generate
```

`.env` dosyasındaki veritabanı bilgilerini kendi ortamına göre düzenle:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pikselpazar
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 5. Tabloları oluştur ve örnek verileri ekle
php artisan migrate --seed

# 6. Yüklenen görseller için depolama bağlantısını oluştur
php artisan storage:link

# 7. Arayüzü derle ve uygulamayı başlat
npm run dev
php artisan serve
```

Uygulama varsayılan olarak `http://127.0.0.1:8000` adresinde çalışır.

---

## 👤 Örnek Hesaplar

`php artisan migrate --seed` komutu aşağıdaki örnek hesapları oluşturur:

| Rol | E-posta | Şifre |
|-----|---------|-------|
| Yönetici | admin@pikselpazar.com | (seeder içinde belirlenir) |
| Kullanıcı | user@pikselpazar.com | (seeder içinde belirlenir) |

> ⚠️ **Güvenlik notu:** Gerçek bir ortama yüklemeden önce `database/seeders/DatabaseSeeder.php` içindeki örnek e-posta ve şifreleri mutlaka değiştir. Şifreleri herkese açık bir depoya gerçek haliyle yazma.

---

## 📂 Proje Yapısı (özet)

```
app/Http/Controllers      # Frontend ve Admin controller'ları
app/Models                # Eloquent modelleri (Product, Order, CartItem, ...)
database/migrations       # Veritabanı tablo tanımları
database/seeders          # Örnek veri üreticileri
resources/views/frontend  # Müşteri arayüzü
resources/views/admin     # Yönetici paneli
routes/web.php            # Uygulama rotaları
```

---

## 📝 Lisans

Bu proje eğitim amaçlı geliştirilmiştir.
