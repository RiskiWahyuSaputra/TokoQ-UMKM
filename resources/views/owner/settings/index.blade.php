@extends('owner.layouts.app')

@section('title', 'Pengaturan - TokoQ')

@section('content')
@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
@endphp

<section class="app-page p-4 lg:p-8">
    <div class="max-w-3xl bg-white border border-outline-variant rounded-2xl p-8">
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

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="flex flex-col md:flex-row md:items-center gap-5">
                @if ($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-2 border-primary-fixed">
                @else
                    <div class="w-24 h-24 rounded-full bg-primary text-on-primary flex items-center justify-center text-2xl font-bold">
                        {{ $initials }}
                    </div>
                @endif
                <div class="flex-1">
                    <label class="block text-body-sm font-bold text-on-surface mb-2" for="profile_photo">Foto Profil</label>
                    <input id="profile_photo" name="profile_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-outline-variant bg-surface px-4 py-3 focus:border-primary focus:ring-primary"/>
                    <p class="mt-2 text-body-sm text-on-surface-variant">Opsional. Format `jpg`, `jpeg`, `png`, atau `webp` dengan ukuran maksimal 2MB.</p>
                </div>
            </div>

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
@endsection
