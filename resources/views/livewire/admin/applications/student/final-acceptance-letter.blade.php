<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Certificate - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 12mm 12mm 12mm 12mm;
            size: A4;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 8.6pt;
            line-height: 1.38;
            color: #1f2937;
            padding-bottom: 46mm;
        }

        .document {
            width: 100%;
        }

        .top-band {
            height: 5px;
            background: #7c2d12;
            margin-bottom: 8px;
        }

        .header {
            margin-bottom: 12px;
        }

        .header-left,
        .header-right {
            display: inline-block;
            vertical-align: top;
            width: 49%;
        }

        .header-right {
            text-align: right;
            font-size: 7.2pt;
            color: #475569;
        }

        .brand-name {
            font-size: 15pt;
            font-weight: bold;
            letter-spacing: 0.5px;
            color: #0f172a;
            line-height: 1;
        }

        .brand-sub {
            font-size: 8pt;
            color: #64748b;
            margin-top: 3px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero {
            margin-top: 6px;
            margin-bottom: 12px;
            border-top: 1px solid #cbd5e1;
            border-bottom: 1px solid #cbd5e1;
            padding: 10px 0;
        }

        .hero-title {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #111827;
            margin: 0 0 4px 0;
            letter-spacing: 1px;
        }

        .hero-subtitle {
            font-size: 9pt;
            color: #475569;
            margin: 0;
        }

        .identity {
            margin-bottom: 10px;
        }

        .identity-left,
        .identity-right {
            display: inline-block;
            vertical-align: top;
        }

        .identity-left {
            width: 78%;
        }

        .identity-right {
            width: 20%;
            text-align: right;
        }

        .identity-line {
            margin-bottom: 4px;
            font-size: 8.1pt;
        }

        .label {
            color: #64748b;
            width: 150px;
            display: inline-block;
            text-transform: uppercase;
            font-size: 7pt;
            letter-spacing: 0.5px;
        }

        .value {
            color: #111827;
            font-weight: bold;
        }

        .photo {
            width: 94px;
            height: 114px;
            border: none !important;
            background: none !important;
            overflow: hidden;
            text-align: center;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-empty {
            line-height: 114px;
            font-size: 7.2pt;
            color: #94a3b8;
        }

        .card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #1d4ed8;
            padding: 9px 10px;
            margin-bottom: 10px;
        }

        .card-title {
            margin: 0 0 5px 0;
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #1e3a8a;
            letter-spacing: 0.4px;
        }

        .program-title {
            margin: 0;
            font-size: 10.2pt;
            font-weight: bold;
            color: #111827;
        }

        .program-meta {
            margin: 5px 0 0 0;
            font-size: 8pt;
            color: #334155;
        }

        .statement {
            margin: 8px 0 12px 0;
            font-size: 8.2pt;
            text-align: justify;
            line-height: 1.48;
        }

        .statement p {
            margin: 0 0 6px 0;
        }

        .statement p:last-child {
            margin-bottom: 0;
        }

        .signature {
            margin-top: 12px;
            text-align: right;
            position: relative;
            min-height: 66px;
        }

        .stamp {
            position: absolute;
            right: 8px;
            top: 3px;
            width: 75px;
            opacity: 0.8;
        }

        .sign-name {
            position: relative;
            z-index: 1;
            font-size: 8.2pt;
            font-weight: bold;
            color: #0f172a;
        }

        .sign-title {
            position: relative;
            z-index: 1;
            font-size: 7.2pt;
            color: #64748b;
            margin-top: 2px;
        }

        .verify {
            position: fixed;
            left: 12mm;
            right: 12mm;
            bottom: 0;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            font-size: 7.2pt;
            background: #fff;
        }

        .verify-title {
            margin: 0 0 4px 0;
            font-weight: bold;
            color: #0f172a;
        }

        .verify-url {
            margin: 0 0 5px 0;
            font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
            font-size: 6.4pt;
            word-break: break-all;
        }

        .verify-left,
        .verify-right {
            display: inline-block;
            vertical-align: top;
        }

        .verify-left {
            width: 70px;
        }

        .verify-right {
            width: 82%;
            font-size: 7pt;
            line-height: 1.35;
            text-align: justify;
            color: #334155;
        }

        .verify-code {
            display: block;
            margin-top: 4px;
        }

        .address {
            margin-top: 7px;
            font-size: 5.8pt;
            text-align: center;
            color: #64748b;
            line-height: 1.25;
        }

        .address p {
            margin: 1px 0;
        }
    </style>
</head>

<body>
    @php
        use Illuminate\Support\Facades\Storage;

        $program = $student->application?->program;
        $degree = $program?->degree;
        $faculty = $program?->faculty;

        $programName = strtoupper($program?->name ?? 'N/A');
        $degreeName = strtoupper($degree?->description ?? ($degree?->name ?? 'N/A'));
        $facultyName = strtoupper($faculty?->name ?? 'GRADUATE SCHOOL');

        $studyLanguage = strtoupper($student->study_language ?? 'EN');
        $studyLanguageLabel = 'English'

        $nationality = strtoupper($student->nationality ?? 'N/A');
        $placeOfBirth = strtoupper($student->place_of_birth ?? ($student->nationality ?? 'N/A'));
        $educationType = 'On-site Education';
        $classYear = $student->current_course ?? 1;
        $classLabel = "Freshman ({$classYear} Grade)";
        $scholarshipStatus = $student->scholarship_status . ' Scholarship' ?? '75% Scholarship';

        $startYear = $student->graduation_year ?? now()->year;
        $endYear = $startYear + 1;
        $academicYear = "{$startYear}-{$endYear} academic year";
        $duration = $degree?->duration ?? 4;

        $photoData = null;
        $photoMime = 'image/jpeg';
        if ($student->profile_photo_path && Storage::exists($student->profile_photo_path)) {
            try {
                $photoContent = Storage::get($student->profile_photo_path);
                if ($photoContent) {
                    $photoData = base64_encode($photoContent);
                    $extension = strtolower(pathinfo($student->profile_photo_path, PATHINFO_EXTENSION));
                    $photoMime = match ($extension) {
                        'jpg', 'jpeg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                        'webp' => 'image/webp',
                        default => 'image/jpeg',
                    };
                }
            } catch (\Exception $e) {
            }
        }

        $stampPath = public_path('images/radom-möhür.png');
        $stampData = file_exists($stampPath) ? base64_encode(file_get_contents($stampPath)) : '';

        $verificationCodeForUrl = $verificationCode ?? null;
        $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
        $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '-';
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(70)->generate($verificationUrl);
        $qrCodeBase64 = base64_encode($qrCode);
    @endphp

    <div class="document">
        <div class="top-band"></div>

        <div class="header">
            <div class="header-left">
                <div class="brand-name">RADOM UNIVERSITY</div>
                <div class="brand-sub">Student Affairs Department</div>
            </div>
            <div class="header-right">
                <div>Issue date: {{ now()->format('d/m/Y') }}</div>
                <div>Reference no:
                    {{ $student->application_number ?? now()->format('d/m/Y') }}/{{ str_pad($student->id, 3, '0', STR_PAD_LEFT) }}
                </div>
            </div>
        </div>

        <div class="hero">
            <h1 class="hero-title">Student Certificate</h1>
            <p class="hero-subtitle">Confirmation of student status and registration details</p>
        </div>

        <div class="identity">
            <div class="identity-left">
                <div class="identity-line"><span class="label">Student number</span> <span
                        class="value">{{ $student->student_number ?? $student->id }}</span></div>
                <div class="identity-line"><span class="label">Passport no</span> <span
                        class="value">{{ $student->passport_number ?? 'N/A' }}</span></div>
                <div class="identity-line"><span class="label">Name and surname</span> <span
                        class="value">{{ tr_upper($student->first_name) }} {{ tr_upper($student->last_name) }}</span>
                </div>
                <div class="identity-line"><span class="label">Father's name</span> <span
                        class="value">{{ tr_upper($student->father_name ?? 'N/A') }}</span></div>
                <div class="identity-line"><span class="label">Date of birth</span> <span
                        class="value">{{ $student->date_of_birth ? $student->date_of_birth->format('d.m.Y') : 'N/A' }}</span>
                </div>
                <div class="identity-line"><span class="label">Place of birth</span> <span
                        class="value">{{ $placeOfBirth }}</span></div>
                <div class="identity-line"><span class="label">Nationality</span> <span
                        class="value">{{ $nationality }}</span></div>
                <div class="identity-line"><span class="label">Gender</span> <span
                        class="value">{{ $student->gender ? ucfirst($student->gender) : 'N/A' }}</span></div>
            </div>
            <div class="identity-right">
                <div class="photo">
                    @if ($photoData)
                        <img src="data:{{ $photoMime }};base64,{{ $photoData }}" alt="Student photo">
                    @else
                        <div class="photo-empty">No photo</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <p class="card-title">Program details</p>
            <p class="program-title">{{ $programName }} - {{ $degreeName }}</p>
            <p class="program-meta">
                Institute / Faculty: {{ $facultyName }} |
                Education language: {{ $studyLanguageLabel }} |
                Education type: {{ $educationType }} |
                Scholarship status: {{ $scholarshipStatus }} |
                Class: {{ $classLabel }} |
                Academic year: {{ $academicYear }}
            </p>
        </div>

        <div class="statement">
            <p>The person identified in this document is a registered student of RADOM UNIVERSITY and currently holds
                active student status.</p>
            <p>The planned total duration of the program is {{ $duration }} years. Current registration applies for
                the {{ $academicYear }} period.</p>
            <p>According to university regulations, the student is required to fulfill curriculum obligations, attend
                classes regularly, and complete required assessments and examinations.</p>
            <p>This certificate is issued upon the request of the relevant person solely for confirmation of student
                status.</p>
        </div>

        <div class="signature">
            @if ($stampData)
                <img class="stamp" src="data:image/png;base64,{{ $stampData }}" alt="Stamp">
            @endif
            <div class="sign-name">Michał Kowalski</div>
            <div class="sign-title">Director of Student Affairs
            </div>
        </div>

        <div class="verify">
            <p class="verify-title">Check the authenticity of this document</p>
            <p class="verify-url">{{ $verificationUrl }}</p>
            <div class="verify-left">
                <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                    style="width: 64px; height: 64px; display: block;" />
            </div>
            <div class="verify-right">
                Scan the QR code or open the link above. During verification, enter this 4-digit code:
                <strong class="verify-code">{{ $codeForEntry }}</strong>
            </div>

            <div class="address">
                <p>Aleja Jozefa Pilsudskiego 35, 09-407 Plock, Poland</p>
                <p>Radom, Poland</p>
                <p>E-mail: info@radomuniversity.pl | rectorate@radomuniversity.pl</p>
            </div>
        </div>
    </div>
</body>

</html>
