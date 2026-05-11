<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan semua tugas
    public function index() {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks', compact('tasks'));
    }

   // Menyimpan tugas baru
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'due_date' => 'nullable|date',
            'category' => 'nullable|string|max:100'
        ]);

        // Karena nama input di form sama dengan nama kolom, kita bisa pakai $request->all()
        // dengan aman selama kolomnya sudah didaftarkan di $fillable
        Task::create($request->all()); 
        
        return back();
    }
    // Menghapus tugas
    public function destroy(Task $task) {
        $task->delete();
        return back();
    }
}