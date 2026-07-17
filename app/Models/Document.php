<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'document_number',
        'title',
        'signer_name',
        'signer_position',
        'signed_at',
        'file_path',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'signed_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Accessor for the public verification URL.
     *
     * @return string
     */
    public function getVerificationUrlAttribute(): string
    {
        return url('/verify-scan/' . $this->uuid);
    }
}
