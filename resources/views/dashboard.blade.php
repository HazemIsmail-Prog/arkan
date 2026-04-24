<x-layouts.app :title="__('Dashboard')">
    <div x-data="dashboardComponent(@js($dashboardPayload))" class="relative flex h-full w-full flex-1 flex-col gap-5">
        <div class="pointer-events-none absolute inset-x-0 -top-20 h-80 rounded-[3rem] bg-white/60 blur-3xl dark:bg-zinc-900/40"></div>

        <section class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/70 p-6 shadow-[0_10px_30px_rgba(15,23,42,0.08),0_2px_8px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_18px_38px_rgba(0,0,0,0.38),0_2px_8px_rgba(0,0,0,0.25),inset_0_1px_0_rgba(255,255,255,0.05)] lg:p-7">
            <div class="absolute inset-x-10 -bottom-14 h-24 rounded-full bg-black/5 blur-2xl dark:bg-black/35"></div>

            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <flux:heading size="xl">{{ __('Dashboard') }}</flux:heading>
                    <flux:text class="mt-2 max-w-2xl text-sm text-zinc-600 dark:text-zinc-300">{{ __('Monitor execution status, schedule completion, pending approvals, equipment availability, and active team members from one workspace.') }}</flux:text>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                    <div class="rounded-2xl border border-white/70 bg-white/80 px-4 py-3 shadow-[0_8px_20px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.85)] backdrop-blur dark:border-zinc-700/70 dark:bg-zinc-800/70 dark:shadow-[0_10px_24px_rgba(0,0,0,0.28),inset_0_1px_0_rgba(255,255,255,0.04)]">
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Work') }}</p>
                        <p class="mt-1 text-xl font-semibold tabular-nums text-zinc-900 dark:text-white" x-text="workProgressPct + '%'"></p>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/80 px-4 py-3 shadow-[0_8px_20px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.85)] backdrop-blur dark:border-zinc-700/70 dark:bg-zinc-800/70 dark:shadow-[0_10px_24px_rgba(0,0,0,0.28),inset_0_1px_0_rgba(255,255,255,0.04)]">
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Timeline') }}</p>
                        <p class="mt-1 text-xl font-semibold tabular-nums text-zinc-900 dark:text-white" x-text="timelineProgressPct + '%'"></p>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/80 px-4 py-3 shadow-[0_8px_20px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.85)] backdrop-blur dark:border-zinc-700/70 dark:bg-zinc-800/70 dark:shadow-[0_10px_24px_rgba(0,0,0,0.28),inset_0_1px_0_rgba(255,255,255,0.04)]">
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Approvals') }}</p>
                        <p class="mt-1 text-xl font-semibold tabular-nums text-zinc-900 dark:text-white" x-text="approvals.length"></p>
                    </div>
                    <div class="rounded-2xl border border-white/70 bg-white/80 px-4 py-3 shadow-[0_8px_20px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.85)] backdrop-blur dark:border-zinc-700/70 dark:bg-zinc-800/70 dark:shadow-[0_10px_24px_rgba(0,0,0,0.28),inset_0_1px_0_rgba(255,255,255,0.04)]">
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Assets') }}</p>
                        <p class="mt-1 text-xl font-semibold tabular-nums text-zinc-900 dark:text-white" x-text="equipment.length"></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-5 lg:grid-cols-12">
            <div class="space-y-5 lg:col-span-4">
                <article class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-[0_12px_30px_rgba(15,23,42,0.1),0_4px_10px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl transition-transform duration-300 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_20px_40px_rgba(0,0,0,0.36),0_3px_10px_rgba(0,0,0,0.22),inset_0_1px_0_rgba(255,255,255,0.05)]">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <flux:heading size="lg">{{ __('Work progress') }}</flux:heading>
                            <flux:text class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Percentage of planned project tasks completed against the approved scope.') }}</flux:text>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="relative shrink-0">
                            <svg viewBox="0 0 120 120" class="size-24 text-emerald-500 dark:text-emerald-400" aria-hidden="true">
                                <circle cx="60" cy="60" r="52" fill="none" class="stroke-zinc-200/70 dark:stroke-zinc-700" stroke-width="10" />
                                <circle cx="60" cy="60" r="52" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round" x-bind:stroke-dasharray="ringCirc" x-bind:stroke-dashoffset="workDashOffset" transform="rotate(-90 60 60)" />
                            </svg>
                            <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                                <span class="text-base font-semibold tabular-nums text-zinc-900 dark:text-white" x-text="workProgressPct + '%'"></span>
                            </div>
                        </div>
                        <div class="w-full space-y-3">
                            <div class="h-2.5 overflow-hidden rounded-full bg-white/90 shadow-inner dark:bg-zinc-800">
                            <div class="h-full rounded-full bg-emerald-500 transition-all dark:bg-emerald-400" :style="{ width: workProgressPct + '%' }"></div>
                            </div>
                            <div class="flex justify-between text-xs text-zinc-500 dark:text-zinc-400"><span>{{ __('Done') }}</span><span class="tabular-nums" x-text="workProgressPct + '%'"></span></div>
                        </div>
                    </div>
                </article>

                <article class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-[0_12px_30px_rgba(15,23,42,0.1),0_4px_10px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl transition-transform duration-300 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_20px_40px_rgba(0,0,0,0.36),0_3px_10px_rgba(0,0,0,0.22),inset_0_1px_0_rgba(255,255,255,0.05)]">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <flux:heading size="lg">{{ __('Project timeline') }}</flux:heading>
                            <flux:text class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Current completion level of scheduled phases versus the baseline timeline.') }}</flux:text>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="relative shrink-0">
                            <svg viewBox="0 0 120 120" class="size-24 text-sky-500 dark:text-sky-400" aria-hidden="true">
                                <circle cx="60" cy="60" r="52" fill="none" class="stroke-zinc-200/70 dark:stroke-zinc-700" stroke-width="10" />
                                <circle cx="60" cy="60" x-bind:r="ringRadius" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round" x-bind:stroke-dasharray="ringCirc" x-bind:stroke-dashoffset="timelineDashOffset" transform="rotate(-90 60 60)" />
                            </svg>
                            <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                                <span class="text-base font-semibold tabular-nums text-zinc-900 dark:text-white" x-text="timelineProgressPct + '%'"></span>
                            </div>
                        </div>
                        <div class="w-full space-y-3">
                            <div class="h-2.5 overflow-hidden rounded-full bg-white/90 shadow-inner dark:bg-zinc-800">
                            <div class="h-full rounded-full bg-sky-500 transition-all dark:bg-sky-400" :style="{ width: timelineProgressPct + '%' }"></div>
                            </div>
                            <div class="flex justify-between text-xs text-zinc-500 dark:text-zinc-400"><span>{{ __('Done') }}</span><span class="tabular-nums" x-text="timelineProgressPct + '%'"></span></div>
                        </div>
                    </div>
                </article>
            </div>
            <article class="overflow-hidden rounded-3xl border border-white/60 bg-white/70 p-5 shadow-[0_12px_30px_rgba(15,23,42,0.1),0_4px_10px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl transition-transform duration-300 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_20px_40px_rgba(0,0,0,0.36),0_3px_10px_rgba(0,0,0,0.22),inset_0_1px_0_rgba(255,255,255,0.05)] lg:col-span-8">
                <div class="mb-4 flex items-start justify-between gap-3">
                    <div>
                        <flux:heading size="lg">{{ __('Photo gallery') }}</flux:heading>
                        <flux:text class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Latest on-site photos documenting construction progress and field activities.') }}</flux:text>
                    </div>
                    <div class="flex gap-1">
                        <flux:button variant="ghost" size="sm" square icon="chevron-left" @click="galleryPrev" type="button" aria-label="{{ __('Previous image') }}"></flux:button>
                        <flux:button variant="ghost" size="sm" square icon="chevron-right" @click="galleryNext" type="button" aria-label="{{ __('Next image') }}"></flux:button>
                    </div>
                </div>
                <div class="overflow-hidden rounded-2xl border border-white/70 bg-white/60 shadow-inner dark:border-zinc-700/80 dark:bg-zinc-900/40">
                    <div class="relative aspect-[16/9] w-full">
                        <template x-for="(src, i) in galleryImages" :key="i">
                            <div x-show="slideIndex === i" x-transition.opacity.duration.300ms class="absolute inset-0">
                                <img :src="src" class="size-full object-cover" loading="lazy" decoding="async" x-bind:alt="galleryPhotoAlt(i)" />
                            </div>
                        </template>
                    </div>
                </div>
                <div class="mt-4 flex justify-center gap-2">
                    <template x-for="(src, i) in galleryImages" :key="i">
                        <button type="button" class="h-2.5 rounded-full transition-all" :class="slideIndex === i ? 'w-8 bg-zinc-700 dark:bg-zinc-300' : 'w-2.5 bg-zinc-300 dark:bg-zinc-600'" @click="galleryGo(src, i)" x-bind:aria-label="gallerySlideAria(i)"></button>
                    </template>
                </div>
            </article>

        </section>

        <section class="grid gap-5 lg:grid-cols-3">

            <article class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-[0_12px_30px_rgba(15,23,42,0.1),0_4px_10px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl transition-transform duration-300 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_20px_40px_rgba(0,0,0,0.36),0_3px_10px_rgba(0,0,0,0.22),inset_0_1px_0_rgba(255,255,255,0.05)]">
                <div class="mb-4 flex items-end justify-between">
                    <flux:heading size="lg">{{ __('Required approvals') }}</flux:heading>
                    <flux:text class="text-xs text-zinc-400 dark:text-zinc-500"><span x-text="approvals.length"></span> {{ __('items') }}</flux:text>
                </div>
                <div class="space-y-2">
                    <template x-for="item in approvals" :key="item.id">
                        <div class="rounded-2xl border border-white/70 bg-white/80 p-3 shadow-[0_6px_18px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur dark:border-zinc-700/70 dark:bg-zinc-800/60 dark:shadow-[0_10px_22px_rgba(0,0,0,0.26),inset_0_1px_0_rgba(255,255,255,0.04)]">
                            <div class="mb-2 flex items-center justify-between gap-2">
                                <p class="truncate text-sm font-medium text-zinc-900 dark:text-white" x-text="item.title"></p>
                                <div class="shrink-0">
                                    <template x-if="item.status === 'completed'"><flux:badge color="green" size="sm"><span>{{ __('Completed') }}</span></flux:badge></template>
                                    <template x-if="item.status === 'pending'"><flux:badge color="amber" size="sm"><span>{{ __('Pending') }}</span></flux:badge></template>
                                    <template x-if="item.status === 'in_progress'"><flux:badge color="blue" size="sm"><span>{{ __('In progress') }}</span></flux:badge></template>
                                    <template x-if="item.status === 'rejected'"><flux:badge color="red" size="sm"><span>{{ __('Rejected') }}</span></flux:badge></template>
                                </div>
                            </div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400" x-text="item.authority"></p>
                        </div>
                    </template>
                </div>
            </article>

            <article class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-[0_12px_30px_rgba(15,23,42,0.1),0_4px_10px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl transition-transform duration-300 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_20px_40px_rgba(0,0,0,0.36),0_3px_10px_rgba(0,0,0,0.22),inset_0_1px_0_rgba(255,255,255,0.05)]">
                <div class="mb-4 flex items-end justify-between">
                    <flux:heading size="lg">{{ __('Equipment') }}</flux:heading>
                    <flux:text class="text-xs text-zinc-400 dark:text-zinc-500"><span x-text="equipment.length"></span> {{ __('units') }}</flux:text>
                </div>
                <div class="space-y-2">
                    <template x-for="unit in equipment" :key="unit.id">
                        <div class="flex items-center justify-between gap-3 rounded-2xl border border-white/70 bg-white/80 p-3 shadow-[0_6px_18px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur transition-transform duration-200 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-800/60 dark:shadow-[0_10px_22px_rgba(0,0,0,0.26),inset_0_1px_0_rgba(255,255,255,0.04)]">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-zinc-900 dark:text-white" x-text="unit.name"></p>
                                <p class="truncate text-xs text-zinc-500 dark:text-zinc-400" x-text="unit.type"></p>
                            </div>
                            <div class="shrink-0">
                                <template x-if="unit.location === 'on_site'"><flux:badge color="emerald" size="sm"><span>{{ __('On site') }}</span></flux:badge></template>
                                <template x-if="unit.location !== 'on_site'"><flux:badge size="sm"><span>{{ __('Off site') }}</span></flux:badge></template>
                            </div>
                        </div>
                    </template>
                </div>
            </article>

            <article class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-[0_12px_30px_rgba(15,23,42,0.1),0_4px_10px_rgba(15,23,42,0.05),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur-xl transition-transform duration-300 hover:-translate-y-0.5 dark:border-zinc-700/70 dark:bg-zinc-900/65 dark:shadow-[0_20px_40px_rgba(0,0,0,0.36),0_3px_10px_rgba(0,0,0,0.22),inset_0_1px_0_rgba(255,255,255,0.05)]">
                <div class="mb-4 flex items-end justify-between">
                    <flux:heading size="lg">{{ __('Project team') }}</flux:heading>
                    <flux:text class="text-xs text-zinc-400 dark:text-zinc-500"><span x-text="projectTeam.length"></span> {{ __('members') }}</flux:text>
                </div>
                <div class="space-y-2">
                    <template x-for="member in projectTeam" :key="member.id">
                        <div class="flex items-center gap-3 rounded-2xl border border-white/70 bg-white/80 p-3 shadow-[0_6px_18px_rgba(15,23,42,0.08),inset_0_1px_0_rgba(255,255,255,0.8)] backdrop-blur dark:border-zinc-700/70 dark:bg-zinc-800/60 dark:shadow-[0_10px_22px_rgba(0,0,0,0.26),inset_0_1px_0_rgba(255,255,255,0.04)]">
                            <img :src="member.company.logo_url" class="h-9 w-9 rounded-lg border border-white/50 bg-white object-contain p-1 dark:border-zinc-700 dark:bg-zinc-800" />
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-zinc-900 dark:text-white" x-text="member.name"></p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400" x-text="member.title"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </article>

        </section>

    </div>
</x-layouts.app>
