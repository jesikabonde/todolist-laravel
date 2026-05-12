<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f5f7fb]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 p-6 hidden md:block">

        <h1 class="text-2xl font-bold text-gray-800 mb-10">
            To Do List
        </h1>

        <nav class="space-y-2">

            <a href="#" class="flex items-center gap-3 bg-blue-50 text-blue-600 px-4 py-3 rounded-xl font-medium">
                Dashboard
            </a>

            <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-100 px-4 py-3 rounded-xl transition">
                Tugas Saya
            </a>

            <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-100 px-4 py-3 rounded-xl transition">
                Kalender
            </a>

            <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-100 px-4 py-3 rounded-xl transition">
                Kategori
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <!-- TOP -->
        <div class="flex items-center justify-between mb-8">

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Halo,todolist👋
                </h2>

                <p class="text-gray-500 mt-1">
                    Tetap produktif dan atur tugasmu dengan rapi.
                </p>
            </div>

            <button class="bg-white border border-gray-200 px-5 py-2 rounded-xl hover:bg-gray-100 transition">
                Keluar
            </button>

        </div>

        <!-- FORM -->
        <div class="bg-white border border-gray-200 rounded-3xl p-5 shadow-sm mb-6">

            <form action="/task" method="POST">
                @csrf

                <div class="flex flex-col lg:flex-row gap-4">

                    <input
                        type="text"
                        name="title"
                        placeholder="Masukkan tugas atau aktivitas..."
                        required
                        class="flex-1 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-200">

                    <input
                        type="date"
                        name="due_date"
                        class="border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-200">

                    <select
                        name="category"
                        class="border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-200">

                        <option value="">Kategori</option>
                        <option value="Proyek">Proyek</option>
                        <option value="Pengembangan">Pengembangan</option>
                        <option value="Pribadi">Pribadi</option>

                    </select>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-medium transition">

                        Tambah Tugas
                    </button>

                </div>

            </form>

        </div>

        <!-- FILTER -->
        <div class="flex gap-3 mb-6 flex-wrap">

            <button class="bg-gray-900 text-white px-5 py-3 rounded-xl font-medium">
                Semua
            </button>

            <button class="bg-white border border-gray-200 px-5 py-3 rounded-xl hover:bg-gray-50 transition">
                Selesai
            </button>

            <button class="bg-white border border-gray-200 px-5 py-3 rounded-xl hover:bg-gray-50 transition">
                Belum Selesai
            </button>

        </div>

        <!-- TABLE -->
        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm">

            <!-- HEADER -->
            <div class="grid grid-cols-5 gap-4 bg-gray-50 px-6 py-4 border-b border-gray-200">

                <div class="font-semibold text-gray-600">Nama Tugas</div>
                <div class="font-semibold text-gray-600">Kategori</div>
                <div class="font-semibold text-gray-600">Status</div>
                <div class="font-semibold text-gray-600">Tanggal</div>
                <div class="font-semibold text-gray-600">Aksi</div>

            </div>

            <!-- TASKS -->
            @forelse ($tasks as $task)

            <div class="grid grid-cols-5 gap-4 px-6 py-5 border-b border-gray-100 items-center hover:bg-gray-50 transition">

                <!-- TITLE -->
                <div>

                    <p class="font-medium text-gray-800
                    {{ $task->is_completed ? 'line-through text-gray-400' : '' }}">

                        {{ $task->title }}
                    </p>

                </div>

                <!-- CATEGORY -->
                <div>

                    @if($task->category)
                        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-sm">
                            {{ $task->category }}
                        </span>
                    @endif

                </div>

                <!-- STATUS -->
                <div>

                    @if($task->is_completed)

                        <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-sm">
                            Selesai
                        </span>

                    @else

                        <span class="bg-orange-50 text-orange-500 px-3 py-1 rounded-full text-sm">
                            Belum
                        </span>

                    @endif

                </div>

                <!-- DATE -->
                <div class="text-gray-500 text-sm">

                    @if($task->due_date)
                        {{ date('d M Y', strtotime($task->due_date)) }}
                    @else
                        -
                    @endif

                </div>

                <!-- ACTION -->
                <div class="flex gap-2 flex-wrap">

                    <!-- DONE -->
                    <form action="/task/{{ $task->id }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition
                            {{ $task->is_completed
                                ? 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                                : 'bg-green-500 text-white hover:bg-green-600' }}">

                            {{ $task->is_completed ? 'Batal' : 'Selesai' }}

                        </button>

                    </form>

                    <!-- DELETE -->
                    <form action="/task/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-50 text-red-500 hover:bg-red-100 px-4 py-2 rounded-xl text-sm font-medium transition">

                            Hapus

                        </button>

                    </form>

                </div>

            </div>

            @empty

            <div class="p-10 text-center text-gray-400">
                Belum ada tugas.
            </div>

            @endforelse

        </div>

    </main>

</div>

</body>
</html>