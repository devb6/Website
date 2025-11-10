# 📦 Panduan Komponen Reusable

## 🎯 Empty State Component

Komponen untuk menampilkan empty state yang konsisten di semua halaman.

### 📝 Cara Menggunakan

#### 1. Di dalam tabel (paling umum)

```blade
@forelse($items as $item)
    <tr>
        <!-- konten tabel -->
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">
            <x-empty-state 
                message="Tidak ada data"
                actionText="Tambah data pertama"
                actionUrl="{{ route('items.create') }}"
            />
        </td>
    </tr>
@endforelse
```

#### 2. Di luar tabel

```blade
@if($items->isEmpty())
    <x-empty-state 
        message="Tidak ada data"
        actionText="Tambah data pertama"
        actionUrl="{{ route('items.create') }}"
    />
@endif
```

### 🔧 Parameter

| Parameter | Tipe | Required | Default | Deskripsi |
|-----------|------|----------|---------|-----------|
| `message` | string | ✅ Yes | - | Pesan yang ditampilkan |
| `actionText` | string | ❌ No | null | Teks untuk link action |
| `actionUrl` | string | ❌ No | null | URL untuk link action |
| `icon` | string | ❌ No | 'inbox' | Nama icon Font Awesome |

### 📚 Contoh Penggunaan

#### Contoh 1: Simple (tanpa action)

```blade
<x-empty-state message="Tidak ada data" />
```

#### Contoh 2: Dengan action link

```blade
<x-empty-state 
    message="Tidak ada data balita"
    actionText="Tambah data balita pertama"
    actionUrl="{{ route('balita.create') }}"
/>
```

#### Contoh 3: Dengan icon custom

```blade
<x-empty-state 
    message="Tidak ada jadwal"
    icon="calendar"
    actionText="Buat jadwal baru"
    actionUrl="{{ route('jadwal.create') }}"
/>
```

#### Contoh 4: Di halaman laporan (tanpa action)

```blade
<x-empty-state message="Tidak ada data untuk ditampilkan" />
```

### 🎨 Icon yang Tersedia

Gunakan nama icon Font Awesome tanpa prefix `fa-`:

- `inbox` (default) - untuk data umum
- `calendar` - untuk jadwal
- `shield-alt` - untuk role/permission
- `user` - untuk user
- `file-alt` - untuk laporan
- `baby` - untuk balita
- `user-injured` - untuk ibu hamil

### 💡 Tips

1. **Selalu gunakan komponen ini** untuk empty state agar konsisten
2. **Sertakan action link** jika user bisa menambah data
3. **Pilih icon yang relevan** dengan konteks halaman
4. **Pesan harus jelas** dan informatif

### 📍 Lokasi File

Komponen berada di: `resources/views/components/empty-state.blade.php`

### 🔄 Update Komponen

Jika perlu mengubah styling empty state, edit file komponen tersebut dan semua halaman akan otomatis ter-update!

---

**Dibuat untuk memudahkan development halaman baru dengan empty state yang konsisten!** ✨

