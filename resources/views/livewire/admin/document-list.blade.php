<div class="min-h-screen bg-slate-900 text-slate-100" x-data="{ showUploadModal: false }">
    <!-- Navigation Bar -->
    <nav class="border-b border-slate-800 bg-slate-900/50 backdrop-blur sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo / Brand -->
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <span class="p-2 bg-gradient-to-tr from-emerald-500 to-teal-400 rounded-lg text-slate-900 font-bold shadow-md shadow-emerald-500/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <span class="text-xl font-bold tracking-tight text-white">DigiSign <span class="text-emerald-400 font-medium text-sm px-1.5 py-0.5 rounded bg-slate-800">Admin</span></span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-xs text-slate-400 font-mono bg-slate-800 px-2 py-1 rounded hidden sm:inline">Server: Online</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="text-xs text-slate-400 hover:text-rose-400 font-semibold bg-slate-800 hover:bg-rose-500/10 border border-slate-700 hover:border-rose-500/20 px-3 py-1.5 rounded-lg transition-colors duration-150 cursor-pointer">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Dokumen Digital</h1>
                <p class="mt-2 text-sm text-slate-400">Kelola dokumen, generate link tanda tangan digital, dan pantau status verifikasi.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <button @click="showUploadModal = true" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-semibold rounded-xl text-slate-950 bg-gradient-to-r from-emerald-400 to-teal-300 hover:from-emerald-300 hover:to-teal-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 focus:ring-offset-slate-900 transition-all duration-200 shadow-lg shadow-emerald-500/10 cursor-pointer">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Unggah Dokumen Baru
                </button>
            </div>
        </div>

        <!-- Feedback Messages -->
        @if (session()->has('message'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center space-x-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <!-- List Operations -->
        <div class="bg-slate-800/40 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl backdrop-blur-md">
            <!-- Search & Filters -->
            <div class="p-6 border-b border-slate-800/80 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative max-w-md w-full">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul, nomor dokumen, atau penandatangan..." class="block w-full pl-10 pr-4 py-2 border border-slate-700/80 rounded-xl bg-slate-900/60 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm transition-all duration-150">
                </div>
                <div class="flex items-center space-x-2 text-xs text-slate-400">
                    <span wire:loading class="flex items-center space-x-2 bg-slate-800/80 px-3 py-1.5 rounded-lg border border-slate-700">
                        <svg class="animate-spin h-3.5 w-3.5 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Menyinkronkan data...</span>
                    </span>
                </div>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-800">
                    <thead class="bg-slate-900/40">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Detail Dokumen</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Penandatangan</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Tanggal TTD</th>
                            <th scope="col" class="px-6 py-4 class text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Link Verifikasi (Scan QR)</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 bg-transparent">
                        @forelse($documents as $doc)
                            <tr class="hover:bg-slate-850/40 transition-colors duration-150">
                                <!-- Document Title and Number -->
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="p-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg mt-0.5">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-white flex flex-wrap items-center gap-1.5">
                                                <span class="line-clamp-1" title="{{ $doc->title }}">{{ $doc->title }}</span>
                                                @if($doc->pdf_password)
                                                    <span class="px-1.5 py-0.5 bg-rose-500/10 text-rose-450 border border-rose-500/20 rounded text-[9px] font-bold" title="Dilindungi Kata Sandi (Copy Blocked)">
                                                        Protected
                                                    </span>
                                                @endif
                                                @if($doc->watermark_text)
                                                    <span class="px-1.5 py-0.5 bg-teal-500/10 text-teal-400 border border-teal-500/20 rounded text-[9px] font-bold" title="Teks Watermark: {{ $doc->watermark_text }}">
                                                        Watermarked
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $doc->document_number }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Signer Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-200">{{ $doc->signer_name }}</div>
                                    <div class="text-xs text-slate-500">{{ $doc->signer_position }}</div>
                                </td>

                                <!-- Signed Date -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-300">{{ $doc->signed_at->translatedFormat('d M Y') }}</div>
                                    <div class="text-xs text-slate-500">{{ $doc->signed_at->format('H:i') }} WIB</div>
                                </td>

                                <!-- Active Status Toggle -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button wire:click="toggleStatus({{ $doc->id }})" class="focus:outline-none inline-flex cursor-pointer transition-opacity duration-150 hover:opacity-85">
                                        @if($doc->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                                Non-aktif
                                            </span>
                                        @endif
                                    </button>
                                </td>

                                <!-- Verification Link & Copy Button -->
                                <td class="px-6 py-4">
                                    <div x-data="{ copied: false, url: '{{ $doc->verification_url }}' }" class="flex items-center space-x-2">
                                        <input type="text" readonly :value="url" class="text-xs font-mono text-slate-400 bg-slate-900/60 border border-slate-700/60 rounded px-2 py-1 max-w-[180px] truncate focus:outline-none">
                                        <button @click="navigator.clipboard.writeText(url); copied = true; $dispatch('toast', { type: 'success', message: 'Tautan disalin ke clipboard!' }); setTimeout(() => copied = false, 2000)" class="p-1 bg-slate-800 hover:bg-slate-750 border border-slate-700 text-slate-300 rounded hover:text-emerald-400 transition-colors duration-150 cursor-pointer" title="Salin Tautan">
                                            <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                            </svg>
                                            <svg x-show="copied" class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                        <a href="{{ $doc->verification_url }}" target="_blank" class="p-1 bg-slate-800 hover:bg-slate-750 border border-slate-700 text-slate-300 rounded hover:text-emerald-400 transition-colors duration-150" title="Buka Link Verifikasi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="p-1.5 bg-slate-850 hover:bg-emerald-500/10 border border-slate-700 hover:border-emerald-500/30 text-slate-400 hover:text-emerald-400 rounded-lg transition-all duration-150" title="Lihat PDF">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </a>
                                        <button wire:click="deleteDocument({{ $doc->id }})" wire:confirm="Apakah Anda yakin ingin menghapus dokumen ini beserta file PDF-nya secara permanen?" class="p-1.5 bg-slate-850 hover:bg-rose-500/10 border border-slate-700 hover:border-rose-500/30 text-slate-400 hover:text-rose-400 rounded-lg transition-all duration-150 cursor-pointer" title="Hapus Dokumen">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <span class="p-4 bg-slate-800/80 border border-slate-700/60 rounded-full text-slate-500">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </span>
                                        <div class="text-base font-semibold text-slate-350">Belum ada dokumen</div>
                                        <div class="text-xs text-slate-500 max-w-xs">Silakan unggah berkas PDF baru untuk membuat QR verifikasi tanda tangan digital.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($documents->hasPages())
                <div class="px-6 py-4 border-t border-slate-800 bg-slate-900/20">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Upload Modal Container -->
    <div x-show="showUploadModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" @click="showUploadModal = false"></div>

        <!-- Modal Content -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-3xl max-w-lg w-full p-8 shadow-2xl relative z-10"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @keydown.escape.window="showUploadModal = false">
                
                <!-- Close Button -->
                <button @click="showUploadModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-white transition-colors duration-150 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Modal Title -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-white">Unggah Dokumen TTD</h2>
                    <p class="text-xs text-slate-400 mt-1">Masukkan metadata berkas untuk membuat tautan verifikasi tersertifikasi.</p>
                </div>

                <!-- Include Livewire Upload Form Component -->
                <livewire:admin.document-upload @document-saved="showUploadModal = false" />
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div x-data="{ toasts: [] }" 
         @toast.window="toasts.push({ id: Date.now(), type: $event.detail[0].type, message: $event.detail[0].message }); setTimeout(() => toasts.shift(), 4500)"
         class="fixed bottom-6 right-6 z-[99] flex flex-col gap-3">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition:enter="transition ease-out duration-300 transform translate-y-2 opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200 transform translate-y-0 opacity-100"
                 x-transition:leave-end="translate-y-2 opacity-0"
                 class="flex items-center space-x-3 px-5 py-4 text-sm font-semibold rounded-2xl shadow-2xl border backdrop-blur-md"
                 :class="toast.type === 'success' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400 shadow-emerald-950/20' : 'bg-rose-500/10 border-rose-500/30 text-rose-400 shadow-rose-950/20'">
                <span class="p-1 rounded-lg" :class="toast.type === 'success' ? 'bg-emerald-500/20' : 'bg-rose-500/20'">
                    <template x-if="toast.type === 'success'">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </template>
                    <template x-if="toast.type !== 'success'">
                        <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </template>
                </span>
                <span x-text="toast.message"></span>
            </div>
        </template>
    </div>
</div>
