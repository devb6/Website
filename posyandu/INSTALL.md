# Panduan Instalasi Sistem Posyandu

## Langkah-langkah Instalasi

### 1. Persiapan
Pastikan sudah terinstall:
- XAMPP (Apache, MySQL, PHP)
- Composer
- Node.js dan NPM (opsional, untuk asset compilation)

### 2. Install Dependencies

Buka terminal/command prompt di folder project dan jalankan:

```bash
composer install
```

### 3. Setup Environment

Copy file `.env.example` menjadi `.env` (jika belum ada), atau buat file `.env` baru dengan isi:

```env
APP_NAME="Sistem Posyandu"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=posyandu
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buka phpMyAdmin (http://localhost/phpmyadmin) dan buat database baru dengan nama `posyandu`, atau jalankan perintah SQL:

```sql
CREATE DATABASE posyandu;
```

### 6. Jalankan Migration

```bash
php artisan migrate
```

Ini akan membuat tabel-tabel yang diperlukan:
- balita
- ibu_hamil
- jadwal

### 7. Akses Aplikasi

Jika menggunakan XAMPP, akses melalui:
```
http://localhost/posyandu/public
```

Atau jika menggunakan PHP built-in server:
```bash
php artisan serve
```
Kemudian akses: `http://localhost:8000`

## Troubleshooting

### Error: Class 'Illuminate\Support\Facades\Route' not found
Jalankan: `composer install`

### Error: SQLSTATE[HY000] [1049] Unknown database 'posyandu'
Pastikan database sudah dibuat di MySQL/phpMyAdmin

### Error: No application encryption key has been specified
Jalankan: `php artisan key:generate`

### Halaman kosong atau error 500
- Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write
- Check file `.env` sudah benar
- Jalankan: `php artisan config:clear`

## Struktur URL

- Dashboard: `/dashboard`
- Data Balita: `/balita`
- Data Ibu Hamil: `/ibu-hamil`
- Jadwal: `/jadwal`
- Laporan: `/laporan`

## Catatan

- Logo sudah tersedia di `public/images/logo.png`
- Template menggunakan Tailwind CSS via CDN
- Tidak perlu menjalankan `npm install` atau `npm run dev` karena menggunakan CDN

