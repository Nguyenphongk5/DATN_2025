<html>
<head>
    <title>My App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow p-4">
        {{ $header ?? '' }}
    </header>

    <main class="p-6">
        {{ $slot }}
    </main>
</body>
</html>
