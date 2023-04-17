<?php

namespace App\Models;

use App\Enums\TasksType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'type'
    ];

    protected $casts = [
        'type' => TasksType::class
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
