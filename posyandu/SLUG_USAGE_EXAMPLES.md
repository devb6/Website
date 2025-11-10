# 📚 Contoh Penggunaan Slug untuk Permission

## 🎯 Ringkasan

Slug digunakan untuk **permission checking** - mengecek apakah user memiliki akses untuk melakukan sesuatu berdasarkan role access yang sudah dibuat di database.

## 🔧 Setup

### 1. Buat Role Access di Database

Pergi ke **Admin → Role Access** dan buat role access baru:

- **Nama**: "Kelola Balita"
- **Slug**: `kelola-balita` (atau biarkan auto-generate)
- **Role**: Pilih role yang boleh akses (contoh: admin, petugas)
- **Permission**: `all` (atau `create`, `read`, `update`, `delete`)
- **Status**: Aktif

### 2. Gunakan di Kode

## 📝 Contoh Implementasi

### Contoh 1: Di Controller (Simple)

```php
use Illuminate\Support\Facades\Auth;

public function index()
{
    // Cek apakah user punya permission dengan slug 'kelola-balita'
    if (!Auth::user()->hasPermission('kelola-balita')) {
        abort(403, 'Anda tidak memiliki akses.');
    }
    
    // Lanjutkan...
}
```

### Contoh 2: Di Controller (Dengan Permission Detail)

```php
public function create()
{
    // Cek apakah user bisa CREATE
    if (!Auth::user()->can('kelola-balita', 'create')) {
        abort(403, 'Anda tidak bisa menambah data.');
    }
    
    return view('balita.create');
}

public function destroy(Balita $balita)
{
    // Cek apakah user bisa DELETE
    if (!Auth::user()->can('kelola-balita', 'delete')) {
        abort(403, 'Anda tidak bisa menghapus data.');
    }
    
    $balita->delete();
    return redirect()->back();
}
```

### Contoh 3: Di Blade View

```blade
<!-- Tampilkan tombol hanya jika user punya permission -->
@if(auth()->user()->hasPermission('kelola-balita'))
    <a href="{{ route('balita.create') }}" class="btn">
        Tambah Data
    </a>
@endif

<!-- Atau dengan permission detail -->
@if(auth()->user()->can('kelola-balita', 'create'))
    <a href="{{ route('balita.create') }}" class="btn">
        Tambah Data
    </a>
@endif

@if(auth()->user()->can('kelola-balita', 'delete'))
    <form action="{{ route('balita.destroy', $balita) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@endif
```

## 🎯 Cara Kerja

1. **Buat Role Access** di halaman Admin → Role Access
   - Contoh: Slug = `kelola-balita`, Role = `petugas`, Permission = `all`

2. **User dengan role `petugas`** login

3. **Di controller**, cek permission:
   ```php
   if ($user->hasPermission('kelola-balita')) {
       // ✅ User bisa akses (karena ada di database)
   }
   ```

4. **Jika tidak ada di database** → User tidak bisa akses (403)

## 📋 Method yang Tersedia

### Di Model User:

```php
// Cek permission (simple)
$user->hasPermission('kelola-balita'); // true/false

// Cek permission dengan detail
$user->can('kelola-balita', 'create');  // true/false
$user->can('kelola-balita', 'update');  // true/false
$user->can('kelola-balita', 'delete');  // true/false
$user->can('kelola-balita', 'read');    // true/false
$user->can('kelola-balita', 'all');     // true/false
```

### Di Helper:

```php
use App\Helpers\PermissionHelper;

// Cek permission
PermissionHelper::can($user, 'kelola-balita');

// Cek dengan permission detail
PermissionHelper::canWithPermission($user, 'kelola-balita', 'create');

// Get semua permission user
$permissions = PermissionHelper::getUserPermissions($user);
// Returns: ['kelola-balita', 'kelola-ibu-hamil', ...]
```

## 🎨 Contoh Lengkap

### Scenario: User Petugas hanya bisa READ, Admin bisa ALL

1. **Buat 2 Role Access:**
   - Slug: `kelola-balita`, Role: `petugas`, Permission: `read`
   - Slug: `kelola-balita`, Role: `admin`, Permission: `all`

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
        abort(403, 'Anda hanya bisa melihat data, tidak bisa menambah.');
    }
    
    return view('balita.create');
}
```

3. **Di View:**

```blade
<!-- Semua yang punya permission bisa lihat -->
@if(auth()->user()->hasPermission('kelola-balita'))
    <h1>Data Balita</h1>
    
    <!-- Hanya yang bisa CREATE -->
    @if(auth()->user()->can('kelola-balita', 'create'))
        <a href="{{ route('balita.create') }}">Tambah</a>
    @endif
    
    <!-- Hanya yang bisa DELETE -->
    @if(auth()->user()->can('kelola-balita', 'delete'))
        <form action="{{ route('balita.destroy', $balita) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Hapus</button>
        </form>
    @endif
@endif
```

## ⚠️ Catatan Penting

1. **Admin selalu bisa akses semua** - tidak perlu cek di database
2. **Slug harus sama persis** dengan yang ada di database
3. **Permission detail** hanya bekerja jika di database permission-nya sesuai
4. **Jika permission = 'all'** → user bisa semua (create, read, update, delete)

## 🚀 Quick Start

1. Buat role access di **Admin → Role Access**
2. Gunakan `$user->hasPermission('slug')` di controller
3. Gunakan `@if(auth()->user()->hasPermission('slug'))` di view
4. Selesai! ✨

---

**Slug = Identifier untuk permission checking. Semakin banyak role access yang dibuat, semakin fleksibel kontrol aksesnya!** 🎯

