<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentVerify extends Component
{
    public $uuid;
    public $document;
    public $isValid = false;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->document = Document::where('uuid', $uuid)->first();
        $this->isValid = $this->document && $this->document->is_active;
    }

    /**
     * Securely streams/downloads the PDF file.
     */
    public function downloadPdf()
    {
        if (!$this->isValid) {
            abort(404, 'Dokumen tidak valid.');
        }

        $filePath = $this->document->file_path;

        if (!Storage::disk('public')->exists($filePath)) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Berkas PDF fisik tidak ditemukan di server.'
            ]);
            return null;
        }

        // Generate clean file name for user download
        $cleanName = Str::slug($this->document->title) ?: 'dokumen-terverifikasi';
        
        return Storage::disk('public')->download($filePath, "{$cleanName}.pdf");
    }

    public function render()
    {
        return view('livewire.public.document-verify')
            ->layout('components.layouts.app');
    }
}
