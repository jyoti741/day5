<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $user_id
 * @property int|null $assigned_by
 * @property string $priority
 * @property string $status
 * @property string $category
 * @property Carbon|null $due_date
 * @property Carbon|null $completed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $assignee
 * @property-read User|null $creator
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'assigned_by',
        'priority',
        'status',
        'category',
        'due_date',
        'completed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'completed_at' => 'datetime',
        ];
    }

    /**
     * The employee/user assigned to this task.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The user who created/assigned this task.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    /**
     * Check if task is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->due_date && $this->status !== 'completed' && $this->due_date->isPast();
    }
}