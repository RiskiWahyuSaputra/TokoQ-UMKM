@extends('admin.layout')

@section('title', 'Validasi UMKM')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Validasi Pendaftaran UMKM</h1>
        <p class="text-sm text-gray-400 mt-1">Tinjau dan aktifkan pendaftaran toko UMKM baru</p>
    </div>
    <div class="flex items-center gap-2">
        <span class="px-3 py-1.5 bg-amber-50 text-amber-600 rounded-full text-xs font-bold flex items-center gap-1.5">
            <span class="w-2 h-2 bg-amber-400 rounded-full pulse-dot"></span>
            {{ $pendingCount }} Menunggu
        </span>
    </div>
</div>

@if(session('success'))
<div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3 animate-fade-in">
    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
    <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
</div>
@endif

@if($pendingCount > 0)
<!-- Bulk Actions -->
<div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
    <form method="POST" action="{{ route('admin.validate.bulk-activate') }}" onsubmit="return confirm('Aktifkan semua toko yang dipilih?')" id="bulkForm">
        @csrf
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" id="selectAll" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary" onchange="toggleAll(this)">
                <span class="text-sm font-medium text-gray-600">Pilih Semua</span>
            </label>
            <div class="flex items-center gap-2 ml-auto">
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl text-xs font-bold hover:shadow-lg hover:shadow-primary/25 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">done_all</span>
                    Aktifkan Terpilih
                </button>
            </div>
        </div>
    </form>
</div>
@endif

<!-- Validation List -->
<div class="space-y-4" id="validationList">
    @forelse($pendingUsers as $user)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden card-hover" data-user-id="{{ $user->id }}">
        <div class="p-5">
            <div class="flex flex-col lg:flex-row lg:items-center gap-5">
                <!-- Checkbox + User Info -->
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    @if($pendingCount > 0)
                    <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="bulk-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary shrink-0" onchange="updateBulkForm()">
                    @endif
                    <div class="w-14 h-14 bg-gradient-to-br from-primary/20 to-emerald-100 rounded-2xl flex items-center justify-center text-primary font-extrabold text-lg shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-gray-800 text-base">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        <p class="text-xs text-gray-300 mt-0.5">Daftar {{ $user->created_at->locale('id')->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Shop Info -->
                <div class="flex-1 min-w-0 lg:border-l lg:border-gray-100 lg:pl-5">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-primary text-[16px]">store</span>
                        <p class="font-bold text-gray-800 text-sm">{{ $user->shop->name ?? '-' }}</p>
                    </div>
                    <p class="text-xs text-gray-400 line-clamp-2">{{ $user->shop->address ?? 'Alamat tidak tersedia' }}</p>
                    @if($user->shop && $user->shop->phone)
                        <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">phone</span>
                            {{ $user->shop->phone }}
                        </p>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-2 shrink-0 flex-wrap">
                    <a href="mailto:{{ $user->email }}" class="px-3 py-2 border border-gray-200 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-50 transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px]">mail</span>
                        <span class="hidden sm:inline">Email</span>
                    </a>
                    <form method="POST" action="{{ route('admin.activate', $user->id) }}" onsubmit="return confirm('Aktifkan toko {{ $user->shop->name ?? $user->name }}?')">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-primary to-emerald-600 text-white rounded-xl text-xs font-bold hover:shadow-lg hover:shadow-primary/25 hover:scale-[1.02] transition-all flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span>
                            Aktifkan
                        </button>
                    </form>
                    <button type="button" onclick="showRejectModal({{ $user->id }}, '{{ $user->name }}')" class="px-3 py-2 border border-red-200 text-red-600 rounded-xl text-xs font-bold hover:bg-red-50 transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px]">close</span>
                        <span class="hidden sm:inline">Tolak</span>
                    </button>
                    <button type="button" onclick="showRevisiModal({{ $user->id }}, '{{ $user->name }}')" class="px-3 py-2 border border-amber-200 text-amber-600 rounded-xl text-xs font-bold hover:bg-amber-50 transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px]">edit</span>
                        <span class="hidden sm:inline">Revisi</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Expanded Details -->
        <div class="border-t border-gray-50 bg-gray-50/50 px-5 py-3">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Owner</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Email</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5 truncate">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Nama Toko</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $user->shop->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Tanggal Daftar</p>
                    <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    @empty
    <!-- Empty State -->
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-4xl text-emerald-400">check_circle</span>
        </div>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Semua Terverifikasi! 🎉</h3>
        <p class="text-sm text-gray-400 max-w-sm mx-auto">Tidak ada pendaftaran UMKM yang menunggu validasi saat ini.</p>
    </div>
    @endforelse
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeRejectModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 mx-4 animate-fade-in">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-extrabold text-gray-800">Tolak Pendaftaran</h3>
            <button onclick="closeRejectModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <p class="text-sm text-gray-500 mb-4">Menolak pendaftaran <span id="rejectUserName" class="font-bold text-gray-800"></span>. Alasan penolakan akan tercatat di log audit.</p>
        <form method="POST" id="rejectForm">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea name="reason" required rows="3" placeholder="Jelaskan alasan penolakan..." class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none resize-none"></textarea>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-xl text-sm font-bold hover:bg-red-600 transition-colors">Tolak</button>
            </div>
        </form>
    </div>
</div>

<!-- Revisi Modal -->
<div id="revisiModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeRevisiModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 mx-4 animate-fade-in">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-extrabold text-gray-800">Minta Revisi</h3>
            <button onclick="closeRevisiModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <p class="text-sm text-gray-500 mb-4">Minta revisi data kepada <span id="revisiUserName" class="font-bold text-gray-800"></span>. Permintaan akan tercatat di log audit.</p>
        <form method="POST" id="revisiForm">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Revisi <span class="text-red-500">*</span></label>
                <textarea name="reason" required rows="3" placeholder="Jelaskan data yang perlu direvisi..." class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none resize-none"></textarea>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="closeRevisiModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-amber-500 text-white rounded-xl text-sm font-bold hover:bg-amber-600 transition-colors">Kirim</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleAll(source) {
    const checkboxes = document.querySelectorAll('.bulk-checkbox');
    checkboxes.forEach(cb => cb.checked = source.checked);
    updateBulkForm();
}

function updateBulkForm() {
    const form = document.getElementById('bulkForm');
    const checkboxes = document.querySelectorAll('.bulk-checkbox:checked');
    // Remove existing hidden inputs
    form.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
    // Add checked values
    checkboxes.forEach(cb => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = cb.value;
        form.appendChild(input);
    });
}

function showRejectModal(userId, userName) {
    document.getElementById('rejectUserName').textContent = userName;
    document.getElementById('rejectForm').action = '/admin/validate/' + userId + '/reject';
    document.getElementById('rejectModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.body.style.overflow = '';
}

function showRevisiModal(userId, userName) {
    document.getElementById('revisiUserName').textContent = userName;
    document.getElementById('revisiForm').action = '/admin/validate/' + userId + '/revisi';
    document.getElementById('revisiModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRevisiModal() {
    document.getElementById('revisiModal').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>
@endsection
