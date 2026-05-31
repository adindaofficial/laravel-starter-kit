@extends('layouts.tailwind.app')

@section('title', 'Dokumentasi Starter Kit')
@section('page-kicker', 'Starter Kit')
@section('page-title', 'Dokumentasi UI')
@section('page-subtitle', 'Referensi komponen, contoh tampilan, dan pola kode untuk layout Tailwind Starter Kit.')
@section('page-actions')
    <div class="flex flex-wrap items-center gap-2">
        <a href="{{ url('/users') }}" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border border-blue-200 bg-white px-4 text-sm font-bold text-blue-700 shadow-sm transition hover:bg-blue-50">
            <i data-lucide="users" class="h-4 w-4"></i>
            Users
        </a>
        <button type="button" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700" data-docs-toast>
            <i data-lucide="sparkles" class="h-4 w-4"></i>
            Demo Toast
        </button>
    </div>
@endsection

@section('content')
    @php
        $sections = [
            ['id' => 'overview', 'label' => 'Overview', 'icon' => 'layout-dashboard'],
            ['id' => 'icons', 'label' => 'Icons', 'icon' => 'sparkles'],
            ['id' => 'colors', 'label' => 'Colors', 'icon' => 'palette'],
            ['id' => 'typography', 'label' => 'Typography', 'icon' => 'type'],
            ['id' => 'buttons', 'label' => 'Buttons', 'icon' => 'mouse-pointer-click'],
            ['id' => 'badges', 'label' => 'Badges', 'icon' => 'tag'],
            ['id' => 'alerts', 'label' => 'Alerts', 'icon' => 'message-square-warning'],
            ['id' => 'cards', 'label' => 'Cards', 'icon' => 'panels-top-left'],
            ['id' => 'modal', 'label' => 'Modal', 'icon' => 'scan-line'],
            ['id' => 'table', 'label' => 'Table', 'icon' => 'table-2'],
            ['id' => 'datatables', 'label' => 'DataTables', 'icon' => 'database'],
            ['id' => 'forms', 'label' => 'Forms', 'icon' => 'text-cursor-input'],
            ['id' => 'form-validation', 'label' => 'Form Validation', 'icon' => 'shield-check'],
            ['id' => 'sweetalert', 'label' => 'SweetAlert2', 'icon' => 'bell-ring'],
            ['id' => 'loading', 'label' => 'Loading States', 'icon' => 'loader-circle'],
            ['id' => 'avatars', 'label' => 'Avatars', 'icon' => 'user-circle'],
            ['id' => 'breadcrumbs', 'label' => 'Breadcrumbs', 'icon' => 'chevrons-right'],
            ['id' => 'pagination', 'label' => 'Pagination', 'icon' => 'chevron-right'],
            ['id' => 'tabs', 'label' => 'Tabs', 'icon' => 'folder-open'],
            ['id' => 'tooltips', 'label' => 'Tooltips', 'icon' => 'info'],
            ['id' => 'progress', 'label' => 'Progress Bars', 'icon' => 'trending-up'],
            ['id' => 'routes', 'label' => 'Routes', 'icon' => 'route'],
        ];

        $icons = [
            'layout-dashboard', 'users', 'table-2', 'database', 'bell-ring', 'scan-line',
            'settings', 'log-out', 'badge-check', 'calendar-days', 'key-round', 'trash-2',
            'edit', 'save', 'download', 'upload', 'search', 'filter', 'mail', 'phone',
            'home', 'heart', 'star', 'bookmark', 'share-2', 'message-circle', 'shopping-cart', 'credit-card'
        ];
    @endphp

    <div class="grid gap-5 xl:grid-cols-[18rem_minmax(0,1fr)]">
        <aside class="hidden self-start rounded-xl border border-slate-200 bg-white shadow-lg xl:sticky xl:top-24 xl:block">
            <div class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white px-4 py-3">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-md">
                        <i data-lucide="book-open" class="h-4 w-4"></i>
                    </div>
                    <div class="text-sm font-bold text-slate-900">Daftar Isi</div>
                </div>
            </div>
            <nav class="max-h-[calc(100vh-12rem)] space-y-1 overflow-y-auto p-3">
                @foreach ($sections as $section)
                    <a href="#{{ $section['id'] }}" class="group flex items-center gap-2.5 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-600 transition-all hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 hover:text-blue-700 hover:shadow-sm">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition-all group-hover:bg-blue-500 group-hover:text-white group-hover:shadow-md">
                            <i data-lucide="{{ $section['icon'] }}" class="h-4 w-4"></i>
                        </span>
                        <span class="truncate">{{ $section['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="space-y-5">
            <section id="overview" class="rounded-lg border border-slate-200 bg-white p-5 shadow-panel">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <div class="text-sm font-bold uppercase text-blue-600">Overview</div>
                        <h2 class="mt-1 text-2xl font-bold text-slate-950">Komponen bawaan starter kit</h2>
                        <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">
                            Halaman ini merangkum pola tampilan yang dipakai oleh starter kit: layout dashboard,
                            ikon Lucide, modal, table, DataTables, SweetAlert2, card statistik, alert, dan form.
                        </p>
                    </div>
                    <div class="grid min-w-0 grid-cols-2 gap-3 sm:grid-cols-3">
                        <div class="rounded-lg border border-blue-100 bg-blue-50 p-3">
                            <div class="text-2xl font-bold text-blue-700">10</div>
                            <div class="text-xs font-semibold text-blue-600">Section</div>
                        </div>
                        <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-3">
                            <div class="text-2xl font-bold text-emerald-700">12</div>
                            <div class="text-xs font-semibold text-emerald-600">Icon</div>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                            <div class="text-2xl font-bold text-slate-800">UI</div>
                            <div class="text-xs font-semibold text-slate-500">Ready</div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="icons" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-950">Icons</h2>
                        <p class="mt-1 text-sm text-slate-500">Starter kit memakai Lucide icons melalui atribut <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">data-lucide</code>.</p>
                    </div>
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">Lucide</span>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($icons as $icon)
                        <div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-blue-700 shadow-sm">
                                <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
                            </span>
                            <span class="truncate text-sm font-semibold text-slate-700">{{ $icon }}</span>
                        </div>
                    @endforeach
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;i data-lucide="users" class="h-5 w-5"&gt;&lt;/i&gt;

&lt;button class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white"&gt;
    &lt;i data-lucide="save" class="h-4 w-4"&gt;&lt;/i&gt;
    Simpan
&lt;/button&gt;@endverbatim</code></pre>
            </section>

            <section id="colors" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Color Palette</h2>
                    <p class="mt-1 text-sm text-slate-500">Palet warna yang digunakan dalam starter kit dengan Tailwind CSS.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <div class="mb-2 text-sm font-bold text-slate-700">Primary Colors</div>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-blue-50 ring-1 ring-blue-200"></div>
                                <div class="text-xs font-semibold text-slate-600">blue-50</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-blue-100 ring-1 ring-blue-200"></div>
                                <div class="text-xs font-semibold text-slate-600">blue-100</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-blue-200 ring-1 ring-blue-300"></div>
                                <div class="text-xs font-semibold text-slate-600">blue-200</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-blue-400 ring-1 ring-blue-500"></div>
                                <div class="text-xs font-semibold text-slate-600">blue-400</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-blue-600 ring-1 ring-blue-700"></div>
                                <div class="text-xs font-semibold text-slate-600">blue-600</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-blue-700 ring-1 ring-blue-800"></div>
                                <div class="text-xs font-semibold text-slate-600">blue-700</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-2 text-sm font-bold text-slate-700">Status Colors</div>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-emerald-500 shadow-lg shadow-emerald-500/30"></div>
                                <div class="text-xs font-semibold text-slate-600">Success</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-amber-500 shadow-lg shadow-amber-500/30"></div>
                                <div class="text-xs font-semibold text-slate-600">Warning</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-rose-500 shadow-lg shadow-rose-500/30"></div>
                                <div class="text-xs font-semibold text-slate-600">Danger</div>
                            </div>
                            <div class="space-y-2">
                                <div class="h-16 rounded-lg bg-slate-500 shadow-lg shadow-slate-500/30"></div>
                                <div class="text-xs font-semibold text-slate-600">Neutral</div>
                            </div>
                        </div>
                    </div>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;div class="bg-blue-600 text-white"&gt;Primary&lt;/div&gt;
&lt;div class="bg-emerald-500 text-white"&gt;Success&lt;/div&gt;
&lt;div class="bg-amber-500 text-white"&gt;Warning&lt;/div&gt;
&lt;div class="bg-rose-500 text-white"&gt;Danger&lt;/div&gt;@endverbatim</code></pre>
            </section>

            <section id="typography" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Typography</h2>
                    <p class="mt-1 text-sm text-slate-500">Hierarki tipografi untuk heading, body text, dan utility text.</p>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <h1 class="text-4xl font-bold text-slate-900">Heading 1 - 4xl Bold</h1>
                        <h2 class="text-3xl font-bold text-slate-900">Heading 2 - 3xl Bold</h2>
                        <h3 class="text-2xl font-bold text-slate-900">Heading 3 - 2xl Bold</h3>
                        <h4 class="text-xl font-bold text-slate-900">Heading 4 - xl Bold</h4>
                        <h5 class="text-lg font-bold text-slate-900">Heading 5 - lg Bold</h5>
                        <h6 class="text-base font-bold text-slate-900">Heading 6 - base Bold</h6>
                    </div>

                    <div class="space-y-2 border-t border-slate-200 pt-4">
                        <p class="text-base text-slate-700">Body text - Regular 16px untuk konten utama dan paragraf panjang.</p>
                        <p class="text-sm text-slate-600">Small text - Regular 14px untuk deskripsi dan keterangan tambahan.</p>
                        <p class="text-xs text-slate-500">Extra small - Regular 12px untuk label, caption, dan metadata.</p>
                    </div>

                    <div class="space-y-2 border-t border-slate-200 pt-4">
                        <p class="font-bold text-slate-900">Bold text untuk emphasis</p>
                        <p class="font-semibold text-slate-800">Semibold untuk sub-heading</p>
                        <p class="font-medium text-slate-700">Medium untuk highlight</p>
                        <p class="italic text-slate-600">Italic untuk quote atau catatan</p>
                        <p class="font-mono text-sm text-slate-700">Monospace untuk code inline</p>
                    </div>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;h1 class="text-4xl font-bold text-slate-900"&gt;Heading 1&lt;/h1&gt;
&lt;p class="text-base text-slate-700"&gt;Body text&lt;/p&gt;
&lt;p class="text-sm text-slate-600"&gt;Small text&lt;/p&gt;
&lt;code class="font-mono text-sm"&gt;Code inline&lt;/code&gt;@endverbatim</code></pre>
            </section>

            <section id="buttons" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Buttons</h2>
                    <p class="mt-1 text-sm text-slate-500">Berbagai variasi button dengan size, color, dan state yang berbeda.</p>
                </div>

                <div class="space-y-6">
                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Primary Buttons</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700 active:scale-95">
                                <i data-lucide="save" class="h-4 w-4"></i>
                                Primary Button
                            </button>
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-emerald-600 px-5 text-sm font-bold text-white shadow-lg shadow-emerald-600/30 transition hover:bg-emerald-700 active:scale-95">
                                <i data-lucide="check" class="h-4 w-4"></i>
                                Success
                            </button>
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-rose-600 px-5 text-sm font-bold text-white shadow-lg shadow-rose-600/30 transition hover:bg-rose-700 active:scale-95">
                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                Danger
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Outline Buttons</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border-2 border-blue-600 bg-white px-5 text-sm font-bold text-blue-700 transition hover:bg-blue-50 active:scale-95">
                                <i data-lucide="edit" class="h-4 w-4"></i>
                                Outline
                            </button>
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border-2 border-emerald-600 bg-white px-5 text-sm font-bold text-emerald-700 transition hover:bg-emerald-50 active:scale-95">
                                <i data-lucide="check-circle" class="h-4 w-4"></i>
                                Success
                            </button>
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border-2 border-slate-300 bg-white px-5 text-sm font-bold text-slate-700 transition hover:bg-slate-50 active:scale-95">
                                <i data-lucide="x" class="h-4 w-4"></i>
                                Cancel
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Button Sizes</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <button class="inline-flex h-8 items-center justify-center rounded-lg bg-blue-600 px-3 text-xs font-bold text-white transition hover:bg-blue-700">Small</button>
                            <button class="inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-bold text-white transition hover:bg-blue-700">Medium</button>
                            <button class="inline-flex h-11 items-center justify-center rounded-lg bg-blue-600 px-5 text-sm font-bold text-white transition hover:bg-blue-700">Default</button>
                            <button class="inline-flex h-12 items-center justify-center rounded-lg bg-blue-600 px-6 text-base font-bold text-white transition hover:bg-blue-700">Large</button>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Icon Buttons</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <button class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white shadow-md transition hover:bg-blue-700 active:scale-95">
                                <i data-lucide="search" class="h-5 w-5"></i>
                            </button>
                            <button class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-600 text-white shadow-md transition hover:bg-emerald-700 active:scale-95">
                                <i data-lucide="heart" class="h-5 w-5"></i>
                            </button>
                            <button class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-amber-600 text-white shadow-md transition hover:bg-amber-700 active:scale-95">
                                <i data-lucide="star" class="h-5 w-5"></i>
                            </button>
                            <button class="inline-flex h-10 w-10 items-center justify-center rounded-lg border-2 border-slate-300 bg-white text-slate-700 transition hover:bg-slate-50 active:scale-95">
                                <i data-lucide="settings" class="h-5 w-5"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Button States</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <button class="inline-flex h-11 items-center justify-center rounded-lg bg-blue-600 px-5 text-sm font-bold text-white transition hover:bg-blue-700">Normal</button>
                            <button class="inline-flex h-11 items-center justify-center rounded-lg bg-blue-600 px-5 text-sm font-bold text-white opacity-50 cursor-not-allowed" disabled>Disabled</button>
                            <button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-bold text-white">
                                <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </button>
                        </div>
                    </div>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;button class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-bold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700 active:scale-95"&gt;
    &lt;i data-lucide="save" class="h-4 w-4"&gt;&lt;/i&gt;
    Primary Button
&lt;/button&gt;@endverbatim</code></pre>
            </section>

            <section id="badges" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Badges & Labels</h2>
                    <p class="mt-1 text-sm text-slate-500">Badge untuk status, kategori, dan label informasi.</p>
                </div>

                <div class="space-y-6">
                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Status Badges</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Active
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700 ring-1 ring-blue-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                Processing
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 ring-1 ring-amber-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                Pending
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-700 ring-1 ring-rose-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                Inactive
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-700 ring-1 ring-slate-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                                Draft
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Solid Badges</div>
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-bold text-white shadow-md">
                                <i data-lucide="tag" class="h-3 w-3"></i>
                                Primary
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-bold text-white shadow-md">
                                <i data-lucide="check" class="h-3 w-3"></i>
                                Success
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-amber-600 px-3 py-1.5 text-xs font-bold text-white shadow-md">
                                <i data-lucide="alert-triangle" class="h-3 w-3"></i>
                                Warning
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-bold text-white shadow-md">
                                <i data-lucide="x-circle" class="h-3 w-3"></i>
                                Danger
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Count Badges</div>
                        <div class="flex flex-wrap items-center gap-4">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold text-slate-700">Messages</span>
                                <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-blue-600 px-2 text-xs font-bold text-white">12</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold text-slate-700">Notifications</span>
                                <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-rose-600 px-2 text-xs font-bold text-white">99+</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold text-slate-700">Cart</span>
                                <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-emerald-600 px-2 text-xs font-bold text-white">3</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 text-sm font-bold text-slate-700">Removable Badges</div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 ring-1 ring-blue-200">
                                Laravel
                                <button class="hover:text-blue-900">
                                    <i data-lucide="x" class="h-3 w-3"></i>
                                </button>
                            </span>
                            <span class="inline-flex items-center gap-2 rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                Tailwind
                                <button class="hover:text-emerald-900">
                                    <i data-lucide="x" class="h-3 w-3"></i>
                                </button>
                            </span>
                            <span class="inline-flex items-center gap-2 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 ring-1 ring-amber-200">
                                Alpine.js
                                <button class="hover:text-amber-900">
                                    <i data-lucide="x" class="h-3 w-3"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200"&gt;
    &lt;span class="h-1.5 w-1.5 rounded-full bg-emerald-500"&gt;&lt;/span&gt;
    Active
&lt;/span&gt;@endverbatim</code></pre>
            </section>

            <section id="alerts" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Alerts</h2>
                    <p class="mt-1 text-sm text-slate-500">Komponen alert tersedia untuk info, success, warning, danger, dan primary.</p>
                </div>

                <div class="grid gap-3 lg:grid-cols-2">
                    @include('layouts.tailwind.components.alert', ['type' => 'primary', 'title' => 'Primary alert', 'content' => 'Gunakan untuk informasi penting di halaman utama.'])
                    @include('layouts.tailwind.components.alert', ['type' => 'success', 'title' => 'Success alert', 'content' => 'Data berhasil diproses dan siap digunakan.'])
                    @include('layouts.tailwind.components.alert', ['type' => 'warning', 'title' => 'Warning alert', 'content' => 'Periksa kembali konfigurasi sebelum deploy.'])
                    @include('layouts.tailwind.components.alert', ['type' => 'danger', 'title' => 'Danger alert', 'content' => 'Aksi ini membutuhkan perhatian tambahan.'])
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim@include('layouts.tailwind.components.alert', [
    'type' => 'success',
    'title' => 'Berhasil',
    'content' => 'Data berhasil disimpan.',
])@endverbatim</code></pre>
            </section>

            <section id="cards" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Stat Cards</h2>
                    <p class="mt-1 text-sm text-slate-500">Gunakan card statistik untuk ringkasan angka dashboard.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    @include('layouts.tailwind.components.stat-card', ['label' => 'Total User', 'value' => '128', 'icon' => 'users'])
                    @include('layouts.tailwind.components.stat-card', ['label' => 'Terverifikasi', 'value' => '112', 'icon' => 'badge-check'])
                    @include('layouts.tailwind.components.stat-card', ['label' => 'Aktif Hari Ini', 'value' => '34', 'icon' => 'activity'])
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim@include('layouts.tailwind.components.stat-card', [
    'label' => 'Total User',
    'value' => $totalUsers,
    'icon' => 'users',
])@endverbatim</code></pre>
            </section>

            <section id="modal" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-950">Modal</h2>
                        <p class="mt-1 text-sm text-slate-500">Modal memakai atribut <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">data-starter-modal</code> dan helper JS <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">window.StarterKit.openModal()</code>.</p>
                    </div>
                    <button type="button" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-bold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700" data-docs-open-modal>
                        <i data-lucide="scan-line" class="h-4 w-4"></i>
                        Buka Modal
                    </button>
                </div>

                <div class="rounded-lg border border-blue-100 bg-blue-50 p-4 text-sm text-blue-900">
                    Modal otomatis bisa ditutup lewat tombol close, backdrop, atau tombol Escape.
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;button type="button" onclick="window.StarterKit.openModal('exampleModal')"&gt;
    Buka Modal
&lt;/button&gt;

&lt;div id="exampleModal" class="fixed inset-0 z-50 hidden" data-starter-modal&gt;
    &lt;div class="absolute inset-0 bg-slate-950/55" data-starter-modal-backdrop&gt;&lt;/div&gt;
    &lt;div class="relative flex min-h-full items-center justify-center p-4"&gt;
        &lt;div class="w-full max-w-lg rounded-lg bg-white" data-starter-modal-panel&gt;
            Konten modal
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;@endverbatim</code></pre>
            </section>

            <section id="table" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Table</h2>
                    <p class="mt-1 text-sm text-slate-500">Contoh table statis untuk data sederhana tanpa plugin.</p>
                </div>

                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="w-full min-w-[720px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-bold uppercase text-slate-500">
                            <tr>
                                <th class="px-4 py-3">Komponen</th>
                                <th class="px-4 py-3">Fungsi</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr>
                                <td class="px-4 py-3 font-semibold text-slate-900">Navbar</td>
                                <td class="px-4 py-3 text-slate-600">Navigasi atas dan profile dropdown.</td>
                                <td class="px-4 py-3"><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">Ready</span></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-slate-900">Sidebar</td>
                                <td class="px-4 py-3 text-slate-600">Menu dashboard, users, dan dokumentasi.</td>
                                <td class="px-4 py-3"><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">Ready</span></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-slate-900">Footer</td>
                                <td class="px-4 py-3 text-slate-600">Informasi sistem dan versi starter kit.</td>
                                <td class="px-4 py-3"><span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">Included</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;div class="overflow-x-auto rounded-lg border border-slate-200"&gt;
    &lt;table class="w-full min-w-[720px] text-left text-sm"&gt;
        &lt;thead class="bg-slate-50 text-xs font-bold uppercase text-slate-500"&gt;
            &lt;tr&gt;
                &lt;th class="px-4 py-3"&gt;Nama&lt;/th&gt;
                &lt;th class="px-4 py-3"&gt;Email&lt;/th&gt;
            &lt;/tr&gt;
        &lt;/thead&gt;
    &lt;/table&gt;
&lt;/div&gt;@endverbatim</code></pre>
            </section>

            <section id="datatables" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">DataTables</h2>
                    <p class="mt-1 text-sm text-slate-500">Tambahkan class <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">starter-datatable</code> dan id unik. Script starter kit akan mengaktifkan search, length, sorting, pagination, prev, dan next.</p>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white p-4">
                    <table id="documentationDataTable" class="starter-datatable w-full text-left text-sm">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DataTables Users</td>
                                <td>Table plugin</td>
                                <td><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">Ready</span></td>
                            </tr>
                            <tr>
                                <td>Search Box</td>
                                <td>Filter</td>
                                <td><span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">Active</span></td>
                            </tr>
                            <tr>
                                <td>Pagination</td>
                                <td>Navigation</td>
                                <td><span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;table id="exampleDataTable" class="starter-datatable w-full text-left text-sm"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;Nama&lt;/th&gt;
            &lt;th&gt;Kategori&lt;/th&gt;
            &lt;th&gt;Status&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;tr&gt;
            &lt;td&gt;DataTables&lt;/td&gt;
            &lt;td&gt;Plugin&lt;/td&gt;
            &lt;td&gt;Ready&lt;/td&gt;
        &lt;/tr&gt;
    &lt;/tbody&gt;
&lt;/table&gt;@endverbatim</code></pre>
            </section>

            <section id="sweetalert" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-950">SweetAlert2</h2>
                        <p class="mt-1 text-sm text-slate-500">Gunakan <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">window.StarterKit.toast()</code> untuk notifikasi singkat atau <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">Swal.fire()</code> untuk dialog custom.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 text-sm font-bold text-emerald-700 hover:bg-emerald-100" data-docs-toast>
                            <i data-lucide="check-circle" class="h-4 w-4"></i>
                            Toast
                        </button>
                        <button type="button" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-amber-200 bg-amber-50 px-4 text-sm font-bold text-amber-700 hover:bg-amber-100" data-docs-alert>
                            <i data-lucide="circle-alert" class="h-4 w-4"></i>
                            Dialog
                        </button>
                    </div>
                </div>

                <pre class="overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatimwindow.StarterKit.toast('Berhasil', 'Data berhasil disimpan.');

Swal.fire({
    icon: 'warning',
    title: 'Konfirmasi',
    text: 'Pastikan data sudah benar.',
    confirmButtonText: 'Mengerti'
});@endverbatim</code></pre>
            </section>

            <section id="forms" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Forms</h2>
                    <p class="mt-1 text-sm text-slate-500">Pola input dibuat sederhana, konsisten, dan fokus pada state focus yang jelas.</p>
                </div>

                <form class="grid gap-4 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Nama</span>
                        <input type="text" value="Administrator" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                    </label>
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Email</span>
                        <input type="email" value="admin@example.com" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                    </label>
                    <label class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3 md:col-span-2">
                        <input type="checkbox" checked class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>
                            <span class="block text-sm font-semibold text-slate-800">Email terverifikasi</span>
                            <span class="block text-xs text-slate-500">Gunakan checkbox untuk status boolean.</span>
                        </span>
                    </label>
                </form>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatim&lt;label class="block"&gt;
    &lt;span class="text-sm font-semibold text-slate-700"&gt;Email&lt;/span&gt;
    &lt;input type="email" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100"&gt;
&lt;/label&gt;@endverbatim</code></pre>
            </section>

            <section id="routes" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-slate-950">Routes dan install</h2>
                    <p class="mt-1 text-sm text-slate-500">Installer membaca route package dari <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">routes/web.php</code> lalu menambahkannya ke <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">routes/web.php</code> aplikasi.</p>
                </div>

                <div class="grid gap-3 lg:grid-cols-2">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <div class="text-sm font-bold text-slate-900">Halaman Users</div>
                        <div class="mt-1 font-mono text-sm text-blue-700">GET /users</div>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <div class="text-sm font-bold text-slate-900">Halaman Dokumentasi</div>
                        <div class="mt-1 font-mono text-sm text-blue-700">GET /documentation</div>
                    </div>
                </div>

                <pre class="mt-4 overflow-x-auto rounded-lg bg-slate-950 p-4 text-xs leading-6 text-slate-100"><code>@verbatimphp artisan starter-kit:install --force
php artisan view:clear@endverbatim</code></pre>
            </section>
        </div>
    </div>

    <div id="docsExampleModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-lg translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <div class="flex items-start justify-between gap-4 border-b border-slate-200 bg-gradient-to-r from-blue-50 via-white to-white p-5">
                    <div class="flex items-start gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                            <i data-lucide="scan-line" class="h-5 w-5"></i>
                        </span>
                        <div>
                            <h3 class="text-base font-bold text-slate-950">Contoh Modal</h3>
                            <p class="mt-1 text-sm text-slate-500">Ini adalah modal dokumentasi yang memakai helper bawaan starter kit.</p>
                        </div>
                    </div>
                    <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>

                <div class="space-y-3 p-5 text-sm text-slate-600">
                    <p>Gunakan struktur ini untuk form tambah, edit, reset password, konfirmasi delete, atau detail data.</p>
                    <div class="rounded-lg border border-blue-100 bg-blue-50 p-3 text-blue-800">Modal mendukung close via backdrop dan Escape.</div>
                </div>

                <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                    <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (event) {
                if (event.target.closest('[data-docs-open-modal]')) {
                    window.StarterKit.openModal('docsExampleModal');
                }

                if (event.target.closest('[data-docs-toast]')) {
                    window.StarterKit.toast('Dokumentasi siap', 'Contoh SweetAlert2 berhasil dijalankan.');
                }

                if (event.target.closest('[data-docs-alert]')) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Contoh Dialog',
                        text: 'Gunakan Swal.fire untuk konfirmasi atau pesan yang membutuhkan aksi user.',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#2563eb'
                    });
                }
            });

            lucide.createIcons();
        });
    </script>
@endpush
