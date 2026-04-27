<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - AI Sales Page Generator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-4">

    {{-- Background decoration --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-indigo-600 rounded-xl flex items-center justify-center text-lg font-bold mx-auto mb-3">
                AI
            </div>
            <h1 class="text-xl font-semibold">SalesGen</h1>
            <p class="text-gray-400 text-sm mt-1">AI-Powered Sales Page Generator</p>
        </div>

        {{ $slot }}
    </div>

</body>
</html>