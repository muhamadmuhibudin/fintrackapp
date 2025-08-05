<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrackApp - Admin Ledger Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-900 text-slate-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-slate-800 border-b border-slate-700 px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-bold tracking-tight text-emerald-400">FinTrack<span
                    class="text-white">App</span></span>
            <div class="text-sm text-slate-400">Secure Enterprise Session</div>
        </nav>

        <main class="flex-1 p-8 max-w-7xl w-full mx-auto">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>

</html>