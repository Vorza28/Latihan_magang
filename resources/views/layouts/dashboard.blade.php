<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-700 text-white">
        <div class="p-4 text-2xl font-bold border-b border-blue-500">
            Siswa Cerdas
        </div>
        <nav class="p-4 space-y-2">
            <a href="/siswa" class="block px-4 py-2 rounded hover:bg-blue-600">📋 Data Siswa</a>
            <a href="/dashboard" class="block px-4 py-2 rounded hover:bg-blue-600">🏆 Ranking Siswa</a>
            <a href="/nilai" class="block px-4 py-2 rounded hover:bg-blue-600">📝 Input Nilai</a>
        </nav>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">@yield('title')</h1>
            <div class="text-sm text-gray-600">
                Admin
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="bg-white text-center p-4 text-sm text-gray-500 border-t">
            © {{ date('Y') }} Siswa Cerdas - Aryasuta Daniswara
        </footer>

    </div>
</div>

</body>
</html>
