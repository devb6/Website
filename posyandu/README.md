# Sistem Informasi Posyandu

Sistem informasi manajemen Posyandu berbasis Laravel dengan template Tailwind CSS.

## Fitur

- ✅ Dashboard dengan statistik
- ✅ Manajemen Data Balita
- ✅ Manajemen Data Ibu Hamil
- ✅ Manajemen Jadwal Kegiatan
- ✅ Laporan Data
- ✅ UI Modern dengan Tailwind CSS

## Requirements

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- XAMPP (sudah termasuk Apache, MySQL, PHP)

## Instalasi

1. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Setup Environment**
   - Copy file `.env.example` menjadi `.env` (jika belum ada)
   - Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=posyandu
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Buat Database**
   - Buat database baru dengan nama `posyandu` di phpMyAdmin atau MySQL
   - Atau jalankan perintah MySQL:
   ```sql
   CREATE DATABASE posyandu;
   ```

5. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

6. **Setup Storage Link (Optional)**
   ```bash
   php artisan storage:link
   ```

## Menjalankan Aplikasi

### Menggunakan XAMPP

1. Pastikan XAMPP sudah berjalan (Apache dan MySQL)
2. Akses aplikasi melalui browser:
   ```
   http://localhost/posyandu/public
   ```

### Menggunakan PHP Built-in Server

```bash
php artisan serve
```

Kemudian akses di browser:
```
http://localhost:8000
```

## Struktur Project

```
posyandu/
├── app/
│   ├── Http/Controllers/    # Controller
│   └── Models/              # Model
├── database/
│   └── migrations/          # Database migration
├── public/
│   ├── images/              # Logo dan gambar
│   └── index.php            # Entry point
├── resources/
│   └── views/               # Blade templates
├── routes/
│   └── web.php              # Web routes
└── tailwind-admin-template-master/  # Template source
```

## Routes

- `/` - Dashboard
- `/dashboard` - Dashboard
- `/balita` - Data Balita (CRUD)
- `/ibu-hamil` - Data Ibu Hamil (CRUD)
- `/jadwal` - Jadwal Kegiatan (CRUD)
- `/laporan` - Laporan

## License

MIT License

## Author

Sistem Informasi Posyandu

