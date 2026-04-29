<x-app-layout>

    {{-- Toolbar --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('sales-pages.history') }}"
                class="text-gray-400 hover:text-white text-sm transition-colors">← Back</a>
            <div class="w-px h-4 bg-white/10"></div>
            <h1 class="text-sm font-medium">{{ $salesPage->product_name }}</h1>
        </div>

        {{-- Export Buttons --}}
        <div class="flex items-center gap-2">

            {{-- Export HTML --}}
            <a href="{{ route('sales-pages.export.html', $salesPage->id) }}"
                class="text-xs border border-white/10 hover:border-white/30 text-gray-400 hover:text-white px-3 py-2 rounded-xl transition-all flex items-center gap-1.5">
                ⬇ HTML
            </a>

            {{-- Export PDF --}}
            <a href="{{ route('sales-pages.export.pdf', $salesPage->id) }}"
                class="text-xs border border-white/10 hover:border-white/30 text-gray-400 hover:text-white px-3 py-2 rounded-xl transition-all flex items-center gap-1.5">
                📄 PDF
            </a>

            {{-- Export PNG (client side) --}}
            <button onclick="exportPNG()"
                class="text-xs border border-white/10 hover:border-white/30 text-gray-400 hover:text-white px-3 py-2 rounded-xl transition-all flex items-center gap-1.5">
                🖼 PNG
            </button>

            <a href="{{ route('generate.create') }}"
                class="text-sm bg-violet-600 hover:bg-violet-500 text-white px-4 py-2 rounded-xl transition-colors">
                + New Page
            </a>
        </div>
    </div>

    {{-- Sales Page Content --}}
    @php $content = $salesPage->generated_content; @endphp

    <div id="sales-page-content">
        @if($salesPage->template === 'dark')
            @include('sales-pages.templates.dark', ['content' => $content, 'salesPage' => $salesPage])
        @elseif($salesPage->template === 'minimalist')
            @include('sales-pages.templates.minimalist', ['content' => $content, 'salesPage' => $salesPage])
        @else
            @include('sales-pages.templates.modern', ['content' => $content, 'salesPage' => $salesPage])
        @endif
    </div>

    {{-- html2canvas for PNG export --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        async function exportPNG() {
            const btn = event.target;
            const original = btn.innerHTML;
            btn.innerHTML = '⏳ Capturing...';
            btn.disabled = true;

            try {
                const element = document.getElementById('sales-page-content');
                const canvas = await html2canvas(element, {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#ffffff',
                    scrollY: -window.scrollY,
                });

                const link = document.createElement('a');
                link.download = '{{ str()->slug($salesPage->product_name) }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            } catch(e) {
                alert('PNG export failed. Please try again.');
            } finally {
                btn.innerHTML = original;
                btn.disabled = false;
            }
        }
    </script>

</x-app-layout>