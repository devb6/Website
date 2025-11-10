# Komponen Reusable

## Empty State Component

Komponen untuk menampilkan empty state yang konsisten di semua halaman.

### Penggunaan:

```blade
<!-- Di dalam tabel, untuk empty state -->
@empty
<tr>
    <td colspan="6" class="text-center">
        <x-empty-state 
            message="Tidak ada data balita"
            actionText="Tambah data balita pertama"
            actionUrl="{{ route('balita.create') }}"
        />
    </td>
</tr>
@endforelse
```

### Parameter:

- `message` (required): Pesan yang ditampilkan
- `actionText` (optional): Teks untuk link action
- `actionUrl` (optional): URL untuk link action
- `icon` (optional): Nama icon Font Awesome (default: 'inbox')

### Contoh:

```blade
<!-- Simple empty state -->
<x-empty-state message="Tidak ada data" />

<!-- Dengan action link -->
<x-empty-state 
    message="Tidak ada data balita"
    actionText="Tambah data pertama"
    actionUrl="{{ route('balita.create') }}"
/>

<!-- Dengan icon berbeda -->
<x-empty-state 
    message="Tidak ada jadwal"
    icon="calendar"
    actionText="Buat jadwal baru"
    actionUrl="{{ route('jadwal.create') }}"
/>
```

