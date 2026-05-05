<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaświadczenie studenckie - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 8mm 10mm 8mm 10mm;
            size: A4;
        }

        body {
            font-family: 'DejaVu Sans', 'Helvetica', Arial, sans-serif;
            font-size: 8.5pt;
            line-height: 1.25;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            padding-bottom: 130px;
            background: #fff;
            position: relative;
            min-height: 100vh;
        }

        /* Watermark */
        body::before {
            content: 'Radom University';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-family: Georgia, 'DejaVu Serif', 'Times New Roman', serif;
            font-size: 40pt;
            font-weight: bold;
            color: #1a2744;
            opacity: 0.05;
            z-index: -1;
            pointer-events: none;
            white-space: nowrap;
            letter-spacing: 0.06em;
        }

        /* ── Header ── */
        .header-wrapper {
            border-bottom: 2px solid #1a2744;
            padding-bottom: 6px;
            margin-bottom: 8px;
        }

        .header-top-accent {
            height: 3px;
            background: linear-gradient(90deg, #1a2744 0%, #c5a55a 50%, #1a2744 100%);
            margin-bottom: 6px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo-cell {
            width: 92px;
            text-align: left;
            vertical-align: middle;
        }

        .logo {
            max-width: 22mm;
            height: auto;
        }

        .brand-wordmark-compact {
            line-height: 1.05;
        }

        .brand-wordmark-compact .brand-wordmark-primary {
            display: block;
            font-family: Georgia, 'DejaVu Serif', 'Times New Roman', serif;
            font-size: 11pt;
            font-weight: bold;
            color: #1a2744;
            letter-spacing: 0.1em;
        }

        .brand-wordmark-compact .brand-wordmark-secondary {
            display: block;
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 6pt;
            font-weight: normal;
            color: #3d5a80;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .title-cell {
            text-align: center;
            padding: 0 10px;
        }

        .university-name {
            font-size: 12pt;
            font-weight: normal;
            color: #1a2744;
            letter-spacing: 0.6px;
            margin: 0;
        }

        .department-name {
            font-size: 7.5pt;
            color: #555;
            margin-top: 3px;
            letter-spacing: 0.5px;
        }

        .date-barcode-cell {
            width: 120px;
            text-align: right;
            vertical-align: middle;
        }

        .date-barcode-cell .barcode-wrap {
            margin-bottom: 4px;
            display: inline-block;
            line-height: 0;
        }

        .date-barcode-cell .barcode-wrap img {
            max-width: 110px;
            height: auto;
            max-height: 28px;
        }

        .date-barcode-cell .date-text {
            font-size: 7.5pt;
            color: #444;
        }

        .ref-number {
            font-size: 6.5pt;
            color: #555;
            text-align: right;
            margin-bottom: 4px;
        }

        /* ── Document Title (Bilingual) ── */
        .document-title {
            text-align: center;
            margin: 8px 0 6px 0;
        }

        .document-title h1 {
            font-size: 10pt;
            font-weight: bold;
            color: #1a2744;
            letter-spacing: 1px;
            margin: 0;
            padding: 6px 0;
            display: inline-block;
            border-bottom: 2px solidrgb(27, 84, 205);
        }

        /* ── Student Info (Bilingual labels) ── */
        .content-wrapper {
            display: table;
            width: 100%;
            margin: 0;
            border-spacing: 15px 0;
        }

        .info-cell {
            display: table-cell;
            vertical-align: top;
            width: auto;
        }

        .photo-cell {
            display: table-cell;
            vertical-align: top;
            width: 110px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7pt;
            line-height: 1.2;
        }

        .info-table td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .info-table .label-col {
            font-weight: bold;
            color: #1a2744;
            width: 42%;
            white-space: normal;
            font-size: 6.5pt;
        }

        .info-table .value-col {
            color: #222;
        }

        /* ── Photo ── */
        .photo-frame {
            width: 110px;
            height: 130px;
            border: none;
            border-radius: 0;
            overflow: hidden;
            background-color: transparent;
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            font-size: 9pt;
        }

        /* ── Body Text (Bilingual) ── */
        .body-text {
            margin-top: 5px;
            font-size: 7pt;
            line-height: 1;
            color: #222;
            text-align: justify;
            padding: 0 2px;
        }

        .body-text .pl {
            margin-bottom: 2px;
        }

        .body-text .en {
            font-style: italic;
            color: #444;
            margin-bottom: 2px;
        }

        /* ── Signature + Stamp ── */
        .signature-stamp-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .signature-stamp-table td {
            vertical-align: bottom;
        }

        .sig-cell {
            position: relative;
            text-align: right;
            padding: 6px 20px 8px 20px;
            min-height: 52px;
        }

        .sig-stamp-overlay {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-58%);
            width: 72px;
            height: auto;
            max-height: 76px;
            object-fit: contain;
            opacity: 0.82;
            z-index: 2;
            pointer-events: none;
        }

        .sig-cell .sig-name {
            position: relative;
            z-index: 1;
            font-weight: bold;
            font-size: 8pt;
            color: #1a2744;
        }

        .sig-cell .sig-title {
            position: relative;
            z-index: 1;
            font-size: 7.5pt;
            color: #555;
            margin-top: 2px;
        }

        /* ── Verification Footer ── */
        .verification-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0;
        }

        .verification-date {
            font-weight: bold;
            font-size: 6.5pt;
            color: #1a2744;
            margin-bottom: 6px;
        }

        /* Plain verification block (same layout as conditional acceptance letter) */
        .verification-pdf {
            font-size: 7pt;
            line-height: 1.35;
            color: #1a1a1a;
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
            font-size: 6.5pt;
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
            font-size: 7pt;
            line-height: 1.35;
        }

        .verification-pdf-text-cell p {
            margin: 0;
        }

        .verification-pdf-text-cell p + p {
            margin-top: 5px;
        }

        .verification-pdf-text-cell .en {
            font-style: italic;
            color: #444;
        }

        .bottom-divider {
            height: 1px;
            background: #000;
            margin: 8px 0 6px 0;
            opacity: 0.25;
        }

        .address-block {
            font-size: 5.5pt;
            line-height: 1.2;
            color: #555;
            text-align: center;
        }

        .address-block p {
            margin: 1px 0;
        }

        .address-block .institution-line {
            font-weight: bold;
            color: #1a2744;
            font-size: 6.5pt;
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
        use Illuminate\Support\Facades\Storage;

        $program = $student->application?->program;
        $degree = $program?->degree;
        $faculty = $program?->faculty;

        $programNameEn = $program?->getName('EN') ?: $program?->name ?? 'N/A';
        $programNamePl = $program?->getName('PL') ?: $programNameEn;
        $degreeNameEn = $degree?->getName('EN') ?: $degree?->name ?? 'N/A';
        $degreeNamePl = $degree?->getName('PL') ?: $degreeNameEn;
        $facultyNameEn = $faculty?->getName('EN') ?: $faculty?->name ?? 'Institute of Graduate Education';
        $facultyNamePl = $faculty?->getName('PL') ?: $facultyNameEn;

        $studyLangCode = strtoupper($student->study_language ?? 'EN');
        $studyLangEn = match ($studyLangCode) {
            'EN' => 'English',
            'TR' => 'Turkish',
            'PL' => 'Polish',
            default => 'English',
        };
        $studyLangDisplay = language_to_polish($studyLangEn);

        $nationalityDisplay = nationality_to_polish($student->nationality);
        $placeOfBirthDisplay = nationality_to_polish($student->place_of_birth ?? $student->nationality);

        $educationTypeEn = 'Full time';
        $educationTypePl = 'Studia stacjonarne';

        $classYear = $student->current_course ?? 1;
        $classEn = "Lesson stage ({$classYear}st year)";
        $classPl = "Etap zajęć ({$classYear}. rok studiów)";

        $scholarshipStatus = $student->scholarship_status ?? '75%';
        $scholarshipEn = "{$scholarshipStatus} Scholarship";
        $scholarshipPl = '%50 Stypendium';

        if (str_contains($scholarshipStatus, '100')) {
            $scholarshipPl = '100% Stypendium';
        } elseif (str_contains($scholarshipStatus, '75')) {
            $scholarshipPl = '%75 Stypendium';
        } elseif (str_contains($scholarshipStatus, '50')) {
            $scholarshipPl = '%50 Stypendium';
        } else {
            $scholarshipPl = $scholarshipStatus . ' Stypendium';
        }

        $startYear = $student->graduation_year ?? now()->year;
        $endYear = $startYear + 1;
        $academicYearEn = "{$startYear}-{$endYear} academic year";
        $academicYearPl = "Rok akademicki {$startYear}-{$endYear}";
    @endphp

    <!-- Top Accent Line -->
    <div class="header-top-accent"></div>
    <!-- Header -->
    <div class="header-wrapper">
        <div class="ref-number">
            Numer referencyjny / Reference No:
            {{ $student->application_number ?? now()->format('d/m/Y') }}/{{ str_pad($student->id, 3, '0', STR_PAD_LEFT) }}
        </div>
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div class="brand-wordmark-compact">
                        <span class="brand-wordmark-primary">Radom</span>
                        <span class="brand-wordmark-secondary">University</span>
                    </div>
                </td>
                <td class="title-cell">
                    <div class="university-name">
                        RADOM UNIVERSITY
                    </div>
                    <div class="department-name">
                        Wydział Spraw Studenckich / Office of Student Affairs
                    </div>
                </td>
                <td class="date-barcode-cell">
                    @php
                        $barcodeCode =
                            trim($student->student_number ?? ($student->application_number ?? '')) ?:
                            'RADOM-' . $student->id . '-' . now()->format('Ymd');
                        $barcodeBase64 = '';
                        try {
                $barcodePng = (new \Picqer\Barcode\BarcodeGeneratorPNG())
                    ->getBarcode($barcodeCode, \Picqer\Barcode\BarcodeGenerator::TYPE_CODE_128, 1, 22, [26, 39, 68]);
                $barcodeBase64 = base64_encode($barcodePng);
                        } catch (\Throwable $e) {
                            // fallback - barcode hidden
                        }
                    @endphp
                    @if ($barcodeBase64)
                        <div class="barcode-wrap">
                            <img src="data:image/png;base64,{{ $barcodeBase64 }}" alt="Barcode"
                                style="max-width: 110px; height: auto; max-height: 28px; display: block;" />
                        </div>
                    @endif
                    <div class="date-text">{{ now()->format('d/m/Y') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Document Title (Bilingual) -->
    <div class="document-title">
        <h1>ZAŚWIADCZENIE STUDENCKIE | CERTIFICATE OF STUDENT STATUS</h1>
    </div>

    <!-- Student Information (Bilingual: PL / EN) -->
    <div class="content-wrapper">
        <div class="info-cell">
            <table class="info-table">
                <tr>
                    <td class="label-col">Numer dokumentu tożsamości / ID card number</td>
                    <td class="value-col">{{ $student->passport_number ?? ($student->student_number ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <td class="label-col">Imię i nazwisko / Name - surname</td>
                    <td class="value-col">{{ strtoupper($student->first_name) }} {{ strtoupper($student->last_name) }}
                    </td>
                </tr>
                <tr>
                    <td class="label-col">Imię ojca / Father name</td>
                    <td class="value-col">{{ strtoupper($student->father_name ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <td class="label-col">Obywatelstwo / Nationality</td>
                    <td class="value-col">{{ $nationalityDisplay }}</td>
                </tr>
                <tr>
                    <td class="label-col">Płeć / Gender</td>
                    <td class="value-col">
                        {{ $student->gender ? (strtolower($student->gender) === 'male' ? 'Mężczyzna / Male' : (strtolower($student->gender) === 'female' ? 'Kobieta / Female' : ucfirst($student->gender))) : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <td class="label-col">Data urodzenia / Date of birth</td>
                    <td class="value-col">
                        {{ $student->date_of_birth ? $student->date_of_birth->format('d.m.Y') : 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label-col">Miejsce urodzenia / Place of birth</td>
                    <td class="value-col">{{ $placeOfBirthDisplay }}</td>
                </tr>
                <tr>
                    <td class="label-col">Jednostka akademicka / Academic unit</td>
                    <td class="value-col">Instytut Studiów Podyplomowych (Międzynarodowy) / Institute of Graduate
                        Education (Multinational)</td>
                </tr>
                <tr>
                    <td class="label-col">Program / Program</td>
                    <td class="value-col">{{ $programNamePl }} - {{ $degreeNamePl }} / {{ $programNameEn }} -
                        {{ $degreeNameEn }}</td>
                </tr>
                <tr>
                    <td class="label-col">Rok studiów / Class</td>
                    <td class="value-col">{{ $classPl }} / {{ $classEn }}</td>
                </tr>
                <tr>
                    <td class="label-col">Typ edukacji / Education type</td>
                    <td class="value-col">{{ $educationTypePl }} / {{ $educationTypeEn }}</td>
                </tr>
                <tr>
                    <td class="label-col">Status stypendium / Scholarship status</td>
                    <td class="value-col">{{ $scholarshipPl }} / {{ $scholarshipEn }}</td>
                </tr>
                <tr>
                    <td class="label-col">Język nauczania / Medium of instruction</td>
                    <td class="value-col">{{ $studyLangDisplay }}</td>
                </tr>
                <tr>
                    <td class="label-col">Data rejestracji / Registration date</td>
                    <td class="value-col">{{ now()->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td class="label-col">Rok akademicki / Academic year</td>
                    <td class="value-col">{{ $academicYearPl }} / {{ $academicYearEn }}</td>
                </tr>
                <tr>
                    <td class="label-col">Status studenta / Current status</td>
                    <td class="value-col">Aktywny student / Active student</td>
                </tr>
            </table>
        </div>
        <div class="photo-cell">
            @php
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
            @endphp
            @if ($photoData)
                <div class="photo-frame">
                    <img src="data:{{ $photoMime }};base64,{{ $photoData }}" alt="Student Photo">
                </div>
            @else
                <div class="photo-frame">
                    <div class="photo-placeholder">Brak zdjęcia / No Photo</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Body Text (Bilingual) -->
    <div class="body-text">
        <p class="pl">* Osoba, której dane identyfikacyjne wskazano powyżej, jest studentem naszej uczelni.</p>
        <p class="en">* The person identified above is a student of this university.</p>

        @php
            $duration = $degree?->duration ?? 4;
            $durationPl = $duration === 1 ? 'rok' : ($duration < 5 ? 'lata' : 'lat');
        @endphp
        <p class="pl">* Przewidywany czas trwania programu wynosi {{ $duration }} {{ $durationPl }}.</p>
        <p class="en">* The foreseen duration of education for the programme is {{ $degree?->duration ?? 4 }}
            years.</p>

        <p class="pl">* Zgodnie z odpowiednimi artykułami Regulaminu Studiów Podyplomowych i Egzaminów RADOM, osoby
            zapisane na program muszą w pełni przestrzegać wymagań dotyczących obecności, uczestnictwa i egzaminów na
            zajęciach, aby korzystać z praw studenta. W przeciwnym razie ich rejestracja w programie zostanie anulowana.
        </p>
        <p class="en">* In accordance with the relevant articles of the RADOM Graduate Education and Examination
            Directive, individuals enrolled in the program must fully comply with the attendance, participation, and
            examination requirements for courses in order to benefit from student rights. Otherwise, the individual's
            enrolment in the program shall be terminated.</p>

        <p class="pl">* Oczekuje się, że zainteresowana osoba osiągnie etap ukończenia studiów w roku akademickim
            {{ $startYear }}-{{ $endYear }}.</p>
        <p class="en">* It is expected that the interested person will reach the graduation stage in the
            {{ $startYear }}-{{ $endYear }} academic year.</p>

        <p class="pl">* Niniejsze zaświadczenie wydano na wniosek osoby, której dotyczy.</p>
        <p class="en">* This certificate is issued at the request of the person named herein.</p>
    </div>

    <!-- Signature + Stamp -->
    @php
        $stampPath = public_path('images/radom-möhür.png');
        $stampData = file_exists($stampPath) ? base64_encode(file_get_contents($stampPath)) : '';
    @endphp
    <table class="signature-stamp-table">
        <tr>
            <td class="sig-cell">
                @if ($stampData)
                    <img class="sig-stamp-overlay" src="data:image/png;base64,{{ $stampData }}" alt="RADOM Stamp">
                @endif
                <div class="sig-name">Prof. Dr. hab. Tomasz Żelazowski-Krępski</div>
                <div class="sig-title">Rektor / Rector</div>
            </td>
        </tr>
    </table>

    <!-- Verification Footer -->
    <div class="verification-footer">
        <div class="verification-date">
            Data / Date: {{ now()->format('d/m/Y') }}
        </div>
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
            <p class="verification-pdf-title">Sprawdź autentyczność dokumentu / Check the authenticity of this document:</p>
            <p class="verification-pdf-url">{{ $verificationUrl }}</p>
            <table class="verification-pdf-layout">
                <tr>
                    <td class="verification-pdf-qr-cell">
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                            style="width: 64px; height: 64px; display: block;" />
                    </td>
                    <td class="verification-pdf-text-cell">
                        <p>
                            Zeskanuj kod QR lub otwórz powyższy link, aby zweryfikować autentyczność dokumentu. Po
                            wyświetleniu monitu wpisz 4-cyfrowy kod:
                            <strong>{{ $codeForEntry }}</strong>
                        </p>
                        <p class="en">
                            Scan the QR code or open the link manually in order to check for authenticity of this
                            document. When prompted, type this 4-digit code:
                            <strong>{{ $codeForEntry }}</strong>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="bottom-divider"></div>
        <div class="address-block">
            <p>Aleja Józefa Piłsudskiego 35, 09-407 Płock, Poland</p>
            <p style="margin-top: 3px;"><strong>Tel:</strong> +48 579 277 493</p>
            <p><strong>E-mail:</strong> info@radomuniversity.pl | rectorate@radomuniversity.pl</p>
        </div>
    </div>

</body>

</html>
