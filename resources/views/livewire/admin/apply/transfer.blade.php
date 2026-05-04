<div class="p-6 max-w-7xl mx-auto" x-data="transferApplyForm({
    endpoint: @js(url('/api/v1/applications/transfer')),
    degrees: @js($degrees),
    programsEndpoint: @js(url('/api/v1/programs/filter'))
})">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Transfer Apply</h1>
        <p class="mt-1 text-sm text-gray-600">Create a new transfer application from the admin panel.</p>
    </div>

    <div x-show="successMessage" x-cloak
        class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
        <span x-text="successMessage"></span>
    </div>

    <div x-show="generalError" x-cloak
        class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
        <span x-text="generalError"></span>
    </div>

    <form x-ref="form" @submit.prevent="submit" class="space-y-8">
        <input type="hidden" name="locale" value="en">
        <input type="hidden" name="degree_type" :value="selectedDegreeType">

        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900">Program Information</h2>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="degree_id" class="block text-sm font-medium text-gray-700 mb-2">Degree <span
                            class="text-red-500">*</span></label>
                    <select id="degree_id" name="degree_id" x-model="selectedDegreeId" @change="handleDegreeChange"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('degree_id')">
                        <option value="">Select degree</option>
                        <template x-for="degree in degrees" :key="degree.id">
                            <option :value="String(degree.id)" x-text="degree.name"></option>
                        </template>
                    </select>
                    <p x-show="errors.degree_id" x-text="firstError('degree_id')" class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="faculty_id" class="block text-sm font-medium text-gray-700 mb-2">Faculty <span
                            class="text-red-500">*</span></label>
                    <select id="faculty_id" x-model="selectedFacultyId" @change="handleFacultyChange"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('faculty_id')" :disabled="!selectedDegreeId">
                        <option value="" x-text="selectedDegreeId ? 'Select faculty' : 'Select degree first'">
                        </option>
                        <template x-for="faculty in availableFaculties" :key="faculty.id">
                            <option :value="String(faculty.id)" x-text="faculty.name"></option>
                        </template>
                    </select>
                    <p x-show="errors.faculty_id" x-text="firstError('faculty_id')" class="mt-2 text-sm text-red-600">
                    </p>
                </div>

                <div>
                    <label for="program_id" class="block text-sm font-medium text-gray-700 mb-2">Program <span
                            class="text-red-500">*</span></label>
                    <select id="program_id" name="program_id" x-model="selectedProgramId" @change="handleProgramChange"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('program_id')" :disabled="!selectedFacultyId || loadingPrograms">
                        <option value="" x-text="programPlaceholder"></option>
                        <template x-for="program in programs" :key="program.id">
                            <option :value="String(program.id)" x-text="programLabel(program)"></option>
                        </template>
                    </select>
                    <p x-show="errors.program_id" x-text="firstError('program_id')" class="mt-2 text-sm text-red-600">
                    </p>
                </div>

                <div>
                    <label for="teachingLanguage" class="block text-sm font-medium text-gray-700 mb-2">Teaching Language
                        <span class="text-red-500">*</span></label>
                    <select id="teachingLanguage" name="teachingLanguage" x-model="selectedTeachingLanguage"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('teachingLanguage')" :disabled="!selectedProgramId || loadingPrograms">
                        <option value=""
                            x-text="selectedProgramId ? 'Select teaching language' : 'Select program first'"></option>
                        <template x-for="language in availableTeachingLanguages" :key="language.value">
                            <option :value="language.value" x-text="language.label"></option>
                        </template>
                    </select>
                    <p x-show="errors.teachingLanguage" x-text="firstError('teachingLanguage')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div class="rounded-lg bg-[#f8f6f3] border border-gray-200 px-4 py-3">
                    <p class="text-sm text-gray-500">Detected Degree Type</p>
                    <p class="mt-1 font-medium text-gray-900" x-text="selectedDegreeTypeLabel || '-'"></p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900">Transfer Information</h2>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="current_university" class="block text-sm font-medium text-gray-700 mb-2">Current
                        University <span class="text-red-500">*</span></label>
                    <input id="current_university" name="current_university" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('current_university')">
                    <p x-show="errors.current_university" x-text="firstError('current_university')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="current_course" class="block text-sm font-medium text-gray-700 mb-2">Current Course
                        <span class="text-red-500">*</span></label>
                    <input id="current_course" name="current_course" type="number" min="1" max="10"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('current_course')">
                    <p x-show="errors.current_course" x-text="firstError('current_course')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="passport_number" class="block text-sm font-medium text-gray-700 mb-2">Passport Number
                        <span class="text-red-500">*</span></label>
                    <input id="passport_number" name="passport_number" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('passport_number')">
                    <p x-show="errors.passport_number" x-text="firstError('passport_number')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender <span
                            class="text-red-500">*</span></label>
                    <select id="gender" name="gender"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('gender')">
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <p x-show="errors.gender" x-text="firstError('gender')" class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name <span
                            class="text-red-500">*</span></label>
                    <input id="first_name" name="first_name" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('first_name')">
                    <p x-show="errors.first_name" x-text="firstError('first_name')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name <span
                            class="text-red-500">*</span></label>
                    <input id="last_name" name="last_name" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('last_name')">
                    <p x-show="errors.last_name" x-text="firstError('last_name')" class="mt-2 text-sm text-red-600">
                    </p>
                </div>

                <div>
                    <label for="father_name" class="block text-sm font-medium text-gray-700 mb-2">Father Name <span
                            class="text-red-500">*</span></label>
                    <input id="father_name" name="father_name" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('father_name')">
                    <p x-show="errors.father_name" x-text="firstError('father_name')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth
                        <span class="text-red-500">*</span></label>
                    <input id="date_of_birth" name="date_of_birth" type="date"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('date_of_birth')">
                    <p x-show="errors.date_of_birth" x-text="firstError('date_of_birth')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Place of Birth
                        <span class="text-red-500">*</span></label>
                    <input id="place_of_birth" name="place_of_birth" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('place_of_birth')">
                    <p x-show="errors.place_of_birth" x-text="firstError('place_of_birth')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                @php
                    $languageOptions = [
                        'Afrikaans', 'Albanian', 'Amharic', 'Arabic', 'Armenian', 'Azerbaijani', 'Basque', 'Belarusian', 'Bengali', 'Bosnian', 'Bulgarian', 'Burmese', 'Catalan', 'Cebuano',
                        'Chinese (Mandarin)', 'Chinese (Cantonese)', 'Croatian', 'Czech', 'Danish', 'Dutch', 'English', 'Estonian', 'Filipino', 'Finnish', 'French', 'Galician', 'Georgian',
                        'German', 'Greek', 'Gujarati', 'Hebrew', 'Hindi', 'Hungarian', 'Icelandic', 'Indonesian', 'Irish', 'Italian', 'Japanese', 'Javanese', 'Kannada', 'Kazakh', 'Khmer',
                        'Korean', 'Kurdish', 'Lao', 'Latvian', 'Lithuanian', 'Macedonian', 'Malay', 'Malayalam', 'Maltese', 'Marathi', 'Mongolian', 'Nepali', 'Norwegian', 'Pashto',
                        'Persian (Farsi)', 'Polish', 'Portuguese', 'Punjabi', 'Romanian', 'Russian', 'Serbian', 'Sinhala', 'Slovak', 'Slovenian', 'Somali', 'Spanish', 'Swahili', 'Swedish',
                        'Tagalog', 'Tamil', 'Telugu', 'Thai', 'Turkish', 'Ukrainian', 'Urdu', 'Uzbek', 'Vietnamese', 'Welsh', 'Yoruba', 'Zulu',
                    ];
                @endphp

                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">Nationality <span
                            class="text-red-500">*</span></label>
                    <select id="nationality" name="nationality"
                        class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('nationality')">
                        <option value="">Select nationality</option>
                        @foreach ($languageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <p x-show="errors.nationality" x-text="firstError('nationality')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="native_language" class="block text-sm font-medium text-gray-700 mb-2">Native Language
                        <span class="text-red-500">*</span></label>
                    <select id="native_language" name="native_language"
                        class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('native_language')">
                        <option value="">Select native language</option>
                        @foreach ($languageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <p x-show="errors.native_language" x-text="firstError('native_language')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900">Contact and Address</h2>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone <span
                            class="text-red-500">*</span></label>
                    <input id="phone" name="phone" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('phone')">
                    <p x-show="errors.phone" x-text="firstError('phone')" class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span
                            class="text-red-500">*</span></label>
                    <input id="email" name="email" type="email"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('email')">
                    <p x-show="errors.email" x-text="firstError('email')" class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country <span
                            class="text-red-500">*</span></label>
                    <input id="country" name="country" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('country')">
                    <p x-show="errors.country" x-text="firstError('country')" class="mt-2 text-sm text-red-600"></p>
                </div>

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City <span
                            class="text-red-500">*</span></label>
                    <input id="city" name="city" type="text"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('city')">
                    <p x-show="errors.city" x-text="firstError('city')" class="mt-2 text-sm text-red-600"></p>
                </div>

                <div class="md:col-span-2">
                    <label for="address_line" class="block text-sm font-medium text-gray-700 mb-2">Address Line <span
                            class="text-red-500">*</span></label>
                    <textarea id="address_line" name="address_line" rows="4"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('address_line')"></textarea>
                    <p x-show="errors.address_line" x-text="firstError('address_line')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900">Documents</h2>
            <p class="mt-1 text-sm text-gray-600">File size limit for each upload is 5 MB. Photo ID should always be
                added.</p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="photo_id" class="block text-sm font-medium text-gray-700 mb-2">Photo ID</label>
                    <input id="photo_id" name="photo_id" type="file"
                        class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('photo_id')">
                    <p x-show="errors.photo_id" x-text="firstError('photo_id')" class="mt-2 text-sm text-red-600">
                    </p>
                </div>

                <div>
                    <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">Profile
                        Photo</label>
                    <input id="profile_photo" name="profile_photo" type="file"
                        class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                        :class="fieldClass('profile_photo')">
                    <p x-show="errors.profile_photo" x-text="firstError('profile_photo')"
                        class="mt-2 text-sm text-red-600"></p>
                </div>

                <template x-if="selectedDegreeType === 'bachelor'">
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="high_school_diploma" class="block text-sm font-medium text-gray-700 mb-2">High
                                School Diploma</label>
                            <input id="high_school_diploma" name="high_school_diploma" type="file"
                                class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                                :class="fieldClass('high_school_diploma')">
                            <p x-show="errors.high_school_diploma" x-text="firstError('high_school_diploma')"
                                class="mt-2 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="high_school_transcript"
                                class="block text-sm font-medium text-gray-700 mb-2">High School Transcript</label>
                            <input id="high_school_transcript" name="high_school_transcript" type="file"
                                class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                                :class="fieldClass('high_school_transcript')">
                            <p x-show="errors.high_school_transcript" x-text="firstError('high_school_transcript')"
                                class="mt-2 text-sm text-red-600"></p>
                        </div>
                    </div>
                </template>

                <template
                    x-if="selectedDegreeType === 'master' || selectedDegreeType === 'master_without_thesis' || selectedDegreeType === 'phd'">
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="bachelor_diploma"
                                class="block text-sm font-medium text-gray-700 mb-2">Bachelor Diploma</label>
                            <input id="bachelor_diploma" name="bachelor_diploma" type="file"
                                class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                                :class="fieldClass('bachelor_diploma')">
                            <p x-show="errors.bachelor_diploma" x-text="firstError('bachelor_diploma')"
                                class="mt-2 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="bachelor_transcript"
                                class="block text-sm font-medium text-gray-700 mb-2">Bachelor Transcript</label>
                            <input id="bachelor_transcript" name="bachelor_transcript" type="file"
                                class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                                :class="fieldClass('bachelor_transcript')">
                            <p x-show="errors.bachelor_transcript" x-text="firstError('bachelor_transcript')"
                                class="mt-2 text-sm text-red-600"></p>
                        </div>
                    </div>
                </template>

                <template x-if="selectedDegreeType === 'phd'">
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="master_diploma" class="block text-sm font-medium text-gray-700 mb-2">Master
                                Diploma</label>
                            <input id="master_diploma" name="master_diploma" type="file"
                                class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                                :class="fieldClass('master_diploma')">
                            <p x-show="errors.master_diploma" x-text="firstError('master_diploma')"
                                class="mt-2 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="master_transcript" class="block text-sm font-medium text-gray-700 mb-2">Master
                                Transcript</label>
                            <input id="master_transcript" name="master_transcript" type="file"
                                class="w-full px-4 py-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#6E0C0C] focus:border-[#6E0C0C]"
                                :class="fieldClass('master_transcript')">
                            <p x-show="errors.master_transcript" x-text="firstError('master_transcript')"
                                class="mt-2 text-sm text-red-600"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 bg-[#6E0C0C] hover:bg-[#8B2525] text-white text-sm font-medium rounded-lg shadow-sm transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="loading">
                <svg x-show="loading" x-cloak class="animate-spin -ml-1 mr-2 h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span x-text="loading ? 'Submitting...' : 'Submit Transfer Application'"></span>
            </button>
        </div>
    </form>
</div>

<script>
    function transferApplyForm(config) {
        return {
            endpoint: config.endpoint,
            programsEndpoint: config.programsEndpoint,
            degrees: config.degrees,
            programs: [],
            selectedDegreeId: '',
            selectedFacultyId: '',
            selectedProgramId: '',
            selectedDegreeType: '',
            selectedTeachingLanguage: '',
            loading: false,
            loadingPrograms: false,
            successMessage: '',
            generalError: '',
            errors: {},

            get selectedProgram() {
                return this.programs.find((program) => String(program.id) === String(this.selectedProgramId)) ||
                    null;
            },

            get selectedDegree() {
                return this.degrees.find((degree) => String(degree.id) === String(this.selectedDegreeId)) || null;
            },

            get availableFaculties() {
                return this.selectedDegree?.faculties || [];
            },

            get availableTeachingLanguages() {
                if (!this.selectedProgram) {
                    return [];
                }

                const languages = this.selectedProgram.study_languages.length ?
                    this.selectedProgram.study_languages :
                    ['en', 'tr'];

                return languages.map((language) => ({
                    value: language,
                    label: language.toUpperCase(),
                }));
            },

            get selectedDegreeTypeLabel() {
                const selectedDegree = this.degrees.find((degree) => String(degree.id) === String(this
                    .selectedDegreeId));
                return selectedDegree ? selectedDegree.name : '';
            },

            get programPlaceholder() {
                if (!this.selectedDegreeId) return 'Select degree first';
                if (!this.selectedFacultyId) return 'Select faculty first';
                if (this.loadingPrograms) return 'Loading programs...';
                return this.programs.length ? 'Select program' : 'No programs found';
            },

            handleDegreeChange() {
                const selectedDegree = this.degrees.find((degree) => String(degree.id) === String(this
                    .selectedDegreeId));
                this.selectedDegreeType = selectedDegree ? selectedDegree.type : '';
                this.selectedFacultyId = '';
                this.programs = [];
                this.selectedProgramId = '';
                this.selectedTeachingLanguage = '';
                delete this.errors.degree_id;
                delete this.errors.faculty_id;
                delete this.errors.program_id;
                delete this.errors.teachingLanguage;
            },

            async handleFacultyChange() {
                this.programs = [];
                this.selectedProgramId = '';
                this.selectedTeachingLanguage = '';
                delete this.errors.faculty_id;
                delete this.errors.program_id;
                delete this.errors.teachingLanguage;

                if (!this.selectedDegreeId || !this.selectedFacultyId) return;

                this.loadingPrograms = true;

                try {
                    const url = new URL(this.programsEndpoint, window.location.origin);
                    url.searchParams.set('degree_id', this.selectedDegreeId);
                    url.searchParams.set('faculty_id', this.selectedFacultyId);
                    url.searchParams.set('lang', 'EN');

                    const response = await fetch(url.toString(), {
                        headers: {
                            'Accept': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        this.programs = [];
                        return;
                    }

                    const items = Array.isArray(result.data) ? result.data : [];
                    this.programs = items.map((program) => ({
                        id: program.id,
                        name: program.name,
                        faculty_name: program.faculty?.name || '',
                        price_per_year: program.price_per_year,
                        study_languages: ['en', 'tr'],
                    }));
                } catch (error) {
                    this.programs = [];
                } finally {
                    this.loadingPrograms = false;
                }
            },

            handleProgramChange() {
                delete this.errors.program_id;
                delete this.errors.teachingLanguage;
                this.selectedTeachingLanguage = '';
            },

            programLabel(program) {
                const details = [];
                if (program.faculty_name) details.push(program.faculty_name);
                if (program.price_per_year) details.push(`${program.price_per_year} EUR`);
                return details.length ? `${program.name} (${details.join(' - ')})` : program.name;
            },

            firstError(field) {
                return this.errors[field] ? this.errors[field][0] : '';
            },

            fieldClass(field) {
                return this.errors[field] ? 'border-red-500' : 'border-gray-300';
            },

            resetState() {
                this.errors = {};
                this.generalError = '';
                this.successMessage = '';
            },

            async submit() {
                this.resetState();
                this.loading = true;

                try {
                    const formData = new FormData(this.$refs.form);

                    const response = await fetch(this.endpoint, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        this.errors = result.errors || {};
                        this.generalError = result.message || 'Transfer application submission failed.';
                        return;
                    }

                    this.successMessage = result.message || 'Transfer application submitted successfully.';
                    this.$refs.form.reset();
                    this.selectedDegreeId = '';
                    this.selectedFacultyId = '';
                    this.programs = [];
                    this.selectedProgramId = '';
                    this.selectedDegreeType = '';
                    this.selectedTeachingLanguage = '';
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } catch (error) {
                    this.generalError = 'Transfer application submission failed. Please try again.';
                } finally {
                    this.loading = false;
                }
            },
        };
    }
</script>
