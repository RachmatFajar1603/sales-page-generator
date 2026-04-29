<div class="bg-gray-950 text-white rounded-2xl overflow-hidden border border-white/10">

    <div class="bg-gradient-to-br from-gray-900 via-gray-950 to-black px-8 py-16 text-center border-b border-white/10">
        <span class="inline-block bg-violet-500/20 text-violet-400 border border-violet-500/30 text-xs px-3 py-1 rounded-full mb-4">✨ Premium</span>
        <h1 class="text-4xl font-bold mb-4 leading-tight">{{ $content['headline'] ?? '' }}</h1>
        <p class="text-xl text-gray-300 mb-4">{{ $content['sub_headline'] ?? '' }}</p>
        <p class="text-gray-400 max-w-2xl mx-auto mb-8 text-sm leading-relaxed">{{ $content['hero_description'] ?? '' }}</p>
        <a href="#pricing" class="inline-block bg-violet-600 hover:bg-violet-500 text-white font-semibold px-8 py-3 rounded-xl transition-colors">
            {{ $content['cta']['primary'] ?? 'Get Started' }}
        </a>
    </div>

    @if(!empty($content['benefits']))
    <div class="px-8 py-12">
        <h2 class="text-2xl font-bold text-center mb-8">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($content['benefits'] as $benefit)
            <div class="text-center p-6 bg-gray-900/60 border border-white/10 rounded-2xl">
                <div class="text-3xl mb-3">{{ $benefit['icon'] ?? '✅' }}</div>
                <h3 class="font-semibold mb-2">{{ $benefit['title'] ?? '' }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $benefit['description'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if(!empty($content['features']))
    <div class="px-8 py-12 bg-gray-900/40">
        <h2 class="text-2xl font-bold text-center mb-8">Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl mx-auto">
            @foreach($content['features'] as $feature)
            <div class="flex items-start gap-3 p-4 bg-gray-900/60 border border-white/10 rounded-xl">
                <span class="text-violet-400 mt-0.5">✓</span>
                <div>
                    <h4 class="font-medium text-sm">{{ $feature['title'] ?? '' }}</h4>
                    <p class="text-gray-400 text-xs mt-1 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if(!empty($content['pricing']))
    <div id="pricing" class="px-8 py-12">
        <h2 class="text-2xl font-bold text-center mb-8">Simple Pricing</h2>
        <div class="max-w-sm mx-auto bg-gray-900/60 border border-violet-500/30 rounded-2xl p-8 text-center">
            @if(!empty($content['pricing']['original_price']))
            <p class="text-gray-500 line-through text-sm mb-1">{{ $content['pricing']['original_price'] }}</p>
            @endif
            <p class="text-4xl font-bold text-violet-400 mb-1">{{ $content['pricing']['display_price'] ?? '' }}</p>
            <p class="text-gray-400 text-sm mb-6">{{ $content['pricing']['billing'] ?? '' }}</p>
            @if(!empty($content['pricing']['includes']))
            <ul class="text-left space-y-2 mb-6">
                @foreach($content['pricing']['includes'] as $item)
                <li class="flex items-center gap-2 text-sm text-gray-300">
                    <span class="text-green-400">✓</span> {{ $item }}
                </li>
                @endforeach
            </ul>
            @endif
            <a href="#" class="block w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-medium transition-colors text-sm">
                {{ $content['cta']['primary'] ?? 'Get Started' }}
            </a>
            <p class="text-gray-500 text-xs mt-3">{{ $content['cta']['secondary'] ?? '' }}</p>
        </div>
    </div>
    @endif

</div>