<?php

namespace App\Mail;

use App\Enums\DocumentTypeEnum;
use App\Enums\ScholarshipStatusEnum;
use App\Models\DocumentVerification;
use App\Models\StudentApplication;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AcceptanceLetterBilingualMail extends Mailable
{
    use Queueable, SerializesModels;

    public StudentApplication $student;

    public function __construct(StudentApplication $student)
    {
        $this->student = $student;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Conditional Acceptance Letter (PL/EN) - ' . $this->student->first_name . ' ' . $this->student->last_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.acceptance-letter',
            with: [
                'student' => $this->student,
            ],
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        try {
            ini_set('memory_limit', '5016M');
            set_time_limit(0);
            if (!$this->student->relationLoaded('application')) {
                $this->student->load('application');
            }

            $verificationCode = null;
            $digitCode = null;
            if ($this->student->application) {
                $verificationCode = strtoupper(Str::random(14));

                $documentVerification = DocumentVerification::create([
                    'application_id' => $this->student->application->id,
                    'document_type' => DocumentTypeEnum::ACCEPTANCE,
                    'verification_code' => $verificationCode,
                    'file_path' => null,
                ]);
                $digitCode = $documentVerification->digit_code;

                $this->student->application->load('documentVerifications');
            }

            $this->student->scholarship_status = ScholarshipStatusEnum::PERCENT_75->value;
            $this->student->save();

            $pdf = Pdf::loadView('livewire.admin.applications.student.acceptance-letter-bilingual', [
                'student' => $this->student,
                'verificationCode' => $verificationCode,
                'digitCode' => $digitCode,
            ])
                ->setOptions([
                    'isRemoteEnabled' => false,
                    'isHtml5ParserEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'defaultFont' => 'DejaVu Serif',
                ])->setPaper('a4', 'portrait');

            $fileName = sprintf(
                'Conditional_Acceptence_Letter_EN_PL_%s_%s_%s_student-%s_%s.pdf',
                $this->student->first_name,
                $this->student->last_name,
                now()->format('Y-m-d'),
                $this->student->id,
                Str::lower(Str::random(8))
            );
            $filePath = 'applications/acceptance-letters/' . $fileName;

            Storage::put($filePath, $pdf->output());
            if ($this->student->application && isset($documentVerification)) {
                $documentVerification->update([
                    'file_path' => $filePath,
                ]);
            }

            return [
                Attachment::fromData(fn () => $pdf->output(), $fileName)
                    ->withMime('application/pdf'),
            ];
        } catch (\Exception $e) {
            Log::error('Error generating bilingual acceptance PDF: ' . $e->getMessage(), [
                'student_id' => $this->student->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return [];
        }
    }
}
