# PikselPazar

Laravel 12 ile geliştirdiğim e-ticaret web sitesi. Kullanıcılar ürünlere bakabilir, sepete ekleyip sipariş verebilir ve yorum yapabilir. Admin panelinden ürünler, kategoriler, siparişler ve kullanıcılar yönetiliyor.

Geliştiren: Şilan Aybek, Nişantaşı Üniversitesi- Yazılım Mühendisliği

## Özellikler

- Üye olma, giriş yapma
- Kategoriye göre ürün listeleme ve arama
- Giyim ürünlerinde beden seçimi (S M L../ 36 37 38..)
- Sepet ve sipariş oluşturma (ödeme yöntemi seçimi var)
- Siparişlerim sayfası
- Ürünlere yorum ve puan verme
- Admin paneli: ürün, kategori, sipariş, kullanıcı ve yorum yönetimi

## Proje Hakkında

Yapı frontend ve backend olarak iki kısımdan oluşuyor. Frontend tarafında müşterinin gördüğü sayfalar Blade ve Bootstrap ile hazırlandı; admin paneli için AdminLTE kullanıldı. Backend tarafında Laravel controller'ları tüm işlemleri (ürün listeleme, sepet, sipariş vb.) yönetiyor, veriler MySQL veritabanında tutuluyor. Veritabanı tabloları Laravel migration'larıyla oluşturuluyor ve seeder ile örnek veriler ekleniyor.

## Kullandığım Teknolojiler

Laravel 12, PHP 8.2, MySQL, Blade, Bootstrap 5, AdminLTE 3

## Kurulum

```bash
git clone https://github.com/silanaybek/LaravelProject.git
cd LaravelProject

composer install
npm install

cp .env.example .env
php artisan key:generate
```

.env dosyasında veritabanı adını `pikselpazar` yapın, sonra:

```bash
php artisan migrate --seed
php artisan storage:link
npm run dev
php artisan serve
```

Site http://127.0.0.1:8000 adresinde açılır.

## Test Hesapları

Seed komutu admin@pikselpazar.com ve user@pikselpazar.com hesaplarını oluşturur. Şifreler DatabaseSeeder.php dosyasında.

Bu hesaplar test amaçlı eklendi.
