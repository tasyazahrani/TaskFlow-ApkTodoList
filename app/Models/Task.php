<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'notes',
        'priority',
        'deadline',
        'subtasks',
        'completed'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'subtasks' => 'array',
        'completed' => 'boolean'
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if task is overdue.
     */
    public function isOverdue()
    {
        return $this->deadline && $this->deadline->isPast() && !$this->completed;
    }

    /**
     * Get priority color class.
     */
    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'high' => 'text-red-600 bg-red-50',
            'low' => 'text-green-600 bg-green-50',
            default => 'text-yellow-600 bg-yellow-50'
        };
    }

    /**
     * Get status based on completion and deadline.
     */
    public function getStatusAttribute()
    {
        if ($this->completed) {
            return 'completed';
        }
        
        if ($this->isOverdue()) {
            return 'overdue';
        }
        
        return 'pending';
    }

    /**
     * Scope for filtering tasks.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    public function scopePending($query)
    {
        return $query->where('completed', false);
    }

    public function scopeOverdue($query)
    {
        return $query->where('completed', false)
                    ->where('deadline', '<', now());
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}