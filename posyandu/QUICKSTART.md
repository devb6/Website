# Quick Start Guide - Sistem Posyandu

## Instalasi Cepat (5 Menit)

### 1. Install Composer Dependencies
```bash
composer install
```

### 2. Setup Environment
Buat file `.env` dari `.env.example` atau copy isi berikut:
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

### 3. Generate Key
```bash
php artisan key:generate
```

### 4. Buat Database
Buka phpMyAdmin dan buat database `posyandu`, atau:
```sql
CREATE DATABASE posyandu;
```

### 5. Run Migration
```bash
php artisan migrate
```

### 6. Akses Aplikasi
```
http://localhost/posyandu/public
```

## Fitur yang Tersedia

✅ **Dashboard** - Statistik dan overview
✅ **Data Balita** - CRUD lengkap data balita
✅ **Data Ibu Hamil** - CRUD lengkap data ibu hamil  
✅ **Jadwal Kegiatan** - Manajemen jadwal posyandu
✅ **Laporan** - Cetak laporan data

## Struktur Menu

- **Dashboard** - Halaman utama dengan statistik
- **Data Balita** - Kelola data balita (tambah, edit, hapus, lihat)
- **Data Ibu Hamil** - Kelola data ibu hamil
- **Jadwal Kegiatan** - Kelola jadwal kegiatan posyandu
- **Laporan** - Lihat dan cetak laporan

## Catatan Penting

- Logo sudah terintegrasi di `public/images/logo.png`
- Template menggunakan Tailwind CSS via CDN (tidak perlu build)
- Semua fitur CRUD sudah lengkap dan siap digunakan
- Database migration sudah tersedia

## Troubleshooting

**Error Database?** 
- Pastikan MySQL sudah running di XAMPP
- Pastikan database `posyandu` sudah dibuat

**Halaman Blank?**
- Check `.env` file sudah benar
- Jalankan: `php artisan config:clear`

**Logo tidak muncul?**
- Pastikan file `public/images/logo.png` ada
- Check permission folder `public/images`

## Support

Untuk bantuan lebih lanjut, lihat file `INSTALL.md` atau `README.md`

