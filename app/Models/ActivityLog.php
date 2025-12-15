<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 'activity_log';
    protected $fillable = ['table_name', 'action', 'old_data', 'new_data', 'user_id'];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship dengan user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk action badge color
     */
    public function getActionBadgeAttribute(): string
    {
        return match($this->action) {
            'create' => 'success',
            'update' => 'warning',
            'delete' => 'danger',
            'restore' => 'info',
            'force_delete' => 'dark',
            default => 'secondary'
        };
    }

    /**
     * Accessor untuk formatted action
     */
    public function getFormattedActionAttribute(): string
    {
        return match($this->action) {
            'create' => 'CREATE',
            'update' => 'UPDATE',
            'delete' => 'DELETE',
            'restore' => 'RESTORE',
            'force_delete' => 'FORCE DELETE',
            default => strtoupper($this->action)
        };
    }

    /**
     * Scope untuk filter by table
     */
    public function scopeByTable($query, $tableName)
    {
        return $query->where('table_name', $tableName);
    }

    /**
     * Scope untuk filter by action
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope untuk filter by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}