<footer class="border-t border-slate-200 bg-white px-4 py-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-2 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
        <span>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</span>
        <span class="inline-flex items-center gap-2">
            <i data-lucide="palette" class="h-4 w-4 text-blue-600"></i>
            Tailwind UI
        </span>
    </div>
</footer>
