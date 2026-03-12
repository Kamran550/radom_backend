<?php

if (!function_exists('tr_upper')) {
    function tr_upper(string $text): string
    {
        $map = [
            'i' => 'İ',
            'ı' => 'I',
            'ğ' => 'Ğ',
            'ü' => 'Ü',
            'ş' => 'Ş',
            'ö' => 'Ö',
            'ç' => 'Ç',
            'ə' => 'Ə',
        ];

        return mb_strtoupper(strtr($text, $map), 'UTF-8');
    }
}



if (!function_exists('course_to_word')) {
    /**
     * Convert course number to Turkish ordinal word
     * 
     * @param int|null $course
     * @return string
     */
    function course_to_word(?int $course): string
    {
        if ($course === null) {
            return 'ikinci';
        }

        $words = [
            1 => 'birinci',
            2 => 'ikinci',
            3 => 'üçüncü',
            4 => 'dördüncü',
            5 => 'beşinci',
            6 => 'altıncı',
        ];

        return $words[$course] ?? 'ikinci';
    }
    function course_to_word_english(?int $course): string
    {
        if ($course === null) {
            return 'second';
        }

        $words = [
            1 => 'first',
            2 => 'second',
            3 => 'third',
            4 => 'fourth',
            5 => 'fifth',
            6 => 'sixth',
        ];

        return $words[$course] ?? 'second';
    }
}


// if (!function_exists('degree_type_to_word')) {
//     function degree_type_to_word(string $degreeName, bool $thesis): string
//     {
//         $isThesis = $thesis ? "(THESIS)" : "(Without THESIS)";
//         $degrees = [
//             "Bachelor's" => "UNDERGRADUATE",
//             "Master's" => "MASTER'S DEGREE " . $isThesis,
//             "PhD" => "DOCTORATE (PhD)",
//         ];
//         return $degrees[$degreeName] ?? $degreeName;
//     }
// }


// if (!function_exists('degree_type_to_word_turkish')) {
//     function degree_type_to_word_turkish(string $degreeName, bool $thesis): string
//     {
//         $isThesis = $thesis ? "(TEZLİ)" : "(TEZSİZ)";
//         $degrees = [
//             "Bachelor's" => "Lisans",
//             "Master's" => "YÜKSEK LİSANS " . $isThesis,
//             "PhD" => "DOKTORA",
//         ];
//         return $degrees[$degreeName] ?? $degreeName;
//     }
// }

if (!function_exists('nationality_to_polish')) {
    /**
     * Return nationality/place in Polish and English format: "Polish / English"
     * If no translation found, returns original with " / " prefix for consistency.
     */
    function nationality_to_polish(?string $nationality): string
    {
        if (empty($nationality)) {
            return 'N/A';
        }
        $map = [
            'Afghan' => 'Afgańczyk', 'Albanian' => 'Albańczyk', 'Algerian' => 'Algierczyk',
            'Andorran' => 'Andorryjczyk', 'Angolan' => 'Angolczyk', 'Antiguans' => 'Antiguańczyk',
            'Argentine' => 'Argentyńczyk', 'Armenian' => 'Orminianin', 'Australian' => 'Australijczyk',
            'Austrian' => 'Austriak', 'Azerbaijani' => 'Azerbejdżanin', 'Bahamian' => 'Bahamczyk',
            'Bahraini' => 'Bahrajnczyk', 'Bangladeshi' => 'Bangladeszczyk', 'Barbadian' => 'Barbadosczyk',
            'Barbudans' => 'Antiguańczyk', 'Batswana' => 'Botswańczyk', 'Belarusian' => 'Białorusin',
            'Belgian' => 'Belg', 'Belizean' => 'Belizeńczyk', 'Beninese' => 'Benińczyk',
            'Bhutanese' => 'Bhutańczyk', 'Bolivian' => 'Boliwijczyk', 'Bosnian' => 'Bośniak',
            'Brazilian' => 'Brazylijczyk', 'British' => 'Brytyjczyk', 'Bruneian' => 'Brunejczyk',
            'Bulgarian' => 'Bułgar', 'Burkinese' => 'Burkijczyk', 'Burmese' => 'Birmańczyk',
            'Burundian' => 'Burundyjczyk', 'Cambodian' => 'Kambodżańczyk', 'Cameroonian' => 'Kameruńczyk',
            'Canadian' => 'Kanadyjczyk', 'Cape Verdean' => 'Reprezentant Republiki Zielonego Przylądka',
            'Central African' => 'Reprezentant Republiki Środkowoafrykańskiej', 'Chadian' => 'Czadyjczyk',
            'Chilean' => 'Chilijczyk', 'Chinese' => 'Chińczyk', 'Colombian' => 'Kolumbijczyk',
            'Comoran' => 'Komoryjczyk', 'Congolese' => 'Kongijczyk', 'Costa Rican' => 'Kostarykańczyk',
            'Croatian' => 'Chorwat', 'Cuban' => 'Kubańczyk', 'Cypriot' => 'Cypryjczyk',
            'Czech' => 'Czesz', 'Danish' => 'Duńczyk', 'Djibouti' => 'Dżibutyjczyk',
            'Dominican' => 'Dominikańczyk', 'Dutch' => 'Holender', 'East Timorese' => 'Timorczyk',
            'Ecuadorean' => 'Ekwadorczyk', 'Egyptian' => 'Egipcjanin', 'Emirati' => 'Emiratczyk',
            'Equatorial Guinean' => 'Reprezentant Gwinei Równikowej', 'Eritrean' => 'Erytrejczyk',
            'Estonian' => 'Estończyk', 'Ethiopian' => 'Etiopczyk', 'Fijian' => 'Fidżyjczyk',
            'Filipino' => 'Filipińczyk', 'Finnish' => 'Fin', 'French' => 'Francuz',
            'Gabonese' => 'Gabóńczyk', 'Gambian' => 'Gambijczyk', 'Georgian' => 'Gruzin',
            'German' => 'Niemiec', 'Ghanaian' => 'Ghańczyk', 'Greek' => 'Grek',
            'Grenadian' => 'Grenadyjczyk', 'Guatemalan' => 'Gwatemalczyk', 'Guinean' => 'Gwinejczyk',
            'Guinea-Bissauan' => 'Reprezentant Gwinei Bissau', 'Guyanese' => 'Gujańczyk',
            'Haitian' => 'Haitańczyk', 'Herzegovinian' => 'Bośniak', 'Honduran' => 'Hondurasyjczyk',
            'Hungarian' => 'Węgier', 'I-Kiribati' => 'Reprezentant Kiribati', 'Icelander' => 'Islandczyk',
            'Indian' => 'Indyjczyk', 'Indonesian' => 'Indonezyjczyk', 'Iranian' => 'Irańczyk',
            'Iraqi' => 'Irakijczyk', 'Irish' => 'Irlandczyk', 'Israeli' => 'Izraelczyk',
            'Italian' => 'Włoch', 'Ivorian' => 'Reprezentant Wybrzeża Kości Słoniowej',
            'Jamaican' => 'Jamajczyk', 'Japanese' => 'Japończyk', 'Jordanian' => 'Jordańczyk',
            'Kazakhstani' => 'Kazachstańczyk', 'Kenyan' => 'Kenijczyk', 'Kittian and Nevisian' => 'Reprezentant Saint Kitts i Nevis',
            'Kuwaiti' => 'Kuwejczyk', 'Kyrgyz' => 'Kirgiski', 'Laotian' => 'Laotańczyk',
            'Latvian' => 'Łotysz', 'Lebanese' => 'Libańczyk', 'Liberian' => 'Liberyjczyk',
            'Libyan' => 'Libijczyk', 'Liechtensteiner' => 'Liechtensteinczyk', 'Lithuanian' => 'Litwin',
            'Luxembourger' => 'Luksemburczyk', 'Macedonian' => 'Macedończyk', 'Malagasy' => 'Malgasz',
            'Malawian' => 'Malawijczyk', 'Malaysian' => 'Malezyjczyk', 'Maldivian' => 'Malediwczyk',
            'Malian' => 'Malijczyk', 'Maltese' => 'Maltańczyk', 'Marshallese' => 'Marshallczyk',
            'Mauritanian' => 'Mauretańczyk', 'Mauritian' => 'Mauritiusczyk', 'Mexican' => 'Meksykanin',
            'Micronesian' => 'Mikronezyjczyk', 'Moldovan' => 'Mołdawianin', 'Monacan' => 'Monakijczyk',
            'Mongolian' => 'Mongoł', 'Montenegrin' => 'Czarnogórzec', 'Moroccan' => 'Marokańczyk',
            'Mozambican' => 'Mozambijczyk', 'Namibian' => 'Namibijczyk', 'Nauruan' => 'Nauruańczyk',
            'Nepalese' => 'Nepalczyk', 'New Zealander' => 'Nowozelandczyk', 'Nicaraguan' => 'Nikaraguańczyk',
            'Nigerian' => 'Nigerijczyk', 'Nigerien' => 'Nigeryjczyk', 'North Korean' => 'Północnokoreańczyk',
            'Northern Irish' => 'Północnoirlandczyk', 'Norwegian' => 'Norweg', 'Omani' => 'Omańczyk',
            'Pakistani' => 'Pakistańczyk', 'Palauan' => 'Palauańczyk', 'Palestinian' => 'Palestyniec',
            'Panamanian' => 'Panamczyk', 'Papua New Guinean' => 'Reprezentant Papui-Nowej Gwinei',
            'Paraguayan' => 'Paragwajczyk', 'Peruvian' => 'Peruwiańczyk', 'Polish' => 'Polak',
            'Portuguese' => 'Portugalczyk', 'Qatari' => 'Katarczyk', 'Romanian' => 'Rumun',
            'Russian' => 'Rosjanin', 'Rwandan' => 'Rwandyjczyk', 'Saint Lucian' => 'Reprezentant Saint Lucia',
            'Salvadoran' => 'Salwadorczyk', 'Samoan' => 'Samoan', 'San Marinese' => 'Reprezentant San Marino',
            'Sao Tomean' => 'Reprezentant Wysp Świętego Tomasza i Książęcej', 'Saudi' => 'Saudyjczyk',
            'Scottish' => 'Szkot', 'Senegalese' => 'Senegalczyk', 'Serbian' => 'Serb',
            'Seychellois' => 'Seszelczyk', 'Sierra Leonean' => 'Reprezentant Sierra Leone',
            'Singaporean' => 'Singapurczyk', 'Slovakian' => 'Słowak', 'Slovenian' => 'Słoweniec',
            'Solomon Islander' => 'Reprezentant Wysp Salomona', 'Somali' => 'Somalijczyk',
            'South African' => 'Reprezentant RPA', 'South Korean' => 'Południowokoreańczyk',
            'Spanish' => 'Hiszpan', 'Sri Lankan' => 'Lankijczyk', 'Sudanese' => 'Sudańczyk',
            'Surinamer' => 'Surinamczyk', 'Swazi' => 'Suazi', 'Swedish' => 'Szwed',
            'Swiss' => 'Szwajcar', 'Syrian' => 'Syryjczyk', 'Taiwanese' => 'Tajwańczyk',
            'Tajik' => 'Tadżyk', 'Tanzanian' => 'Tanzańczyk', 'Thai' => 'Tajlandczyk',
            'Togolese' => 'Togijczyk', 'Tongan' => 'Tongijczyk', 'Trinidadian or Tobagonian' => 'Trynidadczyk',
            'Tunisian' => 'Tunezyjczyk', 'Turkish' => 'Turk', 'Tuvaluan' => 'Tuwalczyk',
            'Ugandan' => 'Ugandyjczyk', 'Ukrainian' => 'Ukrainiec', 'Uruguayan' => 'Urugwajczyk',
            'Uzbekistani' => 'Uzbekistańczyk', 'Vanuatuan' => 'Vanuacki', 'Vatican' => 'Watynczyk',
            'Venezuelan' => 'Wenezuelczyk', 'Vietnamese' => 'Wietnamczyk', 'Welsh' => 'Walijczyk',
            'Yemenite' => 'Jemeńczyk', 'Zambian' => 'Zambijczyk', 'Zimbabwean' => 'Zimbabwejczyk',
        ];
        $trimmed = trim($nationality);
        $pl = $map[$trimmed] ?? null;
        if ($pl) {
            return $pl . ' / ' . $trimmed;
        }
        // Country names (e.g. place of birth): Azerbaijan, Turkey, etc.
        $countryMap = [
            'Azerbaijan' => 'Azerbejdżan', 'Turkey' => 'Turcja', 'Poland' => 'Polska',
            'Germany' => 'Niemcy', 'France' => 'Francja', 'Russia' => 'Rosja',
            'Ukraine' => 'Ukraina', 'Georgia' => 'Gruzja', 'Iran' => 'Iran',
            'Iraq' => 'Irak', 'Saudi Arabia' => 'Arabia Saudyjska', 'Egypt' => 'Egipt',
            'Libya' => 'Libia', 'Nigeria' => 'Nigeria', 'South Africa' => 'Republika Południowej Afryki',
            'India' => 'Indie', 'Pakistan' => 'Pakistan', 'China' => 'Chiny',
            'Japan' => 'Japonia', 'Indonesia' => 'Indonezja', 'Brazil' => 'Brazylia',
            'Argentina' => 'Argentyna', 'Mexico' => 'Meksyk', 'Canada' => 'Kanada',
            'United States' => 'Stany Zjednoczone', 'United Kingdom' => 'Wielka Brytania',
        ];
        $countryPl = $countryMap[$trimmed] ?? null;
        if ($countryPl) {
            return $countryPl . ' / ' . $trimmed;
        }
        return strtoupper($trimmed);
    }
}

if (!function_exists('language_to_polish')) {
    /**
     * Return language in Polish and English format: "Polish / English"
     */
    function language_to_polish(?string $language): string
    {
        if (empty($language)) {
            return 'N/A';
        }
        $map = [
            'Afrikaans' => 'Afrikaans', 'Albanian' => 'Albański', 'Amharic' => 'Amharski',
            'Arabic' => 'Arabski', 'Armenian' => 'Ormiański', 'Azerbaijani' => 'Azerbejdżański',
            'Basque' => 'Baskijski', 'Belarusian' => 'Białoruski', 'Bengali' => 'Bengalski',
            'Bosnian' => 'Bośniacki', 'Bulgarian' => 'Bułgarski', 'Burmese' => 'Birmański',
            'Catalan' => 'Kataloński', 'Cebuano' => 'Cebuański', 'Chinese (Mandarin)' => 'Chiński (mandaryński)',
            'Chinese (Cantonese)' => 'Chiński (kantoński)', 'Croatian' => 'Chorwacki', 'Czech' => 'Czeski',
            'Danish' => 'Duński', 'Dutch' => 'Niderlandzki', 'English' => 'Angielski',
            'Estonian' => 'Estoński', 'Filipino' => 'Filipiński', 'Finnish' => 'Fiński',
            'French' => 'Francuski', 'Galician' => 'Galicyjski', 'Georgian' => 'Gruziński',
            'German' => 'Niemiecki', 'Greek' => 'Grecki', 'Gujarati' => 'Gudżarati',
            'Hebrew' => 'Hebrajski', 'Hindi' => 'Hinduski', 'Hungarian' => 'Węgierski',
            'Icelandic' => 'Islandzki', 'Indonesian' => 'Indonezyjski', 'Irish' => 'Irlandzki',
            'Italian' => 'Włoski', 'Japanese' => 'Japoński', 'Javanese' => 'Jawajski',
            'Kannada' => 'Kannada', 'Kazakh' => 'Kazachski', 'Khmer' => 'Khmerski',
            'Korean' => 'Koreański', 'Kurdish' => 'Kurdyjski', 'Lao' => 'Laotański',
            'Latvian' => 'Łotewski', 'Lithuanian' => 'Litewski', 'Macedonian' => 'Macedoński',
            'Malay' => 'Malajski', 'Malayalam' => 'Malajalam', 'Maltese' => 'Maltański',
            'Marathi' => 'Marathi', 'Mongolian' => 'Mongolski', 'Nepali' => 'Nepalski',
            'Norwegian' => 'Norweski', 'Pashto' => 'Paszto', 'Persian (Farsi)' => 'Perski (Farsi)',
            'Polish' => 'Polski', 'Portuguese' => 'Portugalski', 'Punjabi' => 'Pendżabski',
            'Romanian' => 'Rumuński', 'Russian' => 'Rosyjski', 'Serbian' => 'Serbski',
            'Sinhala' => 'Syngaleski', 'Slovak' => 'Słowacki', 'Slovenian' => 'Słoweński',
            'Somali' => 'Somalijski', 'Spanish' => 'Hiszpański', 'Swahili' => 'Suahili',
            'Swedish' => 'Szwedzki', 'Tagalog' => 'Tagalski', 'Tamil' => 'Tamilski',
            'Telugu' => 'Telugu', 'Thai' => 'Tajski', 'Turkish' => 'Turecki',
            'Ukrainian' => 'Ukraiński', 'Urdu' => 'Urdu', 'Uzbek' => 'Uzbecki',
            'Vietnamese' => 'Wietnamski', 'Welsh' => 'Walijski', 'Yoruba' => 'Joruba',
            'Zulu' => 'Zulu',
        ];
        $trimmed = trim($language);
        $pl = $map[$trimmed] ?? null;
        if ($pl) {
            return $pl . ' / ' . $trimmed;
        }
        return $trimmed;
    }
}
