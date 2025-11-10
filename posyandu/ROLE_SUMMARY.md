# 📋 Ringkasan Sistem Role

## 🎭 Role yang Tersedia

Aplikasi Posyandu memiliki **4 level role**:

### 1. 👑 **ADMIN** (Administrator)
- **Label**: Administrator
- **Warna Badge**: Merah 🔴
- **Hak Akses**: Full access ke semua fitur
- **Bisa**: Semua (CRUD semua data, akses semua menu, kelola user)

### 2. 👨‍💼 **KEPALAPOSYANDU** (Kepala Posyandu)
- **Label**: Kepala Posyandu
- **Warna Badge**: Ungu 🟣
- **Hak Akses**: Full access seperti admin
- **Bisa**: Semua (CRUD semua data, approve data, review laporan)

### 3. 👨‍⚕️ **PETUGAS** (Petugas Posyandu)
- **Label**: Petugas Posyandu  
- **Warna Badge**: Biru 🔵
- **Hak Akses**: Input dan kelola data
- **Bisa**: Input data, edit data, lihat laporan

### 4. 👤 **USER** (User Biasa)
- **Label**: User
- **Warna Badge**: Abu-abu ⚪
- **Hak Akses**: Read only
- **Bisa**: Lihat data dan laporan saja

---

## 🔐 User Default untuk Testing

| Email | Password | Role | Badge Color |
|-------|----------|------|-------------|
| admin@posyandu.com | password | Admin | 🔴 Merah |
| kepala@posyandu.com | password | Kepala Posyandu | 🟣 Ungu |
| petugas@posyandu.com | password | Petugas | 🔵 Biru |
| user@posyandu.com | password | User | ⚪ Abu-abu |

---

## 📝 Cara Menggunakan

### Login dengan Role Berbeda
1. Buka `/login`
2. Gunakan salah satu email di atas
3. Password: `password`
4. Setelah login, badge role akan muncul di header

### Register User Baru
- User yang register otomatis mendapat role **USER**
- Untuk mengubah role, harus dilakukan oleh admin melalui database

---

## 🛠️ Helper Methods di Model User

```php
$user->isAdmin()              // true jika admin
$user->isKepalaPosyandu()     // true jika kepala posyandu
$user->isPetugas()            // true jika petugas
$user->isUser()               // true jika user
$user->canAccessAdmin()       // true jika admin, kepala posyandu, atau petugas
$user->getRole()              // dapatkan UserRole enum
$user->getRole()->label()    // dapatkan label role (string)
```

---

## 🔒 Middleware Role

Gunakan middleware `role` untuk protect routes:

```php
// Hanya admin
Route::middleware(['auth', 'role:admin'])->group(...);

// Admin dan Kepala Posyandu
Route::middleware(['auth', 'role:admin,kepalaposyandu'])->group(...);

// Admin, Kepala Posyandu, dan Petugas
Route::middleware(['auth', 'role:admin,kepalaposyandu,petugas'])->group(...);
```

---

## 📍 Tampilan Role

- Role ditampilkan sebagai **badge** di header (desktop & mobile)
- Warna badge berbeda untuk setiap role:
  - Admin: Merah
  - Kepala Posyandu: Ungu
  - Petugas: Biru
  - User: Abu-abu
- Nama role ditampilkan dalam bahasa Indonesia

---

## ✅ Perbaikan Error

Error **"Call to a member function label() on string"** sudah diperbaiki dengan:
- ✅ Menambahkan method `getRole()` yang memastikan return UserRole enum
- ✅ Menggunakan `getRole()->label()` di view instead of `role->label()`
- ✅ Casting role di model sudah benar

---

**Sistem role sudah aktif dengan 4 role dan siap digunakan!** ✅
