<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditional Acceptance Letter - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 12mm;
            size: A4;
        }

        body {
            /* font-family: 'Times New Roman', 'Times', 'Georgia', serif; */
            font-family: 'DejaVu Serif', 'Times New Roman', serif;

            font-size: 7.2pt;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 0;
            padding-bottom: 180px;
            background: white;
            position: relative;
            min-height: 100vh;
        }

        .letter-meta {
            font-size: 7.5pt;
            margin-bottom: 10px;
        }

        .header {
            padding: 5px 0;
            margin-bottom: 8px;
        }

        .university-name {
            font-size: 12pt;
            font-weight: bold;
            text-align: center;
            margin: 6px 0 2px 0;
            letter-spacing: 0.04em;
        }

        .document-title {
            font-size: 11pt;
            font-weight: bold;
            text-align: center;
            margin: 4px 0 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .applicant-lines {
            font-size: 7.5pt;
            line-height: 1.45;
            margin: 0 0 10px 0;
        }

        .applicant-lines div {
            margin: 2px 0;
        }

        .study-details {
            font-size: 7.5pt;
            line-height: 1.45;
            margin: 10px 0;
        }

        .study-details div {
            margin: 2px 0;
        }

        .greeting {
            margin: 8px 0;
            font-size: 7.5pt;
        }

        .content {
            /* margin: 6px 0; */
            text-align: justify;
            line-height: 1.3;
        }

        .content p {
            margin: 4px 0;
        }

        .section-header {
            font-size: 8pt;
            font-weight: bold;
            margin: 8px 0 5px 0;
            padding: 4px 6px;
            /* background-color: #fff; */
            border-left: 3px solid #000;
        }

        .info-grid {
            border: none;
            display: table;
            width: 100%;
            margin: 8px 0;
            border-collapse: collapse;
            font-size: 7pt;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            padding: 4px 6px;
            font-weight: bold;
            width: 40%;
            /* border: 1px solid #000; */
            border: none;
            /* background-color: #fff; */
        }

        .info-value {
            display: table-cell;
            padding: 4px 6px;
            border: none;

        }

        .subsection-title {
            font-size: 7.5pt;
            font-weight: bold;
            margin: 8px 0 4px 0;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 6.5pt;

        }

        .payment-table th,
        .payment-table td {
            padding: 3px 5px;
            border: 1px solid #000;
            text-align: left;
        }

        .payment-table th {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 6pt;
        }

        .proficiency-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 6pt;
        }

        .proficiency-table th,
        .proficiency-table td {
            padding: 4px 5px;
            border: 1px solid #000;
            text-align: left;
            vertical-align: top;
        }

        .proficiency-table th {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            font-size: 5.5pt;
        }

        .proficiency-table td {
            font-size: 5.5pt;
            line-height: 1.2;
        }

        .required-documents-list {
            margin: 8px 0;
            padding-left: 20px;
        }

        .required-documents-list li {
            margin: 3px 0;
            font-size: 6.5pt;
            line-height: 1.3;
        }

        .closing-section {
            margin-top: 10px;
            margin-bottom: 0px;
        }

        .dates-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
            font-size: 7pt;
        }

        .dates-row {
            display: table-row;
        }

        .dates-label {
            display: table-cell;
            padding: 3px 6px;
            border: 1px solid #000;
            width: 50%;
            font-weight: 600;
        }

        .dates-value {
            display: table-cell;
            padding: 3px 6px;
            border: 1px solid #000;
        }

        .important-box {
            margin: 8px 0;
            padding: 6px;
            border: 1.5px solid #000;
            /* background-color: #fff; */
        }

        .important-title {
            font-size: 8pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .important-box ol {
            margin: 5px 0;
            padding-left: 15px;
            font-size: 6pt;
        }

        .important-box li {
            margin: 3px 0;
            line-height: 1.2;
        }

        .end-line {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            font-size: 7pt;
        }

        .verification-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            margin-top: 15px;
            padding: 0;
        }

        .verification-pdf {
            font-size: 7.5pt;
            line-height: 1.35;
            color: #000;
            text-align: left;
            margin-bottom: 8px;
        }

        .verification-pdf-title {
            margin: 0 0 5px 0;
            font-weight: bold;
        }

        .verification-pdf-url {
            margin: 0 0 8px 0;
            font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
            font-size: 7pt;
            word-break: break-all;
        }

        .verification-pdf-layout {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .verification-pdf-qr-cell {
            width: 72px;
            padding: 0 10px 0 0;
            vertical-align: top;
        }

        .verification-pdf-text-cell {
            vertical-align: top;
            text-align: justify;
            font-size: 7.5pt;
            line-height: 1.35;
        }

        .verification-pdf-text-cell p {
            margin: 0;
        }

        .footer-divider {
            height: 1px;
            background: #000;
            margin: 8px 0 6px 0;
            opacity: 0.25;
        }

        .website-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
            margin: 5px 0;
            font-size: 7pt;
        }

        .social-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 5px;
        }

        .social-handle {
            font-size: 7pt;
            color: #000;
            margin-left: 2px;
        }

        .social-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #333;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10pt;
            font-weight: bold;
            line-height: 1;
        }

        .social-icon.instagram {
            font-size: 12pt;
        }

        .social-icon.twitter {
            font-size: 11pt;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    @php
        $citizenship = $student->nationality ?: ($student->country ?? 'N/A');
        $dob = $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : 'N/A';
        $refNo = $student->application_number ?? ('RADOM/' . $student->id);
        $barcodeCode = trim($student->student_number ?? ($student->application_number ?? '')) ?: 'RADOM-' . $student->id . '-' . now()->format('Ymd');
        $barcodeBase64 = '';
        try {
            $barcodePng = (new \Picqer\Barcode\BarcodeGeneratorPNG())->getBarcode(
                $barcodeCode,
                \Picqer\Barcode\BarcodeGenerator::TYPE_CODE_128,
                1,
                22,
                [26, 39, 68],
            );
            $barcodeBase64 = base64_encode($barcodePng);
        } catch (\Throwable $e) {
            // fallback - barcode hidden
        }
    @endphp

    <div class="letter-meta">
        Płock, Poland, {{ now()->format('d.m.Y') }}<br>
        Reference no: {{ $refNo }}<br>
        @if ($barcodeBase64)
            <img src="data:image/png;base64,{{ $barcodeBase64 }}" alt="Barcode"
                style="max-width: 110px; height: auto; max-height: 28px; display: inline-block; margin-top: 4px;" />
        @endif
    </div>

    <div class="university-name">Radom University</div>
    <div class="document-title">Conditional Scholarship Acceptance Letter</div>

    <div class="applicant-lines">
        <div><strong>Family name:</strong> {{ $student->last_name }}</div>
        <div><strong>First name:</strong> {{ $student->first_name }}</div>
        <div><strong>Citizenship:</strong> {{ $citizenship }}</div>
        <div><strong>Date of birth:</strong> {{ $dob }}</div>
        <div><strong>Passport:</strong> {{ $student->passport_number ?? 'N/A' }}</div>
    </div>

    <!-- Document Title -->

    <!-- Greeting -->

    <!-- Introduction Content -->
    <div class="content">
        <p style="font-size: 9pt; font-weight: bold; color: #1a2744; margin-bottom: 6px;">
            Congratulations!
        </p>
        <p>
            Your application to RADOM UNIVERSITY for the
            {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }} academic year Fall semester has been
            successfully approved. We are excited for you to be a member of the RADOM UNIVERSITY and to join a
            dynamic and diverse student community in a place of endless opportunities. This letter is to confirm
            your conditional acceptance into
            <strong>{{ strtoupper($student->application->program?->name ?? 'N/A') }}</strong>
            {{ $student->application->program?->degree?->name ?? 'N/A' }} degree program under the
            <strong>{{ $student->application->program?->faculty?->name ?? 'N/A' }}</strong>.
            The duration of the program is
            {{ $student->application->program?->degree?->duration ?? 'N/A' }} years, and the medium of
            instruction is {{ $student->study_language === 'EN' ? 'English' : 'Turkish' }}.
        </p>
    </div>

    <br>
    <!-- Applicant and Program Details -->

    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">Application Number</div>
            <div class="info-value">{{ $student->application_number ?? 'N/A' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Full Name</div>
            <div class="info-value">{{ tr_upper($student->first_name . ' ' . $student->last_name) }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Date of Birth</div>
            <div class="info-value">{{ $student->date_of_birth ? $student->date_of_birth->format('d/m/Y') : 'N/A' }}
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Program</div>
            <div class="info-value">{{ $student->application->program?->name ?? 'N/A' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Degree and Duration</div>
            <div class="info-value">{{ $student->application->program?->degree?->name ?? 'N/A' }} -
                {{ $student->application->program?->degree?->duration ?? 'N/A' }} Academic Years
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Faculty</div>
            <div class="info-value">{{ $student->application->program?->faculty?->name ?? 'N/A' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Education Language</div>
            <div class="info-value">{{ $student->study_language === 'EN' ? 'English' : 'Turkish' }}</div>
        </div>
    </div>

    <br>
    <!-- Tuition Fee -->

    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">Annual Program Tuition Fee</div>
            <div class="info-value"><strong>4000 EUR</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tuition Fee with Discount</div>
            <div class="info-value"><strong>185 EUR</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Scholarship</div>
            <div class="info-value"><strong>100%</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Amount of Deposit Payment</div>
            <div class="info-value"><strong>185 EUR</strong></div>
        </div>
    </div>
    <br>
    <!-- Payment Table -->
    <table class="payment-table">
        <thead>
            <tr>
                <th>PAYMENT INFORMATION</th>
                <th>EURO ACCOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>BANK NAME</strong></td>
                <td>Santander Bank Polska S.A.</td>
            </tr>
            <tr>
                <td><strong>CITY / COUNTRY</strong></td>
                <td>Warszawa - Poland</td>
            </tr>
            <tr>
                <td><strong>ACCOUNT NAME</strong></td>
                <td>MAZOVIA.UNIV OF SCI AND TECH.SP.ZOO</td>
            </tr>
            <tr>
                <td><strong>IBAN</strong></td>
                <td>PL13109010140000071219812874</td>
            </tr>
            <tr>
                <td><strong>SWIFT CODE</strong></td>
                <td>WBKPPLPP</td>
            </tr>
            <tr>
                <td><strong>DEPOSIT AMOUNT</strong></td>
                <td>1000 EUR</td>
            </tr>
        </tbody>
    </table>

    <!-- English Language Proficiency Requirements -->
    {{-- <div class="section-header">English Language Proficiency Requirements</div>

    <table class="proficiency-table">
        <thead>
            <tr>
                <th style="width: 18%;">Test Name</th>
                <th style="width: 20%;">Requirement Level 1</th>
                <th style="width: 20%;">Requirement Level 2</th>
                <th style="width: 20%;">Requirement Level 3</th>
                <th style="width: 18%;">Requirement Level 4</th>
                <th style="width: 10%;">Validity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>PTE Academic</strong><br>(Pearson Test of English Academic)</td>
                <td>At least 69 overall with a minimum of 59 in all communicative skills.</td>
                <td>At least 69 overall with a minimum of 62 in all communicative skills.</td>
                <td>At least 76 overall with a minimum of 62 in all communicative skills.</td>
                <td>At least 80 overall with a minimum of 80 in all communicative skills.</td>
                <td>Two calendar years</td>
            </tr>
            <tr>
                <td><strong>TOEFL iBT</strong><br>(including Home Edition)</td>
                <td>At least 90 overall with minimum scores of 17 for writing, 17 for listening, 18 for reading, and 20
                    for speaking.</td>
                <td>At least 90 overall with a minimum of 20 in each subskill.</td>
                <td>At least 100 overall with a minimum of 20 in each subskill.</td>
                <td>At least 109 overall with a minimum of 26 in speaking and 24 in all other subskills.</td>
                <td>Two calendar years</td>
            </tr>
            <tr>
                <td><strong>IELTS (Academic)</strong><br>test from a recognized IELTS test centre (including one skill
                    retake).</td>
                <td>At least 6.5 overall with a minimum of 5.5 in each subskill.</td>
                <td>At least 6.5 overall with a minimum of 6.0 in each subskill.</td>
                <td>At least 7.0 overall with at least 6.0 in each subskill.</td>
                <td>At least 7.5 overall with at least 7.5 in each subskill.</td>
                <td>Two calendar years</td>
            </tr>
        </tbody>
    </table> --}}

    <br>
    <br>
    <!-- Conditional Acceptance Notice -->
    <div class="section-header">Scholarship Confirmation and Enrollment Steps</div>
    <div class="content">
        <p>
            This document confirms your <strong>scholarship-based acceptance</strong> to the program listed above.
            To finalize your enrollment, please complete all required admission procedures, including document
            verification and payment-related steps communicated by the International Admissions Office.
            After successful completion of these steps, your admission process will proceed to the final stage in
            accordance with university regulations.
        </p>
    </div>

    <!-- Additional Information -->
    <div class="content">
        <p>
            For inquiries regarding application, payment, registration, etc., please contact us at:
            <strong>international@radomuniversity.pl</strong>
        </p>
    </div>

    <!-- Closing -->
    <div class="closing-section">
        <p>Sincerely,</p>
        <p><strong>International Admissions Office</strong></p>
    </div>


    <!-- Footer Section -->
    <div class="verification-footer">
        @php
            $verificationCodeForUrl = $verificationCode ?? null;
            $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
            $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                ->size(70)
                ->generate($verificationUrl);
            $qrCodeBase64 = base64_encode($qrCode);
        @endphp
        <div class="verification-pdf">
            <p class="verification-pdf-title">Check the authenticity of this document:</p>
            <p class="verification-pdf-url">{{ $verificationUrl }}</p>
            <table class="verification-pdf-layout">
                <tr>
                    <td class="verification-pdf-qr-cell">
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                            style="width: 64px; height: 64px; display: block;" />
                    </td>
                    <td class="verification-pdf-text-cell">
                        <p>
                            Scan the QR code or open the link manually in order to check for authenticity of this
                            document. When prompted, type this 4-digit code:
                            <strong>{{ $codeForEntry }}</strong>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Divider Line -->
        <div class="footer-divider"></div>

        <!-- Footer Bottom Section -->
        <div style="font-size: 5.5pt; line-height: 1.2; color: #555; text-align: center; margin-top: 4px;">
            <p style="margin: 1px 0;">
                <strong>Tel:</strong> +48 579 277 493 |
                <strong>Email:</strong> international@radomuniversity.pl |
                <strong>Address:</strong> Aleja Józefa Piłsudskiego 35, 09-407 Płock / Poland |
            </p>
        </div>

    </div>

</body>

</html>
