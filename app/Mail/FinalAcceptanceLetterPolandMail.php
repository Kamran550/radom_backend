<?php

namespace App\Mail;

use App\Models\StudentApplication;
use App\Models\User;
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
use App\Models\DocumentVerification;
use App\Enums\DocumentTypeEnum;

class FinalAcceptanceLetterPolandMail extends Mailable
{
    use Queueable, SerializesModels;

    public StudentApplication $student;
    public User $user;
    public ?string $plainPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(StudentApplication $student, User $user, ?string $plainPassword = null)
    {
        $this->student = $student;
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Zaświadczenie studenckie / Student Certificate - ' . $this->student->first_name . ' ' . $this->student->last_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.final-acceptance-letter',
            with: [
                'student' => $this->student,
                'user' => $this->user,
                'plainPassword' => $this->plainPassword,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
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

            $this->student->load('application.program.degree.translations', 'application.program.translations', 'application.program.faculty.translations');

            $verificationCode = null;
            if ($this->student->application) {
                $verificationCode = strtoupper(Str::random(14));

                $documentVerification = DocumentVerification::create([
                    'application_id' => $this->student->application->id,
                    'document_type' => DocumentTypeEnum::CERTIFICATE,
                    'verification_code' => $verificationCode,
                    'file_path' => null,
                ]);

                $this->student->application->load('documentVerifications');
            }

            $pdf = Pdf::loadView('livewire.admin.applications.student.final-acceptance-letter-poland', [
                'student' => $this->student,
                'user' => $this->user,
                'verificationCode' => $verificationCode,
            ])
            ->setOptions([
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'defaultFont' => 'DejaVu Serif',
            ])
            ->setPaper('a4', 'portrait');

            $fileName = $this->student->first_name . '_' . $this->student->last_name . '_[Ikinci-Belge-Poland]_' . now()->format('Y-m-d') . '.pdf';
            $fileName = preg_replace('/[^a-zA-Z0-9_\-\[\]\.]/', '_', $fileName);
            $filePath = 'applications/certificates/' . $fileName;

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
            Log::error('Poland certificate PDF generation error: ' . $e->getMessage(), [
                'student_id' => $this->student->id,
                'user_id' => $this->user->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return [];
        }
    }
}
