<div class="bg-white text-gray-900 rounded-2xl overflow-hidden">

    {{-- Hero --}}
    <div class="bg-gradient-to-br from-violet-600 to-indigo-700 text-white px-8 py-16 text-center">
        <span class="inline-block bg-white/20 text-white text-xs px-3 py-1 rounded-full mb-4">✨ AI Generated</span>
        <h1 class="text-4xl font-bold mb-4 leading-tight">{{ $content['headline'] ?? '' }}</h1>
        <p class="text-xl text-violet-100 mb-4">{{ $content['sub_headline'] ?? '' }}</p>
        <p class="text-violet-200 max-w-2xl mx-auto mb-8 text-sm leading-relaxed">{{ $content['hero_description'] ?? '' }}</p>
        <a href="#pricing" class="inline-block bg-white text-violet-700 font-semibold px-8 py-3 rounded-xl hover:bg-violet-50 transition-colors">
            {{ $content['cta']['primary'] ?? 'Get Started' }}
        </a>
    </div>

    {{-- Benefits --}}
    @if(!empty($content['benefits']))
    <div class="px-8 py-12">
        <h2 class="text-2xl font-bold text-center mb-8">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($content['benefits'] as $benefit)
            <div class="text-center p-6 bg-gray-50 rounded-2xl">
                <div class="text-3xl mb-3">{{ $benefit['icon'] ?? '✅' }}</div>
                <h3 class="font-semibold mb-2">{{ $benefit['title'] ?? '' }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $benefit['description'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Features --}}
    @if(!empty($content['features']))
    <div class="px-8 py-12 bg-gray-50">
        <h2 class="text-2xl font-bold text-center mb-8">Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl mx-auto">
            @foreach($content['features'] as $feature)
            <div class="flex items-start gap-3 p-4 bg-white rounded-xl">
                <span class="text-violet-500 mt-0.5 text-lg">✓</span>
                <div>
                    <h4 class="font-medium text-sm">{{ $feature['title'] ?? '' }}</h4>
                    <p class="text-gray-500 text-xs mt-1 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Social Proof --}}
    @if(!empty($content['social_proof']))
    <div class="px-8 py-12">
        <h2 class="text-2xl font-bold text-center mb-8">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($content['social_proof'] as $proof)
            <div class="p-6 border border-gray-100 rounded-2xl">
                <div class="flex gap-0.5 mb-3">
                    @for($i = 0; $i < ($proof['rating'] ?? 5); $i++)
                    <span class="text-yellow-400 text-sm">★</span>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">"{{ $proof['testimonial'] ?? '' }}"</p>
                <div>
                    <p class="font-medium text-sm">{{ $proof['name'] ?? '' }}</p>
                    <p class="text-gray-400 text-xs">{{ $proof['role'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Pricing --}}
    @if(!empty($content['pricing']))
    <div id="pricing" class="px-8 py-12 bg-gradient-to-br from-violet-50 to-indigo-50">
        <h2 class="text-2xl font-bold text-center mb-8">Simple Pricing</h2>
        <div class="max-w-sm mx-auto bg-white rounded-2xl p-8 shadow-lg border border-violet-100 text-center">
            @if(!empty($content['pricing']['original_price']))
            <p class="text-gray-400 line-through text-sm mb-1">{{ $content['pricing']['original_price'] }}</p>
            @endif
            <p class="text-4xl font-bold text-violet-600 mb-1">{{ $content['pricing']['display_price'] ?? '' }}</p>
            <p class="text-gray-400 text-sm mb-6">{{ $content['pricing']['billing'] ?? '' }}</p>
            @if(!empty($content['pricing']['includes']))
            <ul class="text-left space-y-2 mb-6">
                @foreach($content['pricing']['includes'] as $item)
                <li class="flex items-center gap-2 text-sm text-gray-600">
                    <span class="text-green-500">✓</span> {{ $item }}
                </li>
                @endforeach
            </ul>
            @endif
            <a href="#" class="block w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-medium transition-colors text-sm">
                {{ $content['cta']['primary'] ?? 'Get Started' }}
            </a>
            <p class="text-gray-400 text-xs mt-3">{{ $content['cta']['secondary'] ?? '' }}</p>
        </div>
    </div>
    @endif

    {{-- FAQ --}}
    @if(!empty($content['faq']))
    <div class="px-8 py-12">
        <h2 class="text-2xl font-bold text-center mb-8">Frequently Asked Questions</h2>
        <div class="max-w-2xl mx-auto space-y-4">
            @foreach($content['faq'] as $item)
            <div class="border border-gray-100 rounded-xl p-5">
                <h4 class="font-medium text-sm mb-2">{{ $item['question'] ?? '' }}</h4>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $item['answer'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>