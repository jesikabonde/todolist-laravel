<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Terupgrade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-center">To-Do List</h1>

        <form action="/task" method="POST" class="mb-8 bg-gray-50 p-4 rounded-lg border">
            @csrf
            <div class="flex flex-col gap-3">
                <input type="text" name="title" placeholder="Apa tugas Anda?" required
                       class="border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                
                <div class="flex gap-3">
                    <input type="date" name="due_date" 
                           class="flex-1 border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    
                    <select name="category" class="flex-1 border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Pilih Kategori...</option>
                        <option value="Modul Ajar">Modul Ajar</option>
                        <option value="Infrastruktur Lab">Infrastruktur Lab</option>
                        <option value="Administrasi">Administrasi</option>
                    </select>
                    
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Tambah</button>
                </div>
            </div>
        </form>

        <ul>
            @foreach ($tasks as $task)
                <li class="flex items-center justify-between bg-white p-4 mb-3 border rounded-lg shadow-sm">
                    
                    <div class="flex items-start gap-3">
                        <form action="/task/{{ $task->id }}" method="POST" class="mt-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-6 h-6 rounded border flex items-center justify-center {{ $task->is_completed ? 'bg-green-500 border-green-500 text-white' : 'border-gray-400' }}">
                                {!! $task->is_completed ? '&#10003;' : '' !!}
                            </button>
                        </form>
                        
                        <div>
                            <p class="font-medium {{ $task->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                {{ $task->title }}
                            </p>
                            <div class="flex gap-2 mt-1 text-xs">
                                @if($task->category)
                                    <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded">{{ $task->category }}</span>
                                @endif
                                @if($task->due_date)
                                    <span class="bg-red-100 text-red-800 px-2 py-0.5 rounded">Tenggat: {{ date('d M Y', strtotime($task->due_date)) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <form action="/task/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold ml-4">X</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>