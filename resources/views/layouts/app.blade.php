<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FinTrackApp - Financial Control Panel' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">
    <nav class="border-b border-slate-800 bg-slate-950/50 backdrop-blur px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-bold tracking-tight text-emerald-400">FinTrack<span class="text-white">App</span></span>
            <span class="text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 rounded font-mono">v1.0-RC</span>
        </div>
        <div class="flex items-center space-x-4 text-sm text-slate-400 font-mono">
            <span>Portfolio Demo</span>
            <a href="https://github.com/muhamadmuhibudin/fintrackapp" target="_blank" class="hover:text-emerald-400">GitHub Repo &rarr;</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>