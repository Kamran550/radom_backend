<?php

namespace App\Livewire\Verify;

use Illuminate\Support\Facades\Storage;
use App\Models\DocumentVerification;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.verify')]
class Verify extends Component
{
    public $verificationCode = '';
    public $digitCode = '';
    public $message = '';
    public $messageType = ''; // 'success' or 'error'
    public $application = null;

    /**
     * Mount the component and check for verification code in query parameter
     */
    public function mount(?string $verificationCode = null)
    {
        if ($verificationCode) {
            $this->verificationCode = strtoupper(trim($verificationCode));
        }
    }

    public function verify()
    {
        $this->reset(['message', 'messageType', 'application']);

        if (empty($this->verificationCode)) {
            $this->message = 'Verification link is invalid. Please use the original QR link.';
            $this->messageType = 'error';
            return;
        }

        if (empty($this->digitCode)) {
            $this->message = 'Please enter the 4-digit code.';
            $this->messageType = 'error';
            return;
        }

        $verificationCode = strtoupper(trim($this->verificationCode));
        $digitCode = trim($this->digitCode);

        if (!preg_match('/^\d{4}$/', $digitCode)) {
            $this->message = 'Digit code must be exactly 4 numbers.';
            $this->messageType = 'error';
            return;
        }

        $application = DocumentVerification::where('verification_code', $verificationCode)
            ->where('digit_code', $digitCode)
            ->first();

        if (!$application) {
            $this->message = 'Invalid verification code or digit code. Please try again.';
            $this->messageType = 'error';
            return;
        }

        $this->application = $application;
        
        $this->message = 'Verification successful!';
        $this->messageType = 'success';
    }

    public function getPdfUrl()
    {
        if (!$this->application || !$this->application->file_path) {
            return null;
        }

        if (!Storage::exists($this->application->file_path)) {
            return null;
        }

        return Storage::url($this->application->file_path);
    }

    public function render()
    {
        return view('livewire.verify.verify');
    }
}

