<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramTranslation;
use App\Models\ProgramStudyLanguage;
use App\Models\Faculty;
use App\Models\Degree;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Standard annual fee is €4,000 for all programs
        $standardPrice = 4000;

        // Bachelor's Programs
        $bachelorsPrograms = [
            'Faculty of Management Sciences' => [
                ['en' => 'Aviation Management', 'tr' => 'Havacılık Yönetimi', 'pl' => 'Zarządzanie lotnictwem'],
                ['en' => 'Business Administration', 'tr' => 'İşletme', 'pl' => 'Zarządzanie'],
                ['en' => 'Political Science and Public Administration', 'tr' => 'Siyaset Bilimi ve Kamu Yönetimi', 'pl' => 'Nauki polityczne i administracja publiczna'],
                ['en' => 'International Relations', 'tr' => 'Uluslararası İlişkiler', 'pl' => 'Stosunki międzynarodowe'],
                ['en' => 'International Business and Entrepreneurship', 'tr' => 'Uluslararası İşletmecilik ve Girişimcilik', 'pl' => 'Biznes międzynarodowy i przedsiębiorczość'],
                ['en' => 'International Trade and Logistics', 'tr' => 'Uluslararası Ticaret ve Lojistik', 'pl' => 'Handel międzynarodowy i logistyka'],
                ['en' => 'Management Information Systems', 'tr' => 'Yönetim Bilişim Sistemleri', 'pl' => 'Systemy informatyczne w zarządzaniu'],
                ['en' => 'Economics and Finance', 'tr' => 'Ekonomi ve Finans', 'pl' => 'Ekonomia i finanse'],
            ],
            'Faculty of Health Sciences' => [
                ['en' => 'Exercise and Sports Sciences', 'tr' => 'Egzersiz ve Spor Bilimleri', 'pl' => 'Nauki o ćwiczeniach i sporcie'],
                ['en' => 'Exercise and Sports Sciences for People with Disabilities', 'tr' => 'Engellilerde Egzersiz ve Spor Bilimleri', 'pl' => 'Nauki o ćwiczeniach i sporcie dla osób niepełnosprawnych'],
                ['en' => 'Health Management', 'tr' => 'Sağlık Yönetimi', 'pl' => 'Zarządzanie w ochronie zdrowia'],
                ['en' => 'Cosmetology', 'tr' => 'Kozmetoloji', 'pl' => 'Kosmetologia'],
                ['en' => 'Psychology', 'tr' => 'Psikoloji', 'pl' => 'Psychologia'],
            ],
            'Faculty of Engineering' => [
                ['en' => 'Computer Engineering', 'tr' => 'Bilgisayar Mühendisliği', 'pl' => 'Inżynieria komputerowa'],
                ['en' => 'Software Engineering', 'tr' => 'Yazılım Mühendisliği', 'pl' => 'Inżynieria oprogramowania'],
                ['en' => 'Cyber Security Engineering', 'tr' => 'Siber Güvenlik Mühendisliği', 'pl' => 'Inżynieria cyberbezpieczeństwa'],
                ['en' => 'Artificial Intelligence Engineering', 'tr' => 'Yapay Zeka Mühendisliği', 'pl' => 'Inżynieria sztucznej inteligencji'],
                ['en' => 'Aviation Systems and Technologies Engineering', 'tr' => 'Havacılık Sistemleri ve Teknolojileri Mühendisliği', 'pl' => 'Inżynieria systemów i technologii lotniczych'],
                ['en' => 'Industrial Engineering', 'tr' => 'Endüstri Mühendisliği', 'pl' => 'Inżynieria przemysłowa'],
                ['en' => 'Management Engineering', 'tr' => 'İşletme Mühendisliği', 'pl' => 'Inżynieria zarządzania'],
            ],
            'Faculty of Law' => [
                ['en' => 'Law', 'tr' => 'Hukuk', 'pl' => 'Prawo'],
            ],
        ];

        // Master's Programs
        $mastersPrograms = [
            'Faculty of Health Sciences' => [
                ['en' => 'Physical Activity Health and Sports', 'tr' => 'Fiziksel Aktivite Sağlık ve Spor', 'pl' => 'Aktywność fizyczna, zdrowie i sport'],
                ['en' => 'Health Management', 'tr' => 'Sağlık Yönetimi', 'pl' => 'Zarządzanie w ochronie zdrowia'],
                ['en' => 'Clinical Psychology', 'tr' => 'Klinik Psikoloji', 'pl' => 'Psychologia kliniczna'],
            ],
            'Faculty of Engineering' => [
                ['en' => 'Aviation Systems and Technologies', 'tr' => 'Havacılık Sistemleri ve Teknolojileri', 'pl' => 'Systemy i technologie lotnicze'],
                ['en' => 'Engineering Management', 'tr' => 'Mühendislik Yönetimi', 'pl' => 'Zarządzanie inżynierskie'],
                ['en' => 'Quality and Compliance Assessment Engineering', 'tr' => 'Kalite ve Uygunluk Değerlendirme Mühendisliği', 'pl' => 'Inżynieria oceny jakości i zgodności'],
                ['en' => 'Cybersecurity Engineering', 'tr' => 'Siber Güvenlik Mühendisliği', 'pl' => 'Inżynieria cyberbezpieczeństwa'],
                ['en' => 'Software Engineering', 'tr' => 'Yazılım Mühendisliği', 'pl' => 'Inżynieria oprogramowania'],
                ['en' => 'Renewable Energy Engineering', 'tr' => 'Yenilenebilir Enerji Mühendisliği', 'pl' => 'Inżynieria odnawialnych źródeł energii'],
                ['en' => 'Data Science Engineering', 'tr' => 'Veri Bilimi Mühendisliği', 'pl' => 'Inżynieria nauki o danych'],
                ['en' => 'Computer Engineering', 'tr' => 'Bilgisayar Mühendisliği', 'pl' => 'Inżynieria komputerowa'],
                ['en' => 'Artificial Intelligence Engineering', 'tr' => 'Yapay Zekâ Mühendisliği', 'pl' => 'Inżynieria sztucznej inteligencji'],
            ],
            'Faculty of Management Sciences' => [
                ['en' => 'Business Administration (MBA)', 'tr' => 'İşletme (MBA)', 'pl' => 'Zarządzanie (MBA)'],
                ['en' => 'Management Information Systems', 'tr' => 'Yönetim Bilişim Sistemleri', 'pl' => 'Systemy informatyczne w zarządzaniu'],
            ],
            'Faculty of Law' => [
                ['en' => 'Law', 'tr' => 'Hukuk', 'pl' => 'Prawo'],
            ],
        ];

        // PhD Programs
        $phdPrograms = [
            'Faculty of Engineering' => [
                ['en' => 'Aviation Systems and Technologies', 'tr' => 'Havacılık Sistemleri ve Teknolojileri', 'pl' => 'Systemy i technologie lotnicze'],
                ['en' => 'Cyber Security Engineering', 'tr' => 'Siber Güvenlik Mühendisliği', 'pl' => 'Inżynieria cyberbezpieczeństwa'],
                ['en' => 'Software Engineering', 'tr' => 'Yazılım Mühendisliği', 'pl' => 'Inżynieria oprogramowania'],
                ['en' => 'Management Information Systems', 'tr' => 'Yönetim Bilişim Sistemleri', 'pl' => 'Systemy informatyczne w zarządzaniu'],
                ['en' => 'Management Engineering', 'tr' => 'İşletme Mühendisliği', 'pl' => 'Inżynieria zarządzania'],
                ['en' => 'Computer Engineering', 'tr' => 'Bilgisayar Mühendisliği', 'pl' => 'Inżynieria komputerowa'],
                ['en' => 'Artificial Intelligence Engineering', 'tr' => 'Yapay Zekâ Mühendisliği', 'pl' => 'Inżynieria sztucznej inteligencji'],
            ],
            'Faculty of Management Sciences' => [
                ['en' => 'Business Administration', 'tr' => 'İşletme', 'pl' => 'Zarządzanie'],
                ['en' => 'Management and Organization', 'tr' => 'Yönetim ve Organizasyon', 'pl' => 'Zarządzanie i organizacja'],
            ],
            'Faculty of Health Sciences' => [
                ['en' => 'Sports Health Sciences', 'tr' => 'Spor Sağlık Bilimleri', 'pl' => 'Nauki o zdrowiu w sporcie'],
            ],
            'Faculty of Law' => [
                ['en' => 'Law', 'tr' => 'Hukuk', 'pl' => 'Prawo'],
            ],
        ];

        // Get degrees
        $bachelorsDegree = Degree::where('name', "Bachelor's")->first();
        $mastersDegree = Degree::where('name', "Master's")->first();
        $phdDegree = Degree::where('name', 'PhD')->first();

        // Create Bachelor's Programs
        $this->createPrograms($bachelorsPrograms, $bachelorsDegree, $standardPrice);

        // Create Master's Programs
        $this->createPrograms($mastersPrograms, $mastersDegree, $standardPrice);

        // Create PhD Programs
        $this->createPrograms($phdPrograms, $phdDegree, $standardPrice);
    }

    private function createPrograms(array $programsByFaculty, Degree $degree, int $price): void
    {
        foreach ($programsByFaculty as $facultyName => $programs) {
            $faculty = Faculty::where('name', $facultyName)->first();

            if (!$faculty) {
                continue;
            }

            foreach ($programs as $programData) {
                // Create program with English name (stored in main table)
                $program = Program::firstOrCreate(
                    [
                        'degree_id' => $degree->id,
                        'faculty_id' => $faculty->id,
                        'name' => $programData['en'],
                    ],
                    [
                        'price_per_year' => $price,
                    ]
                );

                // Create English translation
                ProgramTranslation::firstOrCreate(
                    [
                        'program_id' => $program->id,
                        'language' => 'EN',
                    ],
                    [
                        'name' => $programData['en'],
                    ]
                );

                // Create Turkish translation
                ProgramTranslation::firstOrCreate(
                    [
                        'program_id' => $program->id,
                        'language' => 'TR',
                    ],
                    [
                        'name' => $programData['tr'],
                    ]
                );

                // Create Polish translation
                ProgramTranslation::firstOrCreate(
                    [
                        'program_id' => $program->id,
                        'language' => 'PL',
                    ],
                    [
                        'name' => $programData['pl'],
                    ]
                );

                // Create study languages (EN, TR and PL are available for all programs)
                ProgramStudyLanguage::firstOrCreate(
                    [
                        'program_id' => $program->id,
                        'language' => 'EN',
                    ],
                    [
                        'is_available' => true,
                    ]
                );

                ProgramStudyLanguage::firstOrCreate(
                    [
                        'program_id' => $program->id,
                        'language' => 'TR',
                    ],
                    [
                        'is_available' => true,
                    ]
                );

                ProgramStudyLanguage::firstOrCreate(
                    [
                        'program_id' => $program->id,
                        'language' => 'PL',
                    ],
                    [
                        'is_available' => true,
                    ]
                );
            }
        }
    }
}
