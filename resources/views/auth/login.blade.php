<x-guest-layout>
    <div class="bg-gray-900/60 backdrop-blur-md border border-white/10 rounded-2xl p-8">
        <h2 class="text-xl font-semibold mb-1">Welcome back</h2>
        <p class="text-gray-400 text-sm mb-6">Sign in to your account</p>

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl text-sm mb-4">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-400 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
                    placeholder="you@example.com">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1.5">Password</label>
                <input type="password" name="password" required
                    class="w-full bg-gray-800/60 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
                    placeholder="••••••••">
            </div>
            <button type="submit"
                class="w-full bg-violet-600 hover:bg-violet-500 text-white py-2.5 rounded-xl text-sm font-medium transition-colors">
                Sign In
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-violet-400 hover:text-violet-300 transition-colors">Sign up</a>
        </p>
    </div>
</x-guest-layout>