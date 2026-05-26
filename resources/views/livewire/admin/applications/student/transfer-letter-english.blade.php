<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transfer Certificate - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 10mm 12mm;
            size: A4 portrait;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 8.25pt;
            line-height: 1.5;
            color: #222;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .page-sheet {
            width: 100%;
            padding: 2mm 0 0 0;
            min-height: 275mm;
        }

        .navy {
            color: #1a237e;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .header-table td {
            vertical-align: top;
            padding: 0;
        }

        .uni-name {
            font-family: 'DejaVu Serif', Georgia, serif;
            font-size: 14pt;
            font-weight: bold;
            color: #1a237e;
            letter-spacing: 0.04em;
            margin: 0 0 3px 0;
            line-height: 1.22;
            text-transform: uppercase;
        }

        .uni-name-sub {
            font-family: 'DejaVu Serif', Georgia, serif;
            font-size: 11pt;
            font-weight: bold;
            color: #1a237e;
            letter-spacing: 0.03em;
            margin: 0 0 5px 0;
            line-height: 1.22;
            text-transform: uppercase;
        }

        .uni-address {
            font-size: 7.5pt;
            color: #444;
            line-height: 1.45;
            margin: 0;
        }

        .header-vdivider {
            width: 1px;
            background: #ccc;
            padding: 0 !important;
        }

        .header-vdivider-inner {
            width: 1px;
            min-height: 58px;
            background: #ccc;
            margin: 0 auto;
        }

        .office-block {
            font-size: 7.5pt;
            line-height: 1.52;
            color: #333;
            padding-left: 8px;
        }

        .office-block .office-title {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #1a237e;
            margin-bottom: 4px;
            font-size: 7.25pt;
            line-height: 1.4;
        }

        .header-verify-cell {
            vertical-align: top;
            padding-left: 6px;
        }

        .header-verification-box {
            border: 1px solid #999;
            padding: 5px 6px;
            font-size: 6pt;
            line-height: 1.35;
        }

        .header-verification-box h4 {
            margin: 0 0 4px 0;
            font-size: 6.35pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            text-align: center;
            color: #1a237e;
        }

        .header-verification-inner {
            width: 100%;
            border-collapse: collapse;
        }

        .header-verification-inner td {
            vertical-align: top;
            padding: 0;
        }

        .header-verification-inner .qr-cell {
            width: 46px;
            padding-right: 5px;
        }

        .header-verification-inner .qr-cell img {
            width: 44px;
            height: 44px;
            display: block;
        }

        .header-verification-url {
            word-break: break-all;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 5.25pt;
            color: #1a237e;
            margin-top: 2px;
        }

        .header-rule {
            border: none;
            border-top: 2.5px solid #1a237e;
            margin: 10px 0 12px 0;
        }

        .meta-row-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            font-size: 8pt;
            line-height: 1.45;
        }

        .meta-row-table td {
            padding: 0;
            vertical-align: top;
        }

        .meta-right {
            text-align: right;
        }

        .doc-title {
            text-align: center;
            margin: 0 0 6px 0;
        }

        .doc-title .pl {
            font-family: 'DejaVu Serif', Georgia, serif;
            font-size: 11.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a237e;
            margin: 0;
            line-height: 1.28;
        }

        .doc-title .en {
            font-family: 'DejaVu Serif', Georgia, serif;
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #1a237e;
            margin: 4px 0 0 0;
            line-height: 1.28;
        }

        .title-underline {
            width: 52px;
            border-top: 1px solid #1a237e;
            margin: 8px auto 14px auto;
        }

        .intro-columns {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 8pt;
            line-height: 1.52;
        }

        .intro-columns td {
            width: 50%;
            vertical-align: top;
            padding: 2px 12px 2px 0;
            text-align: justify;
        }

        .intro-columns td.en-col {
            padding: 2px 0 2px 10px;
            border-left: 1px solid #ddd;
        }

        .transfer-box {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #333;
            border-radius: 6px;
            margin-bottom: 14px;
        }

        .transfer-box td {
            padding: 12px 14px;
            vertical-align: middle;
            font-size: 8pt;
            line-height: 1.45;
        }

        .transfer-box .from-cell {
            width: 44%;
            border-right: none;
        }

        .transfer-box .arrow-cell {
            width: 12%;
            text-align: center;
            font-size: 16pt;
            color: #1a237e;
            font-weight: bold;
            padding: 0 4px;
        }

        .transfer-box .to-cell {
            width: 44%;
        }

        .transfer-label {
            font-size: 7.25pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a237e;
            margin-bottom: 5px;
            line-height: 1.35;
        }

        .transfer-value {
            font-size: 9pt;
            font-weight: bold;
            color: #111;
            line-height: 1.4;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 8pt;
        }

        .student-table tr {
            border-bottom: 1px solid #ddd;
        }

        .student-table tr:last-child {
            border-bottom: 1px solid #bbb;
        }

        .student-table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        .student-table .label-cell {
            width: 56%;
            color: #333;
            line-height: 1.42;
            font-style: italic;
        }

        .student-table .value-cell {
            width: 42%;
            font-weight: bold;
            color: #111;
            text-align: left;
            line-height: 1.45;
        }

        .closing-columns {
            width: 100%;
            border-collapse: collapse;
            margin: 14px 0 18px 0;
            font-size: 8pt;
            line-height: 1.52;
        }

        .closing-columns td {
            width: 50%;
            vertical-align: top;
            padding: 2px 12px 2px 0;
            text-align: justify;
            color: #333;
        }

        .closing-columns td.en-col {
            padding: 2px 0 2px 12px;
        }

        .signature-block {
            margin-top: 10px;
            text-align: right;
        }

        .signature-inner {
            margin-left: auto;
            border-collapse: collapse;
        }

        .sig-graphic-wrap {
            position: relative;
            min-height: 40px;
            margin-bottom: 2px;
            text-align: right;
        }

        .sig-handwritten {
            display: block;
            margin-left: auto;
            width: 150px;
            height: auto;
            max-height: 48px;
            object-fit: contain;
        }

        .e-sign-box {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: center;
            line-height: 1.4;
            min-width: 185px;
            font-size: 7.5pt;
            background: #fafafa;
        }

        .e-sign-badge {
            font-weight: bold;
            font-size: 7.25pt;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a237e;
            margin-bottom: 6px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
        }

        .e-sign-name {
            font-weight: bold;
            color: #111;
            font-size: 8.5pt;
            margin-top: 4px;
        }

        .e-sign-title {
            font-size: 7.25pt;
            color: #444;
            line-height: 1.42;
        }

        .bilingual-label {
            font-style: italic;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="page-sheet">
        @php
            $applicationDate = $student->application->submitted_at ?? ($student->application->created_at ?? now());
            $startYear = $applicationDate->format('Y');
            $endYear = $startYear + 1;

            $programNameEn =
                $student->application->program?->getName('EN') ?? ($student->application->program?->name ?? 'N/A');
            $programNamePl = $student->application->program?->getName('PL') ?? $programNameEn;
            $degreeNameEn =
                $student->application->program?->degree?->getName('EN') ??
                ($student->application->program?->degree?->name ?? 'N/A');
            $degreeNamePl = $student->application->program?->degree?->getName('PL') ?? $degreeNameEn;

            $refNo = 'RU/TR/' . now()->format('Y') . '/' . str_pad((string) $student->id, 5, '0', STR_PAD_LEFT);

            $signaturePath = public_path('images/imza.png');
            // $signatureData = file_exists($signaturePath) ? base64_encode(file_get_contents($signaturePath)) : '';

            $verificationCodeForUrl = $verificationCode ?? null;
            $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
            $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(44)->generate($verificationUrl);
            $qrCodeBase64 = base64_encode($qrCode);
        @endphp

        <table class="header-table">
            <tr>
                <td style="width: 38%;">
                    <p class="uni-name navy">UNIWERSYTET RADOMSKI</p>
                    <p class="uni-name-sub navy">RADOM UNIVERSITY</p>
                </td>
                <td class="header-vdivider" style="width: 1%;">
                    <div class="header-vdivider-inner"></div>
                </td>
                <td style="width: 34%;">
                    <div class="office-block">
                        <div class="office-title navy">Biuro Spraw Studenckich / Student Affairs Office</div>
                        Radom, Poland <br>
                        Tel: +48 73 947 16 22<br>
                        Email: admission@radomuniversity.pl<br>
                    </div>
                </td>
                <td class="header-verify-cell" style="width: 28%;">
                    <div class="header-verification-box">
                        <h4>Weryfikacja dokumentu / Document Verification</h4>
                        <table class="header-verification-inner">
                            <tr>
                                <td class="qr-cell">
                                    <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt="" />
                                </td>
                                <td>
                                    <div><strong>Kod weryfikacyjny / Verification Code:</strong> {{ $codeForEntry }}</div>
                                    <div class="header-verification-url"><strong>Weryfikacja / Verification:</strong>
                                        {{ $verificationUrl }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <hr class="header-rule" />

        <table class="meta-row-table">
            <tr>
                <td><strong>Nr ref. / Ref. No.:</strong> {{ $refNo }}</td>
                <td class="meta-right"><strong>Data / Date:</strong> {{ now()->format('d.m.Y') }}</td>
            </tr>
        </table>

        <div class="doc-title navy">
            <p class="pl">ZAŚWIADCZENIE O PRZENIESIENIU STUDENTA</p>
            <p class="en">STUDENT TRANSFER CERTIFICATE</p>
        </div>
        <div class="title-underline"></div>

        <table class="intro-columns">
            <tr>
                <td>
                    Niniejszym zaświadcza się, że niżej wymieniony student ubiega się o przeniesienie z uczelni:
                </td>
                <td class="en-col">
                    This is to certify that the below mentioned student is applying for transfer from the institution:
                </td>
            </tr>
        </table>

        <table class="transfer-box">
            <tr>
                <td class="from-cell">
                    <div class="transfer-label">FROM / Z UCZELNI</div>
                    <div class="transfer-value">{{ $student->current_university ?: 'N/A' }}</div>
                </td>
                <td class="arrow-cell">→</td>
                <td class="to-cell">
                    <div class="transfer-label">TO / DO UCZELNI</div>
                    <div class="transfer-value">Uniwersytet Radomski / Radom University</div>
                </td>
            </tr>
        </table>

        <table class="student-table">
            <tr>
                <td class="label-cell">
                    Imię i nazwisko studenta / Student's Full Name
                </td>
                <td class="value-cell">{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    Data urodzenia / Date of Birth
                </td>
                <td class="value-cell">
                    {{ $student->date_of_birth ? $student->date_of_birth->format('d.m.Y') : 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="label-cell">
                    Numer paszportu / Passport Number
                </td>
                <td class="value-cell">{{ $student->passport_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    Numer studenta w uczelni macierzystej / Student ID at Home Institution
                </td>
                <td class="value-cell">{{ $student->student_number ?? ($student->application_number ?? 'N/A') }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    Kierunek studiów / Field of Study
                </td>
                <td class="value-cell">{{ $programNamePl }} / {{ $programNameEn }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    Poziom studiów / Level of Study
                </td>
                <td class="value-cell">{{ $degreeNamePl }} / {{ $degreeNameEn }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    Forma studiów / Mode of Study
                </td>
                <td class="value-cell">Studia stacjonarne / Full-time</td>
            </tr>
            <tr>
                <td class="label-cell">
                    Planowany semestr rozpoczęcia studiów w Radom University / Planned Semester of
                    Enrollment at Radom University
                </td>
                <td class="value-cell">Semestr zimowy {{ $startYear }}/{{ $endYear }} (październik
                    {{ $startYear }}) / Winter Semester {{ $startYear }}/{{ $endYear }} (October
                    {{ $startYear }})</td>
            </tr>
        </table>

        <table class="closing-columns">
            <tr>
                <td>
                    Zaświadczenie zostało wydane na prośbę studenta w celu przedłożenia w Radom University oraz do
                    innych
                    instytucji wymagających potwierdzenia zamiaru przeniesienia.
                </td>
                <td class="en-col">
                    This certificate is issued at the request of the student for submission to Radom University and any
                    other institution requiring confirmation of the transfer intention.
                </td>
            </tr>
        </table>

        <div class="signature-block">
            <table class="signature-inner" align="right">
                <tr>
                    <td>
                        {{-- @if ($signatureData)
                            <div class="sig-graphic-wrap">
                                <img class="sig-handwritten" src="data:image/png;base64,{{ $signatureData }}"
                                    alt="">
                            </div>
                        @endif --}}
                        <div class="e-sign-box">
                            <div class="e-sign-badge">Podpis elektroniczny / E-Signed</div>
                            <div class="e-sign-name">Michał Kowalski</div>
                            <div class="e-sign-title">Dyrektor Działu Spraw Studenckich / Director of Student Affairs</div>
                            <div class="e-sign-title">Uniwersytet Radomski / Radom University</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
