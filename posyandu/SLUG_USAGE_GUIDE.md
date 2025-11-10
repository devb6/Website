# 📖 Panduan Penggunaan Slug untuk Permission

## 🎯 Apa itu Slug?

Slug adalah **identifier unik** untuk role access yang digunakan untuk **permission checking** di kode program.

## 🔧 Cara Menggunakan Slug

### 1. Di Controller

```php
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Auth;

public function index()
{
    $user = Auth::user();
    
    // Cek permission dengan slug
    if (!$user->hasPermission('kelola-balita')) {
        abort(403, 'Anda tidak memiliki akses untuk halaman ini.');
    }
    
    // Atau menggunakan helper
    if (!PermissionHelper::can($user, 'kelola-balita')) {
        abort(403);
    }
    
    // Lanjutkan logic...
}
```

### 2. Di Middleware (Recommended)

Buat middleware baru untuk permission checking:

```php
// app/Http/Middleware/CheckPermission.php
public function handle($request, Closure $next, $slug)
{
    if (!Auth::user()->hasPermission($slug)) {
        abort(403, 'Unauthorized access.');
    }
    
    return $next($request);
}
```

Lalu di `routes/web.php`:

```php
Route::middleware(['auth', 'permission:kelola-balita'])->group(function () {
    Route::resource('balita', BalitaController::class);
});
```

### 3. Di Blade View

```blade
@if(auth()->user()->hasPermission('kelola-balita'))
    <a href="{{ route('balita.create') }}" class="btn">Tambah Data</a>
@endif

@if(auth()->user()->can('kelola-balita', 'create'))
    <!-- Hanya tampilkan jika user bisa create -->
@endif
```

### 4. Dengan Permission Detail

```php
// Cek permission spesifik
if ($user->can('kelola-balita', 'create')) {
    // User bisa create
}

if ($user->can('kelola-balita', 'update')) {
    // User bisa update
}

if ($user->can('kelola-balita', 'delete')) {
    // User bisa delete
}

if ($user->can('kelola-balita', 'all')) {
    // User bisa semua (create, read, update, delete)
}
```

## 📝 Contoh Praktis

### Contoh 1: Controller dengan Permission Check

```php
class BalitaController extends Controller
{
    public function create()
    {
        // Cek apakah user bisa create
        if (!auth()->user()->can('kelola-balita', 'create')) {
            abort(403, 'Anda tidak memiliki izin untuk menambah data.');
        }
        
        return view('balita.create');
    }
    
    public function store(Request $request)
    {
        // Cek permission
        if (!auth()->user()->can('kelola-balita', 'create')) {
            abort(403);
        }
        
        // Lanjutkan logic...
    }
    
    public function destroy(Balita $balita)
    {
        // Cek permission delete
        if (!auth()->user()->can('kelola-balita', 'delete')) {
            abort(403);
        }
        
        $balita->delete();
        return redirect()->route('balita.index');
    }
}
```

### Contoh 2: Di Blade View

```blade
<!-- Tampilkan tombol hanya jika user punya permission -->
@if(auth()->user()->hasPermission('kelola-balita'))
    <div class="mb-4">
        @if(auth()->user()->can('kelola-balita', 'create'))
            <a href="{{ route('balita.create') }}" class="btn btn-primary">
                Tambah Data
            </a>
        @endif
        
        @if(auth()->user()->can('kelola-balita', 'update'))
            <a href="{{ route('balita.edit', $balita) }}" class="btn btn-warning">
                Edit
            </a>
        @endif
        
        @if(auth()->user()->can('kelola-balita', 'delete'))
            <form action="{{ route('balita.destroy', $balita) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        @endif
    </div>
@endif
```

## 🗂️ Struktur Database

Tabel `role_access` menyimpan:
- `slug`: Identifier untuk permission (contoh: `kelola-balita`)
- `role`: Role yang memiliki akses ini (admin, petugas, user, kepalaposyandu)
- `permission`: Detail permission (create, read, update, delete, all)
- `is_active`: Status aktif/tidak aktif

## 🔐 Flow Permission Check

1. User login → dapat role (admin, petugas, user, kepalaposyandu)
2. User akses halaman → cek permission dengan slug
3. Sistem cek di database `role_access`:
   - Apakah ada record dengan slug tersebut?
   - Apakah role user sesuai?
   - Apakah is_active = true?
4. Jika semua cocok → user bisa akses
5. Jika tidak → return 403 (Forbidden)

## 💡 Tips

1. **Gunakan slug yang konsisten** - contoh: `kelola-balita`, `kelola-ibu-hamil`
2. **Admin selalu bisa akses** - tidak perlu cek di database
3. **Gunakan permission detail** - untuk kontrol lebih granular (create, update, delete)
4. **Cache permission** - jika perlu performa lebih baik (optional)

## 📍 File Helper

Helper class ada di: `app/Helpers/PermissionHelper.php`

## 🎯 Quick Reference

```php
// Simple check
$user->hasPermission('kelola-balita');

// With permission detail
$user->can('kelola-balita', 'create');
$user->can('kelola-balita', 'update');
$user->can('kelola-balita', 'delete');

// Get all permissions user
PermissionHelper::getUserPermissions($user);
```

---

**Dengan slug, Anda bisa mengontrol akses user dengan fleksibel dan mudah!** ✨

