@extends('layoutsadmin.app')

@section('title', 'Activity Logs')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Activity Logs</h1>
            <p class="text-gray-600">Monitor system activities and changes</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Search action, table, user..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>

                <!-- Action Filter -->
                <div>
                    <label for="action" class="block text-sm font-medium text-gray-700 mb-2">Action</label>
                    <select id="action" name="action"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ ucfirst($action) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- User Filter -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">User</label>
                    <select id="user_id" name="user_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Table Filter -->
                <div>
                    <label for="table" class="block text-sm font-medium text-gray-700 mb-2">Table</label>
                    <select id="table" name="table"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        <option value="">All Tables</option>
                        @foreach($tables as $table)
                            <option value="{{ $table }}" {{ request('table') == $table ? 'selected' : '' }}>
                                {{ $table }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date From -->
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>

                <!-- Date To -->
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-filter mr-2"></i>
                    Apply Filters
                </button>
                <a href="{{ route('admin.activity-logs.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors">
                    <i class="fas fa-times mr-2"></i>
                    Clear Filters
                </a>
            </div>

            <!-- Active Filters Display -->
            @if(request()->hasAny(['search', 'action', 'user_id', 'table', 'date_from', 'date_to']))
                <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-200">
                    <span class="text-sm text-gray-600">Active Filters:</span>
                    @if(request('search'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                            Search: {{ request('search') }}
                        </span>
                    @endif
                    @if(request('action'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                            Action: {{ ucfirst(request('action')) }}
                        </span>
                    @endif
                    @if(request('user_id'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                            User: {{ $users->find(request('user_id'))->name ?? 'Unknown' }}
                        </span>
                    @endif
                    @if(request('table'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                            Table: {{ request('table') }}
                        </span>
                    @endif
                    @if(request('date_from'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                            From: {{ request('date_from') }}
                        </span>
                    @endif
                    @if(request('date_to'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                            To: {{ request('date_to') }}
                        </span>
                    @endif
                </div>
            @endif
        </form>
    </div>

    <!-- Activity Logs Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold text-xs">
                                        {{ $log->user ? strtoupper(substr($log->user->name, 0, 2)) : 'SY' }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $log->user ? $log->user->name : 'System' }}
                                        </div>
                                        @if($log->user)
                                            <div class="text-xs text-gray-500">{{ $log->user->email }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badgeColor = match($log->action) {
                                        'created' => 'green',
                                        'updated' => 'blue',
                                        'deleted' => 'red',
                                        default => 'gray'
                                    };
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $badgeColor }}-100 text-{{ $badgeColor }}-800">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $log->table_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="showDetails('{{ $log->id }}')" class="text-amber-600 hover:text-amber-700">
                                    <i class="fas fa-eye mr-1"></i>
                                    View Details
                                </button>

                                <!-- Hidden Data for Modal -->
                                <div id="log-data-{{ $log->id }}" class="hidden">
                                    <div class="old-data">{{ json_encode($log->old_data, JSON_PRETTY_PRINT) }}</div>
                                    <div class="new-data">{{ json_encode($log->new_data, JSON_PRETTY_PRINT) }}</div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg">No activity logs found</p>
                                @if(request()->hasAny(['search', 'action', 'user_id', 'table', 'date_from', 'date_to']))
                                    <a href="{{ route('admin.activity-logs.index') }}" class="mt-2 inline-block text-amber-600 hover:text-amber-700">
                                        Clear filters to see all logs
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="detailsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Activity Details
                        </h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-2">Old Data</h4>
                                <pre id="modalOldData" class="bg-gray-100 p-3 rounded text-xs overflow-auto max-h-96"></pre>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-2">New Data</h4>
                                <pre id="modalNewData" class="bg-gray-100 p-3 rounded text-xs overflow-auto max-h-96"></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    onclick="closeModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetails(id) {
        const oldData = document.querySelector(`#log-data-${id} .old-data`).textContent;
        const newData = document.querySelector(`#log-data-${id} .new-data`).textContent;

        document.getElementById('modalOldData').textContent = oldData !== 'null' ? oldData : 'N/A';
        document.getElementById('modalNewData').textContent = newData !== 'null' ? newData : 'N/A';

        document.getElementById('detailsModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
</script>
@endsection