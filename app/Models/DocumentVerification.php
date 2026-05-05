<?php

namespace App\Models;

use App\Enums\DocumentTypeEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'document_type',
        'verification_code',
        'digit_code',
        'file_path',
        'verified_at',
        'payment_id',
    ];

    protected $casts = [
        'document_type' => DocumentTypeEnum::class,
        'verified_at' => 'datetime',
    ];

    /**
     * Get the application that owns the document verification.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    protected static function booted(): void
    {
        static::creating(function (self $verification) {
            if (empty($verification->verification_code)) {
                $verification->verification_code = strtoupper(Str::random(14));
            }

            if (empty($verification->digit_code)) {
                $verification->digit_code = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
