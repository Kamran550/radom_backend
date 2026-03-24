<div class="min-h-screen flex flex-col relative overflow-x-hidden bg-slate-50">
    {{-- Background: soft mesh + grain feel (no purple / generic look) --}}
    <div class="pointer-events-none fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_120%_80%_at_50%_-20%,rgba(20,184,166,0.18),transparent_55%),radial-gradient(ellipse_90%_60%_at_100%_50%,rgba(15,118,110,0.12),transparent_50%),radial-gradient(ellipse_70%_50%_at_0%_100%,rgba(51,65,85,0.08),transparent_45%)]"></div>
        <div class="absolute inset-0 opacity-[0.35]" style="background-image: url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);"></div>
    </div>

    <header class="relative z-10 border-b border-slate-200/80 bg-white/80 backdrop-blur-md shadow-[0_1px_0_rgba(15,23,42,0.04)]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-4 sm:py-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('images/MUST-logo-dark.png') }}"
                    alt="MUST Logo"
                    class="h-12 sm:h-16 md:h-[4.25rem] w-auto object-contain"
                >
            </div>
            <span class="hidden sm:inline-flex text-xs font-medium uppercase tracking-[0.2em] text-teal-700/80">
                Official verify
            </span>
        </div>
    </header>

    <main class="relative z-10 flex-1 px-4 py-10 sm:py-14 lg:py-16">
        @if(!$application || $messageType !== 'success')
            <div class="max-w-xl mx-auto">
                <div class="relative">
                    <div class="absolute -inset-px rounded-3xl bg-gradient-to-br from-teal-400/40 via-slate-300/30 to-teal-600/25 blur-sm"></div>
                    <div class="relative rounded-3xl border border-slate-200/90 bg-white/95 backdrop-blur-sm shadow-[0_24px_60px_-12px_rgba(15,23,42,0.12),0_0_0_1px_rgba(255,255,255,0.8)_inset] px-6 sm:px-10 py-9 sm:py-11">
                        <div class="flex flex-col items-center text-center mb-8">
                            <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-500 to-teal-700 text-white shadow-lg shadow-teal-500/25">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-teal-700/90 mb-2">
                                Document authenticity
                            </p>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">
                                Verify your document
                            </h1>
                            <p class="mt-3 text-sm sm:text-base text-slate-600 max-w-md leading-relaxed">
                                Enter the verification code printed on your document or shared with you. We will confirm that the file matches our records.
                            </p>
                        </div>

                        <form wire:submit.prevent="verify" class="space-y-5">
                            <div class="text-left">
                                <label for="verificationCode" class="block text-sm font-semibold text-slate-800 mb-2">
                                    Verification code
                                </label>
                                <input
                                    type="text"
                                    id="verificationCode"
                                    wire:model="verificationCode"
                                    placeholder="e.g. ABC123XY"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50/80 px-4 py-3.5 text-base text-slate-900 placeholder:text-slate-400 shadow-inner shadow-slate-900/5 outline-none transition focus:border-teal-500 focus:bg-white focus:ring-2 focus:ring-teal-500/20"
                                    autocomplete="off"
                                    autofocus
                                >
                            </div>

                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="group relative w-full overflow-hidden rounded-xl bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-3.5 text-center text-base font-semibold text-white shadow-lg shadow-teal-600/25 outline-none transition hover:from-teal-700 hover:to-teal-800 focus-visible:ring-2 focus-visible:ring-teal-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-55"
                            >
                                <span class="relative z-10 inline-flex items-center justify-center gap-2">
                                    <span wire:loading.remove wire:target="verify">Verify document</span>
                                    <span wire:loading wire:target="verify" class="inline-flex items-center gap-2">
                                        Verifying…
                                    </span>
                                    <svg wire:loading.remove wire:target="verify" class="h-5 w-5 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </span>
                            </button>
                        </form>

                        @if($message && $messageType !== 'success')
                            <div class="mt-6 flex items-start gap-3 rounded-xl border border-red-200/90 bg-red-50/90 px-4 py-3 text-left" role="alert">
                                <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <p class="text-sm font-medium text-red-900 leading-snug pt-1">
                                    {{ $message }}
                                </p>
                            </div>
                        @endif
                    </div>
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
