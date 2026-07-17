<div class="min-h-screen bg-slate-50 flex flex-col justify-between py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background subtle decorations -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-teal-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
    </div>

    <!-- Main Card Container -->
    <div class="max-w-2xl w-full mx-auto bg-white border border-slate-200/80 rounded-3xl shadow-xl overflow-hidden z-10 print:border-none print:shadow-none print:my-0">
        
        <!-- Official Institutional Header -->
        <div class="bg-gradient-to-b from-slate-900 to-slate-950 p-8 text-center border-b border-slate-800">
            <div class="flex justify-center mb-4">
                <!-- Sleek Official Shield Crest -->
                <span class="p-3 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </span>
            </div>
            <h2 class="text-xs font-bold tracking-widest text-emerald-400 uppercase">Republik Indonesia</h2>
            <h1 class="text-xl font-extrabold text-white mt-1 tracking-tight">Sistem Verifikasi Dokumen Digital</h1>
            <p class="text-[10px] text-slate-500 font-mono mt-1">PT. BUNGA TANI SEJAHTERA VERIFICATION PORTAL</p>
        </div>

        @if($isValid)
            <!-- VALID DOCUMENT STATE -->
            <div>
                <!-- Success Banner -->
                <div class="bg-emerald-50 border-b border-emerald-100 p-6 flex items-center space-x-4">
                    <span class="p-2.5 bg-emerald-500 text-white rounded-full flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-base font-bold text-emerald-900 uppercase tracking-wide">Dokumen Terverifikasi</h3>
                        <p class="text-xs text-emerald-700 font-medium">Authentic Document &mdash; Tanda Tangan Elektronik Sah</p>
                    </div>
                </div>

                <!-- Document Details Grid -->
                <div class="p-8 space-y-6">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Judul Dokumen / Document Title</span>
                        <div class="text-base font-extrabold text-slate-900">{{ $document->title }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Nomor Dokumen / Document Number</span>
                            <div class="text-sm font-mono font-bold text-slate-800">{{ $document->document_number }}</div>
                        </div>

                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Tanggal Tanda Tangan / Signing Date</span>
                            <div class="text-sm font-semibold text-slate-800">
                                {{ $document->signed_at->translatedFormat('d F Y') }} <span class="text-slate-500">| {{ $document->signed_at->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 my-6"></div>

                    <!-- Signer Box -->
                    <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-5 flex items-start space-x-4">
                        <span class="p-3 bg-white border border-slate-200 text-slate-500 rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6 text-slate-650" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Ditandatangani Oleh / Signed By</span>
                            <div class="text-base font-bold text-slate-900">{{ $document->signer_name }}</div>
                            <div class="text-xs font-semibold text-slate-500 mt-0.5">{{ $document->signer_position }}</div>
                        </div>
                    </div>

                    <!-- Security Verification Watermark -->
                    <div class="p-4 bg-emerald-500/5 rounded-xl border border-emerald-500/10 text-[11px] text-emerald-800 leading-relaxed font-medium">
                        <strong>Catatan Keamanan:</strong> Informasi ini dihasilkan secara otomatis dari sistem verifikasi tanda tangan digital resmi. Berkas PDF asli terkait telah diuji integritas kriptografisnya dan sah sesuai hukum yang berlaku.
                    </div>

                    <!-- Interactive Action Buttons -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-4 border-t border-slate-100 print:hidden">
                        <!-- Print Button via Alpine -->
                        <button onclick="window.print()" class="inline-flex items-center justify-center px-5 py-2.5 border border-slate-300 hover:bg-slate-50 hover:border-slate-400 text-sm font-semibold rounded-xl text-slate-700 transition-colors duration-150 cursor-pointer">
                            <svg class="-ml-1 mr-2 h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Cetak Verifikasi
                        </button>
                        
                        <!-- Download Button via Livewire -->
                        <button wire:click="downloadPdf" wire:loading.attr="disabled" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-150 shadow-md shadow-emerald-500/10 cursor-pointer disabled:opacity-50">
                            <span wire:loading wire:target="downloadPdf" class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full mr-2"></span>
                            <svg wire:loading.remove wire:target="downloadPdf" class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh Dokumen Asli (PDF)
                        </button>
                    </div>
                </div>
            </div>
        @else
            <!-- INVALID / NOT FOUND STATE -->
            <div class="p-8 text-center">
                <div class="flex justify-center mb-4">
                    <span class="p-4 bg-rose-50 border border-rose-100 text-rose-500 rounded-full animate-pulse">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </span>
                </div>
                <h3 class="text-lg font-extrabold text-rose-900 uppercase">Dokumen Tidak Valid / Not Found</h3>
                <p class="mt-2 text-sm text-slate-500 max-w-sm mx-auto leading-relaxed">Maaf, tautan verifikasi tidak ditemukan atau status dokumen sudah dinonaktifkan oleh administrator.</p>
                
                <div class="mt-8 pt-6 border-t border-slate-100 print:hidden">
                    <p class="text-xs text-slate-400">Silakan hubungi administrator instansi penerbit dokumen untuk informasi lebih lanjut.</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Official Portal Footer -->
    <div class="max-w-2xl w-full mx-auto mt-8 text-center text-xs text-slate-450 z-10 print:hidden">
        <p>&copy; 2026 PT. Bunga Tani Sejahtera - Digital Signature.</p>
        <p class="mt-1 text-[10px] text-slate-400">Verifikasi tanda tangan digital sesuai UU ITE Nomor 11 Tahun 2008 Pasal 11.</p>
    </div>

    <!-- Print Stylesheet -->
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            .print\:hidden {
                display: none !important;
            }
            .print\:border-none {
                border: none !important;
            }
            .print\:shadow-none {
                box-shadow: none !important;
            }
            .print\:my-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
        }
    </style>
</div>
