<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentList extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Toggle the active status of a document.
     */
    public function toggleStatus($id)
    {
        $document = Document::findOrFail($id);
        $document->is_active = !$document->is_active;
        $document->save();

        $status = $document->is_active ? 'activated' : 'deactivated';
        $this->dispatch('toast', [
            'type' => 'success',
            'message' => "Document successfully {$status}."
        ]);
    }

    /**
     * Delete a document and its stored PDF.
     */
    public function deleteDocument($id)
    {
        $document = Document::findOrFail($id);

        // Delete the physical PDF file
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Document deleted successfully.'
        ]);
    }

    public function render()
    {
        $documents = Document::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('document_number', 'like', '%' . $this->search . '%')
                      ->orWhere('signer_name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.document-list', [
            'documents' => $documents
        ])->layout('components.layouts.app');
    }
}
