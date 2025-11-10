# Sistem Role - Aplikasi Posyandu

## Role yang Tersedia

Aplikasi ini memiliki **4 level role** dengan hak akses yang berbeda:

### 1. 👑 **ADMIN** (Administrator)
**Hak Akses:**
- ✅ Full access ke semua fitur
- ✅ Kelola data balita (CRUD)
- ✅ Kelola data ibu hamil (CRUD)
- ✅ Kelola jadwal kegiatan (CRUD)
- ✅ Lihat semua laporan
- ✅ Akses ke semua menu
- ✅ Kelola user dan role

**Kapan digunakan:**
- Untuk super admin sistem
- Memiliki kontrol penuh atas sistem

---

### 2. 👨‍💼 **KEPALAPOSYANDU** (Kepala Posyandu)
**Hak Akses:**
- ✅ Full access seperti admin
- ✅ Kelola data balita (CRUD)
- ✅ Kelola data ibu hamil (CRUD)
- ✅ Kelola jadwal kegiatan (CRUD)
- ✅ Lihat semua laporan
- ✅ Akses ke semua menu
- ✅ Approve dan review data

**Kapan digunakan:**
- Untuk kepala posyandu
- Supervisor yang mengawasi operasional posyandu

---

### 3. 👨‍⚕️ **PETUGAS** (Petugas Posyandu / Kader)
**Hak Akses:**
- ✅ Input data balita
- ✅ Input data ibu hamil
- ✅ Input jadwal kegiatan
- ✅ Lihat laporan
- ✅ Edit data yang sudah diinput
- ❌ Tidak bisa hapus data (opsional, bisa disesuaikan)

**Kapan digunakan:**
- Untuk kader posyandu yang bertugas input data
- Petugas lapangan yang mengisi data

---

### 4. 👤 **USER** (User Biasa)
**Hak Akses:**
- ✅ Lihat dashboard
- ✅ Lihat data balita (read only)
- ✅ Lihat data ibu hamil (read only)
- ✅ Lihat jadwal kegiatan
- ✅ Lihat laporan
- ❌ Tidak bisa input/edit/hapus data

**Kapan digunakan:**
- Untuk warga yang ingin melihat informasi posyandu
- Public access untuk informasi umum

---

## Default User untuk Testing

Setelah menjalankan seeder, tersedia 4 user default:

| Email | Password | Role | Badge Color |
|-------|----------|------|-------------|
| admin@posyandu.com | password | Admin | 🔴 Merah |
| kepala@posyandu.com | password | Kepala Posyandu | 🟣 Ungu |
| petugas@posyandu.com | password | Petugas | 🔵 Biru |
| user@posyandu.com | password | User | ⚪ Abu-abu |

## Cara Menjalankan Seeder

```bash
php artisan db:seed --class=UserSeeder
```

## Implementasi Role

### 1. Di Routes
```php
// Hanya admin yang bisa akses
Route::middleware(['auth', 'role:admin'])->group(function () {
    // routes here
});

// Admin dan Kepala Posyandu bisa akses
Route::middleware(['auth', 'role:admin,kepalaposyandu'])->group(function () {
    // routes here
});

// Admin, Kepala Posyandu, dan Petugas bisa akses
Route::middleware(['auth', 'role:admin,kepalaposyandu,petugas'])->group(function () {
    // routes here
});
```

### 2. Di Controller
```php
// Check role di controller
if (!auth()->user()->isAdmin()) {
    abort(403);
}

// Atau
if (auth()->user()->canAccessAdmin()) {
    // do something - untuk admin, kepala posyandu, dan petugas
}
```

### 3. Di Blade View
```blade
@if(auth()->user()->isAdmin())
    <!-- Tampilkan untuk admin -->
@endif

@if(auth()->user()->isKepalaPosyandu())
    <!-- Tampilkan untuk kepala posyandu -->
@endif

@if(auth()->user()->canAccessAdmin())
    <!-- Tampilkan untuk admin, kepala posyandu, dan petugas -->
@endif
```

## Middleware Role

Middleware `CheckRole` sudah tersedia untuk protect routes berdasarkan role:

```php
Route::middleware(['auth', 'role:admin'])->get('/admin-only', function() {
    return 'Only admin can see this';
});
```

## Helper Methods di Model User

```php
$user->isAdmin()              // true jika admin
$user->isKepalaPosyandu()     // true jika kepala posyandu
$user->isPetugas()            // true jika petugas
$user->isUser()               // true jika user
$user->canAccessAdmin()       // true jika admin, kepala posyandu, atau petugas
$user->getRole()              // dapatkan UserRole enum
$user->getRole()->label()    // dapatkan label role (string)
```

## Update Role User

Untuk mengubah role user, bisa melalui:
1. Database langsung
2. Tinker: `php artisan tinker`
   ```php
   $user = User::find(1);
   $user->role = \App\Enums\UserRole::KEPALAPOSYANDU;
   $user->save();
   ```

## Catatan Keamanan

- Default role untuk user baru yang register adalah **USER**
- Hanya admin yang seharusnya bisa mengubah role user lain
- Semua route sudah dilindungi dengan middleware `auth`
- Role-based access control (RBAC) sudah diimplementasikan
- Method `getRole()` digunakan untuk memastikan role selalu berupa enum, bukan string

## Perbaikan Error

Error "Call to a member function label() on string" sudah diperbaiki dengan:
- Menambahkan method `getRole()` yang memastikan return UserRole enum
- Menggunakan `getRole()->label()` di view instead of `role->label()`
- Casting role di model sudah benar
