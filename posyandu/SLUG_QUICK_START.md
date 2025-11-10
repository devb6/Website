# 🚀 Quick Start: Cara Menggunakan Slug

## 📝 Penjelasan Singkat

**Slug** adalah identifier unik yang digunakan untuk **permission checking** - mengecek apakah user memiliki akses untuk melakukan sesuatu.

## 🎯 Langkah-langkah

### 1. Buat Role Access di Database

1. Login sebagai **Admin**
2. Pergi ke **Admin → Role Access**
3. Klik **"Tambah Role Access"**
4. Isi form:
   - **Nama**: "Kelola Balita"
   - **Slug**: `kelola-balita` (atau biarkan auto-generate)
   - **Role**: Pilih role yang boleh akses (contoh: `petugas`)
   - **Permission**: `all` (atau `create`, `read`, `update`, `delete`)
   - **Status**: Aktif
5. Klik **Simpan**

### 2. Gunakan di Kode

#### Di Controller:

```php
public function index()
{
    // Cek apakah user punya permission dengan slug 'kelola-balita'
    if (!auth()->user()->hasPermission('kelola-balita')) {
        abort(403, 'Anda tidak memiliki akses.');
    }
    
    // Lanjutkan logic...
}
```

#### Di Blade View:

```blade
@if(auth()->user()->hasPermission('kelola-balita'))
    <a href="{{ route('balita.create') }}">Tambah Data</a>
@endif
```

## 💡 Contoh Praktis

### Scenario: Petugas hanya bisa READ, Admin bisa ALL

1. **Buat Role Access:**
   - Slug: `kelola-balita`
   - Role: `petugas`
   - Permission: `read`

2. **Di Controller:**

```php
public function index()
{
    // Semua yang punya permission bisa lihat
    if (!auth()->user()->hasPermission('kelola-balita')) {
        abort(403);
    }
    
    $balita = Balita::all();
    return view('balita.index', compact('balita'));
}

public function create()
{
    // Hanya yang bisa CREATE
    if (!auth()->user()->can('kelola-balita', 'create')) {
        abort(403, 'Anda hanya bisa melihat, tidak bisa menambah.');
    }
    
    return view('balita.create');
}
```

3. **Hasil:**
   - ✅ Petugas bisa lihat data (karena punya permission `read`)
   - ❌ Petugas tidak bisa tambah data (karena tidak punya permission `create`)
   - ✅ Admin bisa semua (karena admin selalu bisa akses semua)

## 🔧 Method yang Tersedia

```php
// Cek permission (simple)
$user->hasPermission('kelola-balita'); // true/false

// Cek dengan permission detail
$user->can('kelola-balita', 'create');  // true/false
$user->can('kelola-balita', 'update');  // true/false
$user->can('kelola-balita', 'delete');  // true/false
$user->can('kelola-balita', 'read');    // true/false
$user->can('kelola-balita', 'all');     // true/false
```

## ⚠️ Catatan Penting

1. **Admin selalu bisa akses semua** - tidak perlu cek di database
2. **Slug harus sama persis** dengan yang ada di database
3. **Permission detail** hanya bekerja jika di database permission-nya sesuai
4. **Jika permission = 'all'** → user bisa semua (create, read, update, delete)

## 📚 Dokumentasi Lengkap

Lihat file:
- `SLUG_USAGE_GUIDE.md` - Panduan lengkap
- `SLUG_USAGE_EXAMPLES.md` - Contoh-contoh implementasi

---

**Slug = Identifier untuk permission checking. Buat role access di database, lalu gunakan di kode!** ✨

