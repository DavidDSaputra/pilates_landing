<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->search, function ($query) use ($request) {
                $query->where('action', 'like', "%{$request->search}%")
                    ->orWhere('model_type', 'like', "%{$request->search}%")
                    ->orWhere('table_name', 'like', "%{$request->search}%")
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('nama_lengkap', 'like', "%{$request->search}%")
                            ->orWhere('email', 'like', "%{$request->search}%");
                    });
            })
            ->when($request->action, function ($query) use ($request) {
                $query->where('action', $request->action);
            })
            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->table, function ($query) use ($request) {
                $query->where('table_name', $request->table);
            })
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->date_to);
            })
            ->latest()
            ->paginate(20)
            ->appends($request->all());

        // Get unique values for filters
        $users = User::orderBy('nama_lengkap')->get();
        $actions = ActivityLog::select('action')->distinct()->pluck('action');
        $tables = ActivityLog::select('table_name')->distinct()->pluck('table_name');

        return view('admin.activity-log.index', compact('logs', 'users', 'actions', 'tables'));
    }
}
