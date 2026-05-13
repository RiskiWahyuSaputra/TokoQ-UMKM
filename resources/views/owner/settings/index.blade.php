<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Pengaturan - TokoQ</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="/template/tokoq_design_system/responsive.css" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: { extend: { "colors": { "inverse-primary": "#b8cf8c","tertiary-fixed": "#dae9ac","surface-bright": "#f8fbea","primary-fixed-dim": "#b8cf8c","primary-fixed": "#d3eba6","on-surface": "#191d13","inverse-on-surface": "#f0f2e2","surface-tint": "#51652e","outline": "#75786b","background": "#f8fbea","surface-variant": "#e1e4d4","on-secondary-container": "#596841","on-tertiary": "#ffffff","secondary-fixed-dim": "#bccd9e","on-error-container": "#93000a","inverse-surface": "#2e3227","secondary": "#55633d","surface-dim": "#d9dccb","secondary-fixed": "#d8e9b9","error-container": "#ffdad6","surface-container-highest": "#e1e4d4","on-tertiary-fixed": "#161f00","primary-container": "#576b33","surface-container-high": "#e7ead9","on-background": "#191d13","on-error": "#ffffff","surface-container-low": "#f2f5e4","tertiary": "#445122","secondary-container": "#d5e6b6","on-primary-container": "#d3eba5","tertiary-container": "#5c6938","on-secondary-fixed": "#131f02","outline-variant": "#c5c8b9","on-secondary": "#ffffff","on-primary-fixed": "#131f00","on-secondary-fixed-variant": "#3d4b28","surface": "#f8fbea","tertiary-fixed-dim": "#becd92","surface-container-lowest": "#ffffff","on-tertiary-container": "#d9e8aa","on-surface-variant": "#45483d","surface-container": "#edefdf","on-primary": "#ffffff","primary": "#40521d","on-primary-fixed-variant": "#3a4d18","error": "#ba1a1a","on-tertiary-fixed-variant": "#3f4b1d" }, "borderRadius": { "DEFAULT": "0.25rem","lg": "0.5rem","xl": "0.75rem","full": "9999px" }, "spacing": { "container-padding": "32px","section-margin": "48px","gutter": "24px","unit": "8px","card-gap": "24px" }, "fontSize": { "h2-mobile": ["24px", {"lineHeight": "1.3","fontWeight": "700"}],"h1-mobile": ["28px", {"lineHeight": "1.2","fontWeight": "700"}],"body-md": ["16px", {"lineHeight": "1.6","fontWeight": "400"}],"body-lg": ["18px", {"lineHeight": "1.6","fontWeight": "400"}],"body-sm": ["14px", {"lineHeight": "1.5","fontWeight": "400"}],"h1": ["40px", {"lineHeight": "1.2","letterSpacing": "-0.02em","fontWeight": "700"}],"h3": ["24px", {"lineHeight": "1.4","fontWeight": "600"}],"label-caps": ["12px", {"lineHeight": "1.2","letterSpacing": "0.05em","fontWeight": "700"}],"h2": ["32px", {"lineHeight": "1.3","letterSpacing": "-0.01em","fontWeight": "700"}] } } }
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="app-shell bg-background text-on-surface font-body-md">

@include('owner.layouts.sidebar', ['activeMenu' => 'settings'])

<main class="app-main ml-64 min-h-screen">
    <header class="app-header h-20 w-full sticky top-0 z-40 bg-surface border-b border-outline-variant flex justify-between items-center px-container-padding">
        <div class="flex items-center gap-4">
            <button class="mobile-nav-trigger lg:hidden" data-sidebar-toggle="" type="button"><span class="material-symbols-outlined">menu</span></button>
            <div>
                <h2 class="font-h3 text-h3 font-bold text-primary">Pengaturan Akun</h2>
                <p class="text-body-sm text-on-surface-variant">Perbarui data akun UMKM Anda</p>
            </div>
        </div>
        <span class="font-bold text-primary">{{ $user->name }}</span>
    </header>

    <section class="app-page p-container-padding">
        <div class="max-w-3xl bg-surface-container-lowest border border-outline-variant rounded-2xl p-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-primary/20 bg-primary/10 px-4 py-3 text-primary">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-error/20 bg-error-container px-4 py-3 text-on-error-container">
                    <p class="font-bold mb-2">Ada data yang perlu diperbaiki:</p>
                    <ul class="list-disc pl-5 text-body-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-2" for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary"/>
                </div>

                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-2" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary"/>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-body-sm font-bold text-on-surface mb-2" for="password">Password Baru</label>
                        <input id="password" name="password" type="password" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary"/>
                    </div>
                    <div>
                        <label class="block text-body-sm font-bold text-on-surface mb-2" for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary"/>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </section>
</main>

<script src="/template/tokoq_design_system/responsive.js"></script>
</body>
</html>
