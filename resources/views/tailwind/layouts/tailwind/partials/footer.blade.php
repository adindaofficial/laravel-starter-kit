<footer class="border-t border-slate-200/80 bg-white/95 px-4 py-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-3 text-sm sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <div class="truncate font-semibold text-slate-800">{{ config('app.name', 'Laravel') }} Workspace</div>
            <div class="mt-0.5 text-xs text-slate-500">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                System online
            </span>
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                <i data-lucide="layers-3" class="h-3.5 w-3.5"></i>
                Tailwind Starter Kit
            </span>
        </div>
    </div>
</footer>
