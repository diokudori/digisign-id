<form wire:submit="save" class="space-y-5 text-slate-200">
    <!-- Document Title -->
    <div>
        <label for="title" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Judul Dokumen</label>
        <input wire:model="title" type="text" id="title" placeholder="Contoh: Surat Keputusan Pengangkatan Staf" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
        @error('title') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <!-- Document Number -->
    <div>
        <label for="document_number" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nomor Dokumen</label>
        <input wire:model="document_number" type="text" id="document_number" placeholder="Contoh: 120/SK-DIR/VII/2026" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
        @error('document_number') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <!-- Signer Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="signer_name" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Penandatangan</label>
            <input wire:model="signer_name" type="text" id="signer_name" placeholder="Contoh: Budi Santoso, M.Kom" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
            @error('signer_name') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="signer_position" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Jabatan Penandatangan</label>
            <input wire:model="signer_position" type="text" id="signer_position" placeholder="Contoh: Direktur Utama" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
            @error('signer_position') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Signing Date -->
    <div>
        <label for="signed_at" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tanggal & Waktu Tanda Tangan</label>
        <input wire:model="signed_at" type="datetime-local" id="signed_at" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
        @error('signed_at') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <!-- Protection Settings Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="watermark_text" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Teks Watermark (Opsional)</label>
            <input wire:model="watermark_text" type="text" id="watermark_text" placeholder="Contoh: TERVERIFIKASI" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
            @error('watermark_text') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="pdf_password" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kata Sandi Pelindung (Opsional)</label>
            <input wire:model="pdf_password" type="password" id="pdf_password" placeholder="Mencegah copy paste teks" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
            @error('pdf_password') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- PDF File Upload Zone -->
    <div x-data="{ isUploading: false, progress: 0 }"
         x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false"
         x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress">
        
        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Berkas PDF Dokumen</label>
        
        <div class="relative border-2 border-dashed border-slate-800 rounded-2xl p-6 hover:border-emerald-500/50 transition-colors duration-150 flex flex-col items-center justify-center bg-slate-950/40">
            <input type="file" wire:model="pdf_file" id="pdf_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="application/pdf">
            
            <svg class="w-10 h-10 text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            
            <div class="text-sm font-semibold text-slate-300">
                @if($pdf_file)
                    <span class="text-emerald-400">Berkas Terpilih: {{ $pdf_file->getClientOriginalName() }}</span>
                @else
                    Pilih berkas PDF atau seret ke sini
                @endif
            </div>
            
            <p class="text-xs text-slate-500 mt-1">Hanya file PDF (Maksimal 10MB)</p>
        </div>

        <!-- Uploading Progress Bar -->
        <div x-show="isUploading" class="mt-3 bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 flex flex-col space-y-1.5" style="display: none;">
            <div class="flex justify-between items-center text-xs font-semibold text-slate-350">
                <span>Mengunggah berkas...</span>
                <span x-text="progress + '%'"></span>
            </div>
            <div class="w-full bg-slate-950 rounded-full h-1.5 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-400 to-teal-400 h-1.5 rounded-full transition-all duration-150" :style="`width: ${progress}%`"></div>
            </div>
        </div>

        @error('pdf_file') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <!-- Form Actions -->
    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-800/80">
        <button type="button" @click="showUploadModal = false" class="px-4 py-2 border border-slate-800 hover:bg-slate-850 hover:border-slate-750 text-slate-400 hover:text-white rounded-xl text-sm font-semibold transition-all duration-150 cursor-pointer">
            Batal
        </button>
        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2 border border-transparent text-sm font-semibold rounded-xl text-slate-950 bg-emerald-400 hover:bg-emerald-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-150 shadow-lg shadow-emerald-500/10 inline-flex items-center space-x-2 cursor-pointer disabled:opacity-50">
            <!-- Loading Spinner -->
            <span wire:loading wire:target="save" class="animate-spin h-4 w-4 border-2 border-slate-950 border-t-transparent rounded-full mr-1.5"></span>
            <span>Simpan Dokumen</span>
        </button>
    </div>
</form>
