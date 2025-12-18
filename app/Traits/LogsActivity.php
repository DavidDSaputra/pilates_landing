<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('create');
        });

        static::updated(function ($model) {
            $model->logActivity('update');
        });

        static::deleted(function ($model) {
            $model->logActivity('delete');
        });
    }

    protected function logActivity($action)
    {
        if (Auth::check()) {
            ActivityLog::create([
                'table_name' => $this->getTable(),
                'action' => $action,
                'old_data' => $action === 'update' || $action === 'delete' ? $this->getOriginal() : null,
                'new_data' => $action === 'create' || $action === 'update' ? $this->getAttributes() : null,
                'user_id' => Auth::id(),
            ]);
        }
    }
}
