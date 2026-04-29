<x-app-layout>
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-semibold">Generate Sales Page</h1>
            <p class="text-gray-400 text-sm mt-1">Fill in your product details and let AI do the magic</p>
        </div>

        {{-- Error --}}
        @if($errors->has('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl text-sm mb-6">
            {{ $errors->first('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('generate.store') }}" id="generate-form">
            @csrf

            <div class="space-y-6">

                {{-- Product Name --}}
                <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
                    <h2 class="font-medium mb-4">Basic Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1.5">Product / Service Name <span class="text-red-400">*</span></label>
                            <input type="text" name="product_name" value="{{ old('product_name') }}" required
                                class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
                                placeholder="e.g. Online Quran Learning App">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1.5">Target Audience <span class="text-red-400">*</span></label>
                            <input type="text" name="target_audience" value="{{ old('target_audience') }}" required
                                class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
                                placeholder="e.g. Muslim parents with children aged 5-15">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1.5">Price</label>
                            <input type="text" name="price" value="{{ old('price') }}"
                                class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
                                placeholder="e.g. Rp 299.000/month or Free">
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
                    <h2 class="font-medium mb-4">Product Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1.5">Description <span class="text-red-400">*</span></label>
                            <textarea name="description" rows="3" required
                                class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors resize-none"
                                placeholder="Describe your product or service in detail...">{{ old('description') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1.5">Key Features <span class="text-red-400">*</span></label>
                            <textarea name="key_features" rows="3" required
                                class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors resize-none"
                                placeholder="e.g. Live sessions with certified ustaz, Progress tracking, 24/7 access...">{{ old('key_features') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1.5">Unique Selling Points</label>
                            <textarea name="unique_selling_points" rows="2"
                                class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors resize-none"
                                placeholder="What makes you different from competitors?">{{ old('unique_selling_points') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Tone & Template --}}
                <div class="bg-gray-900/60 border border-white/10 rounded-2xl p-6">
                    <h2 class="font-medium mb-4">Style Preferences</h2>
                    <div class="space-y-4">

                        {{-- Tone --}}
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Tone</label>
                            <div class="flex flex-wrap gap-2" id="tone-selector">
                                @foreach(['persuasive', 'formal', 'casual', 'urgent', 'friendly'] as $tone)
                                <button type="button"
                                    onclick="selectTone('{{ $tone }}')"
                                    id="tone-{{ $tone }}"
                                    class="tone-btn px-4 py-2 rounded-xl text-sm border transition-all
                                        {{ old('tone', 'persuasive') === $tone
                                            ? 'bg-violet-600 border-violet-500 text-white'
                                            : 'bg-gray-800/60 border-white/10 text-gray-400 hover:border-white/30 hover:text-white' }}">
                                    {{ ucfirst($tone) }}
                                </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="tone" id="tone-input" value="{{ old('tone', 'persuasive') }}">
                        </div>

                        {{-- Template --}}
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Design Template</label>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach(['modern' => '🌟 Modern', 'minimalist' => '⚡ Minimalist', 'dark' => '🌙 Dark Luxury'] as $val => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="template" value="{{ $val }}"
                                        {{ old('template', 'modern') === $val ? 'checked' : '' }}
                                        class="sr-only peer">
                                    <div class="p-3 rounded-xl border border-white/10 text-center text-sm text-gray-400
                                        peer-checked:border-violet-500 peer-checked:text-white peer-checked:bg-violet-600/10
                                        hover:border-white/30 transition-all">
                                        {{ $label }}
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" id="submit-btn"
                    class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-medium transition-colors flex items-center justify-center gap-2">
                    <span id="btn-text">✨ Generate Sales Page</span>
                    <span id="btn-loading" class="hidden">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                        Generating... please wait
                    </span>
                </button>

            </div>
        </form>
    </div>

    <script>
        function selectTone(tone) {
            document.getElementById('tone-input').value = tone;
            document.querySelectorAll('.tone-btn').forEach(btn => {
                btn.className = 'tone-btn px-4 py-2 rounded-xl text-sm border transition-all bg-gray-800/60 border-white/10 text-gray-400 hover:border-white/30 hover:text-white';
            });
            document.getElementById('tone-' + tone).className = 'tone-btn px-4 py-2 rounded-xl text-sm border transition-all bg-violet-600 border-violet-500 text-white';
        }

        document.getElementById('generate-form').addEventListener('submit', function() {
            document.getElementById('btn-text').classList.add('hidden');
            document.getElementById('btn-loading').classList.remove('hidden');
            document.getElementById('submit-btn').disabled = true;
        });
    </script>
</x-app-layout> 