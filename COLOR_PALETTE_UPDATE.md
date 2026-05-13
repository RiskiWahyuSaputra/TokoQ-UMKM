# Update Color Palette TokoQ

## Warna Baru

### Primary (Emerald Green)
- **Hex**: `#10B981`
- **Fungsi**: Memberikan kesan pertumbuhan dan kesuksesan finansial
- **Penggunaan**: Button utama, highlight, navigasi aktif

### Secondary (Soft Mint)
- **Hex**: `#ECFDF5`
- **Fungsi**: Warna latar belakang yang menenangkan agar pengguna tidak merasa pusing melihat banyak data
- **Penggunaan**: Background utama, card background

### Action (Gold/Amber)
- **Hex**: `#F59E0B`
- **Fungsi**: Warna untuk call-to-action dan notifikasi penting
- **Penggunaan**: Button action, warning, highlight penting

### Text (Charcoal)
- **Hex**: `#374151`
- **Fungsi**: Warna teks utama yang mudah dibaca
- **Penggunaan**: Semua teks konten

## File yang Dibuat

1. **`/public/js/tailwind-config.js`**
   - Konfigurasi Tailwind CSS dengan color palette baru
   - Dapat di-include di semua halaman

2. **`/public/css/tokoq-colors.css`**
   - CSS custom dengan variabel warna
   - Utility classes untuk warna baru
   - Override untuk warna lama

3. **`/resources/views/layouts/app.blade.php`**
   - Layout component baru dengan konfigurasi warna
   - Dapat digunakan untuk halaman baru

## File yang Diupdate

1. `/resources/views/landing.blade.php`
2. `/resources/views/owner/dashboard.blade.php`
3. `/resources/views/owner/pos/index.blade.php`

## Cara Menggunakan

### Di File Blade Baru
```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/css/tokoq-colors.css" rel="stylesheet"/>
    <script src="/js/tailwind-config.js"></script>
</head>
<body class="bg-secondary text-text">
    <!-- Content -->
</body>
</html>
```

### Class Tailwind yang Tersedia
- `bg-primary` - Background emerald green
- `bg-secondary` - Background soft mint
- `bg-action` - Background gold/amber
- `text-primary` - Text emerald green
- `text-action` - Text gold/amber
- `text-text` - Text charcoal
- `border-primary` - Border emerald green

### CSS Variables
```css
var(--color-primary)      /* #10B981 */
var(--color-secondary)    /* #ECFDF5 */
var(--color-action)       /* #F59E0B */
var(--color-text)         /* #374151 */
```

## File yang Masih Perlu Diupdate

Untuk menyelesaikan update, file-file berikut masih perlu diupdate dengan konfigurasi warna baru:

- `/resources/views/owner/inventory/index.blade.php`
- `/resources/views/owner/inventory/create.blade.php`
- `/resources/views/owner/inventory/edit.blade.php`
- `/resources/views/owner/ai/index.blade.php`
- `/resources/views/owner/reports/index.blade.php`
- `/resources/views/owner/sales/index.blade.php`
- `/resources/views/owner/settings/index.blade.php`
- `/resources/views/auth/register.blade.php`
- `/resources/views/auth/login.blade.php`
- `/resources/views/admin/*.blade.php`

## Langkah Update Manual

Untuk setiap file di atas:

1. Ganti `<script id="tailwind-config">...</script>` dengan:
```html
<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>
```

2. Ganti class:
   - `bg-background` → `bg-secondary`
   - `text-on-background` → `text-text`
   - `text-on-surface` → `text-text`
   - `bg-surface-container-lowest` → `bg-surface`
   - `text-on-surface-variant` → `text-text-light`

3. Ganti hex color:
   - `#40521d`, `#576b33` → `#10B981`
   - `#f8fbea` → `#ECFDF5`
   - `#191d13` → `#374151`
