<nav class="sticky top-0 z-30 border-b border-zinc-200 bg-white">
    <div class="flex min-h-16 items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <a href="{{ url('/') }}" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-zinc-900 text-white lg:hidden">
                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
            </a>
            <div class="min-w-0">
                <div class="truncate text-sm font-semibold">{{ config('app.name', 'Laravel') }}</div>
                <div class="truncate text-xs text-zinc-500">Tailwind UI</div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ url('/users') }}" class="inline-flex h-9 items-center gap-2 rounded-lg border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 hover:bg-zinc-50 lg:hidden">
                <i data-lucide="users" class="h-4 w-4"></i>
                <span>Users</span>
            </a>

            <button type="button" id="starterNavbarAlert" class="inline-flex h-9 items-center gap-2 rounded-lg border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                <i data-lucide="bell" class="h-4 w-4"></i>
                <span>Notify</span>
            </button>

            @auth
                <span class="hidden text-sm text-zinc-500 sm:inline">{{ auth()->user()->name }}</span>
            @endauth
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        document.getElementById('starterNavbarAlert')?.addEventListener('click', function () {
            Swal.fire({
                icon: 'success',
                title: 'Ready',
                text: 'Starter kit aktif.',
                timer: 1400,
                showConfirmButton: false
            });
        });
    </script>
@endpush
