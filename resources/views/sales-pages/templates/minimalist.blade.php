<div class="bg-white text-gray-900 rounded-2xl overflow-hidden">

    <div class="px-8 py-16 text-center border-b border-gray-100">
        <h1 class="text-4xl font-bold mb-4 leading-tight text-gray-900">{{ $content['headline'] ?? '' }}</h1>
        <p class="text-xl text-gray-500 mb-4">{{ $content['sub_headline'] ?? '' }}</p>
        <p class="text-gray-400 max-w-2xl mx-auto mb-8 text-sm leading-relaxed">{{ $content['hero_description'] ?? '' }}</p>
        <a href="#pricing" class="inline-block bg-gray-900 hover:bg-gray-700 text-white font-medium px-8 py-3 rounded-xl transition-colors text-sm">
            {{ $content['cta']['primary'] ?? 'Get Started' }}
        </a>
    </div>

    @if(!empty($content['benefits']))
    <div class="px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($content['benefits'] as $benefit)
            <div>
                <div class="text-2xl mb-3">{{ $benefit['icon'] ?? '✅' }}</div>
                <h3 class="font-semibold mb-2 text-sm">{{ $benefit['title'] ?? '' }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $benefit['description'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if(!empty($content['pricing']))
    <div id="pricing" class="px-8 py-12 bg-gray-50">
        <div class="max-w-sm mx-auto text-center">
            <p class="text-4xl font-bold mb-1">{{ $content['pricing']['display_price'] ?? '' }}</p>
            <p class="text-gray-400 text-sm mb-6">{{ $content['pricing']['billing'] ?? '' }}</p>
            @if(!empty($content['pricing']['includes']))
            <ul class="text-left space-y-2 mb-6">
                @foreach($content['pricing']['includes'] as $item)
                <li class="flex items-center gap-2 text-sm text-gray-600">
                    <span>→</span> {{ $item }}
                </li>
                @endforeach
            </ul>
            @endif
            <a href="#" class="block w-full bg-gray-900 hover:bg-gray-700 text-white py-3 rounded-xl font-medium transition-colors text-sm">
                {{ $content['cta']['primary'] ?? 'Get Started' }}
            </a>
        </div>
    </div>
    @endif

</div>