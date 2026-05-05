<div class="min-h-screen bg-[#efefef] py-10 px-4">
    <main class="max-w-[760px] mx-auto">
        @if(!$application || $messageType !== 'success')
            <div class="bg-white border border-[#d7d7d7]">
                <div class="px-5 sm:px-8 py-7 sm:py-8 space-y-6">
                    <div class="border border-[#d9d9d9] bg-[#f8f8f8] px-4 py-3">
                        <div class="flex items-start gap-3">
                            <span class="text-xl leading-none text-[#222]">!</span>
                            <div>
                                <p class="text-[22px] leading-6 font-semibold text-[#2b2b2b]">Check the domain name!</p>
                                <p class="mt-2 text-sm text-[#555] leading-5">
                                    Please make sure that the domain name in your browser's address bar is correct, by verifying
                                    it is the same as the institution's DreamApply instance domain name.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form wire:submit.prevent="verify" class="space-y-4">
                        <div>
                            <label for="digitCode" class="block text-sm font-medium text-[#333] mb-2">
                                Please type the additional check digits
                            </label>
                            <input
                                type="text"
                                id="digitCode"
                                wire:model="digitCode"
                                maxlength="4"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                placeholder=""
                                class="w-full h-11 border border-[#d9d9d9] px-3 text-[15px] text-[#222] focus:outline-none focus:ring-1 focus:ring-[#2e5f87] focus:border-[#2e5f87] bg-white"
                                autocomplete="off"
                                autofocus
                            >
                            <p class="mt-2 text-xs text-[#666]">
                                Please refer to the original document, find the verification QR code and type the check digits highlighted in bold.
                            </p>
                        </div>

                        @if($message && $messageType !== 'success')
                            <div class="border border-[#e0b4b4] bg-[#fff6f6] px-3 py-2 text-sm text-[#9f3a38]">
                                {{ $message }}
                            </div>
                        @endif

                        <div class="pt-1">
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center justify-center gap-2 min-w-[150px] h-11 px-6 bg-[#1f4d73] hover:bg-[#173b59] text-white text-lg font-semibold transition disabled:opacity-60 disabled:cursor-not-allowed"
                            >
                                <span wire:loading.remove wire:target="verify">Continue</span>
                                <span wire:loading wire:target="verify">Checking...</span>
                                <svg wire:loading.remove wire:target="verify" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if($application && $messageType === 'success')
            @php
                $pdfUrl = $this->getPdfUrl();
            @endphp
            <div class="max-w-6xl mx-auto space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 rounded-2xl border border-emerald-200/90 bg-emerald-50/90 px-5 py-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-500 text-white shadow-md shadow-emerald-500/30">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-emerald-900">Verification successful</p>
                            <p class="text-sm text-emerald-800/90">This document is registered in our system.</p>
                        </div>
                    </div>
                </div>

                @if($pdfUrl)
                    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-[0_24px_60px_-12px_rgba(15,23,42,0.1)]">
                        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 bg-slate-50/90 px-5 py-4">
                            <h2 class="text-lg font-bold text-slate-900">
                                @if($application->document_type === \App\Enums\DocumentTypeEnum::ACCEPTANCE)
                                    Acceptance letter
                                @elseif($application->document_type === \App\Enums\DocumentTypeEnum::CERTIFICATE)
                                    Certificate
                                @else
                                    Document
                                @endif
                            </h2>
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-500">Preview</span>
                        </div>
                        <div class="w-full bg-slate-100/80" style="height: calc(100vh - 260px); min-height: 560px;">
                            <iframe
                                src="{{ $pdfUrl }}"
                                class="h-full w-full border-0 bg-white"
                                title="{{ $application->document_type === \App\Enums\DocumentTypeEnum::ACCEPTANCE ? 'Acceptance Letter' : 'Certificate' }}"
                            ></iframe>
                        </div>
                    </div>
                @else
                    <div class="flex items-start gap-3 rounded-2xl border border-amber-200/90 bg-amber-50 px-5 py-4" role="status">
                        <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.1 2.448-1.1 3.213 0l6.518 9.375A1.75 1.75 0 0116.03 15H3.97a1.75 1.75 0 01-1.429-2.526L8.257 3.1zM11 11a1 1 0 10-2 0v2a1 1 0 102 0v-2zm-1-4a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <p class="text-sm font-medium text-amber-900 pt-1.5">
                            PDF not found.
                        </p>
                    </div>
                @endif
            </div>
        @endif
    </main>
</div>
