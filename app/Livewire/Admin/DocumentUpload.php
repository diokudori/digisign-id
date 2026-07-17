<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Str;

class DocumentUpload extends Component
{
    use WithFileUploads;

    public $document_number = '';
    public $title = '';
    public $signer_name = '';
    public $signer_position = '';
    public $signed_at = '';
    public $pdf_file;
    public $watermark_text = '';
    public $pdf_password = '';

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'document_number' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'signer_name' => 'required|string|max:150',
            'signer_position' => 'required|string|max:150',
            'signed_at' => 'required|date',
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'watermark_text' => 'nullable|string|max:100',
            'pdf_password' => 'nullable|string|min:4',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'document_number.required' => 'Nomor dokumen wajib diisi.',
            'title.required' => 'Judul dokumen wajib diisi.',
            'signer_name.required' => 'Nama penandatangan wajib diisi.',
            'signer_position.required' => 'Jabatan penandatangan wajib diisi.',
            'signed_at.required' => 'Tanggal penandatanganan wajib diisi.',
            'pdf_file.required' => 'Berkas PDF wajib diunggah.',
            'pdf_file.mimes' => 'Berkas harus berformat PDF.',
            'pdf_file.max' => 'Ukuran berkas PDF maksimal 10MB.',
            'pdf_password.min' => 'Kata sandi pelindung minimal 4 karakter.',
        ];
    }

    /**
     * Save the document.
     */
    public function save()
    {
        $validated = $this->validate();

        // Generate unique 22-character alphanumeric UUID
        do {
            $uuid = Str::random(22);
        } while (Document::where('uuid', $uuid)->exists());

        // Process PDF with Mpdf (Watermark & Password Protection)
        $tempPath = $this->pdf_file->getRealPath();
        
        // Generate new unique file name
        $fileName = 'documents/' . Str::uuid() . '.pdf';
        $destinationPath = storage_path('app/public/' . $fileName);
        
        // Ensure directories exist
        if (!file_exists(dirname($destinationPath))) {
            mkdir(dirname($destinationPath), 0755, true);
        }
        
        $tmpDir = storage_path('app/tmp');
        if (!file_exists($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        try {
            // Initialize Mpdf
            $mpdf = new \Mpdf\Mpdf([
                'tempDir' => $tmpDir,
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 0,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]);
            
            // Set source file
            $pageCount = $mpdf->setSourceFile($tempPath);
            for ($i = 1; $i <= $pageCount; $i++) {
                if ($i > 1) {
                    $mpdf->AddPage();
                }
                $tplId = $mpdf->importPage($i);
                $specs = $mpdf->getTemplateSize($tplId);
                
                // Render original PDF page sizes
                $mpdf->useTemplate($tplId, 0, 0, $specs['width'], $specs['height'], true);
            }
            
            // Add Watermark if provided
            if ($this->watermark_text) {
                $mpdf->SetWatermarkText($this->watermark_text);
                $mpdf->showWatermarkText = true;
                $mpdf->watermark_font = 'Helvetica';
                $mpdf->watermarkTextAlpha = 0.08; // Very subtle diagonal watermark
            }
            
            // Add Password Protection if provided (blocks text copying and modifying)
            if ($this->pdf_password) {
                $mpdf->SetProtection(['print'], '', $this->pdf_password);
            }
            
            // Output directly to the public disk path
            $mpdf->Output($destinationPath, \Mpdf\Output\Destination::FILE);
        } catch (\Exception $e) {
            $this->addError('pdf_file', 'Gagal memproses berkas PDF: ' . $e->getMessage());
            return null;
        }

        // Create the record in database
        $document = Document::create([
            'uuid' => $uuid,
            'document_number' => $validated['document_number'],
            'title' => $validated['title'],
            'signer_name' => $validated['signer_name'],
            'signer_position' => $validated['signer_position'],
            'signed_at' => $validated['signed_at'],
            'file_path' => $fileName,
            'is_active' => true,
            'pdf_password' => $this->pdf_password ? \Illuminate\Support\Facades\Crypt::encryptString($this->pdf_password) : null,
            'watermark_text' => $this->watermark_text ?: null,
        ]);

        // Clear the form fields
        $this->reset(['document_number', 'title', 'signer_name', 'signer_position', 'signed_at', 'pdf_file', 'watermark_text', 'pdf_password']);

        // Show toast and refresh list
        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Dokumen berhasil diunggah, diberi watermark, dan diproteksi!'
        ]);

        $this->dispatch('document-saved');
        
        // Redirect or refresh page
        return redirect()->route('admin.documents');
    }

    public function render()
    {
        return view('livewire.admin.document-upload');
    }
}
