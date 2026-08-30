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
        return $query->where('priority', 'high');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->where('due_date', '<', Carbon::today());
    }

    public function scopeDueSoon($query)
    {
        $today = Carbon::today();
        $threeDaysLater = Carbon::today()->addDays(3);

        return $query->where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', $today)
            ->whereDate('due_date', '<=', $threeDaysLater);
    }

    /**
     * Check if task is overdue.
     * Automatically calculated: due date has passed & status is not completed.
     */
    public function isOverdue(): bool
    {
        if ($this->status === 'completed' || is_null($this->due_date)) {
            return false;
        }

        return $this->due_date->startOfDay()->lt(Carbon::today());
    }

    /**
     * Get the number of days the task is overdue.
     */
    public function daysOverdue(): int
    {
        if (! $this->isOverdue()) {
            return 0;
        }

        $days = (int) abs(Carbon::today()->diffInDays($this->due_date->startOfDay(), false));

        return max(1, $days);
    }

    /**
     * Formatted Overdue badge label.
     * Example: "🔴 OVERDUE · 5 days late" or "🔴 OVERDUE · 1 day late"
     */
    public function overdueBadgeText(): string
    {
        $days = $this->daysOverdue();
        $dayWord = $days === 1 ? 'day' : 'days';

        return "🔴 OVERDUE · {$days} {$dayWord} late";
    }

    /**
     * Check if task is due soon (today, tomorrow, or within next 3 days, and not completed or overdue).
     */
    public function isDueSoon(): bool
    {
        if ($this->status === 'completed' || is_null($this->due_date)) {
            return false;
        }

        $today = Carbon::today();
        $threeDaysLater = Carbon::today()->addDays(3);
        $dueDate = $this->due_date->startOfDay();

        return $dueDate->gte($today) && $dueDate->lte($threeDaysLater);
    }

    /**
     * Get human-friendly remaining time label for upcoming deadlines.
     * E.g. "Due Today", "Due Tomorrow", "Due in 2 days"
     */
    public function remainingTimeLabel(): string
    {
        if (is_null($this->due_date)) {
            return '';
        }

        $today = Carbon::today();
        $dueDate = $this->due_date->startOfDay();
        $diff = (int) $today->diffInDays($dueDate, false);

        if ($diff < 0) {
            $daysLate = abs($diff);
            $dayWord = $daysLate === 1 ? 'day' : 'days';
            return "{$daysLate} {$dayWord} late";
        }

        if ($diff === 0) {
            return 'Due Today';
        }

        if ($diff === 1) {
            return 'Due Tomorrow';
        }

        return "Due in {$diff} days";
    }
}

