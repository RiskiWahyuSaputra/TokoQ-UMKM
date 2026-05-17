@extends('owner.layouts.app')

@section('title', 'Prediksi AI - TokoQ')

@section('styles')
<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes barGrow {
    from { height: 0; }
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
. { animation: fadeInUp 0.5s ease-out forwards; }
. { animation: fadeInUp 0.5s ease-out 0.1s forwards; opacity: 0; }
. { animation: fadeInUp 0.5s ease-out 0.2s forwards; opacity: 0; }
. { animation: fadeInUp 0.5s ease-out 0.3s forwards; opacity: 0; }
.animate-bar-grow { animation: barGrow 0.8s ease-out forwards; }
.animate-float { animation: float 3s ease-in-out infinite; }

.gradient-purple { background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%); }
.gradient-danger { background: linear-gradient(135deg, #EF4444 0%, #F87171 100%); }
.gradient-success { background: linear-gradient(135deg, #10B981 0%, #34D399 100%); }
.gradient-info { background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%); }

.card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.card-hover:hover { transform: translateY(-3px); box-shadow: 0 15px 30px -8px rgba(139, 92, 246, 0.12); }

.bar-item { transition: all 0.3s ease; }
.bar-item:hover { transform: scaleY(1.05); transform-origin: bottom; }
.chart-tooltip { opacity: 0; transition: opacity 0.2s; pointer-events: none; }
.bar-item:hover .chart-tooltip { opacity: 1; }

.scrollbar-thin::-webkit-scrollbar { width: 4px; }
.scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
.scrollbar-thin::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }
</style>
@endsection

@section('content')
@php
    $maxTotal = max($recentDays->max('total') ?? 0, 1);
@endphp

<div class="p-4 lg:p-6 space-y-5">

    <!-- Hero: Prediksi Omzet & Laba -->
    <div class="bg-gradient-to-br from-purple-500 via-indigo-500 to-blue-600 rounded-3xl p-6 lg:p-8 text-white relative overflow-hidden ">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
        <div class="absolute top-6 right-6 animate-float">
            <span class="material-symbols-outlined text-5xl text-white/20">psychology</span>
        </div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-[18px]">auto_awesome</span>
                </div>
                <span class="text-white/80 text-sm font-medium">Prediksi AI</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Omzet Forecast -->
                <div>
                    <p class="text-white/70 text-sm mb-1">Estimasi Omzet Besok</p>
                    <h1 class="text-3xl lg:text-4xl font-extrabold mb-2">Rp {{ number_format($forecast, 0, ',', '.') }}</h1>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $trendPercent >= 0 ? 'bg-emerald-400/20 text-emerald-200' : 'bg-red-400/20 text-red-200' }}">
                        <span class="material-symbols-outlined text-[14px]">{{ $trendPercent >= 0 ? 'trending_up' : 'trending_down' }}</span>
                        {{ $trendPercent >= 0 ? '+' : '' }}{{ $trendPercent }}% vs minggu lalu
                    </span>
                </div>

                <!-- Profit Forecast -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-emerald-300 text-[18px]">savings</span>
                        <p class="text-white/70 text-sm">Estimasi Laba Bersih Besok</p>
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-extrabold mb-2 {{ $profitForecast > 0 ? 'text-emerald-300' : '' }}">Rp {{ number_format($profitForecast, 0, ',', '.') }}</h2>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $profitTrendPercent >= 0 ? 'bg-emerald-400/20 text-emerald-200' : 'bg-red-400/20 text-red-200' }}">
                        <span class="material-symbols-outlined text-[14px]">{{ $profitTrendPercent >= 0 ? 'trending_up' : 'trending_down' }}</span>
                        {{ $profitTrendPercent >= 0 ? '+' : '' }}{{ $profitTrendPercent }}% vs minggu lalu
                    </span>
                    @if($forecast > 0 && $profitForecast > 0)
                    <p class="text-white/50 text-xs mt-2">Margin: {{ round(($profitForecast / $forecast) * 100, 1) }}%</p>
                    @endif
                </div>
            </div>

            <p class="text-white/50 text-xs mt-4">Berdasarkan pola penjualan & harga pokok 7 hari terakhir</p>
        </div>
    </div>

    <!-- Explainability & Confidence -->
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600 text-[20px]">info</span>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">Tentang Prediksi Ini</h3>
                <p class="text-xs text-gray-500">Bagaimana AI TokoQ menghasilkan prediksi</p>
            </div>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="p-4 bg-blue-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-blue-500 text-[18px]">dataset</span>
                    <span class="font-bold text-blue-800 text-sm">Data Dasar</span>
                </div>
                <p class="text-xs text-blue-700">Berdasarkan polak penjualan & harga pokok <strong>7 hari terakhir</strong>.</p>
            </div>
            <div class="p-4 bg-purple-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-purple-500 text-[18px]">speed</span>
                    <span class="font-bold text-purple-800 text-sm">Confidence</span>
                </div>
                @php
                    $dataPoints = $recentDays->count();
                    $confidence = $dataPoints >= 7 ? 'Tinggi' : ($dataPoints >= 3 ? 'Sedang' : 'Rendah');
                    $confColor = $dataPoints >= 7 ? 'text-emerald-600' : ($dataPoints >= 3 ? 'text-amber-600' : 'text-red-600');
                @endphp>
                <p class="text-xs text-purple-700">Akurasi: <strong class="{{ $confColor }}">{{ $confidence }}</strong> ({{ $dataPoints }} hari data)</p>
            </div>
            <div class="p-4 bg-emerald-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-emerald-500 text-[18px]">lightbulb</span>
                    <span class="font-bold text-emerald-800 text-sm">Catatan</span>
                </div>
                <p class="text-xs text-emerald-700">Prediksi akan semakin akurat seiring bertambahnya data transaksi.</p>
            </div>
        </div>
    </div>

    <!-- Chart & Risk Products -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Chart -->
        <div class="col-span-12 lg:col-span-7">
            <div class="bg-white rounded-2xl border border-outline-variant p-6 h-full card-hover ">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-on-surface">Tren Penjualan</h3>
                        <p class="text-xs text-gray-400">7 hari terakhir</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-purple-500"></span>
                        <span class="text-xs text-gray-400">Omzet</span>
                    </div>
                </div>
                @php $maxTotal = max($recentDays->max('total') ?? 0, 1); @endphp
                <div class="h-52 flex items-end gap-3">
                    @foreach ($recentDays as $day)
                        @php
                            $height = max(16, ($day['total'] / $maxTotal) * 180);
                            $isToday = $day['label'] === now()->locale('id')->dayName;
                        @endphp
                        <div class="flex-1 flex flex-col justify-end items-center gap-2 bar-item relative group cursor-pointer">
                            <div class="chart-tooltip absolute -top-10 left-1/2 -translate-x-1/2 bg-text-dark text-white text-xs px-2.5 py-1 rounded-lg whitespace-nowrap z-10">
                                Rp {{ number_format($day['total'], 0, ',', '.') }}
                            </div>
                            <div class="w-full rounded-t-xl animate-bar-grow {{ $isToday ? 'bg-gradient-to-t from-purple-500 to-indigo-400' : 'bg-gradient-to-t from-purple-100 to-purple-50 group-hover:from-purple-200 group-hover:to-purple-100' }}"
                                style="height: {{ $height }}px;">
                            </div>
                            <span class="text-[10px] {{ $isToday ? 'text-purple-600 font-bold' : 'text-gray-400' }}">{{ $day['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Risk Products -->
        <div class="col-span-12 lg:col-span-5 space-y-4">
            <div class="bg-white rounded-2xl border border-outline-variant p-5 card-hover  h-full">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-500 text-[20px]">warning</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-on-surface">Risiko Stok</h3>
                        <p class="text-xs text-gray-400">Perlu perhatian</p>
                    </div>
                </div>
                @if ($criticalProducts->isEmpty())
                    <div class="text-center py-6">
                        <div class="w-14 h-14 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="material-symbols-outlined text-emerald-500 text-[28px]">check_circle</span>
                        </div>
                        <p class="font-bold text-on-surface text-sm mb-1">Semua Aman!</p>
                        <p class="text-xs text-gray-400">Tidak ada produk berisiko stok rendah.</p>
                    </div>
                @else
                    <div class="space-y-2">
                        @foreach ($criticalProducts->take(4) as $product)
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold text-sm text-on-surface truncate">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                                </div>
                                <div class="text-right shrink-0 ml-3">
                                    <p class="font-bold text-sm {{ $product->stock < 5 ? 'text-red-500' : 'text-amber-500' }}">{{ $product->stock }} unit</p>
                                    <span class="text-[10px] px-1.5 py-0.5 rounded-full {{ $product->stock < 5 ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600' }} font-bold">{{ ucfirst($product->status) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Top Products & Restock Recommendations -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Top Products -->
        <div class="col-span-12 lg:col-span-5">
            <div class="bg-white rounded-2xl border border-outline-variant p-5 h-full card-hover ">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-500 text-[20px]">emoji_events</span>
                    </div>
                    <h3 class="font-bold text-on-surface">Produk Terlaris</h3>
                </div>
                @if ($topProducts->isEmpty())
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-3xl text-gray-200 block mb-2">auto_graph</span>
                        <p class="text-sm text-gray-400">Belum ada transaksi untuk dianalisis.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($topProducts as $index => $product)
                            @php $width = max(10, min(100, ($product->total_sold / max($topProducts->max('total_sold'), 1)) * 100)); @endphp
                            <div>
                                <div class="flex items-center justify-between gap-3 mb-1.5">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0 {{ $index === 0 ? 'bg-amber-400 text-white' : ($index === 1 ? 'bg-gray-300 text-white' : ($index === 2 ? 'bg-orange-300 text-white' : 'bg-gray-200 text-gray-600')) }}">
                                            {{ $index + 1 }}
                                        </span>
                                        <p class="font-bold text-sm text-on-surface truncate">{{ $product->name }}</p>
                                    </div>
                                    <p class="font-bold text-primary text-xs shrink-0">Rp {{ number_format($product->revenue, 0, ',', '.') }}</p>
                                </div>
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-amber-400 to-orange-400 rounded-full" style="width: {{ $width }}%"></div>
                                </div>
                                <p class="text-[10px] text-gray-400 mt-1">{{ number_format($product->total_sold) }} item terjual</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Restock Recommendations -->
        <div class="col-span-12 lg:col-span-7">
            <div class="bg-white rounded-2xl border border-outline-variant p-5 h-full card-hover ">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-500 text-[20px]">shopping_cart</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface">Rekomendasi Restock</h3>
                            <p class="text-xs text-gray-400">Saran dari AI</p>
                        </div>
                    </div>
                    <a href="{{ route('reports.index') }}" class="text-primary font-bold text-xs hover:underline">Lihat Laporan →</a>
                </div>
                @if ($shoppingSuggestions->isEmpty())
                    <div class="text-center py-8">
                        <div class="w-14 h-14 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="material-symbols-outlined text-emerald-500 text-[28px]">check_circle</span>
                        </div>
                        <p class="font-bold text-on-surface text-sm mb-1">Stok Masih Aman</p>
                        <p class="text-xs text-gray-400">Belum ada rekomendasi restock saat ini.</p>
                    </div>
                @else
                    <div class="space-y-2">
                        @foreach ($shoppingSuggestions as $suggestion)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold text-sm text-on-surface">{{ $suggestion['name'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $suggestion['category'] }} • Stok saat ini {{ $suggestion['stock'] }}</p>
                                    @if(isset($suggestion['urgency']))
                                    <p class="text-[10px] {{ $suggestion['urgency'] === 'high' ? 'text-red-500' : 'text-amber-500' }} font-medium">
                                        @if($suggestion['urgency'] === 'high') ⚡ Segera restok — habis dalam ~2 hari @else 📅 Restok sebelum minggu depan @endif
                                    </p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3 shrink-0">
                                    <div class="text-right">
                                        <p class="font-bold text-emerald-600 text-sm">+{{ $suggestion['recommended'] }} unit</p>
                                        <p class="text-[10px] text-gray-400">Est. Rp {{ number_format($suggestion['estimate'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button onclick="alert('Fitur Buat Daftar Belanja akan segera tersedia')" class="w-full mt-3 py-2.5 bg-gradient-to-r from-primary to-emerald-600 text-white font-bold text-sm rounded-xl hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">shopping_cart</span>
                        Buat Daftar Belanja
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- AI Action Card -->
    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl p-6 text-white relative overflow-hidden">
        <div class="absolute -bottom-4 -right-4 text-[100px] text-white/10 pointer-events-none">
            <span class="material-symbols-outlined">smart_toy</span>
        </div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-white text-[28px]">psychology</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-lg mb-1">Butuh Strategi Penjualan?</h3>
                <p class="text-white/80 text-sm">Konsultasikan dengan AI TokoQ untuk dapatkan rekomendasi personal untuk bisnis Anda.</p>
            </div>
            <a href="{{ route('products.index') }}" class="shrink-0 px-5 py-2.5 bg-white text-purple-600 rounded-xl font-bold text-sm hover:bg-white/90 transition-colors">
                Buka Inventori
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="pb-4 flex flex-col sm:flex-row justify-between items-center gap-2">
        <p class="text-xs text-gray-500">&copy; 2025 TokoQ. All rights reserved.</p>
    </footer>
</div>
@endsection
