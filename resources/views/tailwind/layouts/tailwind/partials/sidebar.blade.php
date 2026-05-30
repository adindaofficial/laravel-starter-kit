<aside class="hidden min-h-screen w-72 shrink-0 border-r border-zinc-200 bg-white p-4 lg:flex lg:flex-col">
    <a href="{{ url('/') }}" class="mb-6 flex items-center gap-3">
        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-900 text-white">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
        </span>
        <span class="min-w-0">
            <span class="block truncate font-semibold">{{ config('app.name', 'Laravel') }}</span>
            <span class="block text-xs text-zinc-500">Starter Kit</span>
        </span>
    </a>

    <nav class="space-y-1">
        <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->is('/') ? 'bg-brand-500 text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">
            <i data-lucide="gauge" class="h-4 w-4"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ url('/users') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->is('users') ? 'bg-brand-500 text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">
            <i data-lucide="users" class="h-4 w-4"></i>
            <span>Users</span>
        </a>
    </nav>

    <div class="mt-auto rounded-lg border border-zinc-200 bg-zinc-50 p-3 text-xs text-zinc-500">
        Laravel Starter Kit
    </div>
</aside>
