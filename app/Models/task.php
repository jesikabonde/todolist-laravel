<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import trait SoftDeletes

class Task extends Model
{
    use HasFactory, SoftDeletes; // Aktifkan SoftDeletes
    
    // Tambahkan due_date dan category ke fillable
    protected $fillable = ['title', 'is_completed', 'due_date', 'category']; 
}