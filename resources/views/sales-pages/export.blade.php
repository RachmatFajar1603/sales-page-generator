<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $salesPage->product_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto py-8 px-4">
        @php $content = $salesPage->generated_content; @endphp
        @include('sales-pages.templates.' . $salesPage->template, ['content' => $content, 'salesPage' => $salesPage])
    </div>
</body>
</html>