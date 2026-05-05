<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaswiadczenie studenta - {{ $student->first_name }} {{ $student->last_name }}</title>
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
            border: 1px solid #d1d5db;
            background: #f8fafc;
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

        $educationTypePl = 'Studia stacjonarne';
        $classYear = $student->current_course ?? 1;
        $classPl = "Etap zajec ({$classYear}. rok studiow)";

        $scholarshipStatus = $student->scholarship_status ?? '75%';
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
        $academicYearPl = "Rok akademicki {$startYear}-{$endYear}";
        $duration = $degree?->duration ?? 4;
        $durationPl = $duration === 1 ? 'rok' : ($duration < 5 ? 'lata' : 'lat');

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
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(70)
            ->generate($verificationUrl);
        $qrCodeBase64 = base64_encode($qrCode);
    @endphp

    <div class="document">
        <div class="top-band"></div>

        <div class="header">
            <div class="header-left">
                <div class="brand-name">RADOM UNIVERSITY</div>
                <div class="brand-sub">Biuro spraw studenckich</div>
            </div>
            <div class="header-right">
                <div>Data wydania: {{ now()->format('d/m/Y') }}</div>
                <div>Numer referencyjny: {{ $student->application_number ?? now()->format('d/m/Y') }}/{{ str_pad($student->id, 3, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <div class="hero">
            <h1 class="hero-title">Zaswiadczenie studenta</h1>
            <p class="hero-subtitle">Potwierdzenie statusu studenta i danych rejestracyjnych</p>
        </div>

        <div class="identity">
            <div class="identity-left">
                <div class="identity-line"><span class="label">Imie i nazwisko</span> <span class="value">{{ strtoupper($student->first_name) }} {{ strtoupper($student->last_name) }}</span></div>
                <div class="identity-line"><span class="label">Numer dokumentu</span> <span class="value">{{ $student->passport_number ?? ($student->student_number ?? 'N/A') }}</span></div>
                <div class="identity-line"><span class="label">Imie ojca</span> <span class="value">{{ strtoupper($student->father_name ?? 'N/A') }}</span></div>
                <div class="identity-line"><span class="label">Data urodzenia</span> <span class="value">{{ $student->date_of_birth ? $student->date_of_birth->format('d.m.Y') : 'N/A' }}</span></div>
                <div class="identity-line"><span class="label">Miejsce urodzenia</span> <span class="value">{{ $placeOfBirthDisplay }}</span></div>
                <div class="identity-line"><span class="label">Obywatelstwo</span> <span class="value">{{ $nationalityDisplay }}</span></div>
                <div class="identity-line"><span class="label">Plec</span> <span class="value">{{ $student->gender ? (strtolower($student->gender) === 'male' ? 'Mezczyzna' : (strtolower($student->gender) === 'female' ? 'Kobieta' : ucfirst($student->gender))) : 'N/A' }}</span></div>
            </div>
            <div class="identity-right">
                <div class="photo">
                    @if ($photoData)
                        <img src="data:{{ $photoMime }};base64,{{ $photoData }}" alt="Zdjecie studenta">
                    @else
                        <div class="photo-empty">Brak zdjecia</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <p class="card-title">Dane programu</p>
            <p class="program-title">{{ $programNamePl }} - {{ $degreeNamePl }}</p>
            <p class="program-meta">
                Jednostka akademicka: {{ $facultyNamePl }} |
                Jezyk nauczania: {{ $studyLangDisplay }} |
                Typ edukacji: {{ $educationTypePl }} |
                Status stypendium: {{ $scholarshipPl }} |
                Rok studiow: {{ $classPl }} |
                Rok akademicki: {{ $academicYearPl }}
            </p>
        </div>

        <div class="statement">
            <p>Osoba wskazana w niniejszym dokumencie jest zarejestrowanym studentem RADOM UNIVERSITY i posiada aktywny status studenta.</p>
            <p>Planowany laczny okres trwania programu wynosi {{ $duration }} {{ $durationPl }}. Aktualna rejestracja dotyczy okresu akademickiego {{ $startYear }}-{{ $endYear }}.</p>
            <p>Zgodnie z regulaminem studiow uczelni student ma obowiazek realizowac wymagania programowe, uczestniczyc w zajeciach oraz przystepowac do zaliczen i egzaminow zgodnie z harmonogramem.</p>
            <p>Niniejsze zaswiadczenie wydano na wniosek osoby zainteresowanej wyłącznie w celu potwierdzenia statusu studenta.</p>
        </div>

        <div class="signature">
            @if ($stampData)
                <img class="stamp" src="data:image/png;base64,{{ $stampData }}" alt="Pieczec">
            @endif
            <div class="sign-name">Prof. Dr. hab. Tomasz Zelazowski-Krepski</div>
            <div class="sign-title">Rektor</div>
        </div>

        <div class="verify">
            <p class="verify-title">Weryfikacja autentycznosci dokumentu</p>
            <p class="verify-url">{{ $verificationUrl }}</p>
            <div class="verify-left">
                <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                    style="width: 64px; height: 64px; display: block;" />
            </div>
            <div class="verify-right">
                Zeskanuj kod QR lub otworz powyzszy link. Podczas weryfikacji wpisz 4-cyfrowy kod:
                <strong class="verify-code">{{ $codeForEntry }}</strong>
            </div>

            <div class="address">
                <p>Aleja Jozefa Pilsudskiego 35, 09-407 Plock, Poland</p>
                <p>Tel: +48 579 277 493</p>
                <p>E-mail: info@radomuniversity.pl | rectorate@radomuniversity.pl</p>
            </div>
        </div>
    </div>
</body>

</html>
