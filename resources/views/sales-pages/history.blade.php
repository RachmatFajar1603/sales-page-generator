<x-app-layout>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-semibold">History</h1>
            <p class="text-gray-400 text-sm mt-1">All your generated sales pages</p>
        </div>
        <a href="{{ route('generate.create') }}"
            class="bg-violet-600 hover:bg-violet-500 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition-colors">
            + New Page
        </a>
    </div>

    @if ($salesPages->isEmpty())
        <div class="text-center py-20">
            <p class="text-gray-500">No sales pages yet.</p>
            <a href="{{ route('generate.create') }}"
                class="text-violet-400 text-sm hover:text-violet-300 mt-2 inline-block transition-colors">
                Generate your first one →
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($salesPages as $page)
                <div
                    class="bg-gray-900/60 border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <span
                            class="text-xs bg-violet-500/10 text-violet-400 border border-violet-500/20 px-2.5 py-1 rounded-full">
                            {{ ucfirst($page->template) }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $page->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="font-medium mb-1">{{ $page->product_name }}</h3>
                    <p class="text-gray-400 text-xs mb-1">{{ $page->target_audience }}</p>
                    <p class="text-gray-500 text-xs mb-4">Tone: {{ ucfirst($page->tone) }}</p>

                    {{-- Ganti bagian action buttons di history card --}}
                    <div class="flex items-center gap-2">
                        <a href="{{ route('sales-pages.preview', $page->id) }}"
                            class="flex-1 text-center text-xs bg-violet-600/20 hover:bg-violet-600/30 text-violet-400 border border-violet-500/20 py-2 rounded-lg transition-colors">
                            Preview
                        </a>
                        <a href="{{ route('sales-pages.export.pdf', $page->id) }}"
                            class="flex-1 text-center text-xs border border-white/10 hover:border-white/20 text-gray-400 hover:text-white py-2 rounded-lg transition-colors">
                            PDF
                        </a>
                        <a href="{{ route('sales-pages.export.html', $page->id) }}"
                            class="flex-1 text-center text-xs border border-white/10 hover:border-white/20 text-gray-400 hover:text-white py-2 rounded-lg transition-colors">
                            HTML
                        </a>
                        <form method="POST" action="{{ route('sales-pages.destroy', $page->id) }}"
                            onsubmit="return confirm('Delete this page?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-xs border border-red-500/20 hover:border-red-500/40 text-red-400 hover:text-red-300 py-2 px-3 rounded-lg transition-colors">
                                🗑
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $salesPages->links() }}
        </div>
    @endif

</x-app-layout>
