<x-app-layout>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <p class="text-gray-400 text-sm mt-1">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
        <a href="{{ route('generate.create') }}"
            class="bg-violet-600 hover:bg-violet-500 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
            + New Sales Page
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
            <p class="text-gray-400 text-sm">Total Pages Generated</p>
            <p class="text-3xl font-semibold mt-1">{{ $totalPages }}</p>
        </div>
        <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
            <p class="text-gray-400 text-sm">This Month</p>
            <p class="text-3xl font-semibold mt-1">
                {{ auth()->user()->salesPages()->whereMonth('created_at', now()->month)->count() }}
            </p>
        </div>
        <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
            <p class="text-gray-400 text-sm">Published</p>
            <p class="text-3xl font-semibold mt-1">
                {{ auth()->user()->salesPages()->where('status', 'published')->count() }}
            </p>
        </div>
    </div>

    {{-- Recent Pages --}}
    <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-medium">Recent Pages</h2>
            <a href="{{ route('sales-pages.history') }}" class="text-sm text-violet-400 hover:text-violet-300 transition-colors">
                View all →
            </a>
        </div>

        @if($recentPages->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-sm">No sales pages yet.</p>
            <a href="{{ route('generate.create') }}" class="text-violet-400 text-sm hover:text-violet-300 mt-2 inline-block transition-colors">
                Generate your first one →
            </a>
        </div>
        @else
        <div class="space-y-3">
            @foreach($recentPages as $page)
            <div class="flex items-center justify-between p-4 bg-gray-800/40 rounded-xl border border-white/5 hover:border-white/10 transition-colors">
                <div>
                    <p class="text-sm font-medium">{{ $page->product_name }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $page->created_at->diffForHumans() }} · {{ ucfirst($page->tone) }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs bg-green-500/10 text-green-400 border border-green-500/20 px-2.5 py-1 rounded-full">
                        {{ ucfirst($page->status) }}
                    </span>
                    <a href="{{ route('sales-pages.preview', $page->id) }}"
                        class="text-xs text-gray-400 hover:text-white border border-white/10 hover:border-white/30 px-3 py-1.5 rounded-lg transition-all">
                        Preview
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>