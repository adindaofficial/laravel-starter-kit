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
            ['id' => 'alerts', 'label' => 'Alerts', 'icon' => 'message-square-warning'],
            ['id' => 'cards', 'label' => 'Cards', 'icon' => 'panels-top-left'],
            ['id' => 'modal', 'label' => 'Modal', 'icon' => 'scan-line'],
            ['id' => 'table', 'label' => 'Table', 'icon' => 'table-2'],
            ['id' => 'datatables', 'label' => 'DataTables', 'icon' => 'database'],
            ['id' => 'sweetalert', 'label' => 'SweetAlert2', 'icon' => 'bell-ring'],
            ['id' => 'forms', 'label' => 'Forms', 'icon' => 'text-cursor-input'],
            ['id' => 'routes', 'label' => 'Routes', 'icon' => 'route'],
        ];

        $icons = [
            'layout-dashboard',
            'users',
            'table-2',
            'database',
            'bell-ring',
            'scan-line',
            'settings',
            'log-out',
            'badge-check',
            'calendar-days',
            'key-round',
            'trash-2',
        ];
    @endphp

    <div class="grid gap-5 xl:grid-cols-[17rem_minmax(0,1fr)]">
        <aside class="hidden self-start rounded-lg border border-slate-200 bg-white p-3 shadow-sm xl:sticky xl:top-24 xl:block">
            <div class="px-3 py-2 text-xs font-bold uppercase text-slate-400">Daftar Isi</div>
            <nav class="space-y-1">
                @foreach ($sections as $section)
                    <a href="#{{ $section['id'] }}" class="group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition group-hover:bg-blue-100 group-hover:text-blue-700">
                            <i data-lucide="{{ $section['icon'] }}" class="h-4 w-4"></i>
                        </span>
                        {{ $section['label'] }}
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
                    <p class="mt-1 text-sm text-slate-500">Installer menulis route langsung ke <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">routes/web.php</code>.</p>
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
